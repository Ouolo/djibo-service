@extends('layouts.app')
@section('title', 'Djibo Services – Agriculture Durable au Mali')

@push('styles')
<style>
/* ===== HERO ===== */
.dj-hero {
    position: relative;
    min-height: 92vh;
    display: flex;
    align-items: center;
    overflow: hidden;
    background: #000;
}

/* Background Slider */
.dj-hero-slider {
    position: absolute;
    inset: 0;
    z-index: 1;
}

.dj-hero-slide {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center;
    opacity: 0;
    transition: opacity 1.5s ease-in-out;
}

.dj-hero-slide.active {
    opacity: 1;
}

/* SVG champs de mil animé */
.dj-hero-svg-field {
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 280px;
    pointer-events: none;
    z-index: 2;
}

.dj-hero-overlay {
    position: absolute;
    inset: 0;
    background:
        linear-gradient(to right, rgba(0,20,5,0.58) 0%, rgba(0,20,5,0.25) 60%, rgba(0,0,0,0.05) 100%),
        linear-gradient(to top, rgba(0,0,0,0.55) 0%, transparent 40%);
    z-index: 2;
}

.dj-hero-content {
    position: relative;
    z-index: 3;
    padding: 80px 0 160px;
}

.dj-hero-badge {
    display: inline-block;
    background: rgba(102,187,106,0.15);
    border: 1px solid var(--vert-clair);
    color: var(--vert-clair);
    padding: 6px 16px;
    border-radius: 24px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-bottom: 20px;
}

.dj-hero-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(36px, 6vw, 68px);
    font-weight: 800;
    color: #fff;
    line-height: 1.15;
    margin-bottom: 22px;
}

.dj-hero-title em {
    font-style: italic;
    color: var(--jaune-agri); /* Jaune Agriculture pour accent */
}

.dj-hero-desc {
    font-size: 18px;
    color: rgba(255,255,255,0.9);
    max-width: 540px;
    margin-bottom: 36px;
    line-height: 1.7;
}

.dj-hero-actions { display: flex; gap: 16px; flex-wrap: wrap; }

/* floating whatsapp btn */
.dj-float-wa {
    position: fixed;
    bottom: 28px; right: 28px;
    z-index: 999;
    background: #25d366;
    color: #fff;
    width: 58px; height: 58px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 26px;
    box-shadow: 0 6px 24px rgba(37,211,102,0.4);
    animation: floatWa 2.5s ease-in-out infinite;
    text-decoration: none;
}
@keyframes floatWa { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-8px)} }

/* ===== STATS BAR ===== */
.dj-stats-bar {
    background: var(--gris-fonce);
    padding: 28px 0;
    border-bottom: 4px solid var(--jaune-agri);
}
.dj-stat-item { text-align: center; }
.dj-stat-num {
    font-family: 'Playfair Display', serif;
    font-size: 36px; font-weight: 800;
    color: var(--jaune-agri); /* Jaune Agriculture pour stats */
    display: block;
}
.dj-stat-label { font-size: 12px; color: rgba(255,255,255,0.7); letter-spacing: 1px; text-transform: uppercase; }

/* ===== SERVICE CARDS ===== */
.dj-service-card {
    background: var(--blanc);
    border: 1px solid var(--bordure);
    border-top: 4px solid var(--vert-clair); /* Vert Clair pour service cards */
    border-radius: 12px;
    padding: 32px 28px;
    transition: transform 0.3s, box-shadow 0.3s;
    height: 100%;
}
.dj-service-card:hover { transform: translateY(-8px); box-shadow: 0 24px 48px rgba(38,50,56,0.1); }
.dj-service-icon { font-size: 36px; color: var(--vert-clair); margin-bottom: 18px; } /* Vert Clair pour les icônes */
.dj-service-card h3 { font-size: 22px; margin-bottom: 12px; color: var(--vert); }
.dj-service-card p { color: var(--gris-fonce); opacity: 0.85; font-size: 15px; }

/* ===== PRODUIT VEDETTE ===== */
.dj-product-badge {
    display: inline-block;
    background: var(--brun-terre); /* Brun Terre pour compost et sol */
    color: #fff;
    font-size: 11px; font-weight: 700;
    letter-spacing: 2px; text-transform: uppercase;
    padding: 5px 16px; border-radius: 20px;
    margin-bottom: 16px;
}
.dj-benefit-list { list-style: none; padding: 0; margin: 0 0 24px; }
.dj-benefit-list li {
    padding: 8px 0;
    border-bottom: 1px solid var(--bordure);
    font-size: 15px; color: var(--gris-fonce);
}
.dj-benefit-list li::before { content: "✓ "; color: var(--vert); font-weight: 700; }

/* ===== REALISATION CARDS ===== */
.dj-real-card { border-radius: 14px; overflow: hidden; background: var(--blanc); border: 1px solid var(--bordure); height: 100%; }
.dj-real-card img { width: 100%; height: 220px; object-fit: cover; }
.dj-real-card-body { padding: 24px; }
.dj-real-impact { color: var(--bleu-confiance); font-weight: 700; font-size: 14px; margin-bottom: 8px; } /* Bleu Confiance pour réalisations */
.dj-real-card h4 { font-size: 20px; color: var(--vert); margin-bottom: 10px; }

/* ===== TESTIMONIALS ===== */
.dj-testi-card {
    background: var(--blanc);
    border-left: 5px solid var(--brun-terre); /* Brun Terre pour rappels agricoles */
    border-radius: 0 12px 12px 0;
    padding: 28px;
    box-shadow: 0 8px 24px rgba(38,50,56,0.05);
    height: 100%;
}
.dj-testi-quote { font-size: 17px; font-style: italic; color: var(--gris-fonce); margin-bottom: 20px; line-height: 1.65; }
.dj-testi-badge-before { background: rgba(249,168,37,0.1); color: var(--jaune-agri); font-size: 10px; font-weight: 700; padding: 3px 10px; border-radius: 12px; }
.dj-testi-badge-after  { background: var(--vert-light-bg); color: var(--vert); font-size: 10px; font-weight: 700; padding: 3px 10px; border-radius: 12px; }

/* ===== NEWS CARDS ===== */
.dj-news-card { background: var(--blanc); border: 1px solid var(--bordure); border-radius: 12px; overflow: hidden; height: 100%; display: flex; flex-direction: column; }
.dj-news-card img { width: 100%; height: 190px; object-fit: cover; }
.dj-news-body { padding: 22px; flex: 1; display: flex; flex-direction: column; }
.dj-news-date { font-size: 12px; color: var(--jaune-agri); font-weight: 600; margin-bottom: 8px; }
.dj-news-body h5 { font-size: 18px; margin-bottom: 10px; flex: 1; color: var(--vert); }
</style>
@endpush

@section('content')

<!-- ===== HERO ===== -->
<section class="dj-hero">
    <!-- Diaporama d'images en arrière-plan -->
    <div class="dj-hero-slider">
        <div class="dj-hero-slide active" style="background-image: url('{{ asset('assets/images/realisation/formation.jpg') }}')"></div>
        <div class="dj-hero-slide" style="background-image: url('{{ asset('assets/images/realisation/amenagement deni hectar en tomate.jpg') }}')"></div>
        <div class="dj-hero-slide" style="background-image: url('{{ asset('assets/images/realisation/formation3.jpg') }}')"></div>
        <div class="dj-hero-slide" style="background-image: url('{{ asset('assets/images/realisation/formation2.jpg') }}')"></div>
        <div class="dj-hero-slide" style="background-image: url('{{ asset('assets/images/realisation/formation1.jpg') }}')"></div>
    </div>

    <!-- SVG Champs de mil/sorgho animé -->
    <svg class="dj-hero-svg-field" viewBox="0 0 1440 280" preserveAspectRatio="xMidYMax slice" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
        <defs>
            <style>
                .stalk { transform-origin: bottom center; animation: sway 3.5s ease-in-out infinite alternate; }
                .stalk:nth-child(2n)   { animation-duration: 4.1s; animation-delay: 0.3s; }
                .stalk:nth-child(3n)   { animation-duration: 3.8s; animation-delay: 0.7s; }
                .stalk:nth-child(4n)   { animation-duration: 4.5s; animation-delay: 1.1s; }
                .stalk:nth-child(5n)   { animation-duration: 3.2s; animation-delay: 0.5s; }
                @keyframes sway { from { transform: rotate(-3deg); } to { transform: rotate(3deg); } }
            </style>
        </defs>
        <!-- Ground -->
        <rect x="0" y="240" width="1440" height="40" fill="rgba(13,51,24,0.6)"/>
        <!-- Repeated stalk pattern -->
        @php $positions = [30,70,110,150,190,230,270,310,350,390,430,470,510,550,590,630,670,710,750,790,830,870,910,950,990,1030,1070,1110,1150,1190,1230,1270,1310,1360,1400,1440]; @endphp
        @foreach($positions as $i => $x)
            @php $h = rand(120, 200); $w = rand(6,10); $color = ($i%3===0) ? '#66BB6A' : ($i%3===1 ? '#2E7D32' : '#4CAF50'); @endphp
            <g class="stalk" style="transform-origin: {{ $x }}px 240px">
                <!-- Tige -->
                <rect x="{{ $x - $w/2 }}" y="{{ 240 - $h }}" width="{{ $w }}" height="{{ $h }}" rx="3" fill="{{ $color }}" fill-opacity="0.7"/>
                <!-- Épi de mil (ellipse allongée au sommet) -->
                <ellipse cx="{{ $x }}" cy="{{ 240 - $h - 18 }}" rx="{{ $w * 1.8 }}" ry="22" fill="{{ ($i%2===0) ? '#F9A825' : '#8D6E63' }}" fill-opacity="0.85"/>
                <!-- Feuilles -->
                <ellipse cx="{{ $x - 12 }}" cy="{{ 240 - $h*0.65 }}" rx="14" ry="5" fill="{{ $color }}" fill-opacity="0.5" transform="rotate(-25 {{ $x }} {{ 240 - $h*0.65 }})"/>
                <ellipse cx="{{ $x + 12 }}" cy="{{ 240 - $h*0.45 }}" rx="14" ry="5" fill="{{ $color }}" fill-opacity="0.5" transform="rotate(25 {{ $x }} {{ 240 - $h*0.45 }})"/>
            </g>
        @endforeach
    </svg>

    <div class="dj-hero-overlay"></div>

    <div class="container dj-hero-content">
        <div class="row">
            <div class="col-lg-7">
                <span class="dj-hero-badge" data-animate>🌾 Agriculture Durable au Mali</span>
                <h1 class="dj-hero-title" data-animate>
                    Pour des récoltes<br><em>abondantes</em> et écologiques
                </h1>
                <p class="dj-hero-desc" data-animate>
                    Intrants biologiques, formation agronomique et suivi terrain — Djibo Services régénère vos sols et sécurise vos récoltes.
                </p>
                <div class="dj-hero-actions" data-animate>
                    <a href="{{ route('products') }}" class="btn-dj-primary">Voir nos produits</a>
                    <a href="{{ route('contact') }}" class="btn-dj-primary btn-dj-outline">Nous contacter</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bouton WhatsApp flottant -->
<a href="https://wa.me/22392692448?text=Bonjour%20Djibo%20Services,%20je%20souhaite%20en%20savoir%20plus%20sur%20vos%20produits%20et%20services." target="_blank" class="dj-float-wa" aria-label="WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>
<!-- ===== ACTUALITÉS ===== -->
<section style="background: var(--gris-clair); padding: 80px 0;">
    <div class="container">

        <div class="section-heading" data-animate>
            <span class="section-label">📰 Actualités & Conseils</span>
            <h2>Nos Dernières Publications</h2>
            <p>Restez informé des nouveautés, conseils agronomiques et formations de Djibo Services.</p>
        </div>

        <div class="row g-4">
            @foreach($news as $article)
            <div class="col-lg-4 col-md-6" data-animate>
                <div class="dj-news-card">
                    <div class="dj-news-card__img-wrap">
                        <img src="{{ asset($article['image']) }}" alt="{{ $article['title'] }}">
                        <div class="dj-news-card__date-badge">
                            <i class="far fa-calendar-alt"></i>
                            {{ $article['date'] }}
                        </div>
                    </div>
                    <div class="dj-news-card__body">
                        <span class="dj-news-card__tag">🌱 Agriculture Durable</span>
                        <h5 class="dj-news-card__title">{{ $article['title'] }}</h5>
                        <p class="dj-news-card__excerpt">{{ $article['excerpt'] }}</p>
                        <a href="{{ route('actualites.public.show', $article['slug']) }}" class="dj-news-card__link">
                            Lire plus <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- CTA centré sous les cartes --}}
        <div class="text-center mt-5" data-animate>
            <a href="{{ route('contact') }}" class="btn-dj-outline" style="display:inline-flex;align-items:center;gap:10px;padding:14px 36px;border-radius:50px;">
                <i class="fas fa-envelope"></i> Recevoir nos newsletters
            </a>
        </div>

    </div>
</section>

<!-- ===== STATS BAR ===== -->
<div class="dj-stats-bar">
    <div class="container">
        <div class="row g-3">
            <!-- @foreach([['500+','Producteurs formés'],['150+','Hectares régénérés'],['50+','Fermes accompagnées'],['4+','Années d\'expérience']] as $stat) -->
            <!-- <div class="col-6 col-md-3 dj-stat-item">
                <span class="dj-stat-num">{{ $stat[0] }}</span>
                <span class="dj-stat-label">{{ $stat[1] }}</span>
            </div>
            @endforeach -->
        </div>
    </div>
</div>

<!-- ===== NOS SERVICES ===== -->
<section class="section-blanc section-pad">
    <div class="container">
        <div class="section-heading" data-animate>
            <span class="section-label">Notre Expertise</span>
            <h2>Ce que nous faisons pour vous</h2>
        </div>
        <div class="row g-4">
            @foreach($services as $i => $service)
            <div class="col-lg-4 col-md-6" data-animate>
                <div class="dj-service-card">
                    <div class="dj-service-icon"><i class="fas {{ $service['icon'] }}"></i></div>
                    <h3>{{ $service['title'] }}</h3>
                    <p>{{ $service['short_description'] }}</p>
                    <a href="{{ route('services') }}" style="color:var(--bleu-confiance);font-weight:700;font-size:14px;display:inline-block;margin-top:16px;">
                        En savoir plus →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== PRODUIT EN VEDETTE ===== -->
@if($featured_product)
<section class="section-compost-sols section-pad">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5" data-animate>
                <img src="{{ asset($featured_product['image']) }}" alt="{{ $featured_product['name'] }}"
                     style="border-radius:16px;border:3px solid var(--brun-terre);width:100%;max-height:420px;object-fit:cover;">
            </div>
            <div class="col-lg-7" data-animate>
                <span class="badge-compost">🔥 Compost & Fertilité</span>
                <h2 style="margin-bottom:8px;">{{ $featured_product['name'] }}</h2>
                <p style="color:var(--vert);font-size:20px;font-weight:700;margin-bottom:16px;">{{ $featured_product['price'] }}</p>
                <p style="color:var(--gris-fonce);margin-bottom:24px;">{{ $featured_product['description'] }}</p>
                <ul class="dj-benefit-list">
                    @foreach($featured_product['benefits'] as $b)
                    <li>{{ $b }}</li>
                    @endforeach
                </ul>
                <div class="dj-hero-actions">
                    <a href="{{ route('products') }}" class="btn-dj-primary">Voir le catalogue</a>
                    <a href="https://wa.me/22392692448?text=Je%20veux%20commander%20le%20BioActivateur%20Sol-Plus" target="_blank"
                       class="btn-dj-primary" style="background:#25d366;">
                        <i class="fab fa-whatsapp"></i> Commander
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- ===== RÉALISATIONS ===== -->
<section class="section-blanc section-pad">
    <div class="container">
        <div class="section-heading" data-animate>
            <span class="section-label">Impact Terrain</span>
            <h2>Nos Grandes Réalisations</h2>
        </div>
        <div class="row g-4">
            @foreach($realisations as $r)
            <div class="col-lg-4 col-md-6" data-animate>
                <div class="dj-real-card">
                    <img src="{{ asset($r['image']) }}" alt="{{ $r['title'] }}">
                    <div class="dj-real-card-body">
                        <p class="dj-real-impact"><i class="fas fa-map-marker-alt"></i> {{ $r['location'] }} &nbsp;|&nbsp; {{ $r['impact'] }}</p>
                        <h4>{{ $r['title'] }}</h4>
                        <p style="color:#6b5e50;font-size:14px;">{{ Str::limit($r['description'], 120) }}</p>
                        <a href="{{ route('realisations.public.show', $r['id']) }}" class="dj-real-card__link" style="display:inline-block;margin-top:8px; font-weight:700;color:var(--bleu-confiance);">Lire la suite <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center" style="margin-top:40px;" data-animate>
            <a href="{{ route('realisations') }}" class="btn-dj-primary" style="background:transparent;border:2px solid #000;color:#000 !important;">
                Toutes les réalisations <span>&#129058;</span>
            </a>
        </div>
    </div>
</section>



<!-- ===== CTA FINAL ===== -->
<section style="background:linear-gradient(135deg, var(--vert-dark) 0%, var(--vert) 100%); padding:72px 0; text-align:center;">
    <div class="container">
        <h2 style="color:#fff;margin-bottom:16px;" data-animate>Prêt à transformer votre exploitation ?</h2>
        <p style="color:rgba(255,255,255,0.75);font-size:18px;max-width:560px;margin:0 auto 32px;" data-animate>
            Nos experts se déplacent sur votre parcelle pour un diagnostic gratuit.
        </p>
        <div class="dj-hero-actions" style="justify-content:center;" data-animate>
            <a href="{{ route('contact') }}" class="btn-dj-primary btn-dj-orange">Demander un diagnostic</a>
            <a href="https://wa.me/22392692448?text=Bonjour,%20pourriez-vous%20m%27aider%20%C3%A0%20diagnostiquer%20l%27%C3%A9tat%20de%20mon%20champ%20?" target="_blank" class="btn-dj-primary" style="background:#25d366;">
                <i class="fab fa-whatsapp"></i> WhatsApp
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Hero slider scroll indicator
    const hero = document.querySelector('.dj-hero');
    if (hero) {
        hero.addEventListener('click', () => {
            const next = hero.nextElementSibling;
            if (next) next.scrollIntoView({ behavior: 'smooth' });
        });
    }

    // Diaporama d'arrière-plan du Hero (chaque 3 secondes)
    const slides = document.querySelectorAll('.dj-hero-slide');
    if (slides.length > 0) {
        let currentSlide = 0;
        setInterval(() => {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }, 3000);
    }
});
</script>
@endpush
