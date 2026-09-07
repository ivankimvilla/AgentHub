<section class="page-section active" id="page-dashboard">
    <div class="stats-grid">
        <div class="stat-card"><div class="label"><svg width="14" height="14"><use href="#ico-robot"/></svg> Active agents</div><div class="value">4</div><div class="sub">2 running now</div></div>
        <div class="stat-card"><div class="label"><svg width="14" height="14"><use href="#ico-send"/></svg> Posts published</div><div class="value">128</div><div class="sub">+12 this week</div></div>
        <div class="stat-card"><div class="label"><svg width="14" height="14"><use href="#ico-clock"/></svg> In queue</div><div class="value">7</div><div class="sub warn">3 need review</div></div>
        <div class="stat-card"><div class="label"><svg width="14" height="14"><use href="#ico-world"/></svg> Platforms</div><div class="value">3</div><div class="sub muted platform-stat-sub" aria-label="YouTube, Facebook, and TikTok"><svg width="14" height="14"><use href="#ico-youtube"/></svg><svg width="14" height="14"><use href="#ico-facebook"/></svg><svg width="14" height="14"><use href="#ico-tiktok"/></svg></div></div>
    </div>
    <div class="two-col">
        <div class="card upload-card">
            <div class="card-title"><svg width="16" height="16"><use href="#ico-sparkles"/></svg> Upload &amp; write posting copy</div>
            <button class="upload-zone" data-action="upload"><svg width="36" height="36" class="upload-svg"><use href="#ico-cloud-upload"/></svg><p>Drop image or video here</p><small>JPG, PNG, MP4, MOV · max 2 GB</small></button>
            <div class="upload-form-grid"><div><label class="form-label" for="dashboard-agent">Assign agent</label><select id="dashboard-agent" name="dashboard_agent"><option>Multi-platform agent</option><option>YouTube agent</option><option>Facebook agent</option><option>TikTok agent</option></select></div><div><span class="form-label">Publish to</span><div class="platform-checks"><span class="plat-check sel-yt"><svg width="14" height="14"><use href="#ico-youtube"/></svg> YouTube</span><span class="plat-check sel-fb"><svg width="14" height="14"><use href="#ico-facebook"/></svg> Facebook</span><span class="plat-check sel-tk"><svg width="14" height="14"><use href="#ico-tiktok"/></svg> TikTok</span></div></div></div>
            <div class="upload-actions"><button class="btn" data-action="upload">Save as draft</button><button class="btn primary" data-action="upload"><svg width="15" height="15"><use href="#ico-sparkles"/></svg> Write caption &amp; hashtags</button></div>
        </div>
        <div class="stack">
            <div class="card"><div class="card-title"><svg width="16" height="16"><use href="#ico-robot"/></svg> Active agents</div>
                @foreach ([['Multi-platform','Generating caption…','green',['youtube','facebook','tiktok']],['TikTok agent','Awaiting upload','green',['tiktok']],['YouTube agent','Scheduled · 3 posts','blue',['youtube']],['Facebook agent','Needs review','amber',['facebook']]] as $agent)
                    <div class="agent-row"><span class="agent-dot dot-{{ $agent[2] }}"></span><div class="agent-info"><div class="name">{{ $agent[0] }}</div><div class="desc">{{ $agent[1] }}</div></div><div class="plat-tags">@foreach($agent[3] as $platform)<span class="tag tag-{{ $platform === 'youtube' ? 'yt' : ($platform === 'facebook' ? 'fb' : 'tk') }}"><svg width="13" height="13"><use href="#ico-{{ $platform }}"/></svg></span>@endforeach</div></div>
                @endforeach
            </div>
            <div class="card"><div class="card-title"><svg width="16" height="16"><use href="#ico-plug"/></svg> Connected accounts</div><div class="connected-list">
                @forelse($socialAccounts as $account)
                    <div><span class="conn-dot"></span><svg width="16" height="16"><use href="#ico-{{ $account->platform }}"/></svg><span>{{ $account->handle }}</span></div>
                @empty
                    <div class="connected-empty">No connected accounts yet.</div>
                @endforelse
            </div></div>
        </div>
    </div>
    @include('partials.queue-list', ['limit' => 4, 'showAll' => true])
</section>
