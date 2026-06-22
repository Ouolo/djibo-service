@extends('layouts.app')

@section('title', $actualite->titre . ' – Djibo Services')

@push('styles')
<style>
.article-container {
    background: #fff;
    border-radius: 24px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.04);
    overflow: hidden;
    margin-top: -50px;
    position: relative;
    z-index: 10;
    border: 1px solid rgba(0,0,0,0.03);
}

.article-header {
    padding: 40px;
    border-bottom: 1px solid rgba(0,0,0,0.06);
}

.article-body {
    padding: 40px;
    font-size: 1.05rem;
    line-height: 1.8;
    color: #2d3748;
}

.article-body p {
    margin-bottom: 24px;
}

.article-body h3 {
    font-weight: 700;
    margin-top: 36px;
    margin-bottom: 18px;
    color: var(--vert-dark);
}

.article-body ul, .article-body ol {
    margin-bottom: 24px;
    padding-left: 20px;
}

.gallery-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-top: 30px;
}

.gallery-item {
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid rgba(0,0,0,0.08);
    aspect-ratio: 4/3;
    cursor: pointer;
    position: relative;
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .4s ease;
}

.gallery-item:hover img {
    transform: scale(1.08);
}

/* Lightbox styles */
.lightbox {
    display: none;
    position: fixed;
    z-index: 99999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.9);
    align-items: center;
    justify-content: center;
}

.lightbox-content {
    max-width: 90%;
    max-height: 85%;
    border-radius: 8px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.5);
}

.lightbox-close {
    position: absolute;
    top: 24px;
    right: 30px;
    color: #fff;
    font-size: 35px;
    font-weight: bold;
    cursor: pointer;
}

@media (max-width: 768px) {
    .article-header { padding: 24px; }
    .article-body { padding: 24px; }
    .gallery-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
}

@media (max-width: 480px) {
    .gallery-grid { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')

<!-- HEADER BANNER / COVER -->
<div style="position: relative; height: 450px; width: 100%; overflow: hidden;">
    @if($actualite->image)
        <img src="{{ Str::startsWith($actualite->image, 'assets/') ? asset($actualite->image) : Storage::url($actualite->image) }}" 
             style="width:100%; height:100%; object-fit:cover; filter: brightness(0.65);" alt="{{ $actualite->titre }}">
    @else
        <div style="width:100%; height:100%; background: linear-gradient(135deg, var(--vert-dark), var(--vert));"></div>
    @endif
    <div style="position: absolute; bottom: 80px; left: 0; right: 0; text-align: center; color: #fff; padding: 0 20px;">
        <span style="background:var(--jaune-agri); color:#000; font-size:12px; font-weight:700; padding:6px 16px; border-radius:50px; text-transform:uppercase; letter-spacing:1px; display:inline-block; margin-bottom:15px;">
            🌱 Publication
        </span>
        <div style="font-size: 14px; opacity: 0.9; margin-top: 5px;">
            <i class="far fa-calendar-alt"></i> Publié le {{ $actualite->date_formattee }}
        </div>
    </div>
</div>

<!-- CONTENT CONTAINER -->
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="article-container">
                <div class="article-header text-center">
                    <h1 class="font-weight-bold" style="color: var(--vert-dark); font-size: 2.2rem; line-height: 1.3;">
                        {{ $actualite->titre }}
                    </h1>
                </div>
                
                <div class="article-body">
                    {!! $actualite->contenu !!}
                    
                    {{-- MULTIPLE IMAGES GALLERY --}}
                    @if(!empty($actualite->images))
                        <div style="margin-top: 50px; border-top: 1px solid rgba(0,0,0,0.08); padding-top: 40px;">
                            <h3 class="font-weight-bold" style="margin-top:0;">📸 Galerie Photos & Illustration</h3>
                            <p class="text-muted small">Cliquez sur une image pour l'agrandir.</p>
                            
                            <div class="gallery-grid">
                                {{-- Include cover image in gallery too if exists --}}
                                @if($actualite->image)
                                    <div class="gallery-item" onclick="openLightbox('{{ Str::startsWith($actualite->image, 'assets/') ? asset($actualite->image) : Storage::url($actualite->image) }}')">
                                        <img src="{{ Str::startsWith($actualite->image, 'assets/') ? asset($actualite->image) : Storage::url($actualite->image) }}" alt="Cover photo">
                                    </div>
                                @endif
                                
                                @foreach($actualite->images as $img)
                                    <div class="gallery-item" onclick="openLightbox('{{ Storage::url($img) }}')">
                                        <img src="{{ Storage::url($img) }}" alt="Gallery photo">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    {{-- BACK TO LIST BUTTON --}}
                    <div class="text-center mt-5">
                        <hr>
                        <a href="{{ route('actualites.public.index') }}" class="btn btn-link font-weight-bold" style="color: var(--vert); font-size:1.1rem; text-decoration:none;">
                            <i class="fas fa-arrow-left me-2"></i> Retour aux actualités
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- LIGHTBOX MODAL --}}
<div id="lightbox" class="lightbox" onclick="closeLightbox()">
    <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
    <img class="lightbox-content" id="lightbox-img">
</div>

@endsection

@push('scripts')
<script>
function openLightbox(src) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    lightboxImg.src = src;
    lightbox.style.display = 'flex';
}

function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
}
</script>
@endpush
