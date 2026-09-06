<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgentHub | Publish with intelligence</title>
    <meta name="description" content="AgentHub helps teams plan, analyze, and publish content across social platforms from one focused workspace.">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap');
        :root { --bg: #0f1117; --ink: #e8eaf0; --muted: #8b90a0; --line: rgba(255,255,255,.08); --panel: rgba(24,28,39,.86); --accent: #6c74f7; --accent-text: #a5abff; --surface-2: #1f2436; }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { margin: 0; color: var(--ink); background: #0c0f17; font-family: 'DM Sans', sans-serif; }
        a { color: inherit; text-decoration: none; }
        .home-shell { min-height: 100vh; overflow: hidden; background: radial-gradient(circle at 86% 12%, rgba(108,116,247,.14), transparent 30%), radial-gradient(circle at 10% 35%, rgba(108,116,247,.06), transparent 26%), var(--bg); }
        .home-nav, .hero, .feature-band, .home-footer { width: min(1160px, calc(100% - 48px)); margin: 0 auto; }
        .home-nav { display: flex; align-items: center; justify-content: space-between; padding: 28px 0; }
        .brand { display: flex; align-items: center; gap: 11px; font-family: 'Space Grotesk', sans-serif; font-weight: 700; font-size: 19px; letter-spacing: -.03em; }
        .brand-mark { display: grid; place-items: center; width: 34px; height: 34px; color: #fff; background: var(--accent); border-radius: 8px; }
        .nav-links { display: flex; align-items: center; gap: 24px; color: var(--muted); font-size: 13px; }
        .nav-links a:hover { color: var(--ink); }
        .nav-login { color: var(--ink); }
        .button { display: inline-flex; align-items: center; justify-content: center; min-height: 44px; padding: 0 18px; border: 1px solid var(--line); border-radius: 8px; font-size: 13px; font-weight: 600; transition: transform .2s, border-color .2s, background .2s; }
        .button:hover { transform: translateY(-2px); border-color: rgba(255,255,255,.28); }
        .button-primary { color: #fff; background: var(--accent); border-color: var(--accent); }
        .button-primary:hover { background: #7b83fa; border-color: #7b83fa; }
        .hero { display: grid; grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr); align-items: center; gap: 80px; min-height: 620px; padding: 72px 0 104px; }
        .eyebrow { display: inline-flex; align-items: center; gap: 8px; color: var(--accent-text); font-size: 12px; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; }
        .eyebrow::before { content: ''; width: 24px; height: 1px; background: var(--accent); }
        h1, h2, h3 { font-family: 'Space Grotesk', sans-serif; letter-spacing: -.045em; }
        h1 { max-width: 690px; margin: 20px 0; font-size: clamp(44px, 6vw, 78px); line-height: .98; }
        .hero-copy { max-width: 555px; color: var(--muted); font-size: 17px; line-height: 1.7; }
        .hero-actions { display: flex; gap: 12px; margin-top: 30px; }
        .hero-note { margin-top: 18px; color: #6f778d; font-size: 12px; }
        .workspace-preview { position: relative; padding: 14px; border: 1px solid var(--line); border-radius: 14px; background: rgba(24,28,39,.92); box-shadow: 0 24px 80px rgba(0,0,0,.35); transform: rotate(2deg); }
        .preview-top { display: flex; align-items: center; justify-content: space-between; padding: 4px 6px 13px; color: #7c8498; font-size: 10px; }
        .preview-dots { display: flex; gap: 5px; }
        .preview-dots i { width: 6px; height: 6px; border-radius: 50%; background: #535a6e; }
        .preview-body { display: grid; grid-template-columns: 78px 1fr; gap: 12px; min-height: 330px; }
        .preview-side { padding: 12px 8px; background: #151a27; border-radius: 8px; }
        .side-logo { width: 22px; height: 22px; margin-bottom: 24px; border-radius: 6px; background: var(--accent); }
        .side-line { height: 7px; margin: 12px 4px; border-radius: 4px; background: #2a3144; }
        .side-line.active { background: #6972ed; }
        .preview-main { padding: 14px; border: 1px solid rgba(255,255,255,.06); border-radius: 8px; background: #1a1f2d; }
        .preview-heading { width: 42%; height: 13px; margin-bottom: 17px; border-radius: 5px; background: #d9dced; }
        .metric-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; margin-bottom: 12px; }
        .metric { height: 62px; padding: 10px; border: 1px solid rgba(255,255,255,.07); border-radius: 7px; background: #202638; }
        .metric b { display: block; width: 42%; height: 8px; margin-bottom: 9px; border-radius: 3px; background: var(--accent); }
        .metric span { display: block; width: 60%; height: 13px; border-radius: 3px; background: #e2e4f0; }
        .preview-chart { height: 138px; margin-bottom: 12px; border-radius: 7px; background: linear-gradient(155deg, transparent 44%, rgba(108,116,247,.8) 45%, transparent 46%), linear-gradient(25deg, transparent 54%, rgba(165,171,255,.7) 55%, transparent 56%), #202638; }
        .preview-list { display: grid; gap: 7px; }
        .preview-list div { height: 22px; border-radius: 4px; background: #252c3f; }
        .feature-band { padding: 86px 0 100px; border-top: 1px solid var(--line); }
        .section-kicker { color: var(--muted); font-size: 13px; }
        .section-title { max-width: 570px; margin: 12px 0 42px; font-size: 36px; line-height: 1.1; }
        .features { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
        .feature { padding: 25px; border: 1px solid var(--line); border-radius: 10px; background: var(--panel); }
        .feature-number { color: var(--accent-text); font-family: 'Space Grotesk', sans-serif; font-size: 12px; }
        .feature h3 { margin: 40px 0 10px; font-size: 19px; letter-spacing: -.02em; }
        .feature p { margin: 0; color: var(--muted); font-size: 14px; line-height: 1.65; }
        .home-footer { display: flex; align-items: center; justify-content: space-between; padding: 26px 0 34px; border-top: 1px solid var(--line); color: #71798d; font-size: 12px; }
        .legal-links { display: flex; gap: 18px; }
        .legal-links a:hover { color: var(--ink); }
        @media (max-width: 760px) { .home-nav, .hero, .feature-band, .home-footer { width: min(100% - 32px, 560px); } .nav-links { gap: 14px; } .nav-links > a:not(.nav-login) { display: none; } .hero { display: flex; flex-direction: column; align-items: stretch; gap: 46px; min-height: auto; padding: 60px 0 84px; } h1 { font-size: 48px; } .hero-copy { font-size: 15px; } .workspace-preview { transform: none; } .features { grid-template-columns: 1fr; } .feature-band { padding: 64px 0 76px; } .section-title { font-size: 30px; } .home-footer { align-items: flex-start; flex-direction: column; gap: 15px; } }
    </style>
</head>
<body>
    <div class="home-shell">
        <nav class="home-nav" aria-label="Main navigation">
            <a class="brand" href="{{ route('home') }}"><span class="brand-mark"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="11" width="18" height="10" rx="2"/><circle cx="12" cy="5" r="2"/><line x1="12" y1="7" x2="12" y2="11"/><path d="M8 15h.01M12 15h.01M16 15h.01" stroke-width="2.5"/></svg></span> AgentHub</a>
            <div class="nav-links">
                <a href="#capabilities">Capabilities</a>
                <a href="{{ route('privacy') }}">Privacy</a>
                <a href="{{ route('terms') }}">Terms</a>
                <a class="nav-login" href="{{ route('dashboard') }}">Login</a>
                <a class="button button-primary" href="{{ route('dashboard') }}">Get started</a>
            </div>
        </nav>

        <main>
            <section class="hero">
                <div>
                    <span class="eyebrow">The publishing workspace for modern teams</span>
                    <h1>Make every post move with purpose.</h1>
                    <p class="hero-copy">AgentHub brings your content, AI agents, approvals, and social publishing into one calm command center. Plan faster, improve every draft, and keep your voice consistent everywhere.</p>
                    <div class="hero-actions">
                        <a class="button button-primary" href="{{ route('dashboard') }}">Get started <span aria-hidden="true">&nbsp;-></span></a>
                        <a class="button" href="{{ route('dashboard') }}">Login</a>
                    </div>
                    <p class="hero-note">Your content operation, from first idea to published post.</p>
                </div>
                <div class="workspace-preview" aria-label="AgentHub workspace preview">
                    <div class="preview-top"><span>AGENTHUB / WORKSPACE</span><span class="preview-dots"><i></i><i></i><i></i></span></div>
                    <div class="preview-body">
                        <div class="preview-side"><div class="side-logo"></div><div class="side-line active"></div><div class="side-line"></div><div class="side-line"></div><div class="side-line"></div><div class="side-line"></div></div>
                        <div class="preview-main"><div class="preview-heading"></div><div class="metric-row"><div class="metric"><b></b><span></span></div><div class="metric"><b></b><span></span></div><div class="metric"><b></b><span></span></div></div><div class="preview-chart"></div><div class="preview-list"><div></div><div></div><div></div></div></div>
                    </div>
                </div>
            </section>

            <section class="feature-band" id="capabilities">
                <p class="section-kicker">Everything your publishing loop needs</p>
                <h2 class="section-title">From raw thought to reliable distribution.</h2>
                <div class="features">
                    <article class="feature"><span class="feature-number">01 / THINK</span><h3>AI-assisted content</h3><p>Turn ideas into on-brand captions and campaigns with agents built for your workflow.</p></article>
                    <article class="feature"><span class="feature-number">02 / REFINE</span><h3>Human approval, built in</h3><p>Review, edit, and approve every item before it reaches your audience.</p></article>
                    <article class="feature"><span class="feature-number">03 / SHIP</span><h3>Publish everywhere</h3><p>Keep your social channels moving from one organized queue and calendar.</p></article>
                </div>
            </section>
        </main>

        <footer class="home-footer">
            <span>© {{ date('Y') }} AgentHub. Built for better publishing.</span>
            <div class="legal-links"><a href="{{ route('privacy') }}">Privacy Policy</a><a href="{{ route('terms') }}">Terms of Service</a></div>
        </footer>
    </div>
</body>
</html>
