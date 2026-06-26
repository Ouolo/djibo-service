@extends('admin.layouts.app')

@section('title', 'Ajouter Utilisateur')
@section('page-title', 'Créer un Utilisateur')
@section('breadcrumb', 'Admin / Utilisateurs / Créer')

@section('topbar-actions')
    <a href="{{ route('admin.users.index') }}" class="adm-btn adm-btn-outline">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
@endsection

@section('content')

@if($errors->any())
    <div class="adm-alert adm-alert-error">
        <div>
            <strong><i class="fas fa-exclamation-circle"></i> Erreurs de validation :</strong>
            <ul style="margin: 8px 0 0 16px; padding: 0; font-size: 13px;">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    </div>
@endif

<form method="POST" action="{{ route('admin.users.store') }}">
@csrf

<div class="adm-main-grid">

    {{-- Colonne principale --}}
    <div>
        <div class="adm-card" style="margin-bottom: 24px;">
            <div class="adm-card__header">
                <span class="adm-card__title">
                    <i class="fas fa-user-plus" style="color:#2E7D32; margin-right:8px;"></i>
                    Informations du compte
                </span>
            </div>
            <div class="adm-card__body">
                <div class="adm-form-grid">
                    <div class="adm-form-group">
                        <label for="name" class="adm-label">Nom complet <span>*</span></label>
                        <input type="text" class="adm-input @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name') }}" placeholder="Ex: Jean Dupont" required>
                        @error('name')<span class="adm-error"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>@enderror
                    </div>
                    <div class="adm-form-group">
                        <label for="email" class="adm-label">Adresse email <span>*</span></label>
                        <input type="email" class="adm-input @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email') }}" placeholder="Ex: jean@example.com" required>
                        @error('email')<span class="adm-error"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>@enderror
                    </div>
                    <div class="adm-form-group">
                        <label for="password" class="adm-label">Mot de passe <span>*</span></label>
                        <input type="password" class="adm-input @error('password') is-invalid @enderror"
                               id="password" name="password" placeholder="Minimum 8 caractères" required>
                        @error('password')<span class="adm-error"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>@enderror
                    </div>
                    <div class="adm-form-group">
                        <label for="password_confirmation" class="adm-label">Confirmer le mot de passe <span>*</span></label>
                        <input type="password" class="adm-input" id="password_confirmation"
                               name="password_confirmation" placeholder="Ressaisir le mot de passe" required>
                    </div>
                </div>

                <div class="adm-form-group" style="margin-bottom: 0;">
                    <label for="role_id" class="adm-label">Rôle d'accès <span>*</span></label>
                    <select class="adm-select @error('role_id') is-invalid @enderror" id="role_id" name="role_id" required>
                        <option value="">-- Sélectionner un rôle --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                                {{ $role->name }} ({{ $role->description ?? 'Pas de description' }})
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')<span class="adm-error"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>@enderror

                    {{-- Aperçu permissions du rôle --}}
                    <div id="role-permissions-preview" style="margin-top: 14px; display: none;">
                        <div style="font-size: 12px; font-weight: 700; color: #7a9a7d; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px;">
                            <i class="fas fa-shield-alt" style="margin-right: 4px;"></i> Permissions incluses dans ce rôle :
                        </div>
                        <div id="role-perms-list" style="display: flex; flex-wrap: wrap; gap: 6px; background: #f8fbf8; border: 1px solid #e8ede9; border-radius: 8px; padding: 12px;"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Permissions supplémentaires --}}
        <div class="adm-card">
            <div class="adm-card__header" style="display: flex; flex-direction: column; gap: 4px;">
                <span class="adm-card__title">
                    <i class="fas fa-plus-circle" style="color:#2E7D32; margin-right:8px;"></i>
                    Permissions supplémentaires individuelles
                </span>
                <span style="font-size: 12px; color: #7a9a7d; font-style: italic;">S'ajoutent aux permissions du rôle</span>
            </div>
            <div class="adm-card__body">
                {{-- Barre de recherche --}}
                <div style="position: relative; margin-bottom: 16px;">
                    <i class="fas fa-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #7a9a7d;"></i>
                    <input type="text" id="perm-search" placeholder="Rechercher une permission..."
                           style="width: 100%; border: 1.5px solid #d4dfd5; border-radius: 8px; padding: 9px 14px 9px 36px; font-size: 13px; outline: none; font-family: inherit; box-sizing: border-box;"
                           oninput="filterPermissions(this.value)">
                </div>

                @if($availableExtraPermissions->isEmpty())
                    <div style="text-align: center; color: #7a9a7d; padding: 24px;">
                        <i class="fas fa-info-circle" style="display: block; font-size: 28px; opacity: 0.4; margin-bottom: 8px;"></i>
                        Aucune permission supplémentaire disponible.
                    </div>
                @else
                    @foreach($availableExtraPermissions as $group => $perms)
                        <div class="perm-group" data-group="{{ strtolower($group) }}" style="background: #f8fbf8; border: 1px solid #e8ede9; border-radius: 8px; padding: 14px; margin-bottom: 12px;">
                            <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: #2E7D32; letter-spacing: 0.5px; margin-bottom: 10px; display: flex; align-items: center; gap: 6px;">
                                <i class="fas fa-folder" style="color: #66BB6A;"></i>
                                {{ $group }}
                            </div>
                            <div style="display: flex; flex-direction: column; gap: 6px;">
                                @foreach($perms as $perm)
                                    <label class="perm-item" data-name="{{ strtolower($perm->name) }} {{ strtolower($perm->slug) }}"
                                           style="display: flex; align-items: center; gap: 10px; padding: 8px 10px; border-radius: 6px; cursor: pointer; transition: background 0.2s;">
                                        <input type="checkbox"
                                               name="extra_permissions[]"
                                               value="{{ $perm->id }}"
                                               id="ep_{{ $perm->id }}"
                                               style="width: 16px; height: 16px; accent-color: #2E7D32; cursor: pointer; flex-shrink: 0;"
                                               {{ in_array($perm->id, old('extra_permissions', [])) ? 'checked' : '' }}>
                                        <div>
                                            <div style="font-size: 13px; font-weight: 600; color: #1a2e1b;">{{ $perm->name }}</div>
                                            @if($perm->description)
                                                <div style="font-size: 11px; color: #7a9a7d;">{{ $perm->description }}</div>
                                            @endif
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    {{-- Sidebar récapitulatif --}}
    <div>
        <div class="adm-sidebar-card">
            <div class="adm-card__header">
                <span class="adm-card__title">
                    <i class="fas fa-check-double" style="color:#2E7D32; margin-right:8px;"></i>
                    Récapitulatif des accès
                </span>
            </div>
            <div class="adm-card__body">
                <div id="recap-empty" style="text-align: center; color: #7a9a7d; padding: 16px; font-size: 13px;">
                    <i class="fas fa-user-shield" style="font-size: 28px; opacity: 0.3; display: block; margin-bottom: 8px;"></i>
                    Sélectionnez un rôle ou des permissions pour voir le récapitulatif.
                </div>
                <div id="recap-content" style="display: none;">
                    <div id="recap-role-section" style="margin-bottom: 14px; display: none;">
                        <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #7a9a7d; letter-spacing: 0.5px; margin-bottom: 6px;">Via le rôle</div>
                        <div id="recap-role-perms" style="display: flex; flex-wrap: wrap; gap: 5px;"></div>
                    </div>
                    <div id="recap-extra-section" style="display: none;">
                        <div style="font-size: 11px; font-weight: 700; text-transform: uppercase; color: #7a9a7d; letter-spacing: 0.5px; margin-bottom: 6px;">
                            <i class="fas fa-plus" style="font-size: 9px;"></i> Permissions supplémentaires
                        </div>
                        <div id="recap-extra-perms" style="display: flex; flex-wrap: wrap; gap: 5px;"></div>
                    </div>
                </div>

                <div style="margin-top: 20px; padding-top: 16px; border-top: 1px solid #e8ede9; display: flex; flex-direction: column; gap: 8px;">
                    <button type="submit" class="adm-btn adm-btn-primary" style="width: 100%; justify-content: center;">
                        <i class="fas fa-save"></i> Créer l'utilisateur
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="adm-btn adm-btn-outline" style="border-color: #d4dfd5; color: #7a9a7d; width: 100%; justify-content: center;">
                        Annuler
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
</form>

<style>
    /* Configuration globale de sécurité pour les champs */
    .adm-input, .adm-select {
        width: 100%;
        box-sizing: border-box;
    }

    /* Grille principale : 1 colonne par défaut (mobile / tablette portrait) */
    .adm-main-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
        align-items: start;
    }

    /* Grille des champs de saisie : 1 colonne par défaut sur mobile */
    .adm-form-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    /* Comportement sur tablettes et petits écrans (ex: champs sur 2 colonnes) */
    @media (min-width: 600px) {
        .adm-form-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    /* Comportement sur grands écrans (ordinateurs / tablettes paysage) */
    @media (min-width: 992px) {
        .adm-main-grid {
            grid-template-columns: 1fr 380px; /* Retour aux deux colonnes d'origine */
        }
        .adm-sidebar-card {
            position: sticky;
            top: 24px;
        }
    }
</style>

@endsection

@push('scripts')
<script>
const rolesPermissions = {
    @foreach($roles as $role)
    "{{ $role->id }}": [
        @foreach($role->permissions as $perm)
        { id: {{ $perm->id }}, name: "{{ addslashes($perm->name) }}", group: "{{ addslashes($perm->group) }}" },
        @endforeach
    ],
    @endforeach
};

function updateRecap() {
    const roleId = document.getElementById('role_id').value;
    const rolePerms = roleId ? (rolesPermissions[roleId] || []) : [];
    const checkedExtras = Array.from(document.querySelectorAll('input[name="extra_permissions[]"]:checked'))
        .map(cb => ({ id: cb.value, name: cb.closest('label').querySelector('div > div:first-child').textContent.trim() }));

    const recapEmpty   = document.getElementById('recap-empty');
    const recapContent = document.getElementById('recap-content');
    const roleSection  = document.getElementById('recap-role-section');
    const extraSection = document.getElementById('recap-extra-section');
    const rolePermsDiv = document.getElementById('recap-role-perms');
    const extraPermsDiv= document.getElementById('recap-extra-perms');
    const rolePreview  = document.getElementById('role-permissions-preview');
    const rolePermsList= document.getElementById('role-perms-list');

    // Role preview badges
    rolePermsList.innerHTML = '';
    if (rolePerms.length > 0) {
        rolePreview.style.display = 'block';
        rolePerms.forEach(p => {
            const b = document.createElement('span');
            b.className = 'adm-badge adm-badge-green';
            b.style.cssText = 'background:#fff; border:1px solid #c8d8c9; font-weight:500; font-size:11px; padding: 4px 8px; border-radius: 4px; display: inline-flex; align-items: center;';
            b.innerHTML = `<i class="fas fa-check" style="font-size:8px; color:#2E7D32; margin-right:4px;"></i>${p.name}`;
            rolePermsList.appendChild(b);
        });
    } else { rolePreview.style.display = 'none'; }

    // Recap
    const hasAnything = rolePerms.length > 0 || checkedExtras.length > 0;
    recapEmpty.style.display = hasAnything ? 'none' : 'block';
    recapContent.style.display = hasAnything ? 'block' : 'none';

    rolePermsDiv.innerHTML = '';
    roleSection.style.display = rolePerms.length > 0 ? 'block' : 'none';
    rolePerms.forEach(p => {
        const b = document.createElement('span');
        b.className = 'adm-badge adm-badge-green';
        b.style.cssText = 'background:#e8f5e9; border:1px solid #c8d8c9; font-size:11px; padding: 4px 8px; border-radius: 4px;';
        b.textContent = p.name;
        rolePermsDiv.appendChild(b);
    });

    extraPermsDiv.innerHTML = '';
    extraSection.style.display = checkedExtras.length > 0 ? 'block' : 'none';
    checkedExtras.forEach(p => {
        const b = document.createElement('span');
        b.className = 'adm-badge adm-badge-yellow';
        b.style.cssText = 'font-size:11px; background:#fffde7; border:1px solid #ffe082; padding: 4px 8px; border-radius: 4px;';
        b.innerHTML = `<i class="fas fa-plus" style="font-size:8px; margin-right:4px;"></i>${p.name}`;
        extraPermsDiv.appendChild(b);
    });
}

function filterPermissions(term) {
    term = term.toLowerCase();
    document.querySelectorAll('.perm-group').forEach(group => {
        let anyVisible = false;
        group.querySelectorAll('.perm-item').forEach(item => {
            const name = item.dataset.name;
            const groupName = group.dataset.group;
            const match = name.includes(term) || groupName.includes(term);
            item.style.display = match ? '' : 'none';
            if (match) anyVisible = true;
        });
        group.style.display = (anyVisible || !term) ? '' : 'none';
    });
}

document.getElementById('role_id').addEventListener('change', updateRecap);
document.querySelectorAll('input[name="extra_permissions[]"]').forEach(cb => cb.addEventListener('change', updateRecap));

// Hover effect
document.querySelectorAll('.perm-item').forEach(item => {
    item.addEventListener('mouseenter', () => item.style.background = '#f0f8f0');
    item.addEventListener('mouseleave', () => item.style.background = '');
});

updateRecap();
</script>
@endpush