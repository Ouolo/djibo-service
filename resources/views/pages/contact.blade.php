@extends('layouts.app')
@section('title', 'Contactez-nous – Djibo Service')

@section('content')

<div class="dj-breadcrumb">
    <div class="container">
        <h1>📞 Contactez-nous</h1>
        <p>Notre équipe répond à toute demande sous 24 heures</p>
    </div>
</div>

<section class="section-creme section-pad">
    <div class="container">

        @if(session('success'))
        <div style="background:#e8f5e9;border:1px solid var(--vert);border-radius:10px;padding:18px 24px;margin-bottom:32px;color:var(--vert);font-weight:600;">
            ✓ {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div style="background:#fff0eb;border:1px solid var(--orange);border-radius:10px;padding:18px 24px;margin-bottom:32px;color:var(--orange);">
            @foreach($errors->all() as $e)<p style="margin:0 0 4px;">• {{ $e }}</p>@endforeach
        </div>
        @endif

        <div class="row g-5">
            <!-- Coordonnées -->
            <div class="col-lg-5" data-animate>
                <h2 style="margin-bottom:8px;">Nos Coordonnées</h2>
                <p style="color:#6b5e50;margin-bottom:36px;">Appelez-nous, écrivez-nous ou passez directement à nos bureaux à Ségou.</p>

                @foreach([
                    ['fas fa-map-marker-alt','Notre Adresse','Route de Ségou, Sébougou, Ségou, Mali'],
                    ['fas fa-phone-alt','Téléphone','(+223) +223 92 69 24 48'],
                    ['fab fa-whatsapp','WhatsApp','<a href="https://wa.me/22376543210" target="_blank" style="color:var(--vert);font-weight:700;">Cliquer ici pour discuter</a>'],
                    ['fas fa-envelope','E-mail','djiboservices@gmail.com'],
                    ['fas fa-clock','Horaires','Lun-Ven: 08h00-17h00 · Sam: 09h00-13h00'],
                ] as $info)
                <div style="display:flex;gap:16px;margin-bottom:28px;" data-animate>
                    <div style="width:48px;height:48px;background:var(--vert-light);border-radius:50%;display:flex;align-items:center;justify-content:center;color:var(--vert);font-size:18px;flex-shrink:0;">
                        <i class="{{ $info[0] }}"></i>
                    </div>
                    <div>
                        <strong style="color:var(--brun);display:block;margin-bottom:4px;">{{ $info[1] }}</strong>
                        <span style="color:#6b5e50;font-size:15px;">{!! $info[2] !!}</span>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Formulaire -->
            <div class="col-lg-7" data-animate>
                <div style="background:var(--blanc);border:1px solid var(--bordure);border-radius:14px;padding:40px;">
                    <h3 style="margin-bottom:28px;">Envoyez-nous un message</h3>
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label style="font-size:13px;font-weight:600;color:#6b5e50;display:block;margin-bottom:6px;">Nom & Prénom *</label>
                                <input type="text" name="name" value="{{ old('name') }}" required
                                    style="width:100%;border:1px solid var(--bordure);border-radius:8px;padding:12px 16px;font-size:15px;background:var(--creme);outline:none;font-family:'Inter',sans-serif;">
                            </div>
                            <div class="col-md-6">
                                <label style="font-size:13px;font-weight:600;color:#6b5e50;display:block;margin-bottom:6px;">Téléphone *</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" required
                                    style="width:100%;border:1px solid var(--bordure);border-radius:8px;padding:12px 16px;font-size:15px;background:var(--creme);outline:none;font-family:'Inter',sans-serif;">
                            </div>
                            <div class="col-12">
                                <label style="font-size:13px;font-weight:600;color:#6b5e50;display:block;margin-bottom:6px;">Adresse E-mail *</label>
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    style="width:100%;border:1px solid var(--bordure);border-radius:8px;padding:12px 16px;font-size:15px;background:var(--creme);outline:none;font-family:'Inter',sans-serif;">
                            </div>
                            <div class="col-12">
                                <label style="font-size:13px;font-weight:600;color:#6b5e50;display:block;margin-bottom:6px;">Sujet *</label>
                                <input type="text" name="subject" value="{{ old('subject') }}" required
                                    style="width:100%;border:1px solid var(--bordure);border-radius:8px;padding:12px 16px;font-size:15px;background:var(--creme);outline:none;font-family:'Inter',sans-serif;">
                            </div>
                            <div class="col-12">
                                <label style="font-size:13px;font-weight:600;color:#6b5e50;display:block;margin-bottom:6px;">Message *</label>
                                <textarea name="message" rows="5" required
                                    style="width:100%;border:1px solid var(--bordure);border-radius:8px;padding:12px 16px;font-size:15px;background:var(--creme);outline:none;resize:vertical;font-family:'Inter',sans-serif;">{{ old('message') }}</textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-dj-primary" style="width:100%;justify-content:center;">Envoyer le message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Carte Google Maps -->
<div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15538.562304875017!2d-6.300585145785084!3d13.435748892404558!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xe3497d3dfa00c6d%3A0x867ea6de7257dfde!2zU8OpZ291LCBNYWxp!5e0!3m2!1sfr!2s!4v1718023600000!5m2!1sfr!2s"
        width="100%" height="420" style="border:0;display:block;" allowfullscreen="" loading="lazy"></iframe>
</div>

@endsection
