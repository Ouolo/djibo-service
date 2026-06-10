<!--====================  Header Area ====================-->
<div class="header-area header-area--default">

    <!-- Header Top -->
    <div class="header-top-wrap border-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <p class="text-center top-message m-0 py-2">
                        🌱 Djibo Service – Pour une agriculture moderne, durable et productive au Mali
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top -->

    <!-- Header Bottom -->
    <div class="header-bottom-wrap header-sticky">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header default-menu-style position-relative d-flex align-items-center justify-content-between">

                        <!-- Logo -->
                        <div class="header__logo">
                            <a href="{{ route('home') }}" class="d-flex align-items-center text-decoration-none">
                                <svg class="me-2" width="45" height="45" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="50" cy="50" r="48" fill="#1b5e3a" />
                                    <!-- Plant Leaf Sprout -->
                                    <path d="M50 80C50 80 50 50 35 40C20 30 25 15 45 30C45 30 48 35 50 42C52 35 55 30 55 30C75 15 80 30 65 40C50 50 50 80 50 80Z" fill="#f9a825" />
                                    <path d="M50 80C50 80 50 55 45 48C40 41 30 40 40 52C40 52 45 56 48 62C49 58 52 50 52 50C65 42 68 52 58 58C48 64 50 80 50 80Z" fill="#a5d6a7" />
                                </svg>
                                <div class="d-flex flex-column">
                                    <span class="logo-text text-dark">DJIBO SERVICE</span>
                                    <span class="logo-subtext">Agro-écologie & Conseil</span>
                                </div>
                            </a>
                        </div>

                        <!-- Menu -->
                        <div class="header-midle-box">
                            <div class="header-bottom-wrap d-none d-xl-block">
                                <div class="header-bottom-inner">
                                    <div class="header-bottom-left-wrap">
                                        <div class="header__navigation">
                                            <nav class="navigation-menu primary--menu">
                                                <ul class="d-flex align-items-center m-0 p-0">
                                                    <li class="{{ Route::is('home') ? 'active' : '' }}">
                                                        <a href="{{ route('home') }}"><span>Accueil</span></a>
                                                    </li>
                                                    <li class="{{ Route::is('about') ? 'active' : '' }}">
                                                        <a href="{{ route('about') }}"><span>À propos</span></a>
                                                    </li>
                                                    <li class="{{ Route::is('products') ? 'active' : '' }}">
                                                        <a href="{{ route('products') }}"><span>Nos Produits</span></a>
                                                    </li>
                                                    <li class="{{ Route::is('services') ? 'active' : '' }}">
                                                        <a href="{{ route('services') }}"><span>Nos Services</span></a>
                                                    </li>
                                                    <li class="{{ Route::is('realisations') ? 'active' : '' }}">
                                                        <a href="{{ route('realisations') }}"><span>Réalisations</span></a>
                                                    </li>
                                                    <li class="{{ Route::is('testimonials') ? 'active' : '' }}">
                                                        <a href="{{ route('testimonials') }}"><span>Témoignages</span></a>
                                                    </li>
                                                    <li class="{{ Route::is('distributors') ? 'active' : '' }}">
                                                        <a href="{{ route('distributors') }}"><span>Distributeurs</span></a>
                                                    </li>
                                                    <li class="{{ Route::is('contact') ? 'active' : '' }}">
                                                        <a href="{{ route('contact') }}"><span>Contact</span></a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Mobile menu trigger -->
                            <div class="header__actions d-block d-xl-none">
                                <div class="mobile-navigation-icon" id="mobile-menu-trigger">
                                    <i></i>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Bottom -->

</div>
<!--====================  End Header Area ====================-->

<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay" id="mobile-menu-overlay">
    <div class="mobile-menu-overlay__inner">
        <div class="mobile-menu-overlay__header">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-8">
                        <div class="logo">
                            <a href="{{ route('home') }}" class="d-flex align-items-center text-decoration-none">
                                <span class="logo-text text-white">DJIBO SERVICE</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mobile-menu-content text-end">
                            <span class="mobile-navigation-close-icon" id="mobile-menu-close-trigger"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mobile-menu-overlay__body">
            <nav class="offcanvas-navigation">
                <ul>
                    <li><a href="{{ route('home') }}">Accueil</a></li>
                    <li><a href="{{ route('about') }}">À propos</a></li>
                    <li><a href="{{ route('products') }}">Nos Produits</a></li>
                    <li><a href="{{ route('services') }}">Nos Services</a></li>
                    <li><a href="{{ route('realisations') }}">Réalisations</a></li>
                    <li><a href="{{ route('testimonials') }}">Témoignages</a></li>
                    <li><a href="{{ route('distributors') }}">Nos Distributeurs</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
