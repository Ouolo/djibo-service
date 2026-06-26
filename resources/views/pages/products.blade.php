@extends('layouts.app')

@section('title', 'Nos Produits – Djibo Services')

@section('content')

    <!-- Breadcrumb -->
    <div class="breadcrumb-area bg-color-primary py-5 text-center text-white" style="background-image: linear-gradient(135deg, var(--vert-dark), var(--vert));">
        <div class="container">
            <h1 class="font-weight-bold text-white mb-2">🌱 Notre Catalogue Produits</h1>
            <p class="lead m-0" style="color: var(--jaune-agri) !important; font-weight: 700;">
                L’activateur de compost est un produit 100% naturel à base de jus stomacal des ruminants, permettant aux agriculteurs de produire du compost de haute qualité en seulement 10 jours, augmentant ainsi leurs rendements et réduisant leur dépendance aux engrais chimiques.</br>
                Nous sommes la première entreprise à mettre sur place un tel produit (Activateur Bio) sur le marché Ouest Africain.</br> </br>
                Notre technologie permet aux agriculteurs d’obtenir du compost de qualité en seulement 10 jours contrairement aux autres systèmes traditionnels qui nécessitent 45 jours à 90 jours voir plus, ce qui décourage les producteurs dans la production bio. Notre technique permet à nos agriculteurs de maintenir la production durable, biologique et la qualité des produits agricoles. 
                Le compost activateur permet également aux agriculteurs d’utiliser seulement 5 à 10 tonnes de compost pour un hectare au lieu de 15 à 30 tonnes de compost préparé avec les méthodes habituelles.
            </p>
        </div>
    </div>

    <!-- Produit en Vedette -->
    @php
        $featured = collect($products)->firstWhere('is_featured', true);
        $others = collect($products)->where('is_featured', false);
    @endphp

    @if($featured)
        <div class="section-space--ptb_80 bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title-wrap text-center mb-5">
                            <span class="badge py-2 px-4 rounded-pill mb-2" style="background-color: var(--brun-terre); color: #fff;">🔥 INNOVATION EN VEDETTE</span>
                            <h2 class="font-weight-bold">L'Activateur Biologique Révolutionnaire</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center p-4 p-md-5 rounded-lg shadow-sm" style="background-color: rgba(141, 110, 99, 0.08); border-left: 5px solid var(--brun-terre);">
                    <div class="col-lg-5 mb-4 mb-lg-0">
                        <div class="bg-white p-2 rounded shadow-sm">
                            <img src="{{ asset($featured['image']) }}" class="img-fluid rounded w-100" alt="{{ $featured['name'] }}" style="max-height: 400px; object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="ps-lg-4">
                            <span class="font-weight-bold small uppercase d-block mb-1" style="color: var(--brun-terre);">{{ $featured['category'] }}</span>
                            <h3 class="font-weight-bold text-dark mb-2">{{ $featured['name'] }}</h3>
                            <h4 class="font-weight-bold mb-4" style="color: var(--vert);">{{ $featured['price'] }}</h4>
                            <p class="text-muted mb-4">{{ $featured['description'] }}</p>
                            
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <h5 class="font-weight-bold text-dark mb-2"><i class="fas fa-list-ul me-2" style="color: var(--vert-clair);"></i> Avantages</h5>
                                    <ul class="list-unstyled text-muted small">
                                        @foreach($featured['benefits'] as $benefit)
                                            <li class="mb-1"><i class="fas fa-check me-1" style="color: var(--vert-clair);"></i> {{ $benefit }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h5 class="font-weight-bold text-dark mb-2"><i class="fas fa-info-circle me-2" style="color: var(--vert-clair);"></i> Mode d'emploi</h5>
                                    <p class="text-muted small m-0">{{ $featured['usage'] }}</p>
                                </div>
                            </div>

                             <a href="https://wa.me/22392692448?text=Bonjour,%20je%20souhaite%20commander%20le%20BioActivateur%20Sol-Plus" target="_blank" 
                                class="btn-dj-primary" style="background: #25d366; color: #fff;">
                                <i class="fab fa-whatsapp me-2"></i> Commander via WhatsApp
                            </a>
                            <a href="{{ route('fiche-technique') }}" 
                               class="btn-dj-primary" style="background: transparent; border: 2px solid var(--vert); color: var(--vert) !important; margin-left: 12px;">
                                <i class="fas fa-file-alt me-2"></i> Voir la Fiche Technique
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Autres Produits -->
    <div class="section-space--ptb_80 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-wrap text-center mb-5">
                        <h6 class="font-weight-bold mb-2" style="color: var(--vert); letter-spacing: 1px;">AUTRES INTRANTS</h6>
                        <h3 class="font-weight-bold">Gamme Complète Djibo Services</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($others as $product)
                    <div class="col-lg-4 col-md-6 mb-4 wow animate__fadeInUp" data-wow-delay="0.2s">
                        <div class="card h-100 border-0 shadow-sm rounded-lg overflow-hidden d-flex flex-column justify-content-between">
                            <div>
                                <img src="{{ asset($product['image']) }}" class="card-img-top" alt="{{ $product['name'] }}" style="height: 220px; object-fit: cover;">
                                <div class="p-4">
                                    <span class="text-muted small uppercase d-block mb-1">{{ $product['category'] }}</span>
                                    <h5 class="font-weight-bold text-dark mb-2">{{ $product['name'] }}</h5>
                                    <p class="font-weight-bold mb-3" style="color: var(--vert);">{{ $product['price'] }}</p>
                                    <p class="text-muted small mb-4">{{ $product['short_description'] }}</p>
                                    
                                    <div class="bg-light p-2 rounded mb-3">
                                        <small class="d-block font-weight-bold text-dark mb-1">💡 Utilisation :</small>
                                        <p class="text-muted small m-0" style="font-size: 0.8rem;">{{ $product['usage'] }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 pb-4">
                                <a href="https://wa.me/22392692448?text=Bonjour,%20je%20suis%20interesse%20par%20le%20produit%20{{ urlencode($product['name']) }}" target="_blank" 
                                   class="btn w-100 rounded-pill font-weight-bold" 
                                   style="border: 2px solid var(--vert); color: var(--vert); background: transparent; transition: all 0.3s;"
                                   onmouseover="this.style.background='var(--vert)'; this.style.color='#fff';"
                                   onmouseout="this.style.background='transparent'; this.style.color='var(--vert)';">
                                    <i class="fab fa-whatsapp me-2"></i> Commander
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
