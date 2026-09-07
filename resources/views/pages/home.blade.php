<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
@include('partials.icons')
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>AgentHub</title>
<style>
:root{--bg:#0f1118;--bg2:#141824;--panel:#181c27;--panel2:#1e2433;--border:rgba(255,255,255,.09);--text:#eef0f7;--muted:#8d94a8;--purple:#756df7;--blue:#3e8cff;--cyan:#31d8ef;--green:#22c55e}
*{box-sizing:border-box;margin:0;padding:0}
body{font-family:Inter,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;background:var(--bg);color:var(--text);min-height:100vh;overflow-x:hidden}
body:before{content:"";position:fixed;inset:0;pointer-events:none;background:radial-gradient(circle at 75% 46%,rgba(69,87,255,.12),transparent 34%),radial-gradient(circle at 15% 90%,rgba(108,85,255,.08),transparent 30%)}
a{text-decoration:none;color:inherit}
.nav{height:78px;display:flex;align-items:center;justify-content:space-between;padding:0 2.55%;background:transparent;position:relative;z-index:20}
.brand{display:flex;align-items:center;gap:12px;font-weight:700;font-size:19px;letter-spacing:-.35px;color:#fff}
.logo{width:40px;height:40px;border-radius:10px;background:#6658f5;display:grid;place-items:center;box-shadow:none}
.logo svg{width:23px;height:23px}
.brand-name span{color:#8b72ff;font-weight:700}
.navlinks{display:flex;gap:46px;color:#c7cbda;font-size:14px}
.navlinks a:hover{color:#fff}
.actions{display:flex;align-items:center;gap:10px;margin:0}
.btn{display:inline-flex;align-items:center;justify-content:center;width:112px;height:38px;margin:0;border:1px solid #394154;background:#171b26;color:#e9ebf4;padding:0;border-radius:17px;font:600 13px inherit;line-height:1;cursor:pointer;transition:transform .18s ease,background .18s ease,border-color .18s ease,box-shadow .18s ease}
.actions .nav-login{width:78px;border-color:#394154;background:transparent;border-radius:16px}
.btn:hover{transform:translateY(-1px);background:#202638;border-color:#56617a}
.btn.primary{width:112px;border:0;border-radius:18px;background:linear-gradient(90deg,#7567f5,#477df7);box-shadow:0 6px 18px rgba(91,95,247,.2)}
.btn.primary:hover{background:linear-gradient(90deg,#8179ff,#568bff);box-shadow:0 8px 20px rgba(91,95,247,.28)}
.hero{position:relative;min-height:calc(100vh - 78px);display:flex;align-items:center;padding:48px 6.8% 54px;overflow:hidden}
.hero:after{content:"";position:absolute;width:520px;height:520px;right:-210px;top:-150px;background:linear-gradient(135deg,transparent 45%,rgba(70,84,255,.15));transform:rotate(28deg);border-radius:80px;pointer-events:none}
.copy{width:43%;max-width:575px;position:relative;z-index:8}
.badge{display:inline-flex;gap:9px;align-items:center;padding:10px 17px;border:1px solid rgba(105,122,255,.5);border-radius:22px;background:rgba(76,91,180,.1);color:#e1e4f2;font-size:14px;margin-bottom:26px;box-shadow:inset 0 0 20px rgba(91,106,255,.05)}
.badge b{color:#91a2ff}
h1{font-size:clamp(42px,4.15vw,62px);line-height:.98;letter-spacing:-3px;font-weight:800}
h1 .gradient{background:linear-gradient(90deg,#4ed8f4,#7b78f7,#b86cff);-webkit-background-clip:text;color:transparent}
.lead{font-size:16px;line-height:1.7;color:#9ca4b8;max-width:530px;margin:22px 0 25px}
.features{display:grid;grid-template-columns:repeat(4,1fr);gap:17px;max-width:600px}
.feature .ico{width:48px;height:48px;display:grid;place-items:center;color:#63d7ff;margin-bottom:10px}
.feature-icon svg{width:30px;height:30px;display:block;fill:currentColor;stroke:currentColor}
.feature strong{font-size:14px;display:block;margin-bottom:6px}.feature p{font-size:12px;line-height:1.45;color:#8b93a8}
.visual{position:absolute;right:1.5%;top:50%;width:51%;height:535px;transform:translateY(-48%);z-index:3}
.orbit{position:absolute;inset:70px -2% 42px;border:1px solid rgba(74,105,255,.62);border-radius:50%;transform:rotate(-5deg);box-shadow:0 0 45px rgba(53,90,255,.12),inset 0 0 35px rgba(50,100,255,.07)}
.orbit:before,.orbit:after{content:"";position:absolute;border-radius:50%;border:1px solid rgba(59,202,255,.32)}.orbit:before{inset:28px 8%;transform:rotate(9deg)}.orbit:after{inset:55px 14%;opacity:.45}
.spark{position:absolute;width:7px;height:7px;border-radius:50%;background:#62d9ff;box-shadow:0 0 15px #62d9ff}.s1{left:12%;top:45%}.s2{right:10%;top:33%}.s3{right:22%;bottom:18%}.s4{left:31%;top:15%}
.arc{position:absolute;inset:92px 0 42px;display:flex;align-items:center;justify-content:center}
.card{position:absolute;width:154px;height:260px;border-radius:19px;border:1px solid rgba(91,139,255,.72);background:linear-gradient(160deg,rgba(36,75,177,.78),rgba(22,30,51,.94));box-shadow:0 20px 55px rgba(0,0,0,.35),0 0 28px rgba(51,107,255,.18);padding:20px 16px;display:flex;flex-direction:column;align-items:center;text-align:center;transition:.35s ease;backdrop-filter:blur(12px)}
.card:hover{transform:translateY(-18px) rotate(0deg)!important;z-index:10;box-shadow:0 28px 70px rgba(0,0,0,.45),0 0 42px rgba(83,121,255,.3)}
.card .cardico{width:42px;height:42px;border-radius:15px;background:rgba(56,96,195,.45);display:grid;place-items:center;margin-bottom:14px;color:#dff7ff;border:1px solid rgba(117,180,255,.18)}
.card h3{font-size:18px;margin-bottom:7px}.card p{font-size:10px;line-height:1.4;color:#b0bad0}.card .arrow{margin-top:auto;width:32px;height:32px;border-radius:50%;display:grid;place-items:center;background:#337ef3;font-size:19px}
.c1{left:0;transform:translateY(35px) rotate(-15deg);background:linear-gradient(160deg,rgba(100,45,220,.65),rgba(23,29,51,.95));border-color:#8869ff}.c2{left:18%;transform:translateY(10px) rotate(-7deg)}.c3{left:36%;transform:translateY(-16px) rotate(0deg);z-index:5;background:linear-gradient(160deg,rgba(40,90,205,.8),rgba(22,31,54,.96));border-color:#5ca6ff}.c4{left:54%;transform:translateY(8px) rotate(7deg);background:linear-gradient(160deg,rgba(20,119,139,.68),rgba(21,32,51,.96));border-color:#3fd3df}.c5{left:72%;transform:translateY(36px) rotate(15deg);background:linear-gradient(160deg,rgba(91,49,192,.7),rgba(25,28,50,.96));border-color:#8e72ff}
.platforms{position:absolute;left:15%;right:11%;top:30px;display:flex;justify-content:space-between;align-items:center;z-index:8}.platform{width:42px;height:42px;border-radius:14px;display:grid;place-items:center;font-weight:800;font-size:18px;box-shadow:0 10px 25px rgba(0,0,0,.3)}.platform svg{width:100%;height:100%;display:block}.yt{background:#ff202d}.tk{background:#080b10;border:1px solid #434957}.fb{background:#2678e8}.ig{background:linear-gradient(135deg,#f9ce34,#ee2a7b,#6228d7)}
@media(max-width:1050px){.copy{width:52%}.visual{width:57%;right:-8%}.card{width:155px;height:290px}.c2{left:15%}.c3{left:30%}.c4{left:45%}.c5{left:60%}}
@media(max-width:800px){.nav{padding:0 5%}.navlinks{display:none}.hero{padding:55px 6%;display:block}.copy{width:100%;max-width:none}.visual{position:relative;width:100%;right:auto;top:auto;transform:none;height:500px;margin-top:20px}.arc{inset:85px 0 20px}.card{width:135px;height:250px;padding:20px 14px}.card h3{font-size:17px}.card p{font-size:10px}.c1{left:0}.c2{left:18%}.c3{left:36%}.c4{left:54%}.c5{left:72%}.platforms{top:10px;left:5%;right:5%}.platform{width:42px;height:42px}.features{grid-template-columns:repeat(2,1fr);margin-bottom:14px}}
@media(max-width:560px){h1{font-size:43px;letter-spacing:-2px}.lead{font-size:14px}.visual{height:420px}.card{width:105px;height:205px;border-radius:17px;padding:13px 9px}.card .cardico{width:45px;height:45px;border-radius:12px;margin-bottom:12px}.card h3{font-size:14px}.card p{font-size:9px}.card .arrow{width:28px;height:28px;font-size:14px}.c1{left:-2%}.c2{left:16%}.c3{left:36%}.c4{left:52%}.c5{left:70%}}
@media (min-width:801px){.hero{min-height:calc(100vh - 78px);align-items:center}.copy{width:44%;max-width:575px}.visual{width:49%;height:540px;right:2%;top:50%;transform:translateY(-50%)}.arc{inset:96px 0 34px}.card{width:145px;height:250px;padding:18px 14px}.c1{left:0%;transform:translateY(28px) rotate(-14deg)}.c2{left:18%;transform:translateY(8px) rotate(-7deg)}.c3{left:36%;transform:translateY(-12px) rotate(0deg)}.c4{left:54%;transform:translateY(8px) rotate(7deg)}.c5{left:72%;transform:translateY(28px) rotate(14deg)}.platforms{left:13%;right:7%;top:22px;height:92px;display:block}.platform{width:43px;height:43px;font-size:18px;position:absolute}.platform.yt{left:5%;top:28px}.platform.tk{left:34%;top:0}.platform.fb{left:63%;top:10px}.platform.ig{right:1%;top:38px}h1{font-size:clamp(42px,4vw,60px);letter-spacing:-2px}.lead{font-size:14px;line-height:1.6;margin:20px 0 24px}.features{gap:15px;max-width:590px}.feature .ico{width:42px;height:42px}.feature strong{font-size:13px}.feature p{font-size:11px}}
.card{will-change:transform;animation:cardWave 4.8s ease-in-out infinite}.c1{animation-delay:-.15s}.c2{animation-delay:-.75s}.c3{animation-delay:-1.35s}.c4{animation-delay:-1.95s}.c5{animation-delay:-2.55s}@keyframes cardWave{0%,100%{margin-top:0}25%{margin-top:-8px}50%{margin-top:3px}75%{margin-top:8px}}.card:hover{animation-play-state:paused}
.platform.social{position:absolute;width:43px;height:43px;padding:10px;display:grid;place-items:center;border-radius:12px;animation:socialFloat 3.8s ease-in-out infinite}.platform.social:nth-child(1){animation-delay:-.2s}.platform.social:nth-child(2){animation-delay:-1.1s}.platform.social:nth-child(3){animation-delay:-2s}.platform.social:nth-child(4){animation-delay:-2.9s}@keyframes socialFloat{0%,100%{transform:translateY(0) rotate(0deg)}25%{transform:translateY(-7px) rotate(-1deg)}50%{transform:translateY(-2px) rotate(1deg)}75%{transform:translateY(6px) rotate(-.5deg)}}.platform.social:hover{animation-play-state:paused;transform:translateY(-5px) scale(1.08)}
.card .cardico{color:#dce8ff;background:rgba(72,111,211,.42);box-shadow:inset 0 1px 0 rgba(255,255,255,.08)}.card .cardico svg{width:28px;height:28px;display:block}.c1 .cardico{background:rgba(107,72,208,.42)}.c2 .cardico{background:rgba(54,103,196,.48)}.c3 .cardico{background:rgba(61,101,197,.52)}.c4 .cardico{background:rgba(31,112,137,.48)}.c5 .cardico{background:rgba(87,67,184,.46)}
.c1{--card-accent:#8b5cf6;border-color:rgba(139,92,246,.75)!important;background:linear-gradient(160deg,rgba(91,55,178,.82),rgba(25,32,78,.96))!important}.c2{--card-accent:#3b82f6;border-color:rgba(59,130,246,.78)!important;background:linear-gradient(160deg,rgba(38,88,176,.86),rgba(23,38,82,.96))!important}.c3{--card-accent:#2563eb;border-color:rgba(37,99,235,.82)!important;background:linear-gradient(160deg,rgba(40,83,174,.9),rgba(22,42,91,.98))!important}.c4{--card-accent:#06b6d4;border-color:rgba(6,182,212,.8)!important;background:linear-gradient(160deg,rgba(17,112,137,.86),rgba(18,52,78,.97))!important}.c5{--card-accent:#a855f7;border-color:rgba(168,85,247,.8)!important;background:linear-gradient(160deg,rgba(91,52,174,.88),rgba(38,29,82,.98))!important}.c1 .cardico{background:rgba(139,92,246,.34)!important}.c2 .cardico{background:rgba(59,130,246,.34)!important}.c3 .cardico{background:rgba(37,99,235,.34)!important}.c4 .cardico{background:rgba(6,182,212,.34)!important}.c5 .cardico{background:rgba(168,85,247,.34)!important}.card .cardico{border:1px solid color-mix(in srgb,var(--card-accent) 65%,transparent);color:#eef4ff}.card .arrow{background:var(--card-accent)!important;box-shadow:0 6px 18px color-mix(in srgb,var(--card-accent) 40%,transparent)}
</style>
</head>
<body>
<header class="nav">
  <div class="brand" aria-label="AgentHub"><span class="logo"><svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="11" width="18" height="10" rx="2"/><circle cx="12" cy="5" r="2"/><line x1="12" y1="7" x2="12" y2="11"/><path d="M8 15h.01M12 15h.01M16 15h.01" stroke-width="2.5"/></svg></span><span class="brand-name">Agent<span>Hub</span></span></div>
  <div class="actions"><a class="btn primary" href="{{ route('get-started') }}">Get Started</a></div>
</header>
<main class="hero">
  <section class="copy">
  <div class="badge">&#10022; <b>Connect</b> &bull; Upload &bull; One Click &bull; Share Everywhere</div>
    <h1>Manage Your<br>Social Media<br><span class="gradient">All in One Place</span></h1>
    <p class="lead">Connect your platforms, upload your video once, and share everywhere in one click. Save time, reach your audience faster, and manage all your social media content effortlessly with AgentHub.</p>
  <div class="features" id="features">
      <div class="feature"><div class="ico feature-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M7 18.5h10a4 4 0 0 0 .7-7.9A6 6 0 0 0 6.1 9.3 4.5 4.5 0 0 0 7 18.5Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="M12 15V8.5m0 0-2.5 2.5M12 8.5l2.5 2.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></div><strong>Save Time</strong><p>Upload once, share everywhere</p></div>
      <div class="feature"><div class="ico feature-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M10.2 13.8a4 4 0 0 0 5.7 0l2.1-2.1a4 4 0 0 0-5.7-5.7l-1.2 1.2" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M13.8 10.2a4 4 0 0 0-5.7 0L6 12.3A4 4 0 0 0 11.7 18l1.2-1.2" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></div><strong>Reach More</strong><p>Connect all your platforms</p></div>
      <div class="feature"><div class="ico feature-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="m4 12 16-8-5.5 16-3-6L4 12Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/><path d="m11.5 14 4-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></div><strong>One Click</strong><p>Share your video instantly</p></div>
      <div class="feature"><div class="ico feature-icon" aria-hidden="true"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="8.5" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M9 10h.01M15 10h.01M8.5 14c1.8 2.2 5.2 2.2 7 0" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></div><strong>Easy to Use</strong><p>Simple setup, powerful results</p></div>
    </div>
  </section>
  <section class="visual" aria-label="AgentHub features">
    <div class="platforms">
      <div class="platform social yt" aria-label="YouTube"><svg viewBox="0 0 24 24" aria-hidden="true"><use href="#ico-youtube"/></svg></div>
      <div class="platform social tk" aria-label="TikTok"><svg viewBox="0 0 24 24" aria-hidden="true"><use href="#ico-tiktok"/></svg></div>
      <div class="platform social fb" aria-label="Facebook"><svg viewBox="0 0 24 24" aria-hidden="true"><use href="#ico-facebook"/></svg></div>
      <div class="platform social ig" aria-label="Instagram"><svg viewBox="0 0 24 24" aria-hidden="true"><use href="#ico-instagram"/></svg></div>
    </div>
    <div class="orbit"></div><i class="spark s1"></i><i class="spark s2"></i><i class="spark s3"></i><i class="spark s4"></i>
    <div class="arc">
      <article class="card c1"><div class="cardico"><svg viewBox="0 0 24 24"><path d="M10.2 13.8a4 4 0 0 0 5.7 0l2.1-2.1a4 4 0 0 0-5.7-5.7l-1.2 1.2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M13.8 10.2a4 4 0 0 0-5.7 0L6 12.3A4 4 0 0 0 11.7 18l1.2-1.2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></div><h3>Connect</h3><p>Link your social platforms</p><div class="arrow">&rarr;</div></article>
      <article class="card c2"><div class="cardico"><svg viewBox="0 0 24 24"><path d="M7 18.5h10a4 4 0 0 0 .7-7.9A6 6 0 0 0 6.1 9.3 4.5 4.5 0 0 0 7 18.5Z" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linejoin="round"/><path d="M12 15V8.8m0 0-2.5 2.5M12 8.8l2.5 2.5" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"/></svg></div><h3>Upload</h3><p>Add your content in seconds</p><div class="arrow">&rarr;</div></article>
      <article class="card c3"><div class="cardico"><svg viewBox="0 0 24 24"><path d="M9.7 3.8h4.6l.6 2a7.1 7.1 0 0 1 1.6.9l2-.7 2.3 4-1.5 1.4c.1.4.1.8.1 1.2s0 .8-.1 1.2l1.5 1.4-2.3 4-2-.7a7.1 7.1 0 0 1-1.6.9l-.6 2H9.7l-.6-2a7.1 7.1 0 0 1-1.6-.9l-2 .7-2.3-4 1.5-1.4a5.5 5.5 0 0 1 0-2.4L3.2 10l2.3-4 2 .7a7.1 7.1 0 0 1 1.6-.9l.6-2Z" fill="none" stroke="currentColor" stroke-width="1.35" stroke-linejoin="round"/><circle cx="12" cy="12.6" r="2.7" fill="none" stroke="currentColor" stroke-width="1.7"/></svg></div><h3>Manage</h3><p>All your accounts in one place</p><div class="arrow">&rarr;</div></article>
      <article class="card c4"><div class="cardico"><svg viewBox="0 0 24 24"><rect x="4" y="5.5" width="16" height="15" rx="2.5" fill="none" stroke="currentColor" stroke-width="1.8"/><path d="M8 3.5v4M16 3.5v4M4 10h16" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><path d="M8 13.5h2M12 13.5h2M16 13.5h.1M8 17h2M12 17h2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></div><h3>Schedule</h3><p>Plan your content in advance</p><div class="arrow">&rarr;</div></article>
      <article class="card c5"><div class="cardico"><svg viewBox="0 0 24 24"><path d="M5 19V11M10 19V7M15 19V10M20 19V4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M4 20h17" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></div><h3>Analytics</h3><p>Track performance &amp; grow</p><div class="arrow">&rarr;</div></article>
    </div>
  </section>
</main>
</body>
</html>
