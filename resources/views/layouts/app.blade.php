<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgentHub - Dashboard</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        @foreach (['base.css', 'sidebar.css', 'dashboard.css', 'pages.css', 'modals.css', 'agents.css', 'schedule.css', 'queue.css', 'platform.css', 'connections.css', 'settings.css', 'account.css'] as $stylesheet)
            <style>{!! file_get_contents(resource_path('css/agenthub/' . $stylesheet)) !!}</style>
        @endforeach
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const titles = {
                    dashboard: ['Dashboard', 'Saturday, September 5, 2026'],
                    agents: ['Agents', 'Manage your AI publishing agents'],
                    schedule: ['Schedule', 'Manage your publishing calendar'],
                    queue: ['Content queue', '7 items · 3 need review'],
                    youtube: ['YouTube', 'YouTube publishing'],
                    facebook: ['Facebook', 'Facebook publishing'],
                    instagram: ['Instagram', 'Instagram publishing'],
                    tiktok: ['TikTok', 'TikTok publishing'],
                    connections: ['Connections', 'Manage connected social accounts'],
                    settings: ['Settings', 'Configure your AgentHub workspace'],
                    account: ['Account', 'Manage your profile and password']
                };

                function showPage(page) {
                    if (!titles[page]) return;
                    document.getElementById('page-title').textContent = titles[page][0];
                    document.getElementById('page-sub').textContent = titles[page][1];
                    document.title = 'AgentHub - ' + titles[page][0];
                    document.querySelectorAll('.page-section').forEach(section => {
                        section.classList.toggle('active', section.id === 'page-' + page);
                    });
                    document.querySelectorAll('.nav-item').forEach(item => {
                        item.classList.toggle('active', item.dataset.page === page);
                    });
                    document.querySelector('.content').scrollTop = 0;
                    if (window.location.hash !== '#' + page) window.history.replaceState(null, '', '#' + page);
                }

                document.querySelectorAll('[data-page]').forEach(item => {
                    item.addEventListener('click', () => showPage(item.dataset.page));
                });

                const initialPage = window.location.hash.slice(1);
                showPage(titles[initialPage] ? initialPage : 'dashboard');

                document.querySelectorAll('[data-action="toggle"]').forEach(toggle => {
                    toggle.addEventListener('click', () => toggle.classList.toggle('on'));
                });

                document.querySelectorAll('[data-action="upload"], [data-action="connect"], [data-action="review"], [data-action="new-agent"]').forEach(item => {
                    item.addEventListener('click', () => {
                        const action = item.dataset.action;
                        const modal = document.getElementById({upload: 'upload-modal', connect: 'connect-modal', review: 'review-modal', 'new-agent': 'new-agent-modal'}[action]);
                        if (modal) modal.classList.add('active');
                    });
                });

                document.querySelectorAll('[data-action="review"]').forEach(item => item.addEventListener('click', () => {
                    document.getElementById('review-title').textContent = item.dataset.title || 'Content review';
                    document.getElementById('review-caption').value = item.dataset.caption || '';
                    document.getElementById('review-hashtags').value = item.dataset.hashtags || '';
                    document.getElementById('review-form').action = '/content/' + item.dataset.contentId;
                }));

                document.querySelectorAll('.modal-overlay').forEach(overlay => {
                    overlay.addEventListener('click', event => {
                        if (event.target === overlay || event.target.matches('[data-close]')) overlay.classList.remove('active');
                    });
                });

                const passwordFields = document.getElementById('password-fields');
                document.getElementById('password-toggle')?.addEventListener('click', () => {
                    passwordFields.hidden = !passwordFields.hidden;
                });
                document.getElementById('password-cancel')?.addEventListener('click', () => {
                    passwordFields.hidden = true;
                });
                document.getElementById('avatar-upload')?.addEventListener('click', () => document.getElementById('acc-avatar-input').click());
                document.getElementById('acc-avatar-input')?.addEventListener('change', event => {
                    const file = event.target.files[0];
                    if (!file) return;
                    const reader = new FileReader();
                    reader.onload = () => {
                        const avatar = document.getElementById('acc-avatar-preview');
                        avatar.style.backgroundImage = `url(${reader.result})`;
                        avatar.style.backgroundSize = 'cover';
                        avatar.textContent = '';
                    };
                    reader.readAsDataURL(file);
                });
                document.getElementById('twofa-toggle')?.addEventListener('click', () => document.getElementById('twofa-modal').classList.add('active'));
                document.getElementById('twofa-confirm')?.addEventListener('click', () => {
                    if (/^\d{6}$/.test(document.getElementById('twofa-code').value)) {
                        document.getElementById('twofa-modal').classList.remove('active');
                        document.getElementById('twofa-toggle').classList.add('on');
                        document.getElementById('twofa-hint').textContent = 'Enabled · using your authenticator app';
                    } else alert('Please enter the 6-digit code from your authenticator app.');
                });
            });
        </script>
    @endif
</head>
<body>
    @if(session('success'))<div class="toast" role="status">{{ session('success') }}</div>@endif
    @include('partials.icons')
    @include('partials.sidebar')
    <main class="main">
        <header class="topbar">
            <div class="topbar-left"><h1 id="page-title">Dashboard</h1><p id="page-sub">Saturday, September 5, 2026</p></div>
            <div class="topbar-right"><div class="user-menu" id="user-menu">
                @php
                    $currentUser = auth()->user();
                    $userName = $currentUser?->name ?: $currentUser?->email ?: 'AgentHub user';
                    $userInitials = collect(preg_split('/\s+/', trim($userName)))->filter()->take(2)->map(fn ($part) => strtoupper(substr($part, 0, 1)))->implode('');
                @endphp
                <div class="user-menu-panel"><button class="user-menu-item" data-page="account"><svg width="14" height="14"><use href="#ico-robot"/></svg> My Account</button><button class="user-menu-item" data-page="settings"><svg width="14" height="14"><use href="#ico-settings"/></svg> Settings</button></div>
                <button class="user-pill"><div class="avatar">@if($currentUser?->avatar_url)<img src="{{ $currentUser->avatar_url }}" alt="{{ $userName }} profile photo">@else{{ $userInitials }}@endif</div><div class="user-info"><div class="name">{{ $userName }}</div></div></button>
            </div></div>
        </header>
        <div class="content">
            @include('pages.dashboard')
            @include('pages.agents')
            @include('pages.schedule')
            @include('pages.queue')
            @include('pages.platform', ['platform' => 'youtube'])
            @include('pages.platform', ['platform' => 'facebook'])
            @include('pages.platform', ['platform' => 'instagram'])
            @include('pages.platform', ['platform' => 'tiktok'])
            @include('pages.connections')
            @include('pages.settings')
            @include('pages.account')
        </div>
    </main>
    @include('partials.modals')
</body>
</html>
