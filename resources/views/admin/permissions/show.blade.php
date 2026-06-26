@extends('admin.layouts.app')

@section('title', 'Détails Permission')
@section('page-title', 'Détails de la Permission')
@section('breadcrumb', 'Admin / Permissions / Détails')

@section('topbar-actions')
    <div style="display: flex; gap: 8px;">
        @if(auth()->user()->hasPermission('update_roles'))
            <a href="{{ route('admin.permissions.edit', $permission) }}" class="adm-btn adm-btn-jaune">
                <i class="fas fa-edit"></i> Modifier
            </a>
        @endif
        <a href="{{ route('admin.permissions.index') }}" class="adm-btn adm-btn-outline">
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
                Informations système
            </span>
        </div>
        <div class="adm-card__body">
            <div style="margin-bottom: 20px;">
                <div style="font-size: 11px; text-transform: uppercase; color: #7a9a7d; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 4px;">Nom complet</div>
                <div style="font-size: 16px; color: #1a2e1b; font-weight: 600;">{{ $permission->name }}</div>
            </div>

            <div style="margin-bottom: 20px;">
                <div style="font-size: 11px; text-transform: uppercase; color: #7a9a7d; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 4px;">Identifiant système (Slug)</div>
                <code style="font-size: 13px; color: #1b5e20; background: #eef2ee; padding: 4px 8px; border-radius: 4px; display: inline-block;">{{ $permission->slug }}</code>
            </div>

            <div style="display: flex; gap: 20px; border-top: 1px solid #e8ede9; padding-top: 20px;">
                <div style="flex: 1;">
                    <div style="font-size: 11px; text-transform: uppercase; color: #7a9a7d; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 4px;">Groupe</div>
                    <span class="adm-badge adm-badge-green" style="background:#e8f5e9; border: 1px solid #c8d8c9;">
                        <i class="fas fa-folder" style="font-size:10px; margin-right:4px;"></i>
                        {{ $permission->group }}
                    </span>
                </div>
                <div style="flex: 1;">
                    <div style="font-size: 11px; text-transform: uppercase; color: #7a9a7d; font-weight: 700; letter-spacing: 0.5px; margin-bottom: 4px;">Type d'action</div>
                    @php
                        $actionBadgeClass = 'adm-badge-grey';
                        if ($permission->action === 'create') $actionBadgeClass = 'adm-badge-green';
                        elseif ($permission->action === 'read') $actionBadgeClass = 'adm-badge-yellow';
                        elseif ($permission->action === 'update') $actionBadgeClass = 'adm-badge-yellow';
                        elseif ($permission->action === 'delete') $actionBadgeClass = 'adm-badge-grey';
                    @endphp
                    <span class="adm-badge {{ $actionBadgeClass }}" style="text-transform: uppercase;">
                        {{ $permission->action }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Card Description & Rôles liés --}}
    <div style="display: flex; flex-direction: column; gap: 28px;">
        
        <div class="adm-card">
            <div class="adm-card__header">
                <span class="adm-card__title">
                    <i class="fas fa-align-left" style="color:#2E7D32; margin-right:8px;"></i>
                    Description
                </span>
            </div>
            <div class="adm-card__body">
                <p style="font-size: 14px; color: #1a2e1b; line-height: 1.6; margin: 0;">
                    {{ $permission->description ?? 'Aucune description fournie pour cette permission.' }}
                </p>
            </div>
        </div>

        <div class="adm-card">
            <div class="adm-card__header">
                <span class="adm-card__title">
                    <i class="fas fa-user-shield" style="color:#2E7D32; margin-right:8px;"></i>
                    Rôles possédant cette permission
                </span>
            </div>
            <div class="adm-card__body">
                <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                    @forelse($permission->roles as $role)
                        <span class="adm-badge adm-badge-green" style="background:#ffffff; border: 1px solid #c8d8c9; font-weight: 500; font-size: 13px; padding: 6px 12px;">
                            <i class="fas fa-shield-alt" style="color: var(--vert); margin-right: 6px;"></i>
                            {{ $role->name }}
                        </span>
                    @empty
                        <div style="color: #7a9a7d; padding: 10px 0;">
                            <i class="fas fa-info-circle" style="margin-right: 4px;"></i> Aucun rôle ne dispose actuellement de cette permission.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
