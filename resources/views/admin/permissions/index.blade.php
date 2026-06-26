@extends('admin.layouts.app')

@section('title', 'Permissions')
@section('page-title', 'Gestion des Permissions')
@section('breadcrumb', 'Admin / Permissions')

@section('topbar-actions')
    @if(auth()->user()->hasPermission('create_roles'))
        <a href="{{ route('admin.permissions.create') }}" class="adm-btn adm-btn-primary">
            <i class="fas fa-plus"></i> Ajouter Permission
        </a>
    @endif
@endsection

@section('content')

{{-- Search & filter --}}
<form method="GET" action="{{ route('admin.permissions.index') }}" class="adm-search">
    <input type="text" name="search" class="adm-input" placeholder="🔍 Rechercher par nom ou slug..." value="{{ request('search') }}">
    <select name="group" class="adm-input" style="max-width:200px;">
        <option value="">Tous les groupes</option>
        @foreach($groups as $grp)
            <option value="{{ $grp }}" {{ request('group') === $grp ? 'selected' : '' }}>{{ ucfirst($grp) }}</option>
        @endforeach
    </select>
    <button type="submit" class="adm-btn adm-btn-outline">Filtrer</button>
    @if(request('search') || request('group'))
        <a href="{{ route('admin.permissions.index') }}" class="adm-btn adm-btn-sm" style="background:#f0f4f1; color:#7a9a7d; border:1.5px solid #d4dfd5;">Réinitialiser</a>
    @endif
</form>

<div class="adm-card">
    <div class="adm-card__header">
        <span class="adm-card__title">
            <i class="fas fa-lock" style="color:#2E7D32; margin-right:8px;"></i>
            {{ $permissions->total() }} permission(s)
        </span>
    </div>
    <div class="adm-card__body" style="padding:0;">
        @if($permissions->isEmpty())
            <div style="padding:56px; text-align:center; color:#7a9a7d;">
                <i class="fas fa-key" style="font-size:40px; margin-bottom:14px; display:block; opacity:0.4;"></i>
                Aucune permission trouvée.
                @if(auth()->user()->hasPermission('create_roles'))
                    <br><br>
                    <a href="{{ route('admin.permissions.create') }}" class="adm-btn adm-btn-primary">Créer la première</a>
                @endif
            </div>
        @else
            <table class="adm-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Identifiant (Slug)</th>
                        <th>Groupe</th>
                        <th>Action</th>
                        <th>Description</th>
                        <th style="text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $permission)
                    <tr>
                        <td>
                            <div style="font-weight:600; color:#1a2e1b;">{{ $permission->name }}</div>
                        </td>
                        <td>
                            <code style="background:#eef2ee; padding:2px 6px; border-radius:4px; font-size:12px; color:#1b5e20;">{{ $permission->slug }}</code>
                        </td>
                        <td>
                            <span class="adm-badge adm-badge-green" style="background:#e8f5e9; border: 1px solid #c8d8c9;">
                                <i class="fas fa-folder" style="font-size:10px; margin-right:4px;"></i>
                                {{ $permission->group }}
                            </span>
                        </td>
                        <td>
                            @php
                                $actionBadgeClass = 'adm-badge-grey';
                                if ($permission->action === 'create') $actionBadgeClass = 'adm-badge-green';
                                elseif ($permission->action === 'read') $actionBadgeClass = 'adm-badge-yellow';
                                elseif ($permission->action === 'update') $actionBadgeClass = 'adm-badge-yellow';
                                elseif ($permission->action === 'delete') $actionBadgeClass = 'adm-badge-grey';
                            @endphp
                            <span class="adm-badge {{ $actionBadgeClass }}" style="text-transform: uppercase; font-size: 10px;">
                                {{ $permission->action }}
                            </span>
                        </td>
                        <td>
                            <span style="color:#7a9a7d; font-size:13px;">{{ $permission->description ?? '-' }}</span>
                        </td>
                        <td>
                            <div style="display:flex; gap:6px; justify-content:flex-end;">
                                @if(auth()->user()->hasPermission('read_roles'))
                                    <a href="{{ route('admin.permissions.show', $permission) }}" class="adm-btn adm-btn-outline adm-btn-sm" title="Voir les détails">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endif
                                @if(auth()->user()->hasPermission('update_roles'))
                                    <a href="{{ route('admin.permissions.edit', $permission) }}" class="adm-btn adm-btn-outline adm-btn-sm" style="color: var(--jaune); border-color: var(--jaune);" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif
                                @if(auth()->user()->hasPermission('delete_roles'))
                                    <form method="POST" action="{{ route('admin.permissions.destroy', $permission) }}"
                                          onsubmit="return confirm('Supprimer cette permission ?');">
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
            @if($permissions->hasPages())
                <div style="padding:16px 24px;">
                    {{ $permissions->links() }}
                </div>
            @endif
        @endif
    </div>
</div>

@endsection
