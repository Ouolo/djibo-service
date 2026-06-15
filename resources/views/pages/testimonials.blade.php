@extends('layouts.app')

@section('title', 'Témoignages – Djibo Service')

@push('styles')
<style>

/* PAGE GLOBAL */
.testimonial-page-card{
    background: #fff;
    border-radius: 18px;
    padding: 30px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.05);
    border-left: 5px solid var(--vert);
    position: relative;
    transition: all .3s ease;
}

.testimonial-page-card:hover{
    transform: translateY(-6px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
}

/* QUOTE */
.quote-icon-bg{
    position: absolute;
    top: 15px;
    right: 25px;
    font-size: 55px;
    color: rgba(46,125,50,0.06);
}

/* AVANT/APRES */
.before-after-box{
    background: linear-gradient(135deg, #f7fff7, #eef9f0);
    border: 1px solid rgba(46,125,50,0.15);
    border-radius: 12px;
    padding: 15px;
}

/* BADGE ROLE */
.role-badge{
    background: rgba(46,125,50,0.1);
    color: var(--vert);
    font-weight: 600;
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
}

/* PARTENAIRES */
.partner-card{
    background: #fff;
    border-radius: 12px;
    padding: 25px;
    text-align: center;
    font-weight: 600;
    color: #2d3748;
    border: 1px solid #eee;
    transition: .3s;
    height: 100%;
}

.partner-card:hover{
    transform: translateY(-5px);
    border-color: var(--vert);
    color: var(--vert);
    box-shadow: 0 10px 20px rgba(0,0,0,0.06);
}

.partner-icon{
    font-size: 28px;
    margin-bottom: 10px;
}

</style>
@endpush

@section('content')

<!-- HERO -->
<div class="breadcrumb-area py-5 text-center text-white"
     style="background: linear-gradient(135deg, var(--vert-dark), var(--vert));">

    <div class="container">
        <h1 class="font-weight-bold mb-2">⭐ Témoignages & Références</h1>
        <p class="lead m-0" style="color: var(--jaune-agri); font-weight: 700;">
            Expériences réelles des producteurs accompagnés par Djibo Service
        </p>
    </div>
</div>

<!-- TITLE -->
<div class="bg-light py-5 text-center">
    <div class="container">
        <h6 style="color: var(--vert); letter-spacing: 1px;">RETROACTIONS TERRAIN</h6>
        <h3 class="font-weight-bold">Ce que disent nos producteurs</h3>
    </div>
</div>

<!-- TESTIMONIALS -->
<div class="section-space--ptb_80 bg-light">
    <div class="container">

        <div class="row">

            @foreach($testimonials as $testimonial)

            <div class="col-lg-12 mb-4 wow animate__fadeInUp">

                <div class="testimonial-page-card">

                    <div class="quote-icon-bg">
                        <i class="fas fa-quote-right"></i>
                    </div>

                    <div class="row align-items-center">

                        <!-- IMAGE -->
                        <div class="col-md-2 text-center mb-3 mb-md-0">

                            <img src="{{ asset($testimonial['image']) }}"
                                 class="rounded-circle shadow-sm"
                                 style="width:90px;height:90px;object-fit:cover;border:3px solid var(--vert);">

                            <h6 class="font-weight-bold mt-2 mb-0">
                                {{ $testimonial['name'] }}
                            </h6>

                            <small class="text-muted">
                                {{ $testimonial['location'] }}
                            </small>

                        </div>

                        <!-- QUOTE -->
                        <div class="col-md-6 mb-3 mb-md-0">

                            <span class="role-badge">
                                {{ $testimonial['role'] }}
                            </span>

                            <p class="mt-3 mb-0 font-italic" style="font-size: 1.1rem;">
                                “ {{ $testimonial['quote'] }} ”
                            </p>

                        </div>

                        <!-- BEFORE AFTER -->
                        <div class="col-md-4">

                            <h6 class="font-weight-bold mb-3">
                                📊 Résultat terrain
                            </h6>

                            <div class="before-after-box">

                                <div class="mb-2">
                                    <span class="badge bg-danger text-white">Avant</span>
                                    <p class="text-muted small mt-1 mb-0">
                                        {{ $testimonial['before_after']['before'] }}
                                    </p>
                                </div>

                                <hr>

                                <div>
                                    <span class="badge" style="background: var(--vert); color:#fff;">
                                        Après
                                    </span>
                                    <p class="small font-weight-bold mt-1 mb-0" style="color: var(--vert);">
                                        {{ $testimonial['before_after']['after'] }}
                                    </p>
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

<!-- PARTENAIRES -->
<div class="section-space--ptb_80 bg-white">

    <div class="container">

        <div class="text-center mb-5">
            <h6 style="color: var(--vert);">Confiance & Réseau</h6>
            <h3 class="font-weight-bold">Nos partenaires</h3>
        </div>

        <div class="row">

            <div class="col-md-3 col-sm-6 mb-4">
                <div class="partner-card">
                    <div class="partner-icon">🌱</div>
                    Coopérative Maraîchère de Sébougou
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4">
                <div class="partner-card">
                    <div class="partner-icon">🌾</div>
                    Union des Producteurs Niger-Mali
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4">
                <div class="partner-card">
                    <div class="partner-icon">🚜</div>
                    AgroDealer Al-Baraka Ségou
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-4">
                <div class="partner-card">
                    <div class="partner-icon">🧪</div>
                    Labo Microbiologie FAMA
                </div>
            </div>

        </div>

    </div>

</div>

@endsection