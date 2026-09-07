<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgentHub - Get Started</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@600;700&display=swap');
        :root { --bg:#0f1118; --panel:#181c27; --line:rgba(255,255,255,.1); --text:#eef0f7; --muted:#929aaf; --accent:#756df7; --blue:#477df7; }
        * { box-sizing:border-box; } body { min-height:100vh; margin:0; color:var(--text); font-family:'DM Sans',sans-serif; background:radial-gradient(circle at 80% 15%,rgba(79,77,245,.2),transparent 34%),#0f1118; } a { color:inherit; text-decoration:none; }
        .page { width:min(1120px,calc(100% - 40px)); min-height:100vh; margin:0 auto; display:grid; grid-template-columns:1fr 420px; align-items:center; gap:90px; }
        .brand { display:flex; align-items:center; gap:11px; margin-bottom:38px; font:700 20px 'Space Grotesk',sans-serif; } .brand-mark { display:grid; place-items:center; width:40px; height:40px; border-radius:10px; background:#6658f5; } .brand-mark svg { width:23px; height:23px; }
        .eyebrow { color:#9fa8ff; font-size:13px; font-weight:700; letter-spacing:.08em; text-transform:uppercase; } h1 { margin:13px 0 12px; font:700 clamp(40px,5vw,66px)/.98 'Space Grotesk',sans-serif; letter-spacing:-.055em; } .copy p { max-width:520px; margin:0; color:var(--muted); line-height:1.65; font-size:16px; }
        .form-card { padding:30px; border:1px solid var(--line); border-radius:16px; background:rgba(24,28,39,.9); box-shadow:0 20px 70px rgba(0,0,0,.28); } .form-card h2 { margin:0 0 5px; font:700 24px 'Space Grotesk',sans-serif; } .form-card > p { margin:0 0 24px; color:var(--muted); font-size:13px; }
        .field { margin-bottom:16px; } label { display:block; margin-bottom:7px; color:#cbd1df; font-size:12px; font-weight:600; } input { width:100%; height:42px; padding:0 12px; border:1px solid #343c50; border-radius:8px; outline:0; color:var(--text); background:#131722; font:inherit; } input:focus { border-color:#7178f8; box-shadow:0 0 0 3px rgba(117,109,247,.12); } .terms-consent { display:flex; align-items:flex-start; gap:8px; margin:4px 0 14px; color:#8f98ac; font-size:11px; line-height:1.45; } .terms-consent input { flex:0 0 auto; width:15px; height:15px; margin:1px 0 0; accent-color:var(--accent); } .terms-consent a { color:#aab1ff; text-decoration:none; } .submit { width:100%; height:44px; margin-top:7px; border:0; border-radius:8px; color:#fff; background:linear-gradient(90deg,var(--accent),var(--blue)); font:600 14px inherit; cursor:pointer; } .fine-print { margin:15px 0 0; color:#71798d; font-size:11px; line-height:1.5; text-align:center; } .back { display:inline-block; margin-top:25px; color:#aeb7ca; font-size:13px; } .back:hover { color:#fff; }
        @media(max-width:800px) { .page { grid-template-columns:1fr; gap:35px; padding:36px 0; } .brand { margin-bottom:25px; } .form-card { max-width:520px; } }
    </style>
</head>
<body>
    <main class="page">
        <section class="copy">
            <div class="brand" aria-label="AgentHub"><span class="brand-mark"><svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="11" width="18" height="10" rx="2"/><circle cx="12" cy="5" r="2"/><line x1="12" y1="7" x2="12" y2="11"/><path d="M8 15h.01M12 15h.01M16 15h.01" stroke-width="2.5"/></svg></span>Agent<span style="color:#8b72ff">Hub</span></div>
            <span class="eyebrow">Start publishing with clarity</span>
            <h1>Your content operation starts here.</h1>
            <p>Create your AgentHub workspace and bring your social publishing workflow into one focused place.</p>
            <a class="back" href="{{ route('home') }}">← Back to home</a>
        </section>
        <section class="form-card">
            <h2>Create your workspace</h2>
            <p>Set up your account details to get started.</p>
            @if($errors->any())<div style="margin:0 0 18px;color:#fca5a5;font-size:13px">{{ $errors->first() }}</div>@endif
            <form method="POST" action="{{ route('get-started.submit') }}">
                @csrf
                <div class="field"><label for="full-name">Full name</label><input id="full-name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required></div>
                <div class="field"><label for="email">Work email</label><input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required></div>
                <div class="field"><label for="password">Password</label><input id="password" name="password" type="password" autocomplete="new-password" required></div>
                <div class="field"><label for="password-confirmation">Confirm password</label><input id="password-confirmation" name="password_confirmation" type="password" autocomplete="new-password" required></div>
                <label class="terms-consent"><input type="checkbox" name="terms" value="1" @checked(old('terms')) required> <span>I agree to the <a href="{{ route('terms') }}" target="_blank" rel="noopener">Terms &amp; Conditions</a> and <a href="{{ route('privacy') }}" target="_blank" rel="noopener">Privacy Policy</a>.</span></label>
                <button class="submit" type="submit">Create workspace</button>
            </form>
            <p class="fine-print">By continuing, you agree to AgentHub's terms and privacy policy.<br><a href="{{ route('login') }}" style="display:inline-block;margin-top:10px;color:#aeb7ff">Already have an account? Login</a></p>
        </section>
    </main>
</body>
</html>
