@extends('admin.layouts.app')

@section('title', 'Témoignages')
@section('page-title', 'Gestion des Témoignages')
@section('breadcrumb', 'Admin / Témoignages')

@section('topbar-actions')
    <a href="{{ route('admin.temoignages.create') }}" class="adm-btn adm-btn-primary">
        <i class="fas fa-plus"></i> Nouveau témoignage
    </a>
@endsection

@section('content')

{{-- Search & filter --}}
<form method="GET" action="{{ route('admin.temoignages.index') }}" class="adm-search">
    <input type="text" name="search" class="adm-input" placeholder="🔍 Rechercher par nom, rôle, localisation..." value="{{ request('search') }}">
    <select name="type" class="adm-input" style="max-width:140px;">
        <option value="">Tous les types</option>
        <option value="text" {{ request('type') === 'text' ? 'selected' : '' }}>📝 Texte</option>
        <option value="image" {{ request('type') === 'image' ? 'selected' : '' }}>🖼️ Image</option>
        <option value="video" {{ request('type') === 'video' ? 'selected' : '' }}>🎬 Vidéo</option>
    </select>
    <select name="statut" class="adm-input" style="max-width:140px;">
        <option value="">Tous les statuts</option>
        <option value="publie" {{ request('statut') === 'publie' ? 'selected' : '' }}>✅ Publié</option>
        <option value="brouillon" {{ request('statut') === 'brouillon' ? 'selected' : '' }}>📝 Brouillon</option>
    </select>
    <button type="submit" class="adm-btn adm-btn-outline">Filtrer</button>
    @if(request('search') || request('type') || request('statut'))
        <a href="{{ route('admin.temoignages.index') }}" class="adm-btn adm-btn-sm" style="background:#f0f4f1; color:#7a9a7d; border:1.5px solid #d4dfd5;">Réinitialiser</a>
    @endif
</form>

<div class="adm-card">
    <div class="adm-card__header">
        <span class="adm-card__title">
            <i class="fas fa-comments" style="color:#2E7D32; margin-right:8px;"></i>
            {{ $temoignages->total() }} témoignage(s)
        </span>
    </div>
    <div class="adm-card__body" style="padding:0;">
        @if($temoignages->isEmpty())
            <div style="padding:56px; text-align:center; color:#7a9a7d;">
                <i class="fas fa-comments" style="font-size:40px; margin-bottom:14px; display:block; opacity:0.4;"></i>
                Aucun témoignage trouvé.
                <br><br>
                <a href="{{ route('admin.temoignages.create') }}" class="adm-btn adm-btn-primary">Créer le premier</a>
            </div>
        @else
            <table class="adm-table">
                <thead>
                    <tr>
                        <th style="width:40px;">Type</th>
                        <th>Nom & Rôle</th>
                        <th>Localisation</th>
                        <th>Prévisualisation</th>
                        <th style="width:80px;">Statut</th>
                        <th style="width:100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($temoignages as $temoignage)
                        <tr>
                            <td>
                                <span class="adm-badge" style="background:{{ $temoignage->type === 'text' ? '#e3f2fd' : ($temoignage->type === 'image' ? '#f3e5f5' : '#e8f5e9') }}; color:{{ $temoignage->type === 'text' ? '#1976d2' : ($temoignage->type === 'image' ? '#7b1fa2' : '#388e3c') }};">
                                    {{ $temoignage->type_display }}
                                </span>
                            </td>
                            <td>
                                <div class="adm-cell-content">
                                    <strong>{{ $temoignage->nom_client }}</strong>
                                    <small style="display:block; color:#7a9a7d; margin-top:4px;">{{ $temoignage->role }}</small>
                                </div>
                            </td>
                            <td>
                                <small>📍 {{ $temoignage->localisation }}</small>
                            </td>
                            <td>
                                <small style="color:#666; display:block; max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">
                                    {{ Str::limit($temoignage->contenu, 60) }}
                                </small>
                            </td>
                            <td style="text-align:center;">
                                <form method="POST" action="{{ route('admin.temoignages.toggle', $temoignage) }}" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="adm-toggle" style="background:{{ $temoignage->publie ? '#4caf50' : '#ccc' }};" title="Cliquer pour basculer">
                                        {{ $temoignage->publie ? '✅' : '❌' }}
                                    </button>
                                </form>
                            </td>
                            <td style="text-align:center;">
                                <a href="{{ route('admin.temoignages.edit', $temoignage) }}" class="adm-action-btn" title="Éditer">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.temoignages.destroy', $temoignage) }}" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="adm-action-btn adm-action-btn--delete" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

{{-- Pagination --}}
@if($temoignages->hasPages())
    <div style="margin-top:20px; display:flex; justify-content:center;">
        {{ $temoignages->links() }}
    </div>
@endif

<style>
    .adm-search {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        align-items: center;
        flex-wrap: wrap;
    }

    .adm-input {
        padding: 10px 15px;
        border: 1.5px solid #d4dfd5;
        border-radius: 6px;
        font-size: 14px;
    }

    .adm-btn {
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .adm-btn-primary {
        background: #2E7D32;
        color: white;
    }

    .adm-btn-outline {
        background: transparent;
        color: #2E7D32;
        border: 1.5px solid #2E7D32;
    }

    .adm-btn-outline:hover {
        background: #f0f4f1;
    }

    .adm-btn-sm {
        padding: 6px 12px;
        font-size: 12px;
    }

    .adm-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .adm-card__header {
        padding: 20px;
        border-bottom: 1px solid #eee;
        background: #f9fafb;
    }

    .adm-card__title {
        font-size: 14px;
        font-weight: 600;
        color: #333;
    }

    .adm-card__body {
        padding: 20px;
    }

    .adm-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    .adm-table thead {
        background: #f9fafb;
        border-bottom: 1px solid #e0e0e0;
    }

    .adm-table th {
        padding: 12px;
        text-align: left;
        font-weight: 600;
        color: #555;
    }

    .adm-table tbody tr {
        border-bottom: 1px solid #eee;
    }

    .adm-table tbody tr:hover {
        background: #f9fafb;
    }

    .adm-table td {
        padding: 12px;
        vertical-align: middle;
    }

    .adm-badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
    }

    .adm-cell-content {
        line-height: 1.5;
    }

    .adm-toggle {
        background: #ccc;
        border: none;
        border-radius: 4px;
        padding: 4px 8px;
        cursor: pointer;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .adm-toggle:hover {
        transform: scale(1.1);
    }

    .adm-action-btn {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 4px;
        background: #e3f2fd;
        color: #1976d2;
        cursor: pointer;
        border: none;
        font-size: 14px;
        transition: all 0.3s ease;
        margin: 0 2px;
    }

    .adm-action-btn:hover {
        background: #1976d2;
        color: white;
    }

    .adm-action-btn--delete {
        background: #ffebee;
        color: #c62828;
    }

    .adm-action-btn--delete:hover {
        background: #c62828;
        color: white;
    }
</style>

@endsection
