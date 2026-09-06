@php
	$data = ['youtube'=>['YouTube','18.4K subscribers · 28 videos published by agents',[['Views (30d)','142K','+18% vs last month'],['Subscribers','18.4K','+310 this month'],['Avg. watch time','41s','Video format'],['Scheduled','3','Next: Sat 10:00 AM']]], 'facebook'=>['Facebook','9.2K followers · 15 posts published by agents',[['Reach (30d)','58K','+9% vs last month'],['Followers','9.2K','+64 this month'],['Engagement rate','4.1%','Above page average'],['Needs review','1','Facebook agent']]], 'instagram'=>['Instagram','12.8K followers · 24 posts published by agents',[['Reach (30d)','86K','+14% vs last month'],['Followers','12.8K','+420 this month'],['Engagement rate','5.8%','Above page average'],['Scheduled','4','Next: Mon 9:00 AM']]], 'tiktok'=>['TikTok','32.7K followers · 31 videos published by agents',[['Views (30d)','406K','+27% vs last month'],['Followers','32.7K','+1.2K this month'],['Avg. completion','68%','Best-performing platform'],['Awaiting upload','1','TikTok agent']]]][$platform];
	$account = $socialAccounts->firstWhere('platform', $platform);
	$handle = $account?->handle ?? 'Not connected';
@endphp
<section class="page-section" id="page-{{ $platform }}">
	<div class="plat-hero">
		<div class="plat-hero-icon platform-logo platform-{{ $platform }}" aria-label="{{ $data[0] }} logo"><svg width="48" height="48"><use href="#ico-{{ $platform }}"/></svg></div>
		<div class="plat-hero-info">
			<div class="handle">{{ $handle }}</div>
			<div class="desc">{{ $account ? $data[1] : 'Connect this account to publish through AgentHub.' }}</div>
			<div class="platform-status {{ $account ? 'is-connected' : 'is-disconnected' }}">{{ $account ? '● Connected · publishing access enabled' : 'Not connected' }}</div>
		</div>
		@if($account)
			<form method="POST" action="{{ route('social.disconnect', $account) }}">@csrf @method('DELETE')<button class="btn-sm" type="submit">Disconnect</button></form>
		@else
			<a class="btn-sm primary" href="{{ route('social.redirect', $platform) }}">Connect</a>
		@endif
	</div>
	<div class="stats-grid">@foreach ($data[2] as $stat)<div class="stat-card"><div class="label">{{ $stat[0] }}</div><div class="value">{{ $stat[1] }}</div><div class="sub {{ $loop->last ? 'warn' : '' }}">{{ $stat[2] }}</div></div>@endforeach</div>
	<div class="card-title page-heading"><svg width="16" height="16"><use href="#ico-{{ $platform === 'facebook' ? 'photo' : 'video' }}"/></svg> Recent {{ $platform === 'facebook' ? 'posts' : 'uploads' }}</div><div class="post-grid">@foreach (['Product teaser · Fall collection','Customer testimonial highlight reel','Studio tour with the design team'] as $post)<article class="post-tile"><div class="post-tile-thumb"><svg width="26" height="26"><use href="#ico-{{ $platform === 'facebook' ? 'photo' : 'video' }}"/></svg></div><div class="post-tile-body"><div class="title">{{ $post }}</div><div class="post-tile-stats">Views 24.1K　 Likes 1.8K</div></div></article>@endforeach</div>
</section>