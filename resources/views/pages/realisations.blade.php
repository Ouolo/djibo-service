@extends('layouts.app')

@section('title', 'Nos Réalisations – Djibo Services')

@section('content')

    <!-- Breadcrumb -->
    <div class="breadcrumb-area bg-color-primary py-5 text-center text-white" style="background-image: linear-gradient(135deg, var(--vert-dark), var(--vert));">
        <div class="container">
            <h1 class="font-weight-bold text-white mb-2">⭐ Nos Réalisations</h1>
            <p class="lead m-0" style="color: var(--jaune-agri) !important; font-weight: 700;">Découvrez l'impact concret de nos actions sur les parcelles et communautés</p>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-white py-5 border-bottom">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-2 col-sm-6 mb-4 mb-md-0 wow animate__fadeInUp" data-wow-delay="0.1s">
                    <h2 class="font-weight-bold mb-1" style="font-size: 2.5rem; color: var(--jaune-agri);">10 000 +</h2>
                    <p class="text-muted small m-0 uppercase font-weight-bold">Producteurs formés</p>
                </div>
                <div class="col-md-2 col-sm-6 wow animate__fadeInUp" data-wow-delay="0.4s">
                    <h2 class="font-weight-bold mb-1" style="font-size: 2.5rem; color: var(--jaune-agri);">611 168  +</h2>
                    <p class="text-muted small m-0 uppercase font-weight-bold">personnes atteints indirectement  </p>
                </div>
                <div class="col-md-2 col-sm-6 mb-4 mb-md-0 wow animate__fadeInUp" data-wow-delay="0.2s">
                    <h2 class="font-weight-bold mb-1" style="font-size: 2.5rem; color: var(--jaune-agri);">3 200 +</h2>
                    <p class="text-muted small m-0 uppercase font-weight-bold">coopératives touchées</p>
                </div>
                <div class="col-md-2 col-sm-6 mb-4 mb-md-0 wow animate__fadeInUp" data-wow-delay="0.3s">
                    <h2 class="font-weight-bold mb-1" style="font-size: 2.5rem; color: var(--jaune-agri);">50+</h2>
                    <p class="text-muted small m-0 uppercase font-weight-bold">Fermes accompagnées</p>
                </div>
                <div class="col-md-2 col-sm-6 wow animate__fadeInUp" data-wow-delay="0.4s">
                    <h2 class="font-weight-bold mb-1" style="font-size: 2.5rem; color: var(--jaune-agri);">11 390+</h2>
                    <p class="text-muted small m-0 uppercase font-weight-bold">Litres d'activateur vendus</p>
                </div>
                
                 <div class="col-md-2 col-sm-6 wow animate__fadeInUp" data-wow-delay="0.4s">
                    <h2 class="font-weight-bold mb-1" style="font-size: 2.5rem; color: var(--jaune-agri);">30 +</h2>
                    <p class="text-muted small m-0 uppercase font-weight-bold">stagiaires Encadrés </p>
                </div>
            </div>
                

            </div>
        </div>
    </div>

    <!-- Réalisations Grid -->
    <div class="section-space--ptb_80 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-wrap text-center mb-5">
                        <h6 class="font-weight-bold mb-2" style="color: var(--vert); letter-spacing: 1px;">PROJETS MARQUANTS</h6>
                        <h3 class="font-weight-bold">Histoires de Réussite Agro-écologique</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($realisations as $realisation)
                    <div class="col-lg-4 col-md-6 mb-4 wow animate__fadeInUp" data-wow-delay="0.2s">
                        <div class="card border-0 shadow-sm rounded-lg overflow-hidden h-100 d-flex flex-column justify-content-between">
                            <div>
                                <img src="{{ asset($realisation['image']) }}" class="card-img-top w-100" alt="{{ $realisation['title'] }}" style="height: 230px; object-fit: cover;">
                                <div class="p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge text-dark" style="background-color: var(--jaune-agri);"><i class="fas fa-map-marker-alt me-1"></i> {{ $realisation['location'] }}</span>
                                    </div>
                                    <h5 class="card-title font-weight-bold text-dark mb-2">{{ $realisation['title'] }}</h5>
                                    <h6 class="font-weight-bold mb-3" style="color: var(--bleu-confiance);"><i class="fas fa-chart-line me-1"></i> Impact : {{ $realisation['impact'] }}</h6>
                                    <p class="card-text text-muted small">{{ $realisation['description'] }}</p>
                                </div>
                            </div>
                            <div class="px-4 pb-4">
                                <hr class="mt-0">
                                <a href="{{ route('realisations.public.show', $realisation['id']) }}" class="btn btn-link p-0 text-decoration-none font-weight-bold" style="color: var(--bleu-confiance);">
                                    Lire la suite <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                                <a href="https://wa.me/22392692448?text=Je%20souhaite%20en%20savoir%20plus%20sur%20le%20projet%20{{ urlencode($realisation['title']) }}" target="_blank" 
                                   class="btn btn-link p-0 text-decoration-none font-weight-bold ms-3"
                                   style="color: var(--bleu-confiance);">
                                    Contacter via WhatsApp <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
