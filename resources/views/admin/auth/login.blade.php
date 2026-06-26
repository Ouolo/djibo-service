<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin – Djibo Services</title>
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/fontawesome-all.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --vert:#2E7D32; --vert-dark:#1B5E20; --vert-clair:#66BB6A; --jaune:#F9A825; }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, var(--vert-dark) 0%, var(--vert) 60%, #0d3b0e 100%);
            display: flex; align-items: center; justify-content: center;
            padding: 20px;
        }
        .login-wrap { width: 100%; max-width: 420px; }

        /* Logo */
        .login-logo { text-align: center; margin-bottom: 32px; }
        .login-logo svg { margin-bottom: 12px; }
        .login-logo h1 { color: #fff; font-size: 22px; font-weight: 800; }
        .login-logo p { color: rgba(255,255,255,0.65); font-size: 13px; margin-top: 4px; }

        /* Card */
        .login-card {
            background: #fff; border-radius: 20px;
            padding: 40px 36px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.25);
        }
        .login-card h2 { font-size: 20px; font-weight: 700; color: var(--vert-dark); margin-bottom: 6px; }
        .login-card p { font-size: 13px; color: #7a9a7d; margin-bottom: 28px; }

        /* Form */
        .form-group { margin-bottom: 18px; }
        label { font-size: 13px; font-weight: 600; color: #2d4a2f; display: block; margin-bottom: 6px; }
        .input-wrap { position: relative; }
        .input-wrap i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #7a9a7d; font-size: 14px; }
        input {
            width: 100%; border: 1.5px solid #d4dfd5; border-radius: 10px;
            padding: 11px 14px 11px 40px; font-size: 14px; font-family: 'Inter', sans-serif;
            background: #f8fbf8; color: #1a2e1b; outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        input:focus { border-color: var(--vert); box-shadow: 0 0 0 3px rgba(46,125,50,0.12); background: #fff; }

        .remember { display: flex; align-items: center; gap: 8px; font-size: 13px; color: #4a6b4c; }
        .remember input { width: auto; padding: 0; accent-color: var(--vert); }

        .btn-login {
            width: 100%; padding: 13px; background: var(--vert);
            color: #fff; border: none; border-radius: 10px;
            font-size: 15px; font-weight: 700; cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            margin-top: 20px;
        }
        .btn-login:hover { background: var(--vert-dark); }
        .btn-login:active { transform: scale(0.98); }

        .error-msg {
            background: #fef2f2; border-left: 4px solid #dc2626;
            color: #991b1b; font-size: 13px; padding: 12px 14px;
            border-radius: 8px; margin-bottom: 20px;
        }
        .success-msg {
            background: #e8f5e9; border-left: 4px solid var(--vert);
            color: #1b5e20; font-size: 13px; padding: 12px 14px;
            border-radius: 8px; margin-bottom: 20px;
        }

        .back-link { text-align: center; margin-top: 20px; }
        .back-link a { color: rgba(255,255,255,0.7); font-size: 13px; text-decoration: none; }
        .back-link a:hover { color: #fff; }

        /* Credentials hint */
        .credentials-hint {
            margin-top: 20px; padding: 12px 14px;
            background: rgba(249,168,37,0.12); border: 1px solid rgba(249,168,37,0.3);
            border-radius: 8px; font-size: 12px; color: #4a6b4c;
        }
        .credentials-hint strong { color: var(--vert-dark); }
    </style>
</head>
<body>
<div class="login-wrap">
    <div class="login-logo">
        <svg width="56" height="56" viewBox="0 0 100 100" fill="none">
            <circle cx="50" cy="50" r="48" fill="rgba(255,255,255,0.15)"/>
            <circle cx="50" cy="50" r="40" fill="#2E7D32"/>
            <path d="M50 78C50 78 50 50 37 41C24 32 29 18 47 31C47 31 49 36 50 42C51 36 53 31 53 31C71 18 76 32 63 41C50 50 50 78 50 78Z" fill="#F9A825"/>
            <path d="M50 78C50 78 50 56 46 49C42 42 33 42 42 53C42 53 46 57 49 62C50 59 52 52 52 52C64 44 67 53 58 59C50 65 50 78 50 78Z" fill="#66BB6A"/>
        </svg>
        <h1>DJIBO SERVICES</h1>
        <p>Espace Administration</p>
    </div>

    <div class="login-card">
        <h2>Connexion</h2>
        <p>Entrez vos identifiants pour accéder au tableau de bord.</p>

        @if(session('success'))
            <div class="success-msg"><i class="fas fa-check-circle me-2"></i>{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="error-msg">
                <i class="fas fa-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <div class="form-group">
                <label for="email">Adresse Email</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope"></i>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                           placeholder="admin@djiboservice.com" required autofocus>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <div class="input-wrap">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>
            </div>
            <label class="remember">
                <input type="checkbox" name="remember" value="1"> Se souvenir de moi
            </label>
            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt me-2"></i> Se connecter
            </button>
        </form>

        <div class="credentials-hint">
            <strong>Accès démo :</strong> admin@djiboservice.com &nbsp;|&nbsp; djibo@2026
        </div>
    </div>

    <div class="back-link">
        <a href="{{ route('home') }}"><i class="fas fa-arrow-left me-1"></i> Retour au site public</a>
    </div>
</div>
</body>
</html>
