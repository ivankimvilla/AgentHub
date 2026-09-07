<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgentHub - Login or Sign Up</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@600;700&display=swap');
        :root { --bg:#0f1118; --card:#181c27; --ink:#eef0f7; --muted:#929aaf; --line:rgba(255,255,255,.1); --primary:#756df7; --blue:#477df7; }
        * { box-sizing:border-box; } body { min-height:100vh; margin:0; display:grid; place-items:center; overflow:auto; isolation:isolate; color:var(--ink); font-family:'DM Sans',sans-serif; background:radial-gradient(circle at 75% 46%,rgba(69,87,255,.12),transparent 34%),radial-gradient(circle at 15% 90%,rgba(108,85,255,.08),transparent 30%),var(--bg); } a { color:inherit; text-decoration:none; }
        .auth-home-bg { position:fixed; z-index:0; inset:0; display:block; width:100%; height:100%; border:0; pointer-events:none; transform:translateZ(0); }
        .auth-backdrop { position:fixed; z-index:1; inset:0; background:rgba(8,12,25,.34); backdrop-filter:blur(7px); -webkit-backdrop-filter:blur(7px); }
        .auth-shell { position:relative; z-index:2; width:min(520px,calc(100% - 56px)); }
        .auth-close { position:absolute; z-index:2; top:14px; right:15px; display:grid; place-items:center; width:32px; height:32px; border:1px solid rgba(255,255,255,.12); border-radius:50%; color:#b8c2d8; background:rgba(255,255,255,.04); transition:color .18s ease,background .18s ease,border-color .18s ease; }
        .auth-close:hover { border-color:rgba(255,255,255,.3); color:#fff; background:rgba(255,255,255,.1); }
        .auth-close svg { width:15px; height:15px; }
        .auth-promo { display:none; } .social.facebook { display:none; }
        .auth-promo { padding:18px 0; } .promo-eyebrow { color:#9fa8ff; font-size:12px; font-weight:700; letter-spacing:.12em; text-transform:uppercase; } .auth-promo h2 { max-width:480px; margin:14px 0 15px; font:700 clamp(38px,5vw,64px)/.98 'Space Grotesk',sans-serif; letter-spacing:-.06em; } .auth-promo h2 span { background:linear-gradient(90deg,#43d9f4,#7d75ff,#b469ff); -webkit-background-clip:text; background-clip:text; -webkit-text-fill-color:transparent; } .promo-copy { max-width:440px; margin:0; color:#a1b5d5; font-size:15px; line-height:1.65; } .promo-list { display:grid; gap:10px; margin:24px 0 0; padding:0; list-style:none; color:#cbd8ee; font-size:13px; } .promo-list li { display:flex; align-items:center; gap:9px; } .promo-list li:before { content:'✓'; display:grid; place-items:center; width:20px; height:20px; border-radius:50%; color:#fff; background:linear-gradient(135deg,#756df7,#477df7); font-size:11px; }
        .auth-card { padding:28px 40px 24px; border:1px solid rgba(83,126,214,.34); border-radius:16px; background:linear-gradient(145deg,rgba(24,36,67,.82),rgba(13,23,46,.9)); box-shadow:0 22px 70px rgba(0,0,0,.3),inset 0 0 35px rgba(64,108,210,.06); }
        .card-brand { display:flex; align-items:center; justify-content:center; gap:8px; margin-bottom:15px; color:var(--ink); font:700 14px 'Space Grotesk',sans-serif; } .card-brand .mark { display:grid; place-items:center; width:25px; height:25px; border-radius:7px; color:#fff; background:#6658f5; } .mark svg { width:15px; height:15px; } .card-brand-name .brand-accent { color:#8b72ff; }
        h1 { margin:0 0 22px; text-align:center; font:700 28px 'Space Grotesk',sans-serif; } .form { max-width:none; margin:0; } .field { margin-bottom:13px; } label { position:absolute; width:1px; height:1px; overflow:hidden; clip:rect(0,0,0,0); } input { width:100%; height:48px; padding:0 15px; border:1px solid #34517f; border-radius:9px; outline:0; color:var(--ink); background:rgba(13,24,48,.72); font:14px inherit; } input::placeholder { color:#9aaed2; } input:focus { border-color:#7178f8; box-shadow:0 0 0 3px rgba(117,109,247,.14); } .password-field { position:relative; } .password-field input { padding-right:38px; } .password-field button { position:absolute; right:12px; top:15px; width:18px; height:18px; padding:0; border:0; color:#98acd0; background:transparent; font-size:11px; cursor:pointer; }
        .forgot { display:block; margin:6px 0 14px; color:#8996ff; font-size:12px; text-align:center; } .submit { width:100%; height:48px; border:0; border-radius:9px; color:#fff; background:linear-gradient(100deg,#7448ff,#277ef6); box-shadow:0 10px 25px rgba(70,82,255,.24); font:600 14px inherit; cursor:pointer; } .submit:hover { filter:brightness(1.1); }
        .terms-consent { position:static; display:flex; align-items:flex-start; gap:9px; width:auto; height:auto; margin:2px 0 14px; overflow:visible; clip:auto; color:#a3aec4; font-size:11px; line-height:1.45; } .terms-consent input { flex:0 0 auto; width:15px; height:15px; margin:1px 0 0; accent-color:#756df7; } .terms-consent a { color:#aab1ff; text-decoration:none; }
        .switch { margin:12px 0 19px; color:#a3aec4; font-size:12px; text-align:center; } .switch a { color:#aab1ff; } .or { display:flex; align-items:center; gap:9px; margin:0 0 13px; color:#8792a8; font-size:11px; } .or:before,.or:after { content:''; height:1px; flex:1; background:var(--line); }
        .social { display:flex; align-items:center; justify-content:center; width:100%; height:44px; margin-bottom:10px; border:1px solid #dfe3ea; border-radius:8px; color:#354052; background:#fff; font:600 13px inherit; cursor:pointer; } .social.facebook { color:#354052; border-color:#dfe3ea; background:#fff; } .social .social-icon { display:grid; place-items:center; width:20px; height:20px; margin-right:9px; border-radius:50%; color:#fff; background:#1877f2; font-weight:700; } .social.google .social-icon { color:#4285f4; background:transparent; font-size:17px; } .google-mark svg,.facebook-mark svg { display:block; width:20px; height:20px; }
        .message { max-width:225px; margin:0 auto 12px; color:#fca5a5; font-size:11px; text-align:center; } .success-message { max-width:280px; margin:0 auto 12px; color:#a7e4b5; font-size:11px; text-align:center; } .back { display:block; margin-top:18px; color:#aeb7ca; font-size:11px; text-align:center; }
        .auth-card.is-hidden { display:none; }
        @media(max-width:680px) { body { padding:24px 0; } .auth-shell { width:min(420px,calc(100% - 32px)); } .auth-card { padding:26px 24px 22px; } }
    </style>
</head>
<body>
    <iframe class="auth-home-bg" src="{{ route('home') }}" title="AgentHub home page background"></iframe>
    <div class="auth-backdrop" aria-hidden="true"></div>
    <main class="auth-shell" data-initial="{{ request()->routeIs('login') ? 'login' : 'signup' }}">
        <a class="auth-close" href="{{ route('home') }}" aria-label="Close authentication" title="Close">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"/></svg>
        </a>
        <section class="auth-promo">
            <span class="promo-eyebrow">Your social publishing workspace</span>
            <h2>Manage your content <span>in one place.</span></h2>
            <p class="promo-copy">Create your AgentHub account and bring your content, approvals, schedules, and social platforms into one focused workspace.</p>
            <ul class="promo-list"><li>Upload once and share everywhere</li><li>Review and approve every post</li><li>Publish across connected platforms</li></ul>
        </section>
        <section class="auth-card login-card {{ request()->routeIs('login') ? '' : 'is-hidden' }}" id="login-card">
            <div class="card-brand"><span class="mark"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="10" rx="2"/><circle cx="12" cy="5" r="2"/><line x1="12" y1="7" x2="12" y2="11"/><path d="M8 15h.01M12 15h.01M16 15h.01" stroke-width="2.5"/></svg></span><span class="card-brand-name">Agent<span class="brand-accent">Hub</span></span></div>
            <h1>Login</h1>
            @if(session('status'))<div class="success-message">{{ session('status') }}</div>@endif
            @if($errors->any())<div class="message">{{ $errors->first() }}</div>@endif
            <form class="form" method="POST" action="{{ route('login.submit') }}">
                @csrf
                <div class="field"><label for="login-email">Email</label><input id="login-email" name="email" type="email" placeholder="Email" value="{{ old('email') }}" autocomplete="email" required></div>
                <div class="field password-field"><label for="login-password">Password</label><input id="login-password" name="password" type="password" placeholder="Password" autocomplete="current-password" required><button type="button" data-toggle-password="login-password">◉</button></div>
                <a class="forgot" href="{{ route('password.request') }}">Forgot password?</a>
                <button class="submit" type="submit">Login</button>
            </form>
            <p class="switch">Don't have an account? <a href="#signup" data-auth-switch="signup">Signup</a></p>
            <div class="or"><span>Or</span></div>
            <button class="social facebook" type="button"><span class="social-icon facebook-mark" aria-hidden="true"><svg viewBox="0 0 24 24"><rect width="24" height="24" rx="4" fill="#1877F2"/><path fill="#fff" d="M16.7 8H14V6.5c0-.7.5-.9 1-.9h1.7V3h-2.3C11.7 3 11 4.8 11 6.4V8H9v2.7h2V21h3v-10.3h2.2L16.7 8z"/></svg></span>Login with Facebook</button>
            <button class="social google" type="button"><span class="social-icon google-mark" aria-hidden="true"><svg viewBox="0 0 24 24"><path fill="#4285F4" d="M21.35 12.27c0-.72-.06-1.42-.18-2.09H12v3.96h5.24a4.48 4.48 0 0 1-1.94 2.94v2.45h3.14c1.84-1.69 2.91-4.18 2.91-7.26Z"/><path fill="#34A853" d="M12 21.7c2.63 0 4.84-.87 6.45-2.36l-3.14-2.45c-.87.58-1.98.92-3.31.92-2.54 0-4.7-1.72-5.47-4.03H3.28v2.53A9.74 9.74 0 0 0 12 21.7Z"/><path fill="#FBBC05" d="M6.53 13.78a5.85 5.85 0 0 1 0-3.56V7.69H3.28a9.73 9.73 0 0 0 0 8.62l3.25-2.53Z"/><path fill="#EA4335" d="M12 6.19c1.43 0 2.72.49 3.73 1.46l2.8-2.8C16.84 3.27 14.63 2.3 12 2.3a9.74 9.74 0 0 0-8.72 5.39l3.25 2.53C7.3 7.91 9.46 6.19 12 6.19Z"/></svg></span>Login with Google</button>
        </section>
        <section class="auth-card signup-card {{ request()->routeIs('login') ? 'is-hidden' : '' }}" id="signup-card">
            <div class="card-brand"><span class="mark"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="10" rx="2"/><circle cx="12" cy="5" r="2"/><line x1="12" y1="7" x2="12" y2="11"/><path d="M8 15h.01M12 15h.01M16 15h.01" stroke-width="2.5"/></svg></span><span class="card-brand-name">Agent<span class="brand-accent">Hub</span></span></div>
            <h1>Signup</h1>
            @if($errors->any())<div class="message">{{ $errors->first() }}</div>@endif
            <form class="form" method="POST" action="{{ route('get-started.submit') }}">
                @csrf
                <div class="field"><label for="signup-email">Email</label><input id="signup-email" name="email" type="email" placeholder="Email" value="{{ old('email') }}" autocomplete="email" required></div>
                <div class="field password-field"><label for="signup-password">Create password</label><input id="signup-password" name="password" type="password" placeholder="Create password" autocomplete="new-password" required><button type="button" data-toggle-password="signup-password">◉</button></div>
                <div class="field password-field"><label for="signup-confirmation">Confirm password</label><input id="signup-confirmation" name="password_confirmation" type="password" placeholder="Confirm password" autocomplete="new-password" required><button type="button" data-toggle-password="signup-confirmation">◉</button></div>
                <label class="terms-consent"><input type="checkbox" name="terms" value="1" @checked(old('terms')) required> <span>I agree to the <a href="{{ route('terms') }}" target="_blank" rel="noopener">Terms &amp; Conditions</a> and <a href="{{ route('privacy') }}" target="_blank" rel="noopener">Privacy Policy</a>.</span></label>
                <button class="submit" type="submit">Sign up</button>
            </form>
            <p class="switch">Already have an account? <a href="#login" data-auth-switch="login">Login</a></p>
            <div class="or"><span>Or</span></div>
            <button class="social facebook" type="button"><span class="social-icon facebook-mark" aria-hidden="true"><svg viewBox="0 0 24 24"><rect width="24" height="24" rx="4" fill="#1877F2"/><path fill="#fff" d="M16.7 8H14V6.5c0-.7.5-.9 1-.9h1.7V3h-2.3C11.7 3 11 4.8 11 6.4V8H9v2.7h2V21h3v-10.3h2.2L16.7 8z"/></svg></span>Login with Facebook</button>
            <button class="social google" type="button"><span class="social-icon google-mark" aria-hidden="true"><svg viewBox="0 0 24 24"><path fill="#4285F4" d="M21.35 12.27c0-.72-.06-1.42-.18-2.09H12v3.96h5.24a4.48 4.48 0 0 1-1.94 2.94v2.45h3.14c1.84-1.69 2.91-4.18 2.91-7.26Z"/><path fill="#34A853" d="M12 21.7c2.63 0 4.84-.87 6.45-2.36l-3.14-2.45c-.87.58-1.98.92-3.31.92-2.54 0-4.7-1.72-5.47-4.03H3.28v2.53A9.74 9.74 0 0 0 12 21.7Z"/><path fill="#FBBC05" d="M6.53 13.78a5.85 5.85 0 0 1 0-3.56V7.69H3.28a9.73 9.73 0 0 0 0 8.62l3.25-2.53Z"/><path fill="#EA4335" d="M12 6.19c1.43 0 2.72.49 3.73 1.46l2.8-2.8C16.84 3.27 14.63 2.3 12 2.3a9.74 9.74 0 0 0-8.72 5.39l3.25 2.53C7.3 7.91 9.46 6.19 12 6.19Z"/></svg></span>Login with Google</button>
        </section>
    </main>
    <script>
        const authShell = document.querySelector('.auth-shell');
        const authCards = { login: document.getElementById('login-card'), signup: document.getElementById('signup-card') };
        document.querySelectorAll('[data-auth-switch]').forEach(link => link.addEventListener('click', event => {
            event.preventDefault();
            const mode = link.dataset.authSwitch;
            Object.entries(authCards).forEach(([key, card]) => card.classList.toggle('is-hidden', key !== mode));
            history.replaceState(null, '', `#${mode}`);
        }));
        document.querySelectorAll('[data-toggle-password]').forEach(button => {
            button.addEventListener('click', () => {
                const input = document.getElementById(button.dataset.togglePassword);
                input.type = input.type === 'password' ? 'text' : 'password';
            });
        });
        document.querySelectorAll('.social.google').forEach(button => button.addEventListener('click', () => {
            window.location.href = @json(route('social.login.redirect', 'google'));
        }));
        document.querySelectorAll('.social.google').forEach(button => {
            button.lastChild.textContent = 'Continue with Google';
        });
    </script>
</body>
</html>
