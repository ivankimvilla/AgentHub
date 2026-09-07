<?php

namespace App\Http\Controllers;

use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use RuntimeException;

class SocialAuthController extends Controller
{
    private array $providers = ['youtube', 'facebook', 'instagram', 'tiktok'];

    private array $loginProviders = ['google', 'facebook'];

    public function loginRedirect(string $platform, Request $request): RedirectResponse
    {
        abort_unless(in_array($platform, $this->loginProviders, true), 404);
        $config = config("services.{$platform}");
        abort_unless(filled($config['client_id'] ?? null) && filled($config['client_secret'] ?? null), 503, "{$platform} login is not configured.");
        $config['redirect'] = $config['login_redirect'] ?? $config['redirect'];

        $state = Str::random(40);
        $request->session()->put("social_login.{$state}", ['platform' => $platform, 'expires_at' => now()->addMinutes(10)]);

        return redirect()->away($this->authorizationUrl($platform, $config, $state));
    }

    public function loginCallback(string $platform, Request $request): RedirectResponse
    {
        abort_unless(in_array($platform, $this->loginProviders, true), 404);
        $state = $request->session()->pull("social_login.{$request->string('state')}");
        abort_unless($state && $state['platform'] === $platform && now()->lessThan($state['expires_at']), 419, 'The social login session expired.');

        if ($request->filled('error')) {
            return redirect()->route('login')->withErrors(['email' => 'Social login was cancelled.']);
        }

        $token = $this->exchangeCode($platform, $request->string('code')->toString());
        $profile = $this->loginProfile($platform, $token['access_token']);
        if (! $profile['verified']) {
            return redirect()->route('login')->withErrors(['email' => 'Please use a verified Google email address to continue.']);
        }

        $user = User::firstOrCreate(
            ['email' => $profile['email']],
            ['name' => $profile['name'], 'password' => Str::random(40), 'login_provider' => $platform, 'avatar_url' => $profile['avatar_url']],
        );
        $user->forceFill([
            'name' => $profile['name'],
            'email_verified_at' => now(),
            'login_provider' => $platform,
            'avatar_url' => $profile['avatar_url'],
        ])->save();

        Auth::login($user, true);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    public function redirect(string $platform, Request $request): RedirectResponse
    {
        abort_unless(in_array($platform, $this->providers, true), 404);
        $config = config("services.{$platform}");
        abort_unless(filled($config['client_id'] ?? null) && filled($config['client_secret'] ?? null), 503, "{$platform} OAuth is not configured.");

        $state = Str::random(40);
        Cache::put("social_oauth.{$state}", [
            'platform' => $platform,
            'user_id' => auth()->id(),
        ], now()->addMinutes(10));

        return redirect()->away($this->authorizationUrl($platform, $config, $state));
    }

    public function callback(string $platform, Request $request): RedirectResponse
    {
        abort_unless(in_array($platform, $this->providers, true), 404);
        $state = Cache::pull("social_oauth.{$request->string('state')}");
        if (! $state || $state['platform'] !== $platform) {
            return redirect()->route('dashboard')->with('error', 'The Facebook connection session expired. Please try again.');
        }

        if ($request->filled('error')) {
            return redirect()->route('dashboard')->with('error', 'The social account connection was cancelled.');
        }

        $token = $this->exchangeCode($platform, $request->string('code')->toString());
        $profile = $this->profile($platform, $token);
        if (isset($profile['token'])) {
            $token['access_token'] = $profile['token'];
        }

        SocialAccount::updateOrCreate(
            ['user_id' => $state['user_id'], 'platform' => $platform, 'handle' => $profile['handle']],
            [
                'access_token' => $token,
                'publishing_enabled' => true,
            ],
        );

        return redirect()->route('dashboard')->with('success', "{$profile['name']} is now connected with {$platform} publishing access.");
    }

    public function disconnect(SocialAccount $account): RedirectResponse
    {
        $account->delete();

        return back()->with('success', 'Social account disconnected.');
    }

    private function authorizationUrl(string $platform, array $config, string $state): string
    {
        $query = [
            'client_id' => $config['client_id'],
            'redirect_uri' => $config['redirect'],
            'response_type' => 'code',
            'state' => $state,
            'scope' => implode(' ', $config['scopes']),
        ];

        if ($platform === 'tiktok') {
            $query['client_key'] = $config['client_id'];
            unset($query['client_id']);
        }

        return $config['authorize'].'?'.http_build_query($query);
    }

    private function exchangeCode(string $platform, string $code): array
    {
        $config = config("services.{$platform}");
        $payload = [
            'code' => $code,
            'client_secret' => $config['client_secret'],
            'redirect_uri' => $config['redirect'],
        ];

        if ($platform === 'tiktok') {
            $payload['client_key'] = $config['client_id'];
            $response = Http::asForm()->post($config['token'], $payload);
        } elseif (in_array($platform, ['youtube', 'google'], true)) {
            $payload['client_id'] = $config['client_id'];
            $payload['grant_type'] = 'authorization_code';
            $response = Http::asForm()->post($config['token'], $payload);
        } else {
            $response = Http::get($config['token'], array_merge($payload, ['client_id' => $config['client_id']]));
        }

        return tap($response->throw()->json(), function (array $data): void {
            if (blank($data['access_token'] ?? null)) {
                throw new RuntimeException('The platform did not return an access token.');
            }
        });
    }

    private function loginProfile(string $platform, string $accessToken): array
    {
        if ($platform === 'google') {
            $data = Http::withToken($accessToken)->get('https://www.googleapis.com/oauth2/v2/userinfo')->throw()->json();

            return [
                'name' => $data['name'] ?? 'AgentHub user',
                'email' => $data['email'] ?? throw new RuntimeException('Google did not return an email address.'),
                'verified' => (bool) ($data['verified_email'] ?? false),
                'avatar_url' => $data['picture'] ?? null,
            ];
        }

        $data = Http::withToken($accessToken)->get('https://graph.facebook.com/v20.0/me', ['fields' => 'id,name,email,picture.type(large)'])->throw()->json();

        return [
            'name' => $data['name'] ?? 'AgentHub user',
            'email' => $data['email'] ?? throw new RuntimeException('Facebook did not return an email address.'),
            'verified' => true,
            'avatar_url' => $data['picture']['data']['url'] ?? null,
        ];
    }

    private function profile(string $platform, array $token): array
    {
        $accessToken = $token['access_token'];
        if ($platform === 'youtube') {
            $data = Http::withToken($accessToken)->get('https://www.googleapis.com/oauth2/v2/userinfo')->throw()->json();
            return ['name' => $data['name'] ?? $data['email'] ?? 'YouTube account', 'handle' => $data['email'] ?? (string) $data['id']];
        }

        if ($platform === 'facebook') {
            $data = Http::get('https://graph.facebook.com/v20.0/me/accounts', ['access_token' => $accessToken, 'fields' => 'id,name,access_token'])->throw()->json();
            $page = $data['data'][0] ?? null;
            if (! $page) throw new RuntimeException('No Facebook Page was granted for this account.');
            return ['name' => $page['name'], 'handle' => 'page:'.$page['id'], 'token' => $page['access_token']];
        }

        if ($platform === 'instagram') {
            $data = Http::get('https://graph.facebook.com/v20.0/me/accounts', [
                'access_token' => $accessToken,
                'fields' => 'id,name,instagram_business_account{id,username,name}',
            ])->throw()->json();
            $instagram = collect($data['data'] ?? [])->pluck('instagram_business_account')->filter()->first();
            if (! $instagram) {
                throw new RuntimeException('No Instagram Business or Creator account linked to a Facebook Page was found.');
            }

            return ['name' => $instagram['name'] ?? $instagram['username'] ?? 'Instagram account', 'handle' => '@'.($instagram['username'] ?? $instagram['id'])];
        }

        $data = Http::withToken($accessToken)->get('https://open.tiktokapis.com/v2/user/info/', ['fields' => 'open_id,display_name'])->throw()->json('data.user');
        return ['name' => $data['display_name'] ?? 'TikTok account', 'handle' => $data['open_id'] ?? throw new RuntimeException('TikTok did not return an account id.')];
    }
}
