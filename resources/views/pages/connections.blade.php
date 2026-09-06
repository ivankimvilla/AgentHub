@php
	$platforms = ['youtube' => ['YouTube', 'Connect a Google/YouTube channel'], 'facebook' => ['Facebook', 'Connect a Facebook Page'], 'instagram' => ['Instagram', 'Connect an Instagram Business or Creator account'], 'tiktok' => ['TikTok', 'Connect a TikTok account']];
@endphp
<section class="page-section" id="page-connections">
	<div class="section-row"><div><h2>Connected accounts</h2><p>Authorize the platforms that AgentHub may publish to.</p></div></div>
	@if(session('error'))<div class="card connection-error">{{ session('error') }}</div>@endif
	@foreach($platforms as $platform => [$name, $description])
		@forelse($socialAccounts->where('platform', $platform) as $account)
			<div class="conn-card"><div class="conn-card-icon platform-logo platform-{{ $platform }}" aria-label="{{ $name }} logo"><svg width="42" height="42"><use href="#ico-{{ $platform }}"/></svg></div><div class="conn-card-info"><div class="name">{{ $account->handle }}</div><div class="meta">● Connected · publishing access enabled</div></div><button class="btn-sm" data-action="manage">Manage</button><form method="POST" action="{{ route('social.disconnect', $account) }}">@csrf @method('DELETE')<button class="btn-sm" type="submit">Disconnect</button></form></div>
		@empty
			<div class="conn-card unconnected"><div class="conn-card-icon platform-logo platform-{{ $platform }}" aria-label="{{ $name }} logo"><svg width="42" height="42"><use href="#ico-{{ $platform }}"/></svg></div><div class="conn-card-info"><div class="name">{{ $name }}</div><div class="meta">{{ $description }} · Not connected</div></div><a class="btn-sm primary" href="{{ route('social.redirect', $platform) }}">Connect with {{ $name }}</a></div>
		@endforelse
	@endforeach
	<div class="card connection-note"><strong>Secure authorization</strong><span>You will sign in on the platform itself. AgentHub never asks you to paste a password or access token.</span></div>
</section>