@extends('layouts.app')

@section('title', 'Actualités & Publications – Djibo Services')

@push('styles')
<style>
.dj-news-grid-card {
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,0.05);
    transition: all .3s ease;
    border: 1px solid rgba(0,0,0,0.04);
}

.dj-news-grid-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
}

.dj-news-grid-card img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    transition: transform .5s ease;
}

.dj-news-grid-card:hover img {
    transform: scale(1.04);
}

.dj-news-card-body {
    padding: 24px;
}

.dj-news-card-meta {
    font-size: 13px;
    color: var(--gris-fonce);
    opacity: 0.8;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.dj-news-card-title {
    font-size: 1.15rem;
    font-weight: 700;
    color: #1a2e1b;
    margin-bottom: 12px;
    line-height: 1.4;
}

.dj-news-card-excerpt {
    font-size: 14px;
    color: var(--gris-fonce);
    opacity: 0.9;
    margin-bottom: 18px;
    line-height: 1.6;
}

.dj-news-card-btn {
    color: var(--vert);
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: gap .2s ease;
}

.dj-news-grid-card:hover .dj-news-card-btn {
    gap: 10px;
}

/* Pagination Custom styling */
.pagination {
    display: flex;
    justify-content: center;
    gap: 6px;
    margin-top: 40px;
}

.pagination .page-item .page-link {
    border-radius: 8px;
    border: 1px solid rgba(0,0,0,0.08);
    color: var(--vert);
    font-weight: 600;
    padding: 10px 16px;
}

.pagination .page-item.active .page-link {
    background-color: var(--vert);
    border-color: var(--vert);
    color: #fff;
}
</style>
@endpush

@section('content')

<!-- HERO -->
<div class="breadcrumb-area py-5 text-center text-white"
     style="background: linear-gradient(135deg, var(--vert-dark), var(--vert));">
    <div class="container">
        <h1 class="font-weight-bold mb-2 text-white">📰 Notre Actualité</h1>
        <p class="lead m-0" style="color: var(--jaune-agri); font-weight: 700;">
            Conseils agronomiques, activités terrain et nouveautés Djibo Services
        </p>
    </div>
</div>

<!-- GRID -->
<div class="py-5 bg-light">
    <div class="container">
        <div class="row g-4">
            @forelse($actualites as $actu)
                <div class="col-lg-4 col-md-6">
                    <div class="dj-news-grid-card">
                        <div style="overflow:hidden; position:relative;">
                            @if($actu->image)
                                <img src="{{ Str::startsWith($actu->image, 'assets/') ? asset($actu->image) : Storage::url($actu->image) }}" alt="{{ $actu->titre }}">
                            @else
                                <div style="height:220px; background:#e8f5e9; display:flex; align-items:center; justify-content:center; color:var(--vert); font-size:40px;">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                            <div style="position:absolute; top:12px; left:12px; background:var(--jaune-agri); color:#000; font-size:11px; font-weight:700; padding:4px 10px; border-radius:50px; text-transform:uppercase;">
                                @if(!empty($actu->images))
                                    <i class="fas fa-images"></i> {{ count($actu->images) + 1 }} Photos
                                @else
                                    <i class="fas fa-image"></i> 1 Photo
                                @endif
                            </div>
                        </div>
                        <div class="dj-news-card-body">
                            <div class="dj-news-card-meta">
                                <i class="far fa-calendar-alt"></i> {{ $actu->date_formattee }}
                            </div>
                            <h4 class="dj-news-card-title">{{ $actu->titre }}</h4>
                            <p class="dj-news-card-excerpt">{{ $actu->extrait }}</p>
                            <a href="{{ route('actualites.public.show', $actu->slug) }}" class="dj-news-card-btn">
                                Lire la suite <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-newspaper" style="font-size:60px; color:var(--vert); opacity:0.3; margin-bottom:20px;"></i>
                    <h3 class="font-weight-bold">Aucune publication disponible</h3>
                    <p class="text-muted">Revenez très bientôt pour de nouveaux articles !</p>
                </div>
            @endforelse
        </div>

        @if($actualites->hasPages())
            <div class="d-flex justify-content-center">
                {{ $actualites->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
