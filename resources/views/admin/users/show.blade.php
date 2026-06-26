@extends('admin.layouts.app')

@section('title', 'Détails Utilisateur')
@section('page-title', 'Profil de l\'Utilisateur')
@section('breadcrumb', 'Admin / Utilisateurs / Détails')

@section('topbar-actions')
    <div style="display: flex; gap: 8px;">
        @if(auth()->user()->hasPermission('update_users'))
            <a href="{{ route('admin.users.edit', $user) }}" class="adm-btn adm-btn-jaune">
                <i class="fas fa-edit"></i> Modifier
            </a>
        @endif
        <a href="{{ route('admin.users.index') }}" class="adm-btn adm-btn-outline">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>
@endsection

@section('content')

<div style="display: grid; grid-template-columns: 320px 1fr; gap: 24px; align-items: start;">

    {{-- Card profil --}}
    <div class="adm-card">
        <div class="adm-card__header">
            <span class="adm-card__title">
                <i class="fas fa-user-circle" style="color:#2E7D32; margin-right:8px;"></i>
                Profil
            </span>
        </div>
        <div class="adm-card__body" style="text-align: center; padding: 35px 24px;">
            <div style="width: 90px; height: 90px; background: #e8f5e9; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #2E7D32; font-weight: 800; font-size: 32px; border: 3px solid #66BB6A; margin: 0 auto 16px;">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <h3 style="font-size: 20px; font-weight: 700; color: #1a2e1b; margin-bottom: 8px;">{{ $user->name }}</h3>

            @if($user->role)
                <span class="adm-badge adm-badge-green" style="margin-bottom: 24px;">
                    <i class="fas fa-shield-alt" style="margin-right: 4px;"></i>{{ $user->role->name }}
                </span>
            @else
                <span class="adm-badge adm-badge-grey" style="margin-bottom: 24px;">Aucun rôle</span>
            @endif

            <div style="text-align: left; border-top: 1px solid #e8ede9; padding-top: 20px; margin-top: 10px;">
                <div style="margin-bottom: 12px;">
                    <div style="font-size: 11px; text-transform: uppercase; color: #7a9a7d; font-weight: 700; letter-spacing: 0.5px;">Email</div>
                    <div style="font-size: 14px; color: #1a2e1b; font-weight: 500;">
                        <i class="fas fa-envelope" style="color: #7a9a7d; margin-right: 6px;"></i>{{ $user->email }}
                    </div>
                </div>
                <div style="margin-bottom: 12px;">
                    <div style="font-size: 11px; text-transform: uppercase; color: #7a9a7d; font-weight: 700; letter-spacing: 0.5px;">Créé le</div>
                    <div style="font-size: 14px; color: #1a2e1b; font-weight: 500;">
                        <i class="fas fa-calendar-alt" style="color: #7a9a7d; margin-right: 6px;"></i>{{ $user->created_at->format('d/m/Y à H:i') }}
                    </div>
                </div>
                <div>
                    <div style="font-size: 11px; text-transform: uppercase; color: #7a9a7d; font-weight: 700; letter-spacing: 0.5px;">Permissions totales</div>
                    <div style="font-size: 20px; color: #2E7D32; font-weight: 800;">
                        {{ count($user->allPermissions()) }}
                        <span style="font-size: 12px; color: #7a9a7d; font-weight: 500;">droits d'accès</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Colonne droite : permissions --}}
    <div style="display: flex; flex-direction: column; gap: 24px;">

        {{-- Permissions via le rôle --}}
        <div class="adm-card">
            <div class="adm-card__header">
                <span class="adm-card__title">
                    <i class="fas fa-shield-alt" style="color:#2E7D32; margin-right:8px;"></i>
                    Permissions via le rôle
                    @if($user->role)
                        <span class="adm-badge adm-badge-green" style="margin-left: 8px; font-size: 11px;">{{ $user->role->name }}</span>
                    @endif
                </span>
            </div>
            <div class="adm-card__body">
                @if($user->role)
                    @php $groupedRolePermissions = $user->role->permissions()->orderBy('group')->get()->groupBy('group'); @endphp
                    @forelse($groupedRolePermissions as $group => $perms)
                        <div style="background: #f8fbf8; border: 1px solid #e8ede9; border-radius: 8px; padding: 14px; margin-bottom: 12px;">
                            <h5 style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: var(--vert-dark); margin-bottom: 10px; display: flex; align-items: center; gap: 6px;">
                                <i class="fas fa-folder-open" style="color: var(--vert-clair);"></i>{{ $group }}
                            </h5>
                            <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                                @foreach($perms as $perm)
                                    <span class="adm-badge adm-badge-green" style="background: #ffffff; border: 1px solid #c8d8c9; font-weight: 500;">
                                        <i class="fas fa-check" style="font-size: 8px; color: var(--vert); margin-right: 4px;"></i>{{ $perm->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div style="text-align: center; color: #7a9a7d; padding: 20px;">
                            <i class="fas fa-lock" style="font-size: 28px; opacity: 0.3; margin-bottom: 8px; display: block;"></i>
                            Ce rôle ne possède aucune permission.
                        </div>
                    @endforelse
                @else
                    <div style="text-align: center; color: #7a9a7d; padding: 20px;">
                        <i class="fas fa-exclamation-triangle" style="font-size: 28px; opacity: 0.3; margin-bottom: 8px; display: block;"></i>
                        Aucun rôle attribué.
                    </div>
                @endif
            </div>
        </div>

        {{-- Permissions individuelles supplémentaires --}}
        @php $extraPerms = $user->extraPermissions()->orderBy('group')->get()->groupBy('group'); @endphp
        <div class="adm-card">
            <div class="adm-card__header">
                <span class="adm-card__title">
                    <i class="fas fa-plus-circle" style="color:#F9A825; margin-right:8px;"></i>
                    Permissions supplémentaires individuelles
                </span>
                <span class="adm-badge adm-badge-yellow" style="font-size: 11px;">
                    {{ $extraPerms->flatten()->count() }} permission(s)
                </span>
            </div>
            <div class="adm-card__body">
                @forelse($extraPerms as $group => $perms)
                    <div style="background: #fffbf0; border: 1px solid #fde68a; border-radius: 8px; padding: 14px; margin-bottom: 12px;">
                        <h5 style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: #92400e; margin-bottom: 10px; display: flex; align-items: center; gap: 6px;">
                            <i class="fas fa-folder-open" style="color: #F9A825;"></i>{{ $group }}
                        </h5>
                        <div style="display: flex; flex-wrap: wrap; gap: 6px;">
                            @foreach($perms as $perm)
                                <span class="adm-badge adm-badge-yellow" style="background: #ffffff; border: 1px solid #fde68a; font-weight: 500;">
                                    <i class="fas fa-plus" style="font-size: 8px; margin-right: 4px;"></i>{{ $perm->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; color: #7a9a7d; padding: 20px; font-size: 13px;">
                        <i class="fas fa-info-circle" style="font-size: 24px; opacity: 0.3; display: block; margin-bottom: 8px;"></i>
                        Aucune permission supplémentaire attribuée directement à cet utilisateur.
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</div>

@endsection
