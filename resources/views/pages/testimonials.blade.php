@extends('layouts.app')

@section('title', 'Témoignages – Djibo Service')

@push('styles')
    <style>
        .testimonial-page-card {
            background: #fff;
            border-radius: 15px;
            padding: 35px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            border-left: 6px solid #1b5e3a;
            position: relative;
        }
        .quote-icon-bg {
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 50px;
            color: rgba(27, 94, 58, 0.05);
            line-height: 1;
        }
        .before-after-box {
            background-color: #fafdfb;
            border: 1px solid #e8f5e9;
            border-radius: 8px;
            padding: 15px;
        }
        .ref-logo {
            background-color: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            font-weight: bold;
            color: #4a5568;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
            transition: all 0.3s ease;
        }
        .ref-logo:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0,0,0,0.05);
            border-color: #1b5e3a;
            color: #1b5e3a;
        }
    </style>
@endpush

@section('content')

    <!-- Breadcrumb -->
    <div class="breadcrumb-area bg-color-primary py-5 text-center text-white" style="background-image: linear-gradient(135deg, #1b5e3a, #10251e);">
        <div class="container">
            <h1 class="font-weight-bold text-white mb-2">⭐ Témoignages & Références</h1>
            <p class="lead text-warning m-0">Découvrez les retours d'expérience de nos clients sur le terrain</p>
        </div>
    </div>

    <!-- Testimonials List -->
    <div class="section-space--ptb_80 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-wrap text-center mb-5">
                        <h6 class="text-color-primary font-weight-bold mb-2">CE QU'ILS DISENT DE NOUS</h6>
                        <h3 class="font-weight-bold">Les Producteurs Partagent Leur Expérience</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($testimonials as $testimonial)
                    <div class="col-lg-12 mb-4 wow animate__fadeInUp" data-wow-delay="0.2s">
                        <div class="testimonial-page-card">
                            <div class="quote-icon-bg"><i class="fas fa-quote-right"></i></div>
                            <div class="row align-items-center">
                                <div class="col-md-2 text-center mb-3 mb-md-0">
                                    <img src="{{ asset($testimonial['image']) }}" class="rounded-circle border border-success border-3 shadow-sm" alt="{{ $testimonial['name'] }}" style="width: 100px; height: 100px; object-fit: cover;">
                                    <h6 class="font-weight-bold text-dark mt-2 mb-0">{{ $testimonial['name'] }}</h6>
                                    <small class="text-muted">{{ $testimonial['location'] }}</small>
                                </div>
                                <div class="col-md-6 mb-3 mb-md-0 border-end pe-md-4">
                                    <span class="badge bg-success mb-2">{{ $testimonial['role'] }}</span>
                                    <p class="font-italic text-dark mb-0 lead" style="font-size: 1.15rem;">
                                        " {{ $testimonial['quote'] }} "
                                    </p>
                                </div>
                                <div class="col-md-4 ps-md-4">
                                    <h6 class="font-weight-bold text-dark mb-3"><i class="fas fa-history text-success me-2"></i> Étude de Cas Avant / Après</h6>
                                    <div class="before-after-box">
                                        <div class="mb-2">
                                            <span class="badge bg-danger text-white me-2 small">Avant :</span>
                                            <small class="text-muted d-block mt-1">{{ $testimonial['before_after']['before'] }}</small>
                                        </div>
                                        <hr class="my-2">
                                        <div>
                                            <span class="badge bg-success text-white me-2 small">Après :</span>
                                            <small class="text-success font-weight-bold d-block mt-1">{{ $testimonial['before_after']['after'] }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Références & Partenaires -->
    <div class="section-space--ptb_80 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-wrap text-center mb-5">
                        <h6 class="text-color-primary font-weight-bold mb-2">ILS NOUS FONT CONFIANCE</h6>
                        <h3 class="font-weight-bold">Nos Partenaires & Références</h3>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="ref-logo">
                        🌱 Coopérative Maraîchère de Sébougou
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="ref-logo">
                        🌾 Union des Producteurs du Niger-Mali
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="ref-logo">
                        🚜 AgroDealer Al-Baraka Ségou
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="ref-logo">
                        🧪 Labo de Microbiologie FAMA Ségou
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
