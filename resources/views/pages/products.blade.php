@extends('layouts.app')

@section('title', 'Nos Produits – Djibo Service')

@section('content')

    <!-- Breadcrumb -->
    <div class="breadcrumb-area bg-color-primary py-5 text-center text-white" style="background-image: linear-gradient(135deg, #1b5e3a, #10251e);">
        <div class="container">
            <h1 class="font-weight-bold text-white mb-2">🌱 Notre Catalogue Produits</h1>
            <p class="lead text-warning m-0">Des solutions écologiques éprouvées pour revitaliser vos cultures</p>
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
                            <span class="badge bg-success py-2 px-4 rounded-pill mb-2">🔥 INNOVATION EN VEDETTE</span>
                            <h2 class="font-weight-bold">L'Activateur Biologique Révolutionnaire</h2>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center bg-light p-4 p-md-5 rounded-lg shadow-sm">
                    <div class="col-lg-5 mb-4 mb-lg-0">
                        <div class="bg-white p-2 rounded shadow-sm">
                            <img src="{{ asset($featured['image']) }}" class="img-fluid rounded w-100" alt="{{ $featured['name'] }}" style="max-height: 400px; object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="ps-lg-4">
                            <span class="text-success font-weight-bold small uppercase d-block mb-1">{{ $featured['category'] }}</span>
                            <h3 class="font-weight-bold text-dark mb-2">{{ $featured['name'] }}</h3>
                            <h4 class="text-success font-weight-bold mb-4">{{ $featured['price'] }}</h4>
                            <p class="text-muted mb-4">{{ $featured['description'] }}</p>
                            
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <h5 class="font-weight-bold text-dark mb-2"><i class="fas fa-list-ul text-success me-2"></i> Avantages</h5>
                                    <ul class="list-unstyled text-muted small">
                                        @foreach($featured['benefits'] as $benefit)
                                            <li class="mb-1"><i class="fas fa-check text-success me-1"></i> {{ $benefit }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h5 class="font-weight-bold text-dark mb-2"><i class="fas fa-info-circle text-success me-2"></i> Mode d'emploi</h5>
                                    <p class="text-muted small m-0">{{ $featured['usage'] }}</p>
                                </div>
                            </div>

                            <a href="https://wa.me/22376543210?text=Bonjour,%20je%20souhaite%20commander%20le%20BioActivateur%20Sol-Plus" target="_blank" class="ht-btn ht-btn-md">
                                <i class="fab fa-whatsapp me-2"></i> Commander via WhatsApp
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
                        <h6 class="text-color-primary font-weight-bold mb-2">AUTRES INTRANTS</h6>
                        <h3 class="font-weight-bold">Gamme Complète Djibo Service</h3>
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
                                    <p class="text-success font-weight-bold mb-3">{{ $product['price'] }}</p>
                                    <p class="text-muted small mb-4">{{ $product['short_description'] }}</p>
                                    
                                    <div class="bg-light p-2 rounded mb-3">
                                        <small class="d-block font-weight-bold text-dark mb-1">💡 Utilisation :</small>
                                        <p class="text-muted small m-0" style="font-size: 0.8rem;">{{ $product['usage'] }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="px-4 pb-4">
                                <a href="https://wa.me/22376543210?text=Bonjour,%20je%20suis%20interesse%20par%20le%20produit%20{{ urlencode($product['name']) }}" target="_blank" class="btn btn-outline-success w-100 rounded-pill font-weight-bold">
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
