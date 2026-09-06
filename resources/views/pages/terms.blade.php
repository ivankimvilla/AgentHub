<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Service | AgentHub</title>
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
        <span class="eyebrow">A clear agreement for better work</span>
        <h1>Terms of Service</h1>
        <p class="updated">Last updated: September 6, 2026</p>
        <div class="legal-copy">
            <h2>Using AgentHub</h2><p>AgentHub provides tools for planning, analyzing, reviewing, and publishing content. You are responsible for the information you submit and for using the service in accordance with applicable laws and platform rules.</p>
            <h2>Your workspace and content</h2><p>You retain ownership of content you provide. You grant AgentHub the limited permission needed to process that content and carry out the actions you request, including publishing through connected accounts.</p>
            <h2>Connected accounts</h2><p>You must have the right to connect and use each social account. You are responsible for reviewing content and permissions before publishing. Third-party platforms may change their APIs, policies, or availability.</p>
            <h2>Responsible use</h2><p>Do not use AgentHub to publish unlawful, misleading, abusive, infringing, or harmful content, or to attempt unauthorized access to the service or another person's account.</p>
            <h2>Service availability</h2><p>We work to keep AgentHub dependable, but the service may change or occasionally be unavailable for maintenance, technical issues, or circumstances outside our control.</p>
            <h2>Contact</h2><p>Questions about these terms should be sent through the support channel associated with your workspace.</p>
        </div>
    </main>
    <footer class="legal-footer">© {{ date('Y') }} AgentHub <a href="{{ route('privacy') }}">Privacy Policy</a><a href="{{ route('home') }}">Home</a></footer>
</body>
</html>
