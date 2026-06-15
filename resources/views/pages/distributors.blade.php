@extends('layouts.app')

@section('title', 'Nos Distributeurs – Djibo Service')

@section('content')

    <!-- Breadcrumb -->
    <div class="breadcrumb-area bg-color-primary py-5 text-center text-white" style="background-image: linear-gradient(135deg, var(--vert-dark), var(--vert));">
        <div class="container">
            <h1 class="font-weight-bold text-white mb-2">🚜 Nos Distributeurs Agréés</h1>
            <p class="lead m-0" style="color: var(--jaune-agri) !important; font-weight: 700;">Retrouvez facilement nos intrants et produits biologiques près de chez vous</p>
        </div>
    </div>

    <!-- Distributors List -->
    <div class="section-space--ptb_80 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-wrap text-center mb-5">
                        <h6 class="font-weight-bold mb-2" style="color: var(--vert); letter-spacing: 1px;">POINTS DE VENTE</h6>
                        <h3 class="font-weight-bold">Nos Agro-Dealers et Magasins Partenaires</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($distributors as $distributor)
                    <div class="col-lg-4 col-md-6 mb-4 wow animate__fadeInUp" data-wow-delay="0.2s">
                        <div class="card h-100 border-0 shadow-sm rounded-lg overflow-hidden d-flex flex-column justify-content-between">
                            <div class="p-4">
                                <div class="text-white py-2 px-3 rounded d-inline-block mb-3 small font-weight-bold" style="background-color: var(--bleu-confiance);">
                                    <i class="fas fa-store me-1"></i> Point de Vente Agréé
                                </div>
                                <h4 class="font-weight-bold text-dark mb-2">{{ $distributor['name'] }}</h4>
                                <p class="font-weight-bold mb-3" style="color: var(--vert);"><i class="fas fa-map-marker-alt me-1"></i> {{ $distributor['location'] }}</p>
                                <hr class="my-3">
                                
                                <ul class="list-unstyled text-muted small">
                                    <li class="mb-2"><strong>👤 Gérant :</strong> {{ $distributor['contact_name'] }}</li>
                                    <li class="mb-2"><strong>📍 Adresse :</strong> {{ $distributor['address'] }}</li>
                                    <li class="mb-2"><strong>🌍 Zones couvertes :</strong> {{ $distributor['cities_covered'] }}</li>
                                </ul>
                            </div>
                            <div class="p-4 bg-white border-top">
                                <a href="tel:{{ str_replace(' ', '', $distributor['phone']) }}" 
                                   class="btn w-100 rounded-pill font-weight-bold mb-2"
                                   style="border: 2px solid var(--vert); color: var(--vert); background: transparent; transition: all 0.3s;"
                                   onmouseover="this.style.background='var(--vert)'; this.style.color='#fff';"
                                   onmouseout="this.style.background='transparent'; this.style.color='var(--vert)';">
                                    <i class="fas fa-phone-alt me-2"></i> {{ $distributor['phone'] }}
                                </a>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $distributor['phone']) }}?text=Bonjour,%20je%20souhaite%20acheter%20les%20produits%20Djibo%20Service" target="_blank" 
                                   class="btn w-100 rounded-pill font-weight-bold text-white" 
                                   style="background: var(--vert); border: none; transition: background 0.3s;"
                                   onmouseover="this.style.background='var(--vert-dark)';"
                                   onmouseout="this.style.background='var(--vert)';">
                                    <i class="fab fa-whatsapp me-2"></i> Contacter par WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Join Network -->
    <div class="section-space--ptb_80 bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="{{ asset('assets/images/universite/partenaires.jpg') }}" class="img-fluid rounded-lg shadow-sm" alt="Rejoindre réseau" style="max-height: 380px; width: 100%; object-fit: cover;">
                </div>
                <div class="col-lg-6">
                    <div class="ps-lg-4">
                        <h6 class="font-weight-bold mb-2" style="color: var(--vert); letter-spacing: 1px;">REJOINDRE NOTRE RÉSEAU</h6>
                        <h2 class="font-weight-bold mb-4">Devenez Distributeur Djibo Service</h2>
                        <p class="text-muted mb-4">
                            Vous êtes propriétaire d'un magasin d'intrants agricoles, d'une coopérative ou un agro-dealer au Mali ? Rejoignez notre réseau de distribution et proposez à vos clients des produits biologiques haut de gamme certifiés, qui régénèrent les sols et augmentent les rendements.
                        </p>
                        <h5 class="font-weight-bold mb-3">Nos avantages partenaires :</h5>
                        <ul class="list-unstyled mb-4 text-muted">
                            <li class="mb-2"><i class="fas fa-check-circle me-2" style="color: var(--vert-clair);"></i> Marges bénéficiaires attractives et tarifs grossistes.</li>
                            <li class="mb-2"><i class="fas fa-check-circle me-2" style="color: var(--vert-clair);"></i> Formations techniques gratuites sur l'usage des produits.</li>
                            <li class="mb-2"><i class="fas fa-check-circle me-2" style="color: var(--vert-clair);"></i> Référencement de votre boutique sur nos canaux de communication.</li>
                        </ul>
                        <a href="{{ route('contact') }}" class="btn-dj-primary">
                            Postuler maintenant
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
