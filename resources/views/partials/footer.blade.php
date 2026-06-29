<style>
    /* Fond commun */
.social-link {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: rgba(255,255,255,0.1);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all .3s ease;
}

/* Couleurs officielles des icônes */
.social-link.facebook i {
    color: #1877F2;
}

.social-link.instagram i {
    color: #E4405F;
}

.social-link.tiktok i {
    color: #ffffff; /* blanc pour être visible sur le fond sombre */
}

.social-link.whatsapp i {
    color: #25D366;
}

.social-link.linkedin i {
    color: #0A66C2;
}

/* Effet au survol */
.social-link:hover {
    transform: translateY(-5px);
    background: rgba(255,255,255,0.2);
}
</style>
<!--====================  Footer Area ====================-->
<div class="footer-area-wrapper bg-gray">
    <div class="footer-area section-space--ptb_80">
        <div class="container">
            <div class="row footer-widget-wrapper">

                <!-- Company Info & Contact -->
                <div class="col-lg-4 col-md-6 col-sm-6 footer-widget">
                    <div class="footer-widget__logo mb-30">
                        <div class="d-flex align-items-center">
                            <svg class="me-2" width="35" height="35" viewBox="0 0 100 100" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="50" cy="50" r="48" fill="var(--vert)" />
                                <path
                                    d="M50 80C50 80 50 50 35 40C20 30 25 15 45 30C45 30 48 35 50 42C52 35 55 30 55 30C75 15 80 30 65 40C50 50 50 80 50 80Z"
                                    fill="var(--jaune-agri)" />
                            </svg>
                            <span class="logo-text text-white">DJIBO SERVICES</span>
                        </div>
                    </div>
                    <ul class="footer-widget__list">
                        <li>Mali,Mopti,Sevare</li>
                        <li><a href="mailto:contact@djiboservice.com"
                                class="hover-style-link">djiboservices@gmail.com</a></li>
                        <li><a href="tel:+22370001122" class="hover-style-link text-white font-weight--bold">(+223) 92
                                 69 24 48</a></li>
                        <li><a href="https://wa.me/22392692448?text=Bonjour%20Djibo%20Services,%20je%20souhaite%20vous%20contacter." target="_blank" class="hover-style-link"
                                style="color: var(--vert-clair) !important;"><i class="fab fa-whatsapp me-2"></i>
                                WhatsApp Direct</a></li>
                    </ul>
                </div>

                <!-- Products & Services -->
                <div class="col-lg-3 col-md-6 col-sm-6 footer-widget">
                    <h6 class="footer-widget__title mb-20">Nos Services</h6>
                    <ul class="footer-widget__list">
                        <li><a href="{{ route('services') }}" class="hover-style-link">Formation Agricole</a></li>
                        <li><a href="{{ route('services') }}" class="hover-style-link">Appui Conseil</a></li>
                        <li><a href="{{ route('services') }}" class="hover-style-link">Suivi & Accompagnement</a></li>
                        <li><a href="{{ route('products') }}" class="hover-style-link">Activateur Biologique</a></li>
                        <li><a href="{{ route('products') }}" class="hover-style-link">Intrants Organiques</a></li>
                    </ul>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-4 col-sm-6 footer-widget">
                    <h6 class="footer-widget__title mb-20">Liens Rapides</h6>
                    <ul class="footer-widget__list">
                        <li><a href="{{ route('home') }}" class="hover-style-link">Accueil</a></li>
                        <li><a href="{{ route('about') }}" class="hover-style-link">À Propos</a></li>
                        <li><a href="{{ route('realisations') }}" class="hover-style-link">Réalisations</a></li>
                        <li><a href="{{ route('distributors') }}" class="hover-style-link">Distributeurs</a></li>
                        <li><a href="{{ route('contact') }}" class="hover-style-link">Contact</a></li>
                    </ul>
                </div>

                <!-- Réseaux -->
                <div class="col-lg-4 col-md-8">
                    <h4>Nos Réseaux</h4>
                    <ul>
                        <li> 
                            <a href="https://www.facebook.com/profile.php?id=100077406985953" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-facebook"></i>  facebook</a>
                        </li>
                        <li>    
                             <a href="https://www.tiktok.com/@djibo.services0?_r=1&_t=ZS-97XjpuH5X9x" target="_blank" aria-label="TikTok"><i class="fab fa-tiktok"></i>  TikTok</a>
                        </li>
                        <li >
                            <a href="https://www.linkedin.com/company/djibo-services" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i>   LinkedIn</a>
                        </li>
                    </ul>
                    <div style="margin-top:20px">
                        <a href="https://wa.me/22392692448?text=Bonjour,%20je%20veux%20en%20savoir%20plus%20sur%20vos%20services%20et%20produits." target="_blank"
                           style="display:inline-flex;align-items:center;gap:8px;background:#25d366;color:#fff;padding:10px 20px;border-radius:30px;font-weight:700;font-size:14px;text-decoration:none;">
                            <i class="fab fa-whatsapp"></i> Contacter via WhatsApp
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="footer-copyright-area section-space--pb_30">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <span class="copyright-text">&copy; 2026 Djibo Services. <a href="#">Tous droits réservés.</a></span>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <ul class="list ht-social-networks solid-rounded-icon">
    <li class="item">
        <a href="https://www.facebook.com/profile.php?id=100077406985953" target="_blank" aria-label="Facebook" class="social-link facebook">
            <i class="fab fa-facebook-f link-icon"></i>
        </a>
    </li>

    <li class="item">
        <a href="#" target="_blank" aria-label="Instagram" class="social-link instagram">
            <i class="fab fa-instagram link-icon"></i>
        </a>
    </li>

    <li class="item">
        <a href="#" target="_blank" aria-label="TikTok" class="social-link tiktok">
            <i class="fab fa-tiktok link-icon"></i>
        </a>
    </li>

    <li class="item">
        <a href="https://www.linkedin.com/company/djibo-services" target="_blank" aria-label="LinkedIn" class="social-link linkedin">
            <i class="fab fa-linkedin-in link-icon"></i>
        </a>
    </li>

    <li class="item">
        <a href="https://wa.me/22392692448?text=Bonjour%20Djibo%20Services,%20je%20souhaite%20vous%20contacter." target="_blank" aria-label="WhatsApp" class="social-link whatsapp">
            <i class="fab fa-whatsapp link-icon"></i>
        </a>
    </li>
</ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--====================  End    of Footer Area ====================-->