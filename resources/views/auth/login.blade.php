<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Manpreet Bhatia Classes - Admin Login">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Manpreet Bhatia Classes</title>
  <link rel="icon" href="{{ asset('assets/images/logo-mbc.jpg') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/remixicon.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    html, body {
      width: 100%; height: 100%; overflow: hidden;
      font-family: 'Inter', sans-serif;
      background: #060d1f;
    }

    /* ── Animated Background ── */
    .login-bg {
      position: fixed; inset: 0; z-index: 0;
      background: linear-gradient(135deg, #060d1f 0%, #0d1b3e 45%, #1a0533 100%);
    }
    .blob {
      position: absolute; border-radius: 50%;
      filter: blur(90px); opacity: 0.3;
      animation: floatBlob 10s ease-in-out infinite alternate;
    }
    .blob-1 { width: 500px; height: 500px; background: #1e3a8a; top: -200px; left: -150px; }
    .blob-2 { width: 450px; height: 450px; background: #78350f; bottom: -150px; right: -100px; animation-delay: 3s; }
    .blob-3 { width: 300px; height: 300px; background: #0c4a6e; top: 30%; left: 40%; animation-delay: 6s; }
    @keyframes floatBlob {
      from { transform: translate(0,0) scale(1); }
      to   { transform: translate(25px,35px) scale(1.1); }
    }

    /* Particles */
    .particles { position: fixed; inset: 0; z-index: 1; pointer-events: none; overflow: hidden; }
    .particle {
      position: absolute;
      border-radius: 50%;
      animation: riseUp linear infinite;
    }
    @keyframes riseUp {
      0%   { transform: translateY(110vh); opacity: 0; }
      5%   { opacity: 1; }
      95%  { opacity: 0.4; }
      100% { transform: translateY(-10px); opacity: 0; }
    }

    /* ── Wrapper: strict full viewport, no overflow ── */
    .login-wrapper {
      position: relative; z-index: 10;
      width: 100vw; height: 100vh;
      display: flex; overflow: hidden;
    }

    /* ── LEFT PANEL ── */
    .left-panel {
      flex: 0 0 52%;
      display: flex; flex-direction: column;
      align-items: center; justify-content: center;
      padding: 40px 50px;
    }
    @media (max-width: 900px) { .left-panel { display: none; } }

    .brand-logo {
      width: 130px; height: 130px;
      object-fit: contain;
      border-radius: 20px;
      background: rgba(255,255,255,0.06);
      padding: 10px;
      box-shadow: 0 0 40px rgba(251,191,36,0.3), 0 0 0 1px rgba(255,255,255,0.08);
      animation: glow 3s ease-in-out infinite alternate;
      margin-bottom: 22px;
    }
    @keyframes glow {
      from { box-shadow: 0 0 30px rgba(251,191,36,0.25), 0 0 0 1px rgba(255,255,255,0.08); }
      to   { box-shadow: 0 0 60px rgba(251,191,36,0.55), 0 0 0 1px rgba(255,255,255,0.15); }
    }

    .brand-title {
      font-family: 'Poppins', sans-serif;
      font-size: 2.2rem; font-weight: 800;
      background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 60%, #fff 100%);
      -webkit-background-clip: text; -webkit-text-fill-color: transparent;
      text-align: center; line-height: 1.2; margin-bottom: 8px;
    }
    .brand-sub {
      color: rgba(255,255,255,0.4);
      font-size: 0.78rem; letter-spacing: 3px;
      text-transform: uppercase; text-align: center;
      margin-bottom: 40px;
    }

    .feature-list { list-style: none; width: 100%; max-width: 380px; }
    .feature-list li {
      display: flex; align-items: center; gap: 14px;
      padding: 13px 18px; margin-bottom: 10px;
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(255,255,255,0.07);
      border-radius: 12px;
      color: rgba(255,255,255,0.75);
      font-size: 0.9rem; font-weight: 500;
      opacity: 0; transform: translateX(-18px);
      animation: slideIn 0.5s ease forwards;
    }
    .feature-list li:nth-child(1) { animation-delay: 0.15s; }
    .feature-list li:nth-child(2) { animation-delay: 0.3s; }
    .feature-list li:nth-child(3) { animation-delay: 0.45s; }
    .feature-list li:nth-child(4) { animation-delay: 0.6s; }
    @keyframes slideIn { to { opacity: 1; transform: translateX(0); } }

    .fi-icon {
      width: 36px; height: 36px; border-radius: 9px;
      display: flex; align-items: center; justify-content: center;
      font-size: 1rem; flex-shrink: 0;
    }

    /* ── RIGHT PANEL ── */
    .right-panel {
      flex: 0 0 48%;
      display: flex; align-items: center; justify-content: center;
      padding: 30px 24px;
      overflow-y: auto; /* scroll if needed on small screens */
    }
    @media (max-width: 900px) { .right-panel { flex: 0 0 100%; } }

    /* ── Glass Card ── */
    .glass-card {
      width: 100%; max-width: 420px;
      background: rgba(255, 255, 255, 0.055);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 26px;
      padding: 42px 38px;
      backdrop-filter: blur(22px);
      -webkit-backdrop-filter: blur(22px);
      box-shadow: 0 24px 64px rgba(0,0,0,0.45), inset 0 1px 0 rgba(255,255,255,0.1);
      opacity: 0; transform: translateY(30px);
      animation: cardUp 0.7s cubic-bezier(.34,1.56,.64,1) 0.1s forwards;
    }
    @keyframes cardUp { to { opacity: 1; transform: translateY(0); } }

    .card-top { text-align: center; margin-bottom: 28px; }
    .card-logo {
      width: 64px; height: 64px;
      object-fit: contain;
      border-radius: 14px;
      background: rgba(255,255,255,0.07);
      padding: 6px;
      margin-bottom: 14px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.3);
    }
    .card-top h2 {
      font-family: 'Poppins', sans-serif; font-size: 1.55rem; font-weight: 700;
      background: linear-gradient(135deg, #fbbf24, #ffffff);
      -webkit-background-clip: text; -webkit-text-fill-color: transparent;
      margin-bottom: 4px;
    }
    .card-top p { color: rgba(255,255,255,0.38); font-size: 0.85rem; }

    .gold-line {
      height: 1.5px;
      background: linear-gradient(90deg, transparent, #fbbf24 50%, transparent);
      margin-bottom: 26px;
    }

    /* Form */
    .f-group { margin-bottom: 18px; }
    .f-label {
      display: block; margin-bottom: 7px;
      color: rgba(255,255,255,0.55);
      font-size: 0.78rem; font-weight: 600;
      letter-spacing: 1px; text-transform: uppercase;
    }
    .f-wrap { position: relative; }
    .f-icon {
      position: absolute; left: 14px; top: 50%;
      transform: translateY(-50%);
      color: rgba(255,255,255,0.25); font-size: 1rem;
      pointer-events: none; z-index: 1;
    }
    .f-input {
      width: 100%;
      background: rgba(255,255,255,0.06);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: 12px;
      color: #fff;
      font-size: 0.92rem;
      padding: 13px 14px 13px 42px;
      font-family: 'Inter', sans-serif;
      transition: border-color 0.25s, background 0.25s, box-shadow 0.25s;
      outline: none;
    }
    .f-input::placeholder { color: rgba(255,255,255,0.2); }
    .f-input:focus {
      border-color: #fbbf24;
      background: rgba(251,191,36,0.07);
      box-shadow: 0 0 0 3px rgba(251,191,36,0.1);
    }
    .eye-btn {
      position: absolute; right: 14px; top: 50%;
      transform: translateY(-50%);
      background: none; border: none;
      color: rgba(255,255,255,0.25);
      cursor: pointer; font-size: 1rem;
      transition: color 0.2s; padding: 0;
    }
    .eye-btn:hover { color: #fbbf24; }

    /* Options */
    .opts {
      display: flex; align-items: center;
      justify-content: space-between;
      margin-bottom: 24px; font-size: 0.83rem;
    }
    .chk-wrap { display: flex; align-items: center; gap: 8px; cursor: pointer; }
    .chk-wrap input { width: 16px; height: 16px; accent-color: #fbbf24; cursor: pointer; }
    .chk-wrap span { color: rgba(255,255,255,0.5); }
    .forgot { color: #fbbf24; text-decoration: none; font-weight: 600; }
    .forgot:hover { text-decoration: underline; }

    /* Button */
    .btn-go {
      width: 100%; padding: 14px;
      background: linear-gradient(135deg, #f59e0b, #d97706);
      border: none; border-radius: 13px;
      color: #0a0f1e; font-weight: 700;
      font-size: 0.95rem; font-family: 'Poppins', sans-serif;
      letter-spacing: 0.3px; cursor: pointer;
      transition: transform 0.2s, box-shadow 0.2s;
      box-shadow: 0 8px 20px rgba(217,119,6,0.3);
      position: relative; overflow: hidden;
    }
    .btn-go::after {
      content: '';
      position: absolute; inset: 0;
      background: linear-gradient(135deg, rgba(255,255,255,0.18) 0%, transparent 60%);
      border-radius: inherit;
    }
    .btn-go:hover { transform: translateY(-2px); box-shadow: 0 12px 28px rgba(217,119,6,0.45); }
    .btn-go:active { transform: translateY(0); }

    /* Bottom */
    .reg-link {
      text-align: center; margin-top: 20px;
      color: rgba(255,255,255,0.35); font-size: 0.83rem;
    }
    .reg-link a { color: #fbbf24; font-weight: 600; text-decoration: none; }
    .reg-link a:hover { text-decoration: underline; }

    .sec-badge {
      display: flex; align-items: center; justify-content: center;
      gap: 5px; margin-top: 16px;
      color: rgba(255,255,255,0.2); font-size: 0.75rem;
    }
    .sec-badge i { color: #34d399; font-size: 0.85rem; }
  </style>
</head>

<body>

  <!-- Background -->
  <div class="login-bg">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
  </div>

  <!-- Particles -->
  <div class="particles" id="ptcl"></div>

  <!-- Layout -->
  <div class="login-wrapper">

    <!-- LEFT -->
    <div class="left-panel">
      <img src="{{ asset('assets/images/logo-mbc.jpg') }}" alt="MBC Logo" class="brand-logo">
      <div class="brand-title">Manpreet Bhatia<br>Classes</div>
      <div class="brand-sub">Admin Management Portal</div>

      <ul class="feature-list">
        <li>
          <span class="fi-icon" style="background:rgba(59,130,246,0.18);color:#60a5fa;">
            <i class="ri-graduation-cap-fill"></i>
          </span>
          Manage Students &amp; Teachers
        </li>
        <li>
          <span class="fi-icon" style="background:rgba(251,191,36,0.18);color:#fbbf24;">
            <i class="ri-money-dollar-circle-fill"></i>
          </span>
          Fees Collection &amp; Reports
        </li>
        <li>
          <span class="fi-icon" style="background:rgba(16,185,129,0.18);color:#34d399;">
            <i class="ri-calendar-check-fill"></i>
          </span>
          Attendance &amp; Leave Tracking
        </li>
        <li>
          <span class="fi-icon" style="background:rgba(168,85,247,0.18);color:#c084fc;">
            <i class="ri-bar-chart-2-fill"></i>
          </span>
          Exam Results &amp; Analytics
        </li>
      </ul>
    </div>

    <!-- RIGHT -->
    <div class="right-panel">
      <div class="glass-card">

        <div class="card-top">
          <img src="{{ asset('assets/images/logo-mbc.jpg') }}" alt="MBC" class="card-logo">
          <h2>Welcome Back!</h2>
          <p>Sign in to your admin account</p>
        </div>

        <div class="gold-line"></div>

        <form action="{{ route('login.post') }}" method="POST">
          @csrf

          @if ($errors->any())
          <div style="background:rgba(239,68,68,0.15); border:1px solid rgba(239,68,68,0.4); border-radius:10px; padding:12px 16px; margin-bottom:18px;">
            @foreach ($errors->all() as $error)
              <p style="color:#f87171; margin:0; font-size:0.88rem; font-weight:500;"><i class="ri-error-warning-line" style="margin-right:6px;"></i>{{ $error }}</p>
            @endforeach
          </div>
          @endif

          <div class="f-group">
            <label class="f-label">Email Address</label>
            <div class="f-wrap">
              <i class="ri-mail-line f-icon"></i>
              <input type="email" name="email" class="f-input" placeholder="admin@mbclasses.com" value="{{ old('email') }}" required>
            </div>
          </div>

          <div class="f-group">
            <label class="f-label">Password</label>
            <div class="f-wrap">
              <i class="ri-lock-line f-icon"></i>
              <input type="password" name="password" id="pInp" class="f-input" placeholder="••••••••" required>
              <button type="button" class="eye-btn" onclick="toggleEye()">
                <i class="ri-eye-line" id="eyeIco"></i>
              </button>
            </div>
          </div>

          <div class="opts">
            <label class="chk-wrap">
              <input type="checkbox" name="remember">
              <span>Remember me</span>
            </label>
            <a href="javascript:void(0)" class="forgot">Forgot password?</a>
          </div>

          <button type="submit" class="btn-go">
            <i class="ri-login-circle-line" style="margin-right:7px;"></i>
            Sign In to Dashboard
          </button>
        </form>

        <div class="reg-link">
          Don't have an account? <a href="{{ url('/register') }}">Create account</a>
        </div>

        <div class="sec-badge">
          <i class="ri-shield-check-fill"></i>
          Secured with SSL encryption
        </div>

      </div>
    </div>

  </div>

  <script>
    // Particles
    const c = document.getElementById('ptcl');
    for (let i = 0; i < 35; i++) {
      const p = document.createElement('div');
      p.className = 'particle';
      const sz = Math.random() * 3 + 2;
      p.style.cssText = `
        left:${Math.random()*100}vw;
        width:${sz}px; height:${sz}px;
        animation-duration:${Math.random()*14+8}s;
        animation-delay:${Math.random()*12}s;
        background:${Math.random()>.5?'rgba(251,191,36,0.65)':'rgba(96,165,250,0.45)'};
      `;
      c.appendChild(p);
    }

    // Toggle password
    function toggleEye() {
      const i = document.getElementById('pInp');
      const e = document.getElementById('eyeIco');
      i.type = i.type === 'password' ? 'text' : 'password';
      e.className = i.type === 'password' ? 'ri-eye-line' : 'ri-eye-off-line';
    }
  </script>

</body>
</html>
