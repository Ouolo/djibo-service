<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') – Djibo Service</title>
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/fontawesome-all.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --vert:        #2E7D32;
            --vert-dark:   #1B5E20;
            --vert-clair:  #66BB6A;
            --jaune:       #F9A825;
            --bleu:        #1565C0;
            --brun:        #8D6E63;
            --sidebar-bg:  #0f1f12;
            --sidebar-w:   260px;
            --topbar-h:    64px;
            --radius:      12px;
            --shadow:      0 4px 24px rgba(0,0,0,0.08);
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background: #f0f4f1; color: #1a2e1b; display: flex; min-height: 100vh; }

        /* ── SIDEBAR ── */
        .adm-sidebar {
            width: var(--sidebar-w);
            background: var(--sidebar-bg);
            display: flex; flex-direction: column;
            position: fixed; top: 0; left: 0; height: 100vh;
            z-index: 100; overflow-y: auto;
            transition: transform 0.3s ease;
        }
        .adm-sidebar__logo {
            padding: 24px 20px 20px;
            display: flex; align-items: center; gap: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }
        .adm-sidebar__logo svg { flex-shrink: 0; }
        .adm-sidebar__logo-text { color: #fff; font-weight: 800; font-size: 16px; line-height: 1.2; }
        .adm-sidebar__logo-sub { color: var(--vert-clair); font-size: 11px; font-weight: 500; }

        .adm-nav { padding: 16px 12px; flex: 1; }
        .adm-nav__label {
            font-size: 10px; font-weight: 700; letter-spacing: 1.5px;
            text-transform: uppercase; color: rgba(255,255,255,0.35);
            padding: 12px 8px 6px;
        }
        .adm-nav__link {
            display: flex; align-items: center; gap: 12px;
            padding: 11px 14px; border-radius: 8px;
            color: rgba(255,255,255,0.65); text-decoration: none;
            font-size: 14px; font-weight: 500;
            transition: all 0.2s ease; margin-bottom: 2px;
        }
        .adm-nav__link i { width: 18px; text-align: center; font-size: 15px; }
        .adm-nav__link:hover, .adm-nav__link.active {
            background: rgba(102, 187, 106, 0.15);
            color: var(--vert-clair);
        }
        .adm-nav__link.active { font-weight: 700; }
        .adm-nav__badge {
            margin-left: auto; background: var(--jaune); color: #1a2e1b;
            font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 20px;
        }

        .adm-sidebar__user {
            padding: 16px 20px; border-top: 1px solid rgba(255,255,255,0.07);
            display: flex; align-items: center; gap: 12px;
        }
        .adm-sidebar__avatar {
            width: 38px; height: 38px; border-radius: 50%;
            background: var(--vert); display: flex; align-items: center;
            justify-content: center; color: #fff; font-weight: 700; font-size: 15px;
            flex-shrink: 0;
        }
        .adm-sidebar__uname { color: #fff; font-size: 13px; font-weight: 600; }
        .adm-sidebar__urole { color: rgba(255,255,255,0.45); font-size: 11px; }
        .adm-sidebar__logout {
            margin-left: auto; color: rgba(255,255,255,0.4);
            font-size: 16px; transition: color 0.2s;
        }
        .adm-sidebar__logout:hover { color: #ff6b6b; }

        /* ── MAIN ── */
        .adm-main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

        /* ── TOPBAR ── */
        .adm-topbar {
            height: var(--topbar-h); background: #fff;
            border-bottom: 1px solid #e8ede9;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 28px; position: sticky; top: 0; z-index: 50;
            box-shadow: 0 1px 8px rgba(0,0,0,0.05);
        }
        .adm-topbar__title { font-size: 18px; font-weight: 700; color: var(--vert-dark); }
        .adm-topbar__breadcrumb { font-size: 13px; color: #7a9a7d; margin-top: 2px; }
        .adm-topbar__actions { display: flex; align-items: center; gap: 12px; }
        .adm-btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 9px 20px; border-radius: 8px;
            font-size: 13px; font-weight: 600; cursor: pointer;
            text-decoration: none; border: none; transition: all 0.2s ease;
        }
        .adm-btn-primary { background: var(--vert); color: #fff; }
        .adm-btn-primary:hover { background: var(--vert-dark); color: #fff; }
        .adm-btn-outline { background: transparent; border: 1.5px solid var(--vert); color: var(--vert); }
        .adm-btn-outline:hover { background: var(--vert); color: #fff; }
        .adm-btn-danger { background: #dc2626; color: #fff; }
        .adm-btn-danger:hover { background: #b91c1c; color: #fff; }
        .adm-btn-sm { padding: 6px 14px; font-size: 12px; }
        .adm-btn-jaune { background: var(--jaune); color: #1a2e1b; }
        .adm-btn-jaune:hover { background: #e59400; color: #1a2e1b; }

        /* ── CONTENT ── */
        .adm-content { padding: 28px; flex: 1; }

        /* ── ALERTS ── */
        .adm-alert {
            padding: 14px 18px; border-radius: var(--radius);
            margin-bottom: 20px; display: flex; align-items: center; gap: 10px;
            font-size: 14px; font-weight: 500;
        }
        .adm-alert-success { background: #e8f5e9; color: #1b5e20; border-left: 4px solid var(--vert); }
        .adm-alert-error   { background: #fef2f2; color: #991b1b; border-left: 4px solid #dc2626; }

        /* ── CARDS ── */
        .adm-card {
            background: #fff; border-radius: var(--radius);
            box-shadow: var(--shadow); overflow: hidden;
        }
        .adm-card__header {
            padding: 18px 24px; border-bottom: 1px solid #e8ede9;
            display: flex; align-items: center; justify-content: space-between;
        }
        .adm-card__title { font-size: 15px; font-weight: 700; color: var(--vert-dark); }
        .adm-card__body { padding: 24px; }

        /* ── STAT CARDS ── */
        .adm-stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 16px; margin-bottom: 28px; }
        .adm-stat {
            background: #fff; border-radius: var(--radius);
            padding: 20px 22px; box-shadow: var(--shadow);
            display: flex; align-items: center; gap: 16px;
        }
        .adm-stat__icon {
            width: 48px; height: 48px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; flex-shrink: 0;
        }
        .adm-stat__num { font-size: 26px; font-weight: 800; line-height: 1; }
        .adm-stat__label { font-size: 12px; color: #7a9a7d; font-weight: 500; margin-top: 3px; }

        /* ── TABLE ── */
        .adm-table { width: 100%; border-collapse: collapse; }
        .adm-table th {
            background: #f5f7f5; font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 0.8px;
            color: #7a9a7d; padding: 12px 16px; text-align: left;
            border-bottom: 1px solid #e8ede9;
        }
        .adm-table td { padding: 14px 16px; border-bottom: 1px solid #f0f4f1; font-size: 14px; vertical-align: middle; }
        .adm-table tr:last-child td { border-bottom: none; }
        .adm-table tr:hover td { background: #f8fbf8; }

        /* ── BADGES ── */
        .adm-badge {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 3px 10px; border-radius: 20px;
            font-size: 11px; font-weight: 700;
        }
        .adm-badge-green  { background: #e8f5e9; color: #1b5e20; }
        .adm-badge-yellow { background: #fff8e1; color: #e65100; }
        .adm-badge-grey   { background: #f3f4f6; color: #6b7280; }

        /* ── FORM ── */
        .adm-form-group { margin-bottom: 20px; }
        .adm-label { font-size: 13px; font-weight: 600; color: #2d4a2f; display: block; margin-bottom: 6px; }
        .adm-label span { color: #dc2626; }
        .adm-input, .adm-textarea, .adm-select {
            width: 100%; border: 1.5px solid #d4dfd5; border-radius: 8px;
            padding: 10px 14px; font-size: 14px; font-family: 'Inter', sans-serif;
            background: #fff; color: #1a2e1b;
            transition: border-color 0.2s, box-shadow 0.2s; outline: none;
        }
        .adm-input:focus, .adm-textarea:focus, .adm-select:focus {
            border-color: var(--vert); box-shadow: 0 0 0 3px rgba(46,125,50,0.12);
        }
        .adm-textarea { resize: vertical; min-height: 120px; line-height: 1.6; }
        .adm-help { font-size: 12px; color: #7a9a7d; margin-top: 5px; }
        .adm-error { font-size: 12px; color: #dc2626; margin-top: 5px; }
        .adm-toggle { display: flex; align-items: center; gap: 10px; }
        .adm-toggle input[type=checkbox] { width: 18px; height: 18px; accent-color: var(--vert); cursor: pointer; }

        /* ── IMAGE PREVIEW ── */
        .adm-img-preview { width: 100%; max-height: 220px; object-fit: cover; border-radius: 8px; margin-top: 10px; border: 2px solid #e8ede9; }
        .adm-img-placeholder {
            width: 100%; height: 180px; background: #f0f4f1;
            border-radius: 8px; border: 2px dashed #c8d8c9;
            display: flex; align-items: center; justify-content: center;
            color: #7a9a7d; font-size: 13px; margin-top: 10px;
        }

        /* ── PAGINATION ── */
        .adm-pagination { display: flex; justify-content: center; gap: 6px; margin-top: 24px; }
        .adm-pagination a, .adm-pagination span {
            padding: 7px 14px; border-radius: 7px; font-size: 13px; font-weight: 600;
            text-decoration: none; border: 1.5px solid #d4dfd5; color: #4a6b4c;
        }
        .adm-pagination a:hover { background: var(--vert); color: #fff; border-color: var(--vert); }
        .adm-pagination .active span { background: var(--vert); color: #fff; border-color: var(--vert); }

        /* ── SEARCH BAR ── */
        .adm-search { display: flex; gap: 10px; margin-bottom: 20px; }
        .adm-search .adm-input { max-width: 300px; }

        @media (max-width: 768px) {
            .adm-sidebar { transform: translateX(-100%); }
            .adm-sidebar.open { transform: translateX(0); }
            .adm-main { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- SIDEBAR --}}
<aside class="adm-sidebar">
    <div class="adm-sidebar__logo">
        <svg width="36" height="36" viewBox="0 0 100 100" fill="none">
            <circle cx="50" cy="50" r="48" fill="#2E7D32"/>
            <path d="M50 80C50 80 50 50 35 40C20 30 25 15 45 30C45 30 48 35 50 42C52 35 55 30 55 30C75 15 80 30 65 40C50 50 50 80 50 80Z" fill="#F9A825"/>
            <path d="M50 80C50 80 50 55 45 48C40 41 30 40 40 52C40 52 45 56 48 62C49 58 52 50 52 50C65 42 68 52 58 58C48 64 50 80 50 80Z" fill="#66BB6A"/>
        </svg>
        <div>
            <div class="adm-sidebar__logo-text">DJIBO SERVICE</div>
            <div class="adm-sidebar__logo-sub">Administration</div>
        </div>
    </div>

    <nav class="adm-nav">
        <div class="adm-nav__label">Menu principal</div>

        <a href="{{ route('admin.dashboard') }}"
           class="adm-nav__link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i> Tableau de bord
        </a>

        <a href="{{ route('admin.actualites.index') }}"
           class="adm-nav__link {{ request()->routeIs('admin.actualites.*') ? 'active' : '' }}">
            <i class="fas fa-newspaper"></i> Publications
            @php $totalActus = \App\Models\Actualite::count(); @endphp
            @if($totalActus > 0)
                <span class="adm-nav__badge">{{ $totalActus }}</span>
            @endif
        </a>

        <a href="{{ route('admin.produits.index') }}"
           class="adm-nav__link {{ request()->routeIs('admin.produits.*') ? 'active' : '' }}">
            <i class="fas fa-box"></i> Produits
            @php $totalProds = \App\Models\Produit::count(); @endphp
            @if($totalProds > 0)
                <span class="adm-nav__badge">{{ $totalProds }}</span>
            @endif
        </a>

        <a href="{{ route('admin.realisations.index') }}"
           class="adm-nav__link {{ request()->routeIs('admin.realisations.*') ? 'active' : '' }}">
            <i class="fas fa-trophy"></i> Réalisations
            @php $totalReals = \App\Models\Realisation::count(); @endphp
            @if($totalReals > 0)
                <span class="adm-nav__badge">{{ $totalReals }}</span>
            @endif
        </a>

        <div class="adm-nav__label" style="margin-top:12px;">Raccourcis</div>
        <a href="{{ route('admin.actualites.create') }}" class="adm-nav__link">
            <i class="fas fa-plus-circle"></i> Nouvelle publication
        </a>
        <a href="{{ route('admin.realisations.create') }}" class="adm-nav__link">
            <i class="fas fa-plus-circle"></i> Nouvelle réalisation
        </a>
        <a href="{{ route('home') }}" target="_blank" class="adm-nav__link">
            <i class="fas fa-external-link-alt"></i> Voir le site
        </a>
    </nav>

    <div class="adm-sidebar__user">
        <div class="adm-sidebar__avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        <div>
            <div class="adm-sidebar__uname">{{ auth()->user()->name }}</div>
            <div class="adm-sidebar__urole">Administrateur</div>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}" style="margin-left:auto;">
            @csrf
            <button type="submit" class="adm-sidebar__logout" title="Déconnexion" style="background:none;border:none;cursor:pointer;">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </form>
    </div>
</aside>

{{-- MAIN CONTENT --}}
<div class="adm-main">
    {{-- TOPBAR --}}
    <header class="adm-topbar">
        <div>
            <div class="adm-topbar__title">@yield('page-title', 'Tableau de bord')</div>
            <div class="adm-topbar__breadcrumb">@yield('breadcrumb', 'Admin')</div>
        </div>
        <div class="adm-topbar__actions">
            @yield('topbar-actions')
        </div>
    </header>

    <main class="adm-content">
        {{-- Flash messages --}}
        @if(session('success'))
            <div class="adm-alert adm-alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="adm-alert adm-alert-error">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>
</div>

@stack('scripts')
</body>
</html>
