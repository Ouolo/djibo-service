@extends('admin.layouts.app')

@section('title', 'Utilisateurs')
@section('page-title', 'Gestion des Utilisateurs')
@section('breadcrumb', 'Admin / Utilisateurs')

@section('topbar-actions')
    @if(auth()->user()->hasPermission('create_users'))
        <a href="{{ route('admin.users.create') }}" class="adm-btn adm-btn-primary">
            <i class="fas fa-plus"></i> Ajouter Utilisateur
        </a>
    @endif
@endsection

@section('content')

{{-- Search & filter --}}
<form method="GET" action="{{ route('admin.users.index') }}" class="adm-search">
    <input type="text" name="search" class="adm-input" placeholder="🔍 Rechercher par nom ou email..." value="{{ request('search') }}">
    <select name="role_id" class="adm-input" style="max-width:200px;">
        <option value="">Tous les rôles</option>
        @foreach($roles as $role)
            <option value="{{ $role->id }}" {{ request('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
        @endforeach
    </select>
    <button type="submit" class="adm-btn adm-btn-outline">Filtrer</button>
    @if(request('search') || request('role_id'))
        <a href="{{ route('admin.users.index') }}" class="adm-btn adm-btn-sm" style="background:#f0f4f1; color:#7a9a7d; border:1.5px solid #d4dfd5;">Réinitialiser</a>
    @endif
</form>

<div class="adm-card">
    <div class="adm-card__header">
        <span class="adm-card__title">
            <i class="fas fa-users" style="color:#2E7D32; margin-right:8px;"></i>
            {{ $users->total() }} utilisateur(s)
        </span>
    </div>
    <div class="adm-card__body" style="padding:0;">
        @if($users->isEmpty())
            <div style="padding:56px; text-align:center; color:#7a9a7d;">
                <i class="fas fa-user-slash" style="font-size:40px; margin-bottom:14px; display:block; opacity:0.4;"></i>
                Aucun utilisateur trouvé.
                @if(auth()->user()->hasPermission('create_users'))
                    <br><br>
                    <a href="{{ route('admin.users.create') }}" class="adm-btn adm-btn-primary">Créer le premier</a>
                @endif
            </div>
        @else
            <table class="adm-table">
                <thead>
                    <tr>
                        <th style="width:60px;">Avatar</th>
                        <th>Nom & Email</th>
                        <th>Rôle</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>
                            <div style="width:42px; height:42px; background:#e8f5e9; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#2E7D32; font-weight:700; font-size:16px; border:2px solid #66BB6A;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        </td>
                        <td>
                            <div style="font-weight:600; color:#1a2e1b; margin-bottom:3px;">{{ $user->name }}</div>
                            <div style="font-size:12px; color:#7a9a7d;">{{ $user->email }}</div>
                        </td>
                        <td>
                            @if($user->role)
                                @php
                                    $badgeClass = 'adm-badge-grey';
                                    if (in_array($user->role->slug, ['superadmin', 'admin'])) {
                                        $badgeClass = 'adm-badge-green';
                                    } elseif ($user->role->slug === 'editor') {
                                        $badgeClass = 'adm-badge-yellow';
                                    }
                                @endphp
                                <span class="adm-badge {{ $badgeClass }}">
                                    <i class="fas fa-shield-alt" style="font-size:10px; margin-right:4px;"></i>
                                    {{ $user->role->name }}
                                </span>
                            @else
                                <span class="adm-badge adm-badge-grey">Aucun rôle</span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex; gap:6px; justify-content:flex-end;">
                                @if(auth()->user()->hasPermission('read_users'))
                                    <a href="{{ route('admin.users.show', $user) }}" class="adm-btn adm-btn-outline adm-btn-sm" title="Voir les détails">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endif
                                @if(auth()->user()->hasPermission('update_users'))
                                    <a href="{{ route('admin.users.edit', $user) }}" class="adm-btn adm-btn-outline adm-btn-sm" style="color: var(--jaune); border-color: var(--jaune);" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif
                                @if(auth()->user()->hasPermission('delete_users'))
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
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
            @if($users->hasPages())
                <div style="padding:16px 24px;">
                    {{ $users->links() }}
                </div>
            @endif
        @endif
    </div>
</div>

@endsection