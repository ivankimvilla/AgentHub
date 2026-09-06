<aside class="sidebar">
    <div class="sidebar-logo"><div class="logo-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="10" rx="2"/><circle cx="12" cy="5" r="2"/><line x1="12" y1="7" x2="12" y2="11"/><path d="M8 15h.01M12 15h.01M16 15h.01" stroke-width="2.5"/></svg></div><div class="logo-text">Agent<span>Hub</span></div></div>
    <div class="nav-section-label">Main</div>
    @foreach ([['dashboard','ico-dashboard','Dashboard'],['agents','ico-robot','Agents'],['schedule','ico-calendar','Schedule'],['queue','ico-clock','Queue']] as $item)
        <button class="nav-item {{ $loop->first ? 'active' : '' }}" data-page="{{ $item[0] }}"><svg class="nav-icon" width="17" height="17"><use href="#{{ $item[1] }}"/></svg>{{ $item[2] }}@if($item[0] === 'queue')<span class="nav-badge">3</span>@endif</button>
    @endforeach
    <div class="nav-section-label">Publishing</div>
    @foreach ([['youtube','ico-youtube','YouTube'],['facebook','ico-facebook','Facebook'],['instagram','ico-instagram','Instagram'],['tiktok','ico-tiktok','TikTok']] as $item)
        <button class="nav-item" data-page="{{ $item[0] }}"><svg class="nav-icon" width="17" height="17"><use href="#{{ $item[1] }}"/></svg>{{ $item[2] }}</button>
    @endforeach
    <div class="nav-section-label">Settings</div>
    @foreach ([['connections','ico-plug','Connections'],['settings','ico-settings','Settings']] as $item)
        <button class="nav-item" data-page="{{ $item[0] }}"><svg class="nav-icon" width="17" height="17"><use href="#{{ $item[1] }}"/></svg>{{ $item[2] }}</button>
    @endforeach
</aside>
