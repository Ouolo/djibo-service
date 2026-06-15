@extends('layouts.app')
@section('title', 'Nos Services – Djibo Service')

@section('content')

<div class="dj-breadcrumb">
    <div class="container">
        <h1>🌾 Nos Services Agricoles</h1>
        <p>
           <strong> DJIBO SERVICES</strong> accompagne les producteurs, coopératives, organisations paysannes,<strong>ONG </strong> et projets de développement à travers une offre complète de services et de solutions innovantes pour une agriculture durable et résiliente.
        
        </p>
    </div>
</div>

<section class="section-creme section-pad">
    <div class="container">
        <div class="section-heading" data-animate>
            <span class="section-label">Notre Mission</span>
            <h2>Des services experts pour le développement rural</h2>
        </div>

        @foreach($services as $service)
        @php
            $isFormation = ($service['slug'] === 'formation');
            $serviceColor = $isFormation ? 'var(--bleu-confiance)' : 'var(--vert)';
            $serviceColorDark = $isFormation ? '#0d47a1' : 'var(--vert-dark)';
            $serviceColorLight = $isFormation ? 'rgba(21, 101, 192, 0.1)' : 'var(--vert-light-bg)';
        @endphp
        <div style="background:var(--blanc);border:1px solid var(--bordure);border-left: 5px solid {{ $serviceColor }};border-radius:14px;padding:40px;margin-bottom:28px;" data-animate>
            <div class="row align-items-center g-4">
                <div class="col-lg-1 col-md-2 text-center">
                    <div style="width:70px;height:70px;background:linear-gradient(135deg,{{ $serviceColorDark }},{{ $serviceColor }});border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:28px;color:#fff;margin:0 auto;">
                        <i class="fas {{ $service['icon'] }}"></i>
                    </div>
                </div>
                <div class="col-lg-7 col-md-10">
                    <h3 style="font-size:26px;margin-bottom:12px;color:{{ $serviceColor }}; font-weight: 700;">{{ $service['title'] }}</h3>
                    <p style="color:#6b5e50;margin-bottom:20px;">{{ $service['description'] }}</p>
                    <div class="row g-2">
                        @foreach($service['details'] as $detail)
                        <div class="col-md-6">
                            <p style="font-size:14px;color:#5a4535;margin:0;"><span style="color:{{ $serviceColor }};font-weight:700;">✓</span> {{ $detail }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4 d-flex flex-column gap-2">
                    <a href="https://wa.me/22376543210?text=Je%20veux%20plus%20d%27infos%20sur%20{{ urlencode($service['title']) }}"
                       target="_blank" class="btn-dj-primary" style="justify-content:center;background:#25d366;text-align:center;">
                        <i class="fab fa-whatsapp"></i> Demander un devis
                    </a>
                    <a href="{{ route('contact') }}" class="btn-dj-primary" style="justify-content:center;background:transparent;border:2px solid {{ $serviceColor }};color:{{ $serviceColor }};text-align:center;">
                        Nous contacter
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<section style="background:linear-gradient(135deg,var(--vert-dark),var(--vert));padding:64px 0;text-align:center;">
    <div class="container">
        <h2 style="color:#fff;margin-bottom:16px;" data-animate>Besoin d'un accompagnement sur-mesure ?</h2>
        <p style="color:rgba(255,255,255,0.85);font-size:17px;margin-bottom:28px;" data-animate>Nos ingénieurs interviennent sur toute la région de Ségou.</p>
        <a href="{{ route('contact') }}" class="btn-dj-primary" style="background: var(--jaune-agri); color: var(--gris-fonce); border: none; font-weight: 700;" data-animate>Demander une visite diagnostic</a>
    </div>
</section>

@endsection
