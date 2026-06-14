@extends('layouts.app')

@section('title', 'À Propos – Djibo Service')

@section('content')

    <!-- Breadcrumb -->
    <div class="breadcrumb-area bg-color-primary py-5 text-center text-white" style="background-image: linear-gradient(135deg, #1b5e3a, #10251e);">
        <div class="container">
            <h1 class="font-weight-bold text-white mb-2">🌿 À Propos de Nous</h1>
            <p class="lead text-warning m-0">Histoire, Mission, Valeurs et Équipe de Djibo Service</p>
        </div>
    </div>

    <!-- Histoire & Mission -->
    <div class="section-space--ptb_80 bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 wow animate__fadeInLeft" data-wow-delay="0.2s">
                    <img src="{{ asset('assets/images/universite/bati.jpg') }}" class="img-fluid rounded-lg shadow-sm" alt="Ferme Djibo Service" style="max-height: 450px; width: 100%; object-fit: cover;">
                </div>
                <div class="col-lg-6 wow animate__fadeInRight" data-wow-delay="0.4s">
                    <div class="ps-lg-4">
                        <h6 class="text-color-primary font-weight-bold mb-3 uppercase">NOTRE HISTOIRE</h6>
                        <h2 class="font-weight-bold mb-4">Depuis plus de 4 ans au service de la terre</h2>
                        <p class="text-muted mb-4">
                            <STRong>DJIBO SERVICES</STRong>  est une entreprise verte malienne créée en 2022 dans le but de promouvoir une agriculture durable, productive et respectueuse de l’environnement. Née de la volonté de transformer les résultats de la recherche en solutions concrètes pour les producteurs, l’entreprise a développé des innovations locales dans le domaine des biofertilisants et des biopesticides afin de répondre aux défis de la dégradation des sols, de la baisse des rendements agricoles et de la dépendance aux intrants chimiques. Notre innovation phare est un activateur biologique permettant d’accélérer le processus de compostage et de produire un compost de qualité en seulement dix jours.
                        </p>
                        <p class="text-muted mb-4">
                            Depuis sa création,<STRong>DJIBO SERVICES</STRong> accompagne les producteurs, coopératives, PME/PMI et organisations paysannes de développement à travers des services de formation, de suivi-accompagnement, d'appui-conseil et de planification pour renforcer les systèmes alimentaires locaux et améliorer durablement les conditions de vie des communautés rurales.
                        </p>
                        
                        <div class="p-3 bg-light rounded-lg border-left border-success border-3">
                            <h5 class="font-weight-bold text-dark mb-2">Notre Mission</h5>
                            <p class="text-muted m-0">
                                Développer et promouvoir des solutions agricoles innovantes, accessibles et durables permettant d'améliorer la fertilité des sols, d'accroître la productivité agricole et de renforcer la résilience des producteurs face aux défis climatiques et environnementaux.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Valeurs -->
    <div class="section-space--ptb_80 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-wrap text-center mb-5">
                        <h6 class="text-color-primary font-weight-bold mb-2">CE QUI NOUS GUIDE</h6>
                        <h3 class="font-weight-bold">Nos Valeurs Fondamentales</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4 wow animate__fadeInUp" data-wow-delay="0.2s">
                    <div class="card h-100 p-4 border-0 shadow-sm text-center">
                        <div class="card-body">
                            <div class="text-success mb-3" style="font-size: 30px;"><i class="fas fa-seedling"></i></div>
                            <h5 class="font-weight-bold mb-3">Innovation</h5>
                            <p class="text-muted m-0">
                                Nous développons des solutions locales et innovantes répondant aux besoins réels des producteurs.        
                          </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4 wow animate__fadeInUp" data-wow-delay="0.4s">
                    <div class="card h-100 p-4 border-0 shadow-sm text-center">
                        <div class="card-body">
                            <div class="text-success mb-3" style="font-size: 30px;"><i class="fas fa-handshake"></i></div>
                            <h5 class="font-weight-bold mb-3">Durabilité</h5>
                            <p class="text-muted m-0">
                                Nous promouvons des pratiques agricoles respectueuses de l’environnement et favorables à la fertilité des sols.    
                              </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4 wow animate__fadeInUp" data-wow-delay="0.4s">
                    <div class="card h-100 p-4 border-0 shadow-sm text-center">
                        <div class="card-body">
                            <div class="text-success mb-3" style="font-size: 30px;"><i class="fas fa-handshake"></i></div>
                            <h5 class="font-weight-bold mb-3">Integrité</h5>
                            <p class="text-muted m-0">
                                Nous agissons avec honnêteté, transparence et responsabilité envers nos partenaires et bénéficiaires.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4 wow animate__fadeInUp" data-wow-delay="0.4s">
                    <div class="card h-100 p-4 border-0 shadow-sm text-center">
                        <div class="card-body">
                            <div class="text-success mb-3" style="font-size: 30px;"><i class="fas fa-handshake"></i></div>
                            <h5 class="font-weight-bold mb-3">Engagement Communautaire</h5>
                            <p class="text-muted m-0">
                                Nous plaçons les producteurs et les communautés rurales au cœur de nos actions pour un développement inclusif.          
                           </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4 wow animate__fadeInUp" data-wow-delay="0.4s">
                    <div class="card h-100 p-4 border-0 shadow-sm text-center">
                        <div class="card-body">
                            <div class="text-success mb-3" style="font-size: 30px;"><i class="fas fa-handshake"></i></div>
                            <h5 class="font-weight-bold mb-3">Esprit de Partenariat</h5>
                            <p class="text-muted m-0">
                                Nous privilégions la collaboration avec les institutions publiques, les organisations de développement, les coopératives et le secteur privé pour maximiser notre impact.               
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Zone d'intervention -->
    <div class="section-space--ptb_80 bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-lg-2 mb-5 mb-lg-0 wow animate__fadeInRight" data-wow-delay="0.2s">
                    <img src="{{ asset('assets/images/universite/univ.jpg') }}" class="img-fluid rounded-lg shadow-sm" alt="Zone intervention" style="max-height: 450px; width: 100%; object-fit: cover;">
                </div>
                <div class="col-lg-6 order-lg-1 wow animate__fadeInLeft" data-wow-delay="0.4s">
                    <div class="pe-lg-4">
                        <h6 class="text-color-primary font-weight-bold mb-3 uppercase">PRÈS DE CHEZ VOUS</h6>
                        <h2 class="font-weight-bold mb-4">Notre Zone d'Intervention</h2>
                        <p class="text-muted mb-4">
                            Basés principalement dans la region de Mopti, nous couvrons activement l'ensemble de la 5ème région du Mali et 5 autres region  du Mali à savoir Douentza, Bandiagara, Koutiala, Koulikoro, Sikasso, Bougouni, Ségou, Kita. Nos techniciens interviennent régulièrement sur site dans les secteurs suivants :
                        </p>
                        <!-- <ul class="list-unstyled mb-4">
                            <li class="mb-3 text-muted"><i class="fas fa-map-marker-alt text-success me-2"></i> <strong>Ségou & Sébougou :</strong> Notre quartier général et notre ferme vitrine.</li>
                            <li class="mb-3 text-muted"><i class="fas fa-map-marker-alt text-success me-2"></i> <strong>Cercle de Bla :</strong> Zone à forte production céréalière et cotonnière.</li>
                            <li class="mb-3 text-muted"><i class="fas fa-map-marker-alt text-success me-2"></i> <strong>Cercle de San :</strong> Suivi des producteurs maraîchers et riziculteurs.</li>
                            <li class="mb-3 text-muted"><i class="fas fa-map-marker-alt text-success me-2"></i> <strong>Markala :</strong> Appui aux coopératives le long du fleuve Niger.</li>
                        </ul> -->
                        <p class="text-muted m-0">
                            Grâce à notre réseau de distributeurs agréés, nos produits sont également expédiés et disponibles dans d'autres régions du Mali.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Équipe -->
    <div class="section-space--ptb_80 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-wrap text-center mb-5">
                        <h6 class="text-color-primary font-weight-bold mb-2">DES EXPERTS PASSIONNÉS</h6>
                        <h3 class="font-weight-bold">Notre Équipe Dirigeante</h3>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach($team as $member)
                    <div class="col-lg-4 col-md-6 mb-4 wow animate__fadeInUp" data-wow-delay="0.2s">
                        <div class="card h-100 border-0 shadow-sm overflow-hidden text-center">
                            <!-- Placeholder image colored as fallback or real team asset -->
                            <div class="bg-success py-4 d-flex justify-content-center align-items-center" style="height: 180px; background-image: linear-gradient(135deg, #2e7d32, #1b5e3a);">
                                <div class="rounded-circle bg-white d-flex justify-content-center align-items-center" style="width: 110px; height: 110px; border: 4px solid rgba(255,255,255,0.4);">
                                    <i class="fas fa-user-tie text-success" style="font-size: 50px;"></i>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <h5 class="card-title font-weight-bold text-dark m-0">{{ $member['name'] }}</h5>
                                <p class="text-success small font-weight-bold mb-3">{{ $member['role'] }}</p>
                                <p class="card-text text-muted small">{{ $member['bio'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
