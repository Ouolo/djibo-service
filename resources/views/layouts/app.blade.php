<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Djibo Service – Formation agricole, appui conseil et intrants biologiques pour une agriculture durable au Mali.">
    <title>@yield('title', 'Djibo Service – Agriculture Durable au Mali')</title>
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
           DESIGN SYSTEM – DJIBO SERVICE (Palette Sahel)
        ============================================ */
        :root {
            --vert:       #1A6B2E;   /* Vert profond principal */
            --vert-dark:  #124820;   /* Vert très sombre (navbar) */
            --vert-light: #e8f5e9;   /* Fond vert très clair */
            --orange:     #E65100;   /* Orange-Sahel accent */
            --ocre:       #C8860A;   /* Terre ocre secondaire */
            --creme:      #FAF6EF;   /* Crème sable fond */
            --brun:       #2C1A0E;   /* Brun foncé texte */
            --blanc:      #FFFFFF;
            --gris-clair: #f1ede5;
            --bordure:    #d4b896;   /* Bordure terre */
        }

        /* ---- BASE ---- */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--brun);
            background: var(--creme);
            font-size: 16px;
            line-height: 1.7;
        }

        h1, h2, h3, h4, h5 {
            font-family: 'Playfair Display', serif;
            color: var(--brun);
            line-height: 1.25;
        }

        h6 { font-family: 'Inter', sans-serif; }

        a { color: var(--vert); text-decoration: none; transition: color 0.25s; }
        a:hover { color: var(--orange); }

        img { max-width: 100%; display: block; }

        /* ---- NAVBAR ---- */
        .dj-navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1000;
            background: var(--vert-dark);
            box-shadow: 0 2px 20px rgba(0,0,0,0.25);
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
            color: var(--ocre);
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
            color: var(--ocre);
            font-weight: 700;
        }

        .dj-nav-cta {
            background: var(--orange) !important;
            color: #fff !important;
            border-radius: 24px !important;
            padding: 8px 20px !important;
            font-weight: 700 !important;
        }

        .dj-nav-cta:hover {
            background: #bf360c !important;
            color: #fff !important;
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
        .dj-mobile-menu a:hover { color: var(--ocre); }

        /* ---- MAIN CONTENT OFFSET ---- */
        .dj-page-body { padding-top: 68px; }

        /* ---- SECTION UTILITIES ---- */
        .section-creme { background: var(--creme); }
        .section-blanc { background: var(--blanc); }
        .section-vert-pale { background: var(--vert-light); }
        .section-brun { background: var(--brun); color: var(--creme); }
        .section-brun h1, .section-brun h2, .section-brun h3 { color: var(--creme); }

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
            color: var(--orange);
            display: block;
            margin-bottom: 10px;
        }

        .section-heading h2 {
            font-size: clamp(28px, 4vw, 42px);
            color: var(--brun);
        }

        .section-heading p {
            font-size: 17px;
            color: #6b5e50;
            max-width: 620px;
            margin: 16px auto 0;
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
            color: var(--ocre);
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
            background: var(--vert);
            color: #fff;
            padding: 14px 32px;
            border-radius: 40px;
            font-weight: 700;
            font-size: 15px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 20px rgba(26, 107, 46, 0.25);
            text-decoration: none;
        }

        .btn-dj-primary:hover {
            background: var(--vert-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(26, 107, 46, 0.35);
            color: #fff;
        }

        .btn-dj-orange {
            background: var(--orange);
            box-shadow: 0 4px 20px rgba(230, 81, 0, 0.25);
        }

        .btn-dj-orange:hover {
            background: #bf360c;
            box-shadow: 0 8px 30px rgba(230, 81, 0, 0.35);
        }

        .btn-dj-outline {
            background: transparent;
            border: 2px solid rgba(255,255,255,0.6);
            color: #fff;
            box-shadow: none;
        }

        .btn-dj-outline:hover {
            background: rgba(255,255,255,0.12);
            border-color: #fff;
            color: #fff;
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
            box-shadow: 0 20px 50px rgba(44, 26, 14, 0.12);
        }

        .dj-card-body { padding: 28px; }

        .dj-card-icon {
            width: 56px; height: 56px;
            background: var(--vert-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: var(--vert);
            margin-bottom: 18px;
        }

        /* ---- FOOTER ---- */
        .dj-footer {
            background: var(--brun);
            color: rgba(250, 246, 239, 0.8);
            padding: 64px 0 0;
        }

        .dj-footer h4 {
            color: var(--creme);
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--ocre);
            display: inline-block;
        }

        .dj-footer ul { list-style: none; padding: 0; }
        .dj-footer ul li { margin-bottom: 10px; font-size: 14px; }
        .dj-footer ul li a { color: rgba(250,246,239,0.75); font-size: 14px; }
        .dj-footer ul li a:hover { color: var(--ocre); }

        .dj-footer-bottom {
            background: rgba(0,0,0,0.3);
            padding: 18px 0;
            margin-top: 48px;
            font-size: 13px;
            color: rgba(250,246,239,0.5);
        }

        .dj-footer-bottom a { color: var(--ocre); }

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
                <svg class="dj-brand-leaf" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <circle cx="40" cy="40" r="38" fill="#1A6B2E"/>
                    <path d="M40 66 C40 66 40 40 28 32 C16 24 20 12 36 24 C36 24 38 28 40 34 C42 28 44 24 44 24 C60 12 64 24 52 32 C40 40 40 66 40 66Z" fill="#C8860A"/>
                    <path d="M40 66 C40 66 40 44 36 38 C32 32 24 32 32 42 C32 42 36 45 38 50 C39 46 42 40 42 40 C52 34 54 42 46 46 C38 50 40 66 40 66Z" fill="#E8F5E9"/>
                </svg>
                <div class="dj-brand-text">
                    <span class="dj-brand-name">Djibo Service</span>
                    <span class="dj-brand-sub">Agro-écologie & Conseil</span>
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
                <li class="{{ Route::is('distributors') ? 'active' : '' }}"><a href="{{ route('distributors') }}">Distributeurs</a></li>
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
                <li><a href="{{ route('distributors') }}">Distributeurs</a></li>
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
                            <circle cx="40" cy="40" r="38" fill="#1A6B2E"/>
                            <path d="M40 66 C40 66 40 40 28 32 C16 24 20 12 36 24 C36 24 38 28 40 34 C42 28 44 24 44 24 C60 12 64 24 52 32 C40 40 40 66 40 66Z" fill="#C8860A"/>
                        </svg>
                    </div>
                    <p style="font-size:14px; margin-bottom:20px;">Djibo Service est votre partenaire agroécologique de confiance au Mali — intrants biologiques, formation et conseil agronomique depuis Ségou.</p>
                    <ul>
                        <li>📍 Route de Ségou, Sébougou, Ségou, Mali</li>
                        <li>📞 <a href="tel:+22376543210">(+223) 76 54 32 10</a></li>
                        <li>📧 <a href="mailto:contact@djiboservice.com">contact@djiboservice.com</a></li>
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
                <span>&copy; 2026 <a href="{{ route('home') }}">Djibo Service</a>. Tous droits réservés.</span>
                <div class="d-flex gap-3">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
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
