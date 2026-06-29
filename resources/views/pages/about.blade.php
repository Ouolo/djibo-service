@extends('layouts.app')

@section('title', 'À Propos – Djibo Services')


@section('content')

{{-- STYLES SPÉCIFIQUES À CETTE PAGE --}}
<style>
    .about-hero {
        position: relative;
        padding: 140px 0 100px;
        background: linear-gradient(135deg, rgba(27,94,32,0.95), rgba(46,125,50,0.85)), url('{{ asset('assets/images/universite/bati.jpg') }}') center/cover;
        color: white;
        text-align: center;
        overflow: hidden;
    }
    .about-hero::after {
        content: '';
        position: absolute;
        bottom: -2px; left: 0; width: 100%; height: 60px;
        background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 1440 120" xmlns="http://www.w3.org/2000/svg"><path d="M0 120L1440 0V120H0Z" fill="%23ffffff"/></svg>') no-repeat bottom;
        background-size: cover;
    }
    .about-hero h1 {
        font-weight: 800;
        font-size: 3.5rem;
        margin-bottom: 20px;
        text-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    .about-hero p {
        font-size: 1.25rem;
        color: var(--jaune-agri);
        font-weight: 600;
        max-width: 700px;
        margin: 0 auto;
    }

    /* Section Histoire */
    .history-img-wrapper {
        position: relative;
        padding-right: 30px;
        padding-bottom: 30px;
    }
    .history-img-wrapper::before {
        content: '';
        position: absolute;
        bottom: 0; right: 0;
        width: 80%; height: 80%;
        background: var(--jaune-agri);
        border-radius: 24px;
        z-index: 0;
    }
    .history-img {
        position: relative;
        z-index: 1;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        width: 100%;
        height: 450px;
        object-fit: cover;
    }
    .history-badge {
        position: absolute;
        bottom: 40px;
        left: -30px;
        background: var(--vert);
        color: white;
        padding: 20px;
        border-radius: 16px;
        box-shadow: 0 15px 30px rgba(46,125,50,0.3);
        z-index: 2;
        text-align: center;
    }
    .history-badge h3 { margin: 0; font-weight: 800; font-size: 2rem; color: #fff; }
    .history-badge p { margin: 0; font-size: 0.9rem; font-weight: 600; }

    /* Stats Banner */
    .stats-banner {
        background: var(--vert-dark);
        padding: 80px 0;
        color: white;
        position: relative;
    }
    .stat-box {
        text-align: center;
        padding: 20px;
        transition: transform 0.3s ease;
    }
    .stat-box:hover {
        transform: translateY(-10px);
    }
    .stat-num {
        font-size: 3.5rem;
        font-weight: 800;
        color: var(--jaune-agri);
        margin-bottom: 10px;
        line-height: 1;
    }
    .stat-label {
        font-size: 1.1rem;
        font-weight: 500;
        opacity: 0.9;
    }

    /* Valeurs */
    .value-card {
        background: white;
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
        transition: all 0.4s ease;
        height: 100%;
        border: 1px solid rgba(0,0,0,0.02);
    }
    .value-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 20px 40px rgba(46,125,50,0.1);
        border-color: rgba(46,125,50,0.1);
    }
    .value-icon {
        width: 80px;
        height: 80px;
        background: rgba(102,187,106,0.1);
        color: var(--vert);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        margin: 0 auto 24px;
        transition: all 0.3s ease;
    }
    .value-card:hover .value-icon {
        background: var(--vert);
        color: white;
        transform: scale(1.1) rotate(5deg);
    }
    .value-card h5 {
        font-weight: 700;
        margin-bottom: 15px;
        color: var(--gris-fonce);
    }

    /* Equipe */
    .team-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 14px 40px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        text-align: center;
        border: 1px solid rgba(0,0,0,0.05);
    }
    .team-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 45px rgba(0,0,0,0.12);
    }
    .team-cover {
        height: 140px;
        background: linear-gradient(135deg, #0d3b6f, #1f6bb8);
    }
    .team-avatar {
        width: 140px;
        height: 140px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: -70px auto 20px;
        border: 4px solid white;
        box-shadow: 0 12px 25px rgba(0,0,0,0.12);
        color: var(--vert);
        font-size: 40px;
        overflow: hidden;
    }
    .team-card.team-featured .team-avatar {
        width: 160px;
        height: 160px;
        margin: -80px auto 18px;
    }
    .team-avatar img {
        transition: transform 0.4s ease;
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }
    .team-card:hover .team-avatar img {
        transform: scale(1.18);
    }
</style>

<!-- ===== HERO ===== -->
<div class="about-hero" data-animate>
    <div class="container">
        <h1 style="color: white;">À Propos de Nous</h1>
        <p>Découvrez l'histoire, la mission et les valeurs qui animent Djibo Services au quotidien pour une agriculture plus verte.</p>
    </div>
</div>

<!-- ===== HISTOIRE & MISSION ===== -->
<section class="section-pad bg-white">
    <div class="container">
        <div class="row align-items-center">
            
            <div class="col-lg-6 mb-5 mb-lg-0" data-animate>
                <div class="history-img-wrapper">
                    <img src="{{ asset('assets/images/realisation/propos.jpg') }}" class="history-img" alt="Djibo Services">
                    <div class="history-badge">
                        <h3>2022</h3>
                        <p>Année de création</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 ps-lg-5" data-animate>
                <div class="section-heading mb-4 text-start">
                    <span class="section-label">Notre Histoire</span>
                    <h2 style="font-size: 2.5rem; line-height: 1.2;">Au service de la terre et des producteurs</h2>
                </div>
                <p class="text-muted mb-4" style="font-size: 1.1rem; line-height: 1.7;">
                    <strong>DJIBO SERVICES</strong> est une entreprise verte malienne créée dans le but de promouvoir une agriculture durable, productive et respectueuse de l’environnement. Née de la volonté de transformer les résultats de la recherche en solutions concrètes, nous avons développé des innovations locales pour répondre à la dégradation des sols et à la dépendance aux intrants chimiques.
                </p>
                
                <div class="p-4 mt-4" style="background: rgba(102,187,106,0.08); border-left: 4px solid var(--vert); border-radius: 0 16px 16px 0;">
                    <h5 class="font-weight-bold mb-2" style="color: var(--vert);"><i class="fas fa-bullseye me-2"></i> Notre Mission</h5>
                    <p class="text-muted m-0">
                        Développer et promouvoir des solutions agricoles innovantes, accessibles et durables permettant d'améliorer la fertilité des sols, d'accroître la productivité et de renforcer la résilience des producteurs face aux défis climatiques.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===== CHIFFRES CLÉS ===== -->
<section class="stats-banner" data-animate>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-6 mb-4 mb-md-0">
                <div class="stat-box">
                    <div class="stat-num">4+</div>
                    <div class="stat-label">Années d'expertise</div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4 mb-md-0">
                <div class="stat-box">
                    <div class="stat-num">10 000+</div>
                    <div class="stat-label">Producteurs accompagnés</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-box">
                    <div class="stat-num">8</div>
                    <div class="stat-label">Régions couvertes</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-box">
                    <div class="stat-num">100%</div>
                    <div class="stat-label">Solutions locales</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===== VALEURS ===== -->
<section style="background: var(--gris-clair); padding: 100px 0;">
    <div class="container">
        <div class="section-heading text-center" data-animate>
            <span class="section-label">Ce qui nous guide</span>
            <h2>Nos Valeurs Fondamentales</h2>
            <p>Les principes qui structurent notre engagement auprès des communautés rurales.</p>
        </div>

        <div class="row g-4 justify-content-center">
            
            <div class="col-lg-3 col-md-6" data-animate>
                <div class="value-card">
                    <div class="value-icon"><i class="fas fa-lightbulb"></i></div>
                    <h5>Innovation</h5>
                    <p class="text-muted m-0">Solutions locales et innovantes répondant aux besoins réels des agriculteurs.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-animate>
                <div class="value-card">
                    <div class="value-icon"><i class="fas fa-leaf"></i></div>
                    <h5>Durabilité</h5>
                    <p class="text-muted m-0">Pratiques agricoles respectueuses de l’environnement et de la fertilité des sols.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-animate>
                <div class="value-card">
                    <div class="value-icon"><i class="fas fa-shield-alt"></i></div>
                    <h5>Intégrité</h5>
                    <p class="text-muted m-0">Honnêteté, transparence et responsabilité envers nos partenaires.</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-animate>
                <div class="value-card">
                    <div class="value-icon"><i class="fas fa-hands-helping"></i></div>
                    <h5>Communauté</h5>
                    <p class="text-muted m-0">Les producteurs ruraux sont placés au cœur de toutes nos actions.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===== ZONE INTERVENTION ===== -->
<section class="section-pad bg-white">
    <div class="container">
        <div class="row align-items-center">
            
            <div class="col-lg-6 order-lg-2 mb-5 mb-lg-0" data-animate>
                <img src="{{ asset('assets/images/realisation/zone.jpg') }}" class="img-fluid rounded-lg shadow-lg" alt="Zone d'intervention" style="border-radius: 24px;">
            </div>

            <div class="col-lg-6 order-lg-1 pe-lg-5" data-animate>
                <div class="section-heading text-start mb-4">
                    <span class="section-label">Où nous trouver</span>
                    <h2>Une présence nationale au Mali</h2>
                </div>
                <p class="text-muted mb-4" style="font-size: 1.1rem;">
                    Basés principalement dans la région de Mopti, nous disposons également d'une annexe à Bamako pour mieux vous servir. Nous couvrons activement l'ensemble de la 5ème région du Mali et nous nous étendons sur plusieurs autres zones stratégiques :
                </p>

                <div class="row mb-4">
                    <div class="col-6">
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-map-marker-alt text-success me-2"></i> Mopti (Siège)</li>
                            <li class="mb-2"><i class="fas fa-map-marker-alt text-success me-2"></i> Bamako (Annexe)</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Douentza</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Bandiagara</li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Sikasso</li>
                            <li class="mb-2"><i class="fas fa-map-marker-alt text-success me-2"></i> Ségou (Annexe)</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Koulikoro</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Bougouni</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> Kita</li>
                        </ul>
                    </div>
                </div>

                <div class="alert alert-success" style="background: rgba(102,187,106,0.1); border: 1px dashed var(--vert-clair); color: var(--vert-dark);">
                    <i class="fas fa-truck-fast me-2"></i> Nos produits sont expédiés partout au Mali via notre réseau de distributeurs agréés.
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===== EQUIPE ===== -->
<section style="background: var(--gris-clair); padding: 100px 0;">
    <div class="container">
        <div class="section-heading text-center" data-animate>
            <span class="section-label">Des experts engagés</span>
            <h2>Notre Équipe Dirigeante</h2>
            <p>Découvrez les visages qui propulsent l'innovation agricole chez Djibo Services.</p>
        </div>

        <div class="row justify-content-center g-4">
            @foreach($team as $member)
            <div class="col-lg-4 col-md-6" data-animate>
                <div class="team-card h-100">
                    <div class="team-cover"></div>
                    <div class="team-avatar overflow-hidden">
                        @if(!empty($member['image']))
                            <img src="{{ asset($member['image']) }}" alt="{{ $member['name'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <i class="fas fa-user-tie"></i>
                        @endif
                    </div>
                    <div class="p-4 pt-0">
                        <h4 class="font-weight-bold mb-1" style="color: var(--gris-fonce);">{{ $member['name'] }}</h4>
                        <p class="font-weight-bold mb-3" style="color: var(--vert); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px;">
                            {{ $member['role'] }}
                        </p>
                       
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ===== CTA FINAL ===== -->
<section class="section-pad text-center bg-white" data-animate>
    <div class="container">
        <div class="p-5" style="background: linear-gradient(135deg, var(--vert), var(--vert-dark)); border-radius: 24px; color: white; box-shadow: 0 20px 40px rgba(46,125,50,0.2);">
            <h2 class="mb-3 font-weight-bold text-white">Prêt à transformer votre agriculture ?</h2>
            <p class="mb-4" style="font-size: 1.1rem; opacity: 0.9; max-width: 600px; margin: 0 auto;">Contactez-nous pour en savoir plus sur nos produits, nos formations ou pour devenir distributeur partenaire.</p>
            <a href="{{ route('contact') }}" class="btn-dj-primary" style="background: var(--jaune-agri); color: var(--gris-fonce); font-size: 1.1rem; padding: 15px 40px;">
                Contactez-nous <i class="fas fa-paper-plane ms-2"></i>
            </a>
        </div>
    </div>
</section>  

@endsection