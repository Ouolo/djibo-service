<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Djibo Services – Formation agricole, appui conseil et intrants biologiques pour une agriculture durable au Mali.">
    <title>@yield('title', 'Djibo Services – Agriculture Durable au Mali')</title>
    <link rel="icon" href="{{ asset('assets/images/favicon.webp') }}" type="image/webp">

    <!-- Google Fonts : Playfair Display + Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap + FontAwesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/fontawesome-all.min.css') }}">

    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        /* ============================================
           DESIGN SYSTEM – DJIBO SERVICE (Palette Vert Nature)
        ============================================ */
        :root {
            /* Couleurs principales */
            --vert:             #2E7D32;   /* Vert Nature - logo, boutons principaux, titres */
            --vert-dark:        #1B5E20;   /* Vert sombre pour navbar, footer sombre */
            --vert-clair:       #66BB6A;   /* Vert Clair - icônes, cartes de services, arrière-plans légers */
            --vert-light-bg:    #E8F5E9;   /* Version très claire du vert clair pour arrière-plans doux */
            
            /* Couleurs secondaires */
            --brun-terre:       #8D6E63;   /* Brun Terre - rappels agricoles, compost & fertilité */
            --jaune-agri:       #F9A825;   /* Jaune Agriculture - statistiques, chiffres clés, boutons d'action */
            --bleu-confiance:   #1565C0;   /* Bleu Confiance - liens, éléments institutionnels, formations */
            
            /* Couleurs neutres */
            --blanc:            #FFFFFF;   /* Blanc */
            --gris-fonce:       #263238;   /* Gris foncé - texte principal */
            --gris-clair:       #F5F7F8;   /* Gris clair - arrière-plans, bordures */
            --bordure:          #E0E4E6;   /* Bordure neutre */

            /* Mappage de compatibilité pour conserver le style sans casser le HTML existant */
            --brun:             var(--gris-fonce);
            --creme:            var(--gris-clair);
            --orange:           var(--jaune-agri);
            --ocre:             var(--brun-terre);
            --vert-light:       var(--vert-light-bg);
            --vert-nature:      var(--vert);
        }

        /* ---- BASE ---- */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--gris-fonce);
            background: var(--gris-clair);
            font-size: 16px;
            line-height: 1.7;
        }

        h1, h2, h3, h4, h5 {
            font-family: 'Playfair Display', serif;
            color: var(--vert); /* Vert Nature pour les titres */
            line-height: 1.25;
        }

        h6 { font-family: 'Inter', sans-serif; }

        a { color: var(--bleu-confiance); text-decoration: none; transition: color 0.25s; }
        a:hover { color: var(--vert); }

        img { max-width: 100%; display: block; }

        /* ---- NAVBAR ---- */
        .dj-navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            background: var(--vert-dark);
            box-shadow: 0 2px 20px rgba(0,0,0,0.15);
            transition: background 0.3s;
        }

        .dj-navbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            height: 68px;
            max-width: 1280px;
            margin: 0 auto;
        }

        .dj-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .dj-brand-leaf {
            width: 42px; height: 42px;
            flex-shrink: 0;
        }

        .dj-brand-text {
            display: flex;
            flex-direction: column;
        }

        .dj-brand-name {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 800;
            color: var(--blanc);
            letter-spacing: 0.5px;
            line-height: 1.1;
        }

        .dj-brand-sub {
            font-size: 10px;
            font-weight: 600;
            color: var(--jaune-agri);
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .dj-nav-links {
            display: flex;
            align-items: center;
            gap: 4px;
            list-style: none;
        }

        .dj-nav-links a {
            color: rgba(255,255,255,0.85);
            font-size: 14px;
            font-weight: 500;
            padding: 8px 14px;
            border-radius: 6px;
            transition: all 0.25s;
            white-space: nowrap;
        }

        .dj-nav-links a:hover,
        .dj-nav-links li.active > a {
            color: #fff;
            background: rgba(255,255,255,0.12);
        }

        .dj-nav-links li.active > a {
            color: var(--jaune-agri) !important;
            font-weight: 700;
        }

        .dj-nav-cta {
            background: var(--jaune-agri) !important;
            color: var(--gris-fonce) !important;
            border-radius: 24px !important;
            padding: 8px 20px !important;
            font-weight: 700 !important;
            box-shadow: 0 4px 10px rgba(249, 168, 37, 0.2);
            transition: all 0.3s !important;
        }

        .dj-nav-cta:hover {
            background: var(--blanc) !important;
            color: var(--vert-dark) !important;
            box-shadow: 0 6px 15px rgba(255, 255, 255, 0.4);
        }

        /* Mobile hamburger */
        .dj-hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 8px;
            background: transparent;
            border: none;
        }
        .dj-hamburger span {
            display: block;
            width: 26px; height: 2px;
            background: #fff;
            border-radius: 2px;
            transition: all 0.3s;
        }

        /* Mobile menu */
        .dj-mobile-menu {
            display: none;
            position: absolute;
            top: 68px; left: 0; right: 0;
            background: var(--vert-dark);
            padding: 16px 0;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }

        .dj-mobile-menu.open { display: block; }
        .dj-mobile-menu ul { list-style: none; padding: 0 24px; }
        .dj-mobile-menu a {
            display: block;
            padding: 12px 0;
            color: rgba(255,255,255,0.85);
            font-size: 15px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .dj-mobile-menu a:hover { color: var(--jaune-agri); }

        /* ---- MAIN CONTENT OFFSET ---- */
        .dj-page-body { padding-top: 68px; }

        /* ---- SECTION UTILITIES ---- */
        .section-creme { background: var(--gris-clair); }
        .section-blanc { background: var(--blanc); }
        .section-vert-pale { background: var(--vert-light-bg); }
        .section-brun { background: var(--gris-fonce); color: var(--gris-clair); }
        .section-brun h1, .section-brun h2, .section-brun h3 { color: var(--gris-clair); }

        /* Custom section themes */
        .section-compost-sols {
            background-color: rgba(141, 110, 99, 0.08) !important; /* 8% opacity of Brun Terre */
            border-top: 4px solid var(--brun-terre);
            border-bottom: 4px solid var(--brun-terre);
        }

        .section-formations {
            background-color: rgba(21, 101, 192, 0.05) !important; /* 5% opacity of Bleu Confiance */
            border-top: 4px solid var(--bleu-confiance);
            border-bottom: 4px solid var(--bleu-confiance);
        }

        .section-pad { padding: 80px 0; }
        .section-pad-sm { padding: 48px 0; }

        .section-heading {
            text-align: center;
            margin-bottom: 56px;
        }

        .section-label {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            color: var(--vert-clair);
            display: block;
            margin-bottom: 10px;
        }

        .section-heading h2 {
            font-size: clamp(28px, 4vw, 42px);
            color: var(--vert); /* Vert Nature pour les titres de section */
        }

        .section-heading p {
            font-size: 17px;
            color: var(--gris-fonce);
            opacity: 0.8;
            max-width: 620px;
            margin: 16px auto 0;
        }

        /* ---- NEWS CARDS ---- */
        .dj-news-card {
            background: var(--blanc);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.07);
            transition: transform 0.35s ease, box-shadow 0.35s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .dj-news-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 40px rgba(46, 125, 50, 0.18);
        }
        .dj-news-card__img-wrap {
            position: relative;
            overflow: hidden;
            height: 210px;
        }
        .dj-news-card__img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .dj-news-card:hover .dj-news-card__img-wrap img {
            transform: scale(1.06);
        }
        .dj-news-card__date-badge {
            position: absolute;
            bottom: 14px;
            left: 14px;
            background: var(--jaune-agri);
            color: var(--gris-fonce);
            font-size: 12px;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .dj-news-card__body {
            padding: 24px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }
        .dj-news-card__tag {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--vert-clair);
            margin-bottom: 10px;
        }
        .dj-news-card__title {
            font-size: 17px;
            font-weight: 700;
            color: var(--gris-fonce);
            margin-bottom: 10px;
            line-height: 1.45;
        }
        .dj-news-card__excerpt {
            font-size: 14px;
            color: #6b5e50;
            line-height: 1.6;
            flex: 1;
            margin-bottom: 18px;
        }
        .dj-news-card__link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 14px;
            font-weight: 700;
            color: var(--bleu-confiance);
            text-decoration: none;
            transition: gap 0.2s ease, color 0.2s ease;
        }
        .dj-news-card__link:hover {
            color: var(--vert);
            gap: 10px;
        }

        /* ---- BREADCRUMB ---- */
        .dj-breadcrumb {
            background: linear-gradient(135deg, var(--vert-dark) 0%, var(--vert) 100%);
            padding: 60px 0 50px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .dj-breadcrumb::before {
            content: '';
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 40px,
                rgba(255,255,255,0.02) 40px,
                rgba(255,255,255,0.02) 80px
            );
        }

        .dj-breadcrumb h1 {
            color: #fff;
            font-size: clamp(26px, 4vw, 44px);
            position: relative;
            z-index: 1;
        }

        .dj-breadcrumb p {
            color: var(--jaune-agri);
            font-size: 16px;
            margin-top: 10px;
            position: relative;
            z-index: 1;
        }

        /* ---- BUTTONS ---- */
        .btn-dj-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--vert); /* Vert Nature */
            color: #fff !important;
            padding: 14px 32px;
            border-radius: 40px;
            font-weight: 700;
            font-size: 15px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 20px rgba(46, 125, 50, 0.25);
            text-decoration: none;
        }

        .btn-dj-primary:hover {
            background: var(--vert-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(46, 125, 50, 0.35);
            color: #fff !important;
        }

        .btn-dj-orange {
            background: var(--jaune-agri); /* Jaune Agriculture */
            color: var(--gris-fonce) !important;
            box-shadow: 0 4px 20px rgba(249, 168, 37, 0.25);
        }

        .btn-dj-orange:hover {
            background: var(--vert);
            color: #fff !important;
            box-shadow: 0 8px 30px rgba(46, 125, 50, 0.35);
        }

        .btn-dj-outline {
            background: transparent;
            border: 2px solid rgba(255,255,255,0.6);
            color: #fff !important;
            box-shadow: none;
        }

        .btn-dj-outline:hover {
            background: rgba(255,255,255,0.12);
            border-color: #fff;
            color: #fff !important;
            box-shadow: none;
        }

        /* ---- CARDS ---- */
        .dj-card {
            background: var(--blanc);
            border: 1px solid var(--bordure);
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .dj-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 50px rgba(38, 50, 56, 0.1);
        }

        .dj-card-body { padding: 28px; }

        .dj-card-icon {
            width: 56px; height: 56px;
            background: var(--vert-light-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: var(--vert-clair); /* Vert Clair */
            margin-bottom: 18px;
        }

        /* ---- FOOTER ---- */
        .dj-footer {
            background: var(--gris-fonce); /* Gris Foncé */
            color: rgba(255, 255, 255, 0.75);
            padding: 64px 0 0;
            border-top: 5px solid var(--vert);
        }

        .dj-footer h4 {
            color: var(--blanc);
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--jaune-agri);
            display: inline-block;
        }

        .dj-footer ul { list-style: none; padding: 0; }
        .dj-footer ul li { margin-bottom: 10px; font-size: 14px; }
        .dj-footer ul li a { color: rgba(255,255,255,0.75); font-size: 14px; }
        .dj-footer ul li a:hover { color: var(--jaune-agri); }

        .dj-footer-bottom {
            background: rgba(0,0,0,0.2);
            padding: 18px 0;
            margin-top: 48px;
            font-size: 13px;
            color: rgba(255,255,255,0.5);
        }

        .dj-footer-bottom a { color: var(--jaune-agri); }

        /* ---- ANIMATIONS ---- */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .fade-up { animation: fadeUp 0.8s ease both; }
        .delay-1 { animation-delay: 0.2s; }
        .delay-2 { animation-delay: 0.4s; }
        .delay-3 { animation-delay: 0.6s; }

        /* ---- RESPONSIVE ---- */
        @media (max-width: 992px) {
            .dj-nav-links { display: none; }
            .dj-hamburger { display: flex; }
            .section-pad { padding: 56px 0; }
        }

        @media (max-width: 576px) {
            .dj-navbar-inner { padding: 0 16px; }
            .section-pad { padding: 40px 0; }
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- ======= NAVBAR ======= -->
    <nav class="dj-navbar">
        <div class="dj-navbar-inner">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="dj-brand">
                 <img src="{{ asset('assets/images/logo-djibo.jpg') }}" alt="Djibo Services" style="height: 60px; width: auto;">
                <div class="dj-brand-text">
                    <span class="dj-brand-name">Djibo Services</span>
                    <span class="dj-brand-sub">Création – Innovation - Développement</span>
                </div>
            </a>

            <!-- Desktop Nav -->
            <ul class="dj-nav-links" id="dj-nav">
                <li class="{{ Route::is('home') ? 'active' : '' }}"><a href="{{ route('home') }}">Accueil</a></li>
                <li class="{{ Route::is('about') ? 'active' : '' }}"><a href="{{ route('about') }}">À propos</a></li>
                <li class="{{ Route::is('products') ? 'active' : '' }}"><a href="{{ route('products') }}">Produits</a></li>
                <li class="{{ Route::is('services') ? 'active' : '' }}"><a href="{{ route('services') }}">Services</a></li>
                <li class="{{ Route::is('realisations') ? 'active' : '' }}"><a href="{{ route('realisations') }}">Réalisations</a></li>
                <li class="{{ Route::is('testimonials') ? 'active' : '' }}"><a href="{{ route('testimonials') }}">Témoignages</a></li>
                <li class="{{ request()->routeIs('actualites.public.*') ? 'active' : '' }}"><a href="{{ route('actualites.public.index') }}">Actualités</a></li>
                <li><a href="{{ route('contact') }}" class="dj-nav-cta">Contact</a></li>
            </ul>

            <!-- Hamburger -->
            <button class="dj-hamburger" id="dj-hamburger" aria-label="Menu">
                <span></span><span></span><span></span>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div class="dj-mobile-menu" id="dj-mobile-menu">
            <ul>
                <li><a href="{{ route('home') }}">Accueil</a></li>
                <li><a href="{{ route('about') }}">À propos</a></li>
                <li><a href="{{ route('products') }}">Nos Produits</a></li>
                <li><a href="{{ route('services') }}">Nos Services</a></li>
                <li><a href="{{ route('realisations') }}">Réalisations</a></li>
                <li><a href="{{ route('testimonials') }}">Témoignages</a></li>
                <li><a href="{{ route('actualites.public.index') }}">Actualités</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- ======= PAGE BODY ======= -->
    <main class="dj-page-body">
        @yield('content')
    </main>

    <!-- ======= FOOTER ======= -->
    <footer class="dj-footer">
        <div class="container">
            <div class="row g-5">
                <!-- Colonne entreprise -->
                <div class="col-lg-4 col-md-6">
                    <div class="mb-24" style="margin-bottom:24px">
                        <svg width="36" height="36" viewBox="0 0 80 80" fill="none" aria-hidden="true">
                            <circle cx="40" cy="40" r="38" fill="var(--vert)"/>
                            <path d="M40 66 C40 66 40 40 28 32 C16 24 20 12 36 24 C36 24 38 28 40 34 C42 28 44 24 44 24 C60 12 64 24 52 32 C40 40 40 66 40 66Z" fill="var(--jaune-agri)"/>
                        </svg>
                    </div>
                    <p style="font-size:14px; margin-bottom:20px;">Djibo Services est votre partenaire agroécologique de confiance au Mali — intrants biologiques, formation et conseil agronomique depuis Ségou.</p>
                    <ul>
                       <!--  <li>📍 Route de Ségou, Sébougou, Ségou, Mali</li> -->
                        <li>📞 <a href="tel:+22376543210">(+223) 76 54 32 10</a></li>
                        <li>📧 <a href="mailto:djiboservice@gmail.com">contact@djiboservice.com</a></li>
                        <li>💬 <a href="https://wa.me/22376543210" target="_blank">WhatsApp Direct</a></li>
                    </ul>
                </div>

                <!-- Nos services -->
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <h4>Services</h4>
                    <ul>
                        <li><a href="{{ route('services') }}">Formation Agricole</a></li>
                        <li><a href="{{ route('services') }}">Appui Conseil</a></li>
                        <li><a href="{{ route('services') }}">Suivi Accompagnement</a></li>
                        <li><a href="{{ route('products') }}">Intrants Bio</a></li>
                    </ul>
                </div>

                <!-- Liens rapides -->
                <div class="col-lg-2 col-md-4 col-sm-6">
                    <h4>Navigation</h4>
                    <ul>
                        <li><a href="{{ route('home') }}">Accueil</a></li>
                        <li><a href="{{ route('about') }}">À Propos</a></li>
                        <li><a href="{{ route('realisations') }}">Réalisations</a></li>
                        <li><a href="{{ route('distributors') }}">Distributeurs</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>

                <!-- Horaires -->
                <div class="col-lg-4 col-md-8">
                    <h4>Horaires d'Ouverture</h4>
                    <ul>
                        <li>Lundi – Vendredi : 08h00 – 17h00</li>
                        <li>Samedi : 09h00 – 13h00</li>
                        <li style="color: rgba(250,246,239,0.4)">Dimanche : Fermé</li>
                    </ul>
                    <div style="margin-top:20px">
                        <a href="https://wa.me/22376543210" target="_blank"
                           style="display:inline-flex;align-items:center;gap:8px;background:#25d366;color:#fff;padding:10px 20px;border-radius:30px;font-weight:700;font-size:14px;text-decoration:none;">
                            <i class="fab fa-whatsapp"></i> Contacter via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="dj-footer-bottom">
            <div class="container d-flex flex-wrap justify-content-between align-items-center gap-2">
                <span>&copy; 2026 <a href="{{ route('home') }}">Djibo Services</a>. Tous droits réservés.</span>
                <div class="d-flex gap-3">
                    <a href="https://www.facebook.com/djibobio/" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" target="_blank" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                    <a href="https://wa.me/22376543210" target="_blank" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>

    <script>
        // Hamburger toggle
        const hamburger = document.getElementById('dj-hamburger');
        const mobileMenu = document.getElementById('dj-mobile-menu');
        if (hamburger && mobileMenu) {
            hamburger.addEventListener('click', () => {
                mobileMenu.classList.toggle('open');
            });
        }

        // Scroll: lighten navbar on scroll up
        let lastScroll = 0;
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            const navbar = document.querySelector('.dj-navbar');
            if (currentScroll > 80) {
                navbar.style.background = 'rgba(18, 72, 32, 0.97)';
                navbar.style.backdropFilter = 'blur(10px)';
            } else {
                navbar.style.background = 'var(--vert-dark)';
                navbar.style.backdropFilter = 'none';
            }
            lastScroll = currentScroll;
        });

        // Intersection Observer for fade-up animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('[data-animate]').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(24px)';
            el.style.transition = 'opacity 0.7s ease, transform 0.7s ease';
            observer.observe(el);
        });
    </script>

    @stack('scripts')
</body>
</html>
