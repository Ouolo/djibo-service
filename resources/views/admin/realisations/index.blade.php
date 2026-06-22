@extends('admin.layouts.app')

@section('title', 'Réalisations')
@section('page-title', 'Gestion des Réalisations')
@section('breadcrumb', 'Admin / Réalisations')

@section('topbar-actions')
    <a href="{{ route('admin.realisations.create') }}" class="adm-btn adm-btn-primary">
        <i class="fas fa-plus"></i> Nouvelle réalisation
    </a>
@endsection

@section('content')

{{-- Search & filter --}}
<form method="GET" action="{{ route('admin.realisations.index') }}" class="adm-search">
    <input type="text" name="search" class="adm-input" placeholder="🔍 Rechercher par titre ou localisation…" value="{{ request('search') }}">
    <select name="statut" class="adm-input" style="max-width:160px;">
        <option value="">Tous les statuts</option>
        <option value="actif"   {{ request('statut') === 'actif'   ? 'selected' : '' }}>✅ En ligne</option>
        <option value="inactif" {{ request('statut') === 'inactif' ? 'selected' : '' }}>📝 Masqué</option>
    </select>
    <button type="submit" class="adm-btn adm-btn-outline">Filtrer</button>
    @if(request('search') || request('statut'))
        <a href="{{ route('admin.realisations.index') }}" class="adm-btn adm-btn-sm" style="background:#f0f4f1; color:#7a9a7d; border:1.5px solid #d4dfd5;">Réinitialiser</a>
    @endif
</form>

<div class="adm-card">
    <div class="adm-card__header">
        <span class="adm-card__title">
            <i class="fas fa-trophy" style="color:#2E7D32; margin-right:8px;"></i>
            {{ $realisations->total() }} réalisation(s)
        </span>
    </div>
    <div class="adm-card__body" style="padding:0;">
        @if($realisations->isEmpty())
            <div style="padding:56px; text-align:center; color:#7a9a7d;">
                <i class="fas fa-trophy" style="font-size:40px; margin-bottom:14px; display:block; opacity:0.4;"></i>
                Aucune réalisation trouvée.
                <br><br>
                <a href="{{ route('admin.realisations.create') }}" class="adm-btn adm-btn-primary">Créer la première</a>
            </div>
        @else
            <table class="adm-table">
                <thead>
                    <tr>
                        <th style="width:70px;">Image</th>
                        <th>Titre &amp; Localisation</th>
                        <th>Impact</th>
                        <th>Ordre</th>
                        <th>Statut</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($realisations as $real)
                    <tr>
                        <td>
                            @if($real->image)
                                <img src="{{ Str::startsWith($real->image, 'assets/') ? asset($real->image) : Storage::url($real->image) }}"
                                     alt="{{ $real->titre }}"
                                     style="width:58px; height:52px; object-fit:cover; border-radius:8px; border:1px solid #e8ede9;">
                            @else
                                <div style="width:58px;height:52px;background:#e8f5e9;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#66BB6A;">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div style="font-weight:600; color:#1a2e1b; margin-bottom:3px;">{{ Str::limit($real->titre, 65) }}</div>
                            <div style="font-size:12px; color:#7a9a7d;">
                                <i class="fas fa-map-marker-alt" style="margin-right:4px;"></i>{{ $real->localisation }}
                            </div>
                        </td>
                        <td style="font-size:13px; color:#2E7D32; font-weight:600; max-width:160px;">
                            {{ Str::limit($real->impact, 50) }}
                        </td>
                        <td style="text-align:center; color:#7a9a7d; font-size:13px;">
                            {{ $real->ordre }}
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.realisations.toggle', $real) }}">
                                @csrf @method('PATCH')
                                <button type="submit" class="adm-badge {{ $real->actif ? 'adm-badge-green' : 'adm-badge-yellow' }}"
                                        style="cursor:pointer; border:none; font-family:inherit;"
                                        title="{{ $real->actif ? 'Cliquer pour masquer' : 'Cliquer pour mettre en ligne' }}">
                                    <i class="fas fa-circle" style="font-size:6px;"></i>
                                    {{ $real->actif ? 'En ligne' : 'Masqué' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <div style="display:flex; gap:6px; justify-content:flex-end;">
                                <a href="{{ route('admin.realisations.edit', $real) }}" class="adm-btn adm-btn-outline adm-btn-sm" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.realisations.destroy', $real) }}"
                                      onsubmit="return confirm('Supprimer cette réalisation ?');">
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
            @if($realisations->hasPages())
                <div style="padding:16px 24px;">
                    {{ $realisations->links() }}
                </div>
            @endif
        @endif
    </div>
</div>

@endsection
