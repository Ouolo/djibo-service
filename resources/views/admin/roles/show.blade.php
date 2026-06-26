@extends('admin.layouts.app')

@section('title', 'Détails du Rôle')
@section('page-title', 'Profil du Rôle')
@section('breadcrumb', 'Admin / Rôles / Détails')

@section('topbar-actions')
    <div style="display: flex; gap: 8px;">
        @if(auth()->user()->hasPermission('update_roles')
            && (auth()->user()->isSuperAdmin() || !in_array($role->slug, ['superadmin', 'admin', 'editor', 'viewer'])))
            <a href="{{ route('admin.roles.edit', $role) }}" class="adm-btn adm-btn-jaune">
                <i class="fas fa-edit"></i> Modifier
            </a>
        @endif
        <a href="{{ route('admin.roles.index') }}" class="adm-btn adm-btn-outline">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>
@endsection

@section('content')

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 28px;">
    
    {{-- Card d'informations --}}
    <div class="adm-card" style="align-self: start;">
        <div class="adm-card__header">
            <span class="adm-card__title">
                <i class="fas fa-info-circle" style="color:#2E7D32; margin-right:8px;"></i>
                Informations du Rôle
            </span>
        </div>
        <div class="adm-card__body">
            <div style="margin-bottom: 20px;">
                <div style="font-size: 11px; text-transform: uppercase; color: #7a9a7d; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 4px;">Nom du Rôle</div>
                <div style="font-size: 16px; color: #1a2e1b; font-weight: 600;">{{ $role->name }}</div>
            </div>

            <div style="margin-bottom: 20px;">
                <div style="font-size: 11px; text-transform: uppercase; color: #7a9a7d; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 4px;">Identifiant système (Slug)</div>
                <code style="font-size: 13px; color: #1b5e20; background: #eef2ee; padding: 4px 8px; border-radius: 4px; display: inline-block;">{{ $role->slug }}</code>
            </div>

            <div style="margin-bottom: 20px;">
                <div style="font-size: 11px; text-transform: uppercase; color: #7a9a7d; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 4px;">Description</div>
                <p style="font-size: 14px; color: #1a2e1b; line-height: 1.5; margin: 0;">
                    {{ $role->description ?? 'Aucune description disponible' }}
                </p>
            </div>

            <div style="display: flex; gap: 20px; border-top: 1px solid #e8ede9; padding-top: 20px; margin-top: 10px;">
                <div style="flex: 1;">
                    <div style="font-size: 11px; text-transform: uppercase; color: #7a9a7d; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 4px;">Utilisateurs liés</div>
                    <span class="adm-badge adm-badge-grey" style="font-size: 12px; padding: 4px 10px;">
                        <i class="fas fa-users" style="margin-right: 4px;"></i>
                        {{ $role->users()->count() }} membres
                    </span>
                </div>
                <div style="flex: 1;">
                    <div style="font-size: 11px; text-transform: uppercase; color: #7a9a7d; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 4px;">Permissions activées</div>
                    <span class="adm-badge adm-badge-green" style="font-size: 12px; padding: 4px 10px;">
                        <i class="fas fa-key" style="margin-right: 4px;"></i>
                        {{ $role->permissions()->count() }} clés
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Card des permissions --}}
    <div class="adm-card">
        <div class="adm-card__header">
            <span class="adm-card__title">
                <i class="fas fa-lock" style="color:#2E7D32; margin-right:8px;"></i>
                Permissions du Rôle
            </span>
        </div>
        <div class="adm-card__body">
            @php
                $groupedPermissions = $role->permissions()->orderBy('group')->get()->groupBy('group');
            @endphp

            @forelse($groupedPermissions as $group => $perms)
                <div style="background: #f8fbf8; border: 1px solid #e8ede9; border-radius: 8px; padding: 14px; margin-bottom: 16px;">
                    <h5 style="font-size: 13px; font-weight: 700; text-transform: uppercase; color: var(--vert-dark); margin-bottom: 10px; display: flex; align-items: center; gap: 6px;">
                        <i class="fas fa-folder-open" style="color: var(--vert-clair);"></i>
                        {{ $group }}
                    </h5>
                    <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                        @foreach($perms as $perm)
                            <span class="adm-badge adm-badge-green" style="background: #ffffff; border: 1px solid #c8d8c9; font-weight: 500;">
                                <i class="fas fa-check" style="font-size: 8px; color: var(--vert); margin-right: 4px;"></i>
                                {{ $perm->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @empty
                <div style="text-align: center; color: #7a9a7d; padding: 40px 24px;">
                    <i class="fas fa-lock" style="font-size: 36px; opacity: 0.3; margin-bottom: 12px; display: block;"></i>
                    Aucune permission assignée à ce rôle.
                </div>
            @endforelse
        </div>
    </div>

</div>

@endsection
