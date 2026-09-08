<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgentHub - Privacy Policy</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@600;700&display=swap');
        :root { --ink:#f3f6ff; --muted:#a5adbd; --line:rgba(255,255,255,.1); --accent:#9ca7ff; }
        * { box-sizing:border-box; } body { margin:0; color:var(--ink); background:#0c0f17; font-family:'DM Sans',sans-serif; line-height:1.7; } a { color:inherit; text-decoration:none; }
        .legal-shell { min-height:100vh; } .legal-nav { position:relative; z-index:2; width:min(1280px,calc(100% - 80px)); height:78px; display:flex; align-items:center; margin:0 auto; } .brand { display:flex; align-items:center; gap:11px; color:var(--ink); text-decoration:none; font-family:'Space Grotesk',sans-serif; font-size:20px; font-weight:700; } .brand-mark { display:grid; place-items:center; width:40px; height:40px; margin:0; color:#fff; background:#6658f5; border-radius:10px; } .brand-mark svg { width:23px; height:23px; } .brand-accent { color:#8b72ff; } .legal-main { width:min(820px,calc(100% - 40px)); margin:0 auto; padding:54px 0 70px; } h1,h2 { font-family:'Space Grotesk',sans-serif; letter-spacing:-.045em; line-height:1.1; } h1 { margin:16px 0 8px; font-size:clamp(40px,6vw,60px); } h1 span { color:#9ca7ff; } .legal-intro { max-width:650px; margin:10px 0 0; color:var(--muted); font-size:14px; line-height:1.6; } .legal-copy { margin-top:40px; border-top:1px solid var(--line); } h2 { margin:0; padding-top:28px; font-size:19px; } p,li { color:var(--muted); font-size:14px; text-align:justify; } .legal-copy a { color:#9ca7ff; text-decoration:none; } @media(max-width:520px){.legal-nav{width:calc(100% - 40px);height:68px}.legal-main{padding-top:32px}}
    </style>
</head>
<body>
    <div class="legal-shell">
    <nav class="legal-nav"><a class="brand" href="{{ route('home') }}" aria-label="AgentHub home"><span class="brand-mark"><svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="11" width="18" height="10" rx="2"/><circle cx="12" cy="5" r="2"/><line x1="12" y1="7" x2="12" y2="11"/><path d="M8 15h.01M12 15h.01M16 15h.01" stroke-width="2.5"/></svg></span><span>Agent<span class="brand-accent">Hub</span></span></a></nav>
    <main class="legal-main">
        <h1>Privacy <span>Policy</span></h1>
        <p class="legal-intro">This Privacy Policy explains how AgentHub collects, uses, and protects information when you use the service.</p>
        <div class="legal-copy">
            <h2>What we collect</h2><p>AgentHub may collect account details, workspace settings, content you choose to submit, and technical information needed to keep the service secure and reliable.</p>
            <h2>How we use information</h2><p>We use this information to provide the AgentHub workspace, analyze and organize content at your request, publish to connected platforms, communicate with you about the service, and improve reliability.</p>
            <h2>Connected platforms</h2><p>When you connect a social account, AgentHub uses the permissions you grant to perform requested publishing actions. Platform data remains subject to that platform's own policies and controls.</p>
            <h2>Data choices</h2><p>You may request access to, correction of, or deletion of your information by contacting the AgentHub team. You can also disconnect a connected social account from the workspace.</p>
            <h2>Contact us</h2><p>For privacy questions or requests, please contact the AgentHub service owner through the support channel associated with your workspace. You can also review our <a href="{{ route('terms') }}">Terms and Conditions</a>.</p>
        </div>
    </main>
    </div>
</body>
</html>
