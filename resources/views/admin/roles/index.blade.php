@extends('admin.layouts.app')

@section('title', 'Rôles')
@section('page-title', 'Gestion des Rôles')
@section('breadcrumb', 'Admin / Rôles')

@section('topbar-actions')
    @if(auth()->user()->hasPermission('create_roles'))
        <a href="{{ route('admin.roles.create') }}" class="adm-btn adm-btn-primary">
            <i class="fas fa-plus"></i> Ajouter un rôle
        </a>
    @endif
@endsection

@section('content')

{{-- Stats block --}}
<div class="adm-stats">
    <div class="adm-stat">
        <div class="adm-stat__icon" style="background: #e8f5e9; color: var(--vert);">
            <i class="fas fa-user-shield"></i>
        </div>
        <div>
            <div class="adm-stat__num">{{ $roles->total() }}</div>
            <div class="adm-stat__label">Rôles configurés</div>
        </div>
    </div>
</div>

{{-- Search --}}
<form method="GET" action="{{ route('admin.roles.index') }}" class="adm-search">
    <input type="text" name="search" class="adm-input" placeholder="🔍 Rechercher un rôle..." value="{{ request('search') }}">
    <button type="submit" class="adm-btn adm-btn-outline">Rechercher</button>
    @if(request('search'))
        <a href="{{ route('admin.roles.index') }}" class="adm-btn adm-btn-sm" style="background:#f0f4f1; color:#7a9a7d; border:1.5px solid #d4dfd5;">Réinitialiser</a>
    @endif
</form>

<div class="adm-card">
    <div class="adm-card__header">
        <span class="adm-card__title">
            <i class="fas fa-shield-alt" style="color:#2E7D32; margin-right:8px;"></i>
            Liste des rôles d'accès
        </span>
    </div>
    <div class="adm-card__body" style="padding:0;">
        @if($roles->isEmpty())
            <div style="padding:56px; text-align:center; color:#7a9a7d;">
                <i class="fas fa-user-shield" style="font-size:40px; margin-bottom:14px; display:block; opacity:0.4;"></i>
                Aucun rôle trouvé.
            </div>
        @else
            <table class="adm-table">
                <thead>
                    <tr>
                        <th>Nom du Rôle</th>
                        <th>Identifiant (Slug)</th>
                        <th>Description</th>
                        <th>Permissions</th>
                        <th>Utilisateurs</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td>
                            <div style="font-weight:600; color:#1a2e1b;">{{ $role->name }}</div>
                        </td>
                        <td>
                            <code style="background:#eef2ee; padding:2px 6px; border-radius:4px; font-size:12px; color:#1b5e20;">{{ $role->slug }}</code>
                        </td>
                        <td>
                            <span style="color:#7a9a7d; font-size:13px;">{{ $role->description ?? 'Aucune description disponible' }}</span>
                        </td>
                        <td>
                            <span class="adm-badge adm-badge-green" style="background:#e8f5e9; border: 1px solid #c8d8c9;">
                                <i class="fas fa-key" style="font-size:10px; margin-right:4px;"></i>
                                {{ $role->permissions->count() }} permissions
                            </span>
                        </td>
                        <td>
                            <span class="adm-badge adm-badge-grey">
                                <i class="fas fa-users" style="font-size:10px; margin-right:4px;"></i>
                                {{ $role->users()->count() }} utilisateurs
                            </span>
                        </td>
                        <td>
                            <div style="display:flex; gap:6px; justify-content:flex-end;">
                                @if(auth()->user()->hasPermission('read_roles'))
                                    <a href="{{ route('admin.roles.show', $role) }}" class="adm-btn adm-btn-outline adm-btn-sm" title="Voir les détails">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endif
                                @if(auth()->user()->hasPermission('update_roles')
                                    && (auth()->user()->isSuperAdmin() || !in_array($role->slug, ['superadmin', 'admin', 'editor', 'viewer'])))
                                    <a href="{{ route('admin.roles.edit', $role) }}" class="adm-btn adm-btn-outline adm-btn-sm" style="color: var(--jaune); border-color: var(--jaune);" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif
                                @if(auth()->user()->hasPermission('delete_roles')
                                    && !in_array($role->slug, ['superadmin', 'admin', 'editor', 'viewer']))
                                    <form method="POST" action="{{ route('admin.roles.destroy', $role) }}"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce rôle ?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            @if($roles->hasPages())
                <div style="padding:16px 24px;">
                    {{ $roles->links() }}
                </div>
            @endif
        @endif
    </div>
</div>

@endsection