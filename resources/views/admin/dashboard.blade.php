@extends('admin.layouts.app')

@section('title', 'Tableau de bord')
@section('page-title', 'Tableau de bord')
@section('breadcrumb', 'Admin / Accueil')

@section('topbar-actions')
    <a href="{{ route('admin.actualites.create') }}" class="adm-btn adm-btn-primary">
        <i class="fas fa-plus"></i> Nouvelle publication
    </a>
@endsection

@section('content')

{{-- Stats --}}
<div class="adm-stats">
    <div class="adm-stat">
        <div class="adm-stat__icon" style="background:#e8f5e9; color:#2E7D32;">
            <i class="fas fa-newspaper"></i>
        </div>
        <div>
            <div class="adm-stat__num">{{ $stats['total'] }}</div>
            <div class="adm-stat__label">Publications totales</div>
        </div>
    </div>
    <div class="adm-stat">
        <div class="adm-stat__icon" style="background:#e8f5e9; color:#1B5E20;">
            <i class="fas fa-check-circle"></i>
        </div>
        <div>
            <div class="adm-stat__num" style="color:#2E7D32;">{{ $stats['publiees'] }}</div>
            <div class="adm-stat__label">En ligne</div>
        </div>
    </div>
    <div class="adm-stat">
        <div class="adm-stat__icon" style="background:#fff8e1; color:#F9A825;">
            <i class="fas fa-pencil-alt"></i>
        </div>
        <div>
            <div class="adm-stat__num" style="color:#F9A825;">{{ $stats['brouillons'] }}</div>
            <div class="adm-stat__label">Brouillons</div>
        </div>
    </div>
    <div class="adm-stat">
        <div class="adm-stat__icon" style="background:#e3f2fd; color:#1565C0;">
            <i class="fas fa-globe"></i>
        </div>
        <div>
            <div class="adm-stat__num" style="color:#1565C0;">8</div>
            <div class="adm-stat__label">Pages du site</div>
        </div>
    </div>
</div>

{{-- Recent publications --}}
<div class="adm-card">
    <div class="adm-card__header">
        <span class="adm-card__title"><i class="fas fa-clock" style="color:#2E7D32; margin-right:8px;"></i> Publications Récentes</span>
        <a href="{{ route('admin.actualites.index') }}" class="adm-btn adm-btn-outline adm-btn-sm">Voir tout</a>
    </div>
    <div class="adm-card__body" style="padding:0;">
        @if($stats['recentes']->isEmpty())
            <div style="padding:40px; text-align:center; color:#7a9a7d;">
                <i class="fas fa-newspaper" style="font-size:36px; margin-bottom:12px; display:block;"></i>
                Aucune publication pour l'instant.
                <br><br>
                <a href="{{ route('admin.actualites.create') }}" class="adm-btn adm-btn-primary">Créer la première</a>
            </div>
        @else
            <table class="adm-table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stats['recentes'] as $actu)
                    <tr>
                        <td>
                            <div style="font-weight:600; color:#1a2e1b;">{{ Str::limit($actu->titre, 60) }}</div>
                            <div style="font-size:12px; color:#7a9a7d; margin-top:2px;">{{ Str::limit($actu->extrait, 80) }}</div>
                        </td>
                        <td style="color:#7a9a7d; font-size:13px; white-space:nowrap;">
                            {{ $actu->date_formattee }}
                        </td>
                        <td>
                            @if($actu->publie)
                                <span class="adm-badge adm-badge-green"><i class="fas fa-circle" style="font-size:6px;"></i> En ligne</span>
                            @else
                                <span class="adm-badge adm-badge-yellow"><i class="fas fa-circle" style="font-size:6px;"></i> Brouillon</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex; gap:6px;">
                                <a href="{{ route('admin.actualites.edit', $actu) }}" class="adm-btn adm-btn-outline adm-btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

{{-- Quick actions --}}
<div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-top:20px;">
    <div class="adm-card">
        <div class="adm-card__body" style="text-align:center; padding:28px;">
            <div style="font-size:32px; margin-bottom:12px;">📝</div>
            <div style="font-weight:700; color:#1a2e1b; margin-bottom:6px;">Rédiger une publication</div>
            <div style="font-size:13px; color:#7a9a7d; margin-bottom:16px;">Partagez vos actualités, conseils et nouveautés avec vos visiteurs.</div>
            <a href="{{ route('admin.actualites.create') }}" class="adm-btn adm-btn-primary">
                <i class="fas fa-plus"></i> Nouvelle publication
            </a>
        </div>
    </div>
    <div class="adm-card">
        <div class="adm-card__body" style="text-align:center; padding:28px;">
            <div style="font-size:32px; margin-bottom:12px;">🌐</div>
            <div style="font-weight:700; color:#1a2e1b; margin-bottom:6px;">Voir le site public</div>
            <div style="font-size:13px; color:#7a9a7d; margin-bottom:16px;">Vérifiez le rendu de vos publications sur la page d'accueil.</div>
            <a href="{{ route('home') }}" target="_blank" class="adm-btn adm-btn-outline">
                <i class="fas fa-external-link-alt"></i> Ouvrir le site
            </a>
        </div>
    </div>
</div>

@endsection
