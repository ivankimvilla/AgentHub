<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy | AgentHub</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@600;700&display=swap');
        :root { --ink:#f4f5fb; --muted:#9aa1b5; --line:rgba(255,255,255,.1); --orange:#ff9d5c; }
        * { box-sizing:border-box; } body { margin:0; color:var(--ink); background:#0c0f17; font-family:'DM Sans',sans-serif; line-height:1.7; } a { color:inherit; }
        .legal-nav,.legal-main,.legal-footer { width:min(820px,calc(100% - 40px)); margin:0 auto; } .legal-nav { padding:28px 0; border-bottom:1px solid var(--line); } .brand { color:var(--ink); text-decoration:none; font-family:'Space Grotesk',sans-serif; font-weight:700; } .mark { display:inline-grid; place-items:center; width:28px; height:28px; margin-right:8px; color:#10131e; background:var(--orange); border-radius:7px; } .legal-main { padding:70px 0; } .eyebrow { color:var(--orange); font-size:12px; font-weight:700; letter-spacing:.08em; text-transform:uppercase; } h1,h2 { font-family:'Space Grotesk',sans-serif; letter-spacing:-.04em; line-height:1.1; } h1 { margin:14px 0 10px; font-size:clamp(38px,6vw,60px); } .updated { color:var(--muted); font-size:13px; } .legal-copy { margin-top:52px; } h2 { margin:34px 0 8px; font-size:22px; } p,li { color:var(--muted); font-size:15px; } .legal-footer { padding:24px 0 34px; border-top:1px solid var(--line); color:var(--muted); font-size:13px; } .legal-footer a { margin-left:18px; }
    </style>
</head>
<body>
    <nav class="legal-nav"><a class="brand" href="{{ route('home') }}"><span class="mark">A</span>AgentHub</a></nav>
    <main class="legal-main">
        <span class="eyebrow">Your data, handled with care</span>
        <h1>Privacy Policy</h1>
        <p class="updated">Last updated: September 6, 2026</p>
        <div class="legal-copy">
            <h2>What we collect</h2><p>AgentHub may collect account details, workspace settings, content you choose to submit, and technical information needed to keep the service secure and reliable.</p>
            <h2>How we use information</h2><p>We use this information to provide the AgentHub workspace, analyze and organize content at your request, publish to connected platforms, communicate with you about the service, and improve reliability.</p>
            <h2>Connected platforms</h2><p>When you connect a social account, AgentHub uses the permissions you grant to perform requested publishing actions. Platform data remains subject to that platform's own policies and controls.</p>
            <h2>Data choices</h2><p>You may request access to, correction of, or deletion of your information by contacting the AgentHub team. You can also disconnect a connected social account from the workspace.</p>
            <h2>Contact</h2><p>For privacy questions or requests, please contact the AgentHub service owner through the support channel associated with your workspace.</p>
        </div>
    </main>
    <footer class="legal-footer">© {{ date('Y') }} AgentHub <a href="{{ route('terms') }}">Terms of Service</a><a href="{{ route('home') }}">Home</a></footer>
</body>
</html>
