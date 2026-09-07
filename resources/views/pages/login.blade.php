<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgentHub -Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@600;700&display=swap');
        :root { --text:#eef0f7; --muted:#929aaf; --line:rgba(255,255,255,.1); --accent:#756df7; --blue:#477df7; }
        * { box-sizing:border-box; } body { min-height:100vh; margin:0; display:grid; place-items:center; color:var(--text); font-family:'DM Sans',sans-serif; background:radial-gradient(circle at 20% 10%,rgba(79,77,245,.2),transparent 32%),#0f1118; } a { color:inherit; text-decoration:none; }
        .card { width:min(420px,calc(100% - 36px)); padding:32px; border:1px solid var(--line); border-radius:16px; background:rgba(24,28,39,.92); box-shadow:0 20px 70px rgba(0,0,0,.3); } .brand { display:flex; align-items:center; gap:11px; margin-bottom:30px; font:700 20px 'Space Grotesk',sans-serif; } .mark { display:grid; place-items:center; width:40px; height:40px; border-radius:10px; background:#6658f5; } .mark svg { width:23px; height:23px; } .brand span span { color:#8b72ff; } h1 { margin:0 0 6px; font:700 28px 'Space Grotesk',sans-serif; } .intro { margin:0 0 24px; color:var(--muted); font-size:13px; } .error { margin-bottom:16px; color:#fca5a5; font-size:13px; } .field { margin-bottom:16px; } label { display:block; margin-bottom:7px; color:#cbd1df; font-size:12px; font-weight:600; } input { width:100%; height:42px; padding:0 12px; border:1px solid #343c50; border-radius:8px; outline:0; color:var(--text); background:#131722; font:inherit; } input:focus { border-color:#7178f8; box-shadow:0 0 0 3px rgba(117,109,247,.12); } .submit { width:100%; height:44px; border:0; border-radius:8px; color:#fff; background:linear-gradient(90deg,var(--accent),var(--blue)); font:600 14px inherit; cursor:pointer; } .links { display:flex; justify-content:space-between; margin-top:22px; color:#aeb7ca; font-size:13px; } .links a:hover { color:#fff; }
    </style>
</head>
<body>
    <main class="card">
        <div class="brand" aria-label="AgentHub"><span class="mark"><svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="11" width="18" height="10" rx="2"/><circle cx="12" cy="5" r="2"/><line x1="12" y1="7" x2="12" y2="11"/><path d="M8 15h.01M12 15h.01M16 15h.01" stroke-width="2.5"/></svg></span>Agent<span>Hub</span></div>
        <h1>Welcome back</h1>
        <p class="intro">Log in with your Gmail or any email address and password.</p>
        @if($errors->any())<div class="error">{{ $errors->first() }}</div>@endif
        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <div class="field"><label for="email">Email address</label><input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required></div>
            <div class="field"><label for="password">Password</label><input id="password" name="password" type="password" autocomplete="current-password" required></div>
            <label style="display:flex;align-items:center;gap:8px;margin-bottom:18px;font-weight:400"><input style="width:15px;height:15px" type="checkbox" name="remember" value="1"> Remember me</label>
            <button class="submit" type="submit">Login</button>
        </form>
        <div class="links"><a href="{{ route('home') }}">Back to home</a><a href="{{ route('get-started') }}">Create an account</a></div>
    </main>
</body>
</html>
