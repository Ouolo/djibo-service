@extends('layouts.app')

@section('title', 'Fiche Technique – Bonnes Pratiques – Djibo Services')

@push('styles')
<style>
/* ===== HERO FICHE ===== */
.ft-hero {
    background: linear-gradient(135deg, var(--vert-dark) 0%, var(--vert) 60%, #4CAF50 100%);
    padding: 90px 0 70px;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.ft-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: repeating-linear-gradient(
        45deg, transparent, transparent 40px,
        rgba(255,255,255,0.03) 40px, rgba(255,255,255,0.03) 80px
    );
}
.ft-hero h1 { color: #fff; position: relative; z-index: 1; }
.ft-hero p  { color: var(--jaune-agri); position: relative; z-index: 1; font-size: 1.1rem; font-weight: 600; max-width: 680px; margin: 12px auto 0; }

/* ===== ÉTAPES ===== */
.ft-step {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    background: #fff;
    border-radius: 16px;
    padding: 24px 28px;
    box-shadow: 0 4px 20px rgba(46,125,50,0.08);
    border-left: 5px solid var(--vert-clair);
    transition: transform 0.3s, box-shadow 0.3s;
    height: 100%;
}
.ft-step:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(46,125,50,0.15);
}
.ft-step-num {
    width: 48px; height: 48px;
    background: var(--vert);
    color: #fff;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; font-weight: 800;
    flex-shrink: 0;
}
.ft-step-body h5 { color: var(--vert); font-weight: 700; margin-bottom: 6px; }
.ft-step-body p  { color: var(--gris-fonce); font-size: 14px; margin: 0; opacity: 0.85; line-height: 1.6; }

/* ===== DOSAGE TABLE ===== */
.ft-table thead { background: var(--vert); color: #fff; }
.ft-table tbody tr:nth-child(even) { background: var(--vert-light-bg); }
.ft-table td, .ft-table th { padding: 12px 18px; vertical-align: middle; }

/* ===== FICHE IMAGE ===== */
.ft-img-wrapper {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    transition: transform 0.4s;
}
.ft-img-wrapper:hover { transform: scale(1.01); }
.ft-img-wrapper img { width: 100%; display: block; }
.ft-img-badge {
    position: absolute;
    top: 18px; left: 18px;
    background: var(--jaune-agri);
    color: var(--gris-fonce);
    font-weight: 800;
    font-size: 12px;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    padding: 6px 16px;
    border-radius: 20px;
}

/* ===== WARNING BOX ===== */
.ft-alert {
    background: rgba(249,168,37,0.1);
    border: 2px solid var(--jaune-agri);
    border-radius: 14px;
    padding: 20px 24px;
}
.ft-alert i { color: var(--jaune-agri); font-size: 22px; }
</style>
@endpush

@section('content')

{{-- ===== HERO ===== --}}
<div class="ft-hero">
    <div class="container">
        <h1 class="fw-bold mb-2">📋 Fiche Technique & Bonnes Pratiques</h1>
        <p>Guide complet d'utilisation de l'Activateur Biologique Djibo Services pour une production de compost optimale en 10 jours.</p>
    </div>
</div>
{{-- ===== BANDEAU PRODUIT ASSOCIÉ ===== --}}
<div style="background: var(--vert); padding: 14px 0;" data-animate>
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="d-flex align-items-center gap-3">
                <i class="fas fa-box-open" style="font-size:22px; color:var(--jaune-agri);"></i>
                <div>
                    <span style="color:rgba(255,255,255,0.75); font-size:12px; text-transform:uppercase; letter-spacing:1.5px; font-weight:600;">Produit associé à cette fiche</span>
                    <strong style="color:#fff; display:block; font-size:16px;">BioActivateur Sol-Plus – Djibo Services</strong>
                </div>
            </div>
            <a href="{{ route('products') }}" 
               style="display:inline-flex; align-items:center; gap:8px; background:var(--jaune-agri); color:var(--gris-fonce); padding:10px 24px; border-radius:30px; font-weight:700; font-size:14px; text-decoration:none; white-space:nowrap; transition:all 0.3s;"
               onmouseover="this.style.background='#fff';" onmouseout="this.style.background='var(--jaune-agri)';">
                <i class="fas fa-arrow-right"></i> Voir le Produit
            </a>
        </div>
    </div>
</div>

{{-- ===== PRÉSENTATION DU PRODUIT ===== --}}
<section style="background: var(--gris-clair); padding: 72px 0;">
    <div class="container">
        <div class="row align-items-center g-5">

            {{-- Image fiche technique --}}
            <div class="col-lg-6" data-animate>
                <div class="ft-img-wrapper">
                    <img src="{{ asset('assets/images/realisation/ficheTechnique.jpg') }}" alt="Fiche Technique Activateur Biologique Djibo Services">
                    <span class="ft-img-badge">📄 Fiche Officielle</span>
                </div>
                <div class="text-center mt-4">
                    <a href="{{ asset('assets/images/realisation/ficheTechnique.jpg') }}" download="FicheTechnique-Djibo-Service.jpg"
                       class="btn-dj-primary" style="display: inline-flex; align-items: center; gap: 8px;">
                        <i class="fas fa-download"></i> Télécharger la fiche
                    </a>
                </div>
            </div>

            {{-- Texte de présentation --}}
            <div class="col-lg-6" data-animate>
                <div class="section-heading text-start mb-4">
                    <span class="section-label">Notre Produit Phare</span>
                    <h2 style="font-size: 2rem;">L'Activateur Compost</h2>
                </div>
                <p style="font-size: 1.05rem; color: var(--gris-fonce); line-height: 1.8; margin-bottom: 20px;">
                    L'activateur compost est un produit <strong>100% naturel</strong> à base de jus stomacal des ruminants. 
                    Il permet aux agriculteurs de produire du compost de haute qualité en <strong>seulement 10 jours</strong>, 
                    contre 45 à 90 jours avec les méthodes traditionnelles.
                </p>
                <div class="row g-3">
                    @foreach([
                        ['fas fa-clock', 'Compost prêt en 10 jours', 'Versus 45–90 jours traditionnels'],
                        ['fas fa-seedling', '5 à 10 t/ha suffisent', 'Versus 15–30 t/ha en méthode classique'],
                        ['fas fa-leaf', '100% naturel & biologique', 'Aucun produit chimique ajouté'],
                        ['fas fa-award', 'Premier en Afrique de l\'Ouest', 'Innovation exclusive Djibo Services'],
                    ] as $feat)
                    <div class="col-6">
                        <div style="background:#fff; border-radius:12px; padding:16px; box-shadow:0 4px 12px rgba(0,0,0,0.06); height:100%;">
                            <i class="fas {{ $feat[0] }}" style="font-size:22px; color:var(--vert); margin-bottom:8px; display:block;"></i>
                            <strong style="font-size:13px; color:var(--gris-fonce);">{{ $feat[1] }}</strong>
                            <p style="font-size:12px; color:#888; margin:4px 0 0;">{{ $feat[2] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ===== AVANT / APRÈS ===== --}}
<section style="background: #fff; padding: 72px 0;">
    <div class="container">
        <div class="section-heading text-center mb-5" data-animate>
            <span class="section-label">Résultats Prouvés</span>
            <h2>Avant & Après l'Utilisation</h2>
            <p>Photos réelles de parcelles avant et après application de l'Activateur Biologique Djibo Services.</p>
        </div>
        <div class="row g-4">

            {{-- AVANT --}}
            <div class="col-lg-6" data-animate>
                <div style="background: rgba(249,168,37,0.06); border: 2px solid var(--jaune-agri); border-radius:20px; overflow:hidden; height:100%; display:flex; flex-direction:column;">
                    {{-- Image Avant --}}
                    <div style="position:relative; flex-shrink:0;">
                        <img src="{{ asset('assets/images/realisation/Avant.jpg') }}"
                             alt="Sol avant utilisation de l'activateur – méthode traditionnelle"
                             style="width:100%; height:260px; object-fit:cover; display:block;">
                        <span style="position:absolute; top:14px; left:14px; background:var(--jaune-agri); color:var(--gris-fonce); font-weight:800; font-size:12px; letter-spacing:1.5px; text-transform:uppercase; padding:6px 16px; border-radius:20px;">
                            ⏱ J-0 — Avant
                        </span>
                    </div>
                    {{-- Contenu --}}
                    <div style="padding:24px 28px; flex:1;">
                        <h5 style="color: var(--jaune-agri); margin-bottom:12px;">
                            <i class="fas fa-times-circle me-2"></i>Méthode Traditionnelle
                        </h5>
                        <ul style="font-size:14px; color:var(--gris-fonce); line-height:2; padding-left:20px; margin:0;">
                           
                            
                            <li>Qualité variable et inconstante</li>
                            <li>Découragement des producteurs</li>
                            <li>Dépendance aux engrais chimiques</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- APRÈS --}}
            <div class="col-lg-6" data-animate>
                <div style="background: var(--vert-light-bg); border: 2px solid var(--vert-clair); border-radius:20px; overflow:hidden; height:100%; display:flex; flex-direction:column;">
                    {{-- Image Après --}}
                    <div style="position:relative; flex-shrink:0;">
                        <img src="{{ asset('assets/images/realisation/Apres.jpg') }}"
                             alt="Sol après 10 jours d'utilisation de l'activateur Djibo Services"
                             style="width:100%; height:260px; object-fit:cover; display:block;">
                        <span style="position:absolute; top:14px; left:14px; background:var(--vert); color:#fff; font-weight:800; font-size:12px; letter-spacing:1.5px; text-transform:uppercase; padding:6px 16px; border-radius:20px;">
                            ✅ J+10 — Après
                        </span>
                    </div>
                    {{-- Contenu --}}
                    <div style="padding:24px 28px; flex:1;">
                        <h5 style="color: var(--vert); margin-bottom:12px;">
                            <i class="fas fa-check-circle me-2"></i>Avec l'Activateur Djibo Services
                        </h5>
                        <ul style="font-size:14px; color:var(--gris-fonce); line-height:2; padding-left:20px; margin:0;">
                            <li>Compost homogène et de haute qualité</li>
                            <li>Producteurs autonomes et motivés</li>
                            <li>Agriculture 100% biologique et durable</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ===== CTA ===== --}}
<section style="background: linear-gradient(135deg, var(--vert-dark), var(--vert)); padding: 72px 0; text-align:center;" data-animate>
    <div class="container">
        <h2 style="color:#fff; margin-bottom:16px;">Prêt à commander le BioActivateur Sol-Plus ?</h2>
        <p style="color: rgba(255,255,255,0.85); font-size:1.1rem; max-width:580px; margin:0 auto 32px;">
            Vous avez consulté la fiche technique — passez à l'action ! Commandez directement ou contactez nos techniciens pour un accompagnement personnalisé.
        </p>
        <div class="dj-hero-actions" style="justify-content:center; flex-wrap:wrap;">
            <a href="{{ route('products') }}" class="btn-dj-primary btn-dj-orange">
                <i class="fas fa-box-open"></i> Voir la Fiche Produit
            </a>
            <a href="https://wa.me/22392692448?text=Bonjour,%20j%27ai%20lu%20la%20fiche%20technique%20et%20je%20veux%20commander%20l%27Activateur%20Djibo%20Service"
               target="_blank" class="btn-dj-primary" style="background:#25d366;">
                <i class="fab fa-whatsapp"></i> Commander sur WhatsApp
            </a>
            <a href="{{ route('contact') }}" class="btn-dj-primary" style="background:rgba(255,255,255,0.15); border:2px solid rgba(255,255,255,0.4);">
                <i class="fas fa-phone-alt"></i> Nous contacter
            </a>
        </div>
    </div>
</section>

@endsection
