@extends('admin.layouts.app')

@section('title', 'Publications')
@section('page-title', 'Gestion des Publications')
@section('breadcrumb', 'Admin / Publications')

@section('topbar-actions')
    <a href="{{ route('admin.actualites.create') }}" class="adm-btn adm-btn-primary">
        <i class="fas fa-plus"></i> Nouvelle publication
    </a>
@endsection

@section('content')

{{-- Search & filter --}}
<form method="GET" action="{{ route('admin.actualites.index') }}" class="adm-search">
    <input type="text" name="search" class="adm-input" placeholder="🔍 Rechercher par titre..." value="{{ request('search') }}">
    <select name="statut" class="adm-input" style="max-width:160px;">
        <option value="">Tous les statuts</option>
        <option value="publie" {{ request('statut') === 'publie' ? 'selected' : '' }}>✅ En ligne</option>
        <option value="brouillon" {{ request('statut') === 'brouillon' ? 'selected' : '' }}>📝 Brouillon</option>
    </select>
    <button type="submit" class="adm-btn adm-btn-outline">Filtrer</button>
    @if(request('search') || request('statut'))
        <a href="{{ route('admin.actualites.index') }}" class="adm-btn adm-btn-sm" style="background:#f0f4f1; color:#7a9a7d; border:1.5px solid #d4dfd5;">Réinitialiser</a>
    @endif
</form>

<div class="adm-card">
    <div class="adm-card__header">
        <span class="adm-card__title">
            <i class="fas fa-newspaper" style="color:#2E7D32; margin-right:8px;"></i>
            {{ $actualites->total() }} publication(s)
        </span>
    </div>
    <div class="adm-card__body" style="padding:0;">
        @if($actualites->isEmpty())
            <div style="padding:56px; text-align:center; color:#7a9a7d;">
                <i class="fas fa-newspaper" style="font-size:40px; margin-bottom:14px; display:block; opacity:0.4;"></i>
                Aucune publication trouvée.
                <br><br>
                <a href="{{ route('admin.actualites.create') }}" class="adm-btn adm-btn-primary">Créer la première</a>
            </div>
        @else
            <table class="adm-table">
                <thead>
                    <tr>
                        <th style="width:60px;">Image</th>
                        <th>Titre & extrait</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($actualites as $actu)
                    <tr>
                        <td>
                            @if($actu->image)
                                <img src="{{ Str::startsWith($actu->image, 'assets/') ? asset($actu->image) : Storage::url($actu->image) }}"
                                     alt="{{ $actu->titre }}"
                                     style="width:52px; height:52px; object-fit:cover; border-radius:8px; border:1px solid #e8ede9;">
                            @else
                                <div style="width:52px;height:52px;background:#e8f5e9;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#66BB6A;">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <div style="font-weight:600; color:#1a2e1b; margin-bottom:3px;">{{ Str::limit($actu->titre, 70) }}</div>
                            <div style="font-size:12px; color:#7a9a7d;">{{ Str::limit($actu->extrait, 100) }}</div>
                        </td>
                        <td style="color:#7a9a7d; font-size:13px; white-space:nowrap;">
                            {{ $actu->date_formattee }}
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.actualites.toggle', $actu) }}">
                                @csrf @method('PATCH')
                                <button type="submit" class="adm-badge {{ $actu->publie ? 'adm-badge-green' : 'adm-badge-yellow' }}"
                                        style="cursor:pointer; border:none; font-family:inherit;"
                                        title="{{ $actu->publie ? 'Cliquer pour mettre en brouillon' : 'Cliquer pour publier' }}">
                                    @if($actu->publie)
                                        <i class="fas fa-circle" style="font-size:6px;"></i> En ligne
                                    @else
                                        <i class="fas fa-circle" style="font-size:6px;"></i> Brouillon
                                    @endif
                                </button>
                            </form>
                        </td>
                        <td>
                            <div style="display:flex; gap:6px; justify-content:flex-end;">
                                <a href="{{ route('admin.actualites.edit', $actu) }}" class="adm-btn adm-btn-outline adm-btn-sm" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.actualites.destroy', $actu) }}"
                                      onsubmit="return confirm('Supprimer cette publication ?');">
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
            @if($actualites->hasPages())
                <div style="padding:16px 24px;">
                    {{ $actualites->links() }}
                </div>
            @endif
        @endif
    </div>
</div>

@endsection
