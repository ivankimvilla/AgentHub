<?php

namespace Tests\Feature;

use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SocialAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_configured_provider_redirect_starts_oauth_flow(): void
    {
        $this->actingAs(User::factory()->create());

        config([
            'services.youtube.client_id' => 'youtube-client',
            'services.youtube.client_secret' => 'youtube-secret',
        ]);

        $response = $this->get(route('social.redirect', 'youtube'));

        $response->assertRedirect();
        $this->assertStringContainsString('accounts.google.com', $response->headers->get('Location'));
    }

    public function test_social_tokens_are_encrypted_in_storage(): void
    {
        $account = SocialAccount::create([
            'platform' => 'youtube',
            'handle' => 'channel@example.com',
            'access_token' => ['access_token' => 'secret-token', 'refresh_token' => 'refresh-token'],
        ]);

        $raw = $account->getRawOriginal('access_token');
        $this->assertNotSame('secret-token', $raw);
        $this->assertSame('secret-token', $account->fresh()->access_token['access_token']);
    }

    public function test_instagram_uses_the_meta_oauth_flow(): void
    {
        $this->actingAs(User::factory()->create());

        config([
            'services.instagram.client_id' => 'meta-client',
            'services.instagram.client_secret' => 'meta-secret',
        ]);

        $response = $this->get(route('social.redirect', 'instagram'));

        $response->assertRedirect();
        $this->assertStringContainsString('facebook.com', $response->headers->get('Location'));
        $this->assertStringContainsString('instagram_content_publish', $response->headers->get('Location'));
    }

}
