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
                        <h2 class="font-weight-bold mb-4">Depuis plus de 10 ans au service de la terre</h2>
                        <p class="text-muted mb-4">
                            Fondé à Ségou par des passionnés d'agronomie, <strong>Djibo Service</strong> est né du constat alarmant de la dégradation rapide des sols arables au Mali sous l'effet du changement climatique et de l'usage abusif d'intrants chimiques.
                        </p>
                        <p class="text-muted mb-4">
                            Nous avons démarré comme un simple bureau de conseil. Très vite, pour répondre concrètement aux défis des producteurs, nous avons développé nos propres formules d'activateurs biologiques de compostage et d'intrants organiques pour offrir des alternatives crédibles, économiques et respectueuses de l'environnement.
                        </p>
                        
                        <div class="p-3 bg-light rounded-lg border-left border-success border-3">
                            <h5 class="font-weight-bold text-dark mb-2">Notre Mission</h5>
                            <p class="text-muted m-0">
                                Démocratiser les techniques agroécologiques au Mali en fournissant des intrants biologiques de haute qualité, des formations pratiques et un accompagnement agronomique continu pour garantir la sécurité alimentaire et l'autosuffisance des producteurs.
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
                <div class="col-md-4 mb-4 wow animate__fadeInUp" data-wow-delay="0.2s">
                    <div class="card h-100 p-4 border-0 shadow-sm text-center">
                        <div class="card-body">
                            <div class="text-success mb-3" style="font-size: 30px;"><i class="fas fa-seedling"></i></div>
                            <h5 class="font-weight-bold mb-3">Responsabilité Écologique</h5>
                            <p class="text-muted m-0">Toutes nos actions et produits visent à régénérer la terre et préserver la biodiversité sahélienne.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 wow animate__fadeInUp" data-wow-delay="0.4s">
                    <div class="card h-100 p-4 border-0 shadow-sm text-center">
                        <div class="card-body">
                            <div class="text-success mb-3" style="font-size: 30px;"><i class="fas fa-handshake"></i></div>
                            <h5 class="font-weight-bold mb-3">Proximité & Engagement</h5>
                            <p class="text-muted m-0">Nous croyons en un accompagnement direct sur le terrain, main dans la main avec le producteur agricole.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 wow animate__fadeInUp" data-wow-delay="0.6s">
                    <div class="card h-100 p-4 border-0 shadow-sm text-center">
                        <div class="card-body">
                            <div class="text-success mb-3" style="font-size: 30px;"><i class="fas fa-microscope"></i></div>
                            <h5 class="font-weight-bold mb-3">Innovation Agricole</h5>
                            <p class="text-muted m-0">Rechercher et formuler sans cesse des solutions biologiques innovantes adaptées aux sols locaux.</p>
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
                            Basés principalement à Ségou, nous couvrons activement l'ensemble de la 4ème région du Mali. Nos techniciens interviennent régulièrement sur site dans les secteurs suivants :
                        </p>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-3 text-muted"><i class="fas fa-map-marker-alt text-success me-2"></i> <strong>Ségou & Sébougou :</strong> Notre quartier général et notre ferme vitrine.</li>
                            <li class="mb-3 text-muted"><i class="fas fa-map-marker-alt text-success me-2"></i> <strong>Cercle de Bla :</strong> Zone à forte production céréalière et cotonnière.</li>
                            <li class="mb-3 text-muted"><i class="fas fa-map-marker-alt text-success me-2"></i> <strong>Cercle de San :</strong> Suivi des producteurs maraîchers et riziculteurs.</li>
                            <li class="mb-3 text-muted"><i class="fas fa-map-marker-alt text-success me-2"></i> <strong>Markala :</strong> Appui aux coopératives le long du fleuve Niger.</li>
                        </ul>
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
