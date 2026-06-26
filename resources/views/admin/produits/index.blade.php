@extends('admin.layouts.app')

@section('title', 'Produits')
@section('page-title', 'Gestion des Produits')
@section('breadcrumb', 'Admin / Produits')

@section('topbar-actions')
    <a href="{{ route('admin.produits.create') }}" class="adm-btn adm-btn-primary">
        <i class="fas fa-plus"></i> Nouveau produit
    </a>
@endsection

@section('content')

{{-- Search & filter --}}
<form method="GET" action="{{ route('admin.produits.index') }}" class="adm-search">
    <input type="text" name="search" class="adm-input" placeholder="🔍 Rechercher par nom..." value="{{ request('search') }}">
    <select name="statut" class="adm-input" style="max-width:160px;">
        <option value="">Tous les statuts</option>
        <option value="actif" {{ request('statut') === 'actif' ? 'selected' : '' }}>✅ Actif</option>
        <option value="inactif" {{ request('statut') === 'inactif' ? 'selected' : '' }}>📝 Inactif</option>
    </select>
    <button type="submit" class="adm-btn adm-btn-outline">Filtrer</button>
    @if(request('search') || request('statut'))
        <a href="{{ route('admin.produits.index') }}" class="adm-btn adm-btn-sm" style="background:#f0f4f1; color:#7a9a7d; border:1.5px solid #d4dfd5;">Réinitialiser</a>
    @endif
</form>

<div class="adm-card">
    <div class="adm-card__header">
        <span class="adm-card__title">
            <i class="fas fa-box" style="color:#2E7D32; margin-right:8px;"></i>
            {{ $produits->total() }} produit(s)
        </span>
    </div>
    <div class="adm-card__body" style="padding:0;">
        @if($produits->isEmpty())
            <div style="padding:56px; text-align:center; color:#7a9a7d;">
                <i class="fas fa-box" style="font-size:40px; margin-bottom:14px; display:block; opacity:0.4;"></i>
                Aucun produit trouvé.
                <br><br>
                <a href="{{ route('admin.produits.create') }}" class="adm-btn adm-btn-primary">Créer le premier</a>
            </div>
        @else
            <table class="adm-table">
                <thead>
                    <tr>
                        <th style="width:60px;">Image</th>
                        <th>Nom & Catégorie</th>
                        <th>Prix</th>
                        <th>Vedette</th>
                        <th>Statut</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produits as $produit)
                    <tr>
                        <td>
                            @if($produit->image)
                                <img src="{{ Str::startsWith($produit->image, 'assets/') ? asset($produit->image) : Storage::url($produit->image) }}"
                                     alt="{{ $produit->nom }}"
                                     style="width:52px; height:52px; object-fit:cover; border-radius:8px; border:1px solid #e8ede9;">
                            @else
                                <div style="width:52px;height:52px;background:#e8f5e9;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#66BB6A;">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div style="font-weight:600; color:#1a2e1b; margin-bottom:3px;">{{ Str::limit($produit->nom, 70) }}</div>
                            <div style="font-size:12px; color:#7a9a7d;">{{ $produit->categorie }}</div>
                        </td>
                        <td style="color:#1a2e1b; font-weight:600; white-space:nowrap;">
                            {{ $produit->prix ?: 'Non défini' }}
                        </td>
                        <td>
                            @if($produit->en_vedette)
                                <span class="adm-badge adm-badge-yellow"><i class="fas fa-star" style="font-size:10px;"></i> Oui</span>
                            @else
                                <span style="color:#7a9a7d; font-size:12px;">Non</span>
                            @endif
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.produits.toggle', $produit) }}">
                                @csrf @method('PATCH')
                                <button type="submit" class="adm-badge {{ $produit->actif ? 'adm-badge-green' : 'adm-badge-grey' }}"
                                        style="cursor:pointer; border:none; font-family:inherit;"
                                        title="{{ $produit->actif ? 'Cliquer pour désactiver' : 'Cliquer pour activer' }}">
                                    @if($produit->actif)
                                        <i class="fas fa-circle" style="font-size:6px;"></i> Actif
                                    @else
                                        <i class="fas fa-circle" style="font-size:6px;"></i> Inactif
                                    @endif
                                </button>
                            </form>
                        </td>
                        <td>
                            <div style="display:flex; gap:6px; justify-content:flex-end; flex-wrap:wrap;">
                                @if($produit->published_to_facebook)
                                    <span class="adm-badge adm-badge-blue" title="Publié sur Facebook" style="background:#1877F2; color:white;">
                                        <i class="fab fa-facebook-f"></i> Publié
                                    </span>
                                @else
                                    <form method="POST" action="" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="adm-btn adm-btn-sm" title="Publier sur Facebook"
                                                style="background:#1877F2; color:white; border:none; padding:6px 12px; border-radius:4px; cursor:pointer; font-size:12px;">
                                            <i class="fab fa-facebook-f"></i> Publier
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('admin.produits.edit', $produit) }}" class="adm-btn adm-btn-outline adm-btn-sm" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.produits.destroy', $produit) }}"
                                      onsubmit="return confirm('Supprimer ce produit ?');"
                                      style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            @if($produits->hasPages())
                <div style="padding:16px 24px;">
                    {{ $produits->links() }}
                </div>
            @endif
        @endif
    </div>
</div>

@endsection
