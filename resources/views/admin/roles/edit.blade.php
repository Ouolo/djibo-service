@extends('admin.layouts.app')

@section('title', 'Modifier Rôle')
@section('page-title', 'Modifier le Rôle')
@section('breadcrumb', 'Admin / Rôles / Modifier')

@section('content')

<style>
    /* ============================================
       VARIABLES & BASE STYLES
       ============================================ */
    :root {
        --primary: #2E7D32;
        --primary-dark: #1B5E20;
        --primary-light: #e8f5e9;
        --success: #66BB6A;
        --danger: #dc2626;
        --muted: #7a9a7d;
        --light: #f0f4f1;
        --border: #d4dfd5;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ============================================
       HEADER SECTION
       ============================================ */
    .page-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border-radius: 12px;
        padding: 24px 30px;
        color: #fff;
        margin-bottom: 24px;
        box-shadow: 0 4px 20px rgba(46, 125, 50, 0.15);
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(20px); }
    }

    .page-header > * {
        position: relative;
        z-index: 1;
    }

    .page-header h2 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 4px;
        letter-spacing: -0.5px;
    }

    .page-header p {
        font-size: 14px;
        opacity: 0.9;
        margin: 0;
    }

    .page-header .btn-back {
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #fff;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        transition: var(--transition);
        text-decoration: none;
    }

    .page-header .btn-back:hover {
        background: rgba(255, 255, 255, 0.25);
        border-color: rgba(255, 255, 255, 0.5);
    }

    /* ============================================
       CARD STYLES
       ============================================ */
    .custom-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        background: #fff;
    }

    .custom-card .card-body {
        padding: 30px;
    }

    /* ============================================
       FORM SECTION STYLES
       ============================================ */
    .form-section {
        margin-bottom: 35px;
    }

    .form-section:last-child {
        margin-bottom: 0;
    }

    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid var(--light);
    }

    .section-icon {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 16px;
        margin-right: 12px;
        flex-shrink: 0;
    }

    .section-title {
        font-size: 16px;
        font-weight: 700;
        color: #1a2e1b;
        margin: 0;
    }

    /* ============================================
       FORM CONTROLS
       ============================================ */
    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #2d4a2f;
        margin-bottom: 8px;
        display: block;
    }

    .form-control {
        border: 1.5px solid var(--border);
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 14px;
        font-family: inherit;
        transition: var(--transition);
        background: #fff;
        width: 100%;
        outline: none;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
    }

    .form-control.is-invalid {
        border-color: var(--danger);
    }

    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    .invalid-feedback {
        display: block;
        font-size: 12px;
        color: var(--danger);
        margin-top: 6px;
        font-weight: 500;
    }

    /* ============================================
       ERROR ALERT
       ============================================ */
    .alert-custom {
        background: linear-gradient(135deg, #fef2f2 0%, #fffbfb 100%);
        border: 1.5px solid #f5d4d4;
        border-radius: 8px;
        padding: 16px 20px;
        margin-bottom: 24px;
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.05);
    }

    .alert-custom strong {
        color: var(--danger);
        font-weight: 700;
    }

    .alert-custom ul {
        margin: 8px 0 0 20px;
        padding: 0;
    }

    .alert-custom li {
        color: #666;
        margin: 4px 0;
        font-size: 13px;
    }

    /* ============================================
       PERMISSIONS SECTION
       ============================================ */
    .permissions-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 2px solid var(--light);
    }

    .permissions-search {
        flex: 1;
        margin-right: 20px;
    }

    .search-input {
        position: relative;
    }

    .search-input input {
        width: 100%;
        border: 1.5px solid var(--border);
        border-radius: 8px;
        padding: 10px 14px 10px 38px;
        font-size: 14px;
        transition: var(--transition);
        outline: none;
    }

    .search-input input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
    }

    .search-input i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--muted);
        font-size: 14px;
    }

    .search-counter {
        font-size: 12px;
        color: var(--muted);
        font-weight: 600;
        white-space: nowrap;
        background: var(--light);
        padding: 10px 14px;
        border-radius: 8px;
    }

    /* ============================================
       PERMISSION GROUPS
       ============================================ */
    .permission-groups {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }

    .permission-group {
        background: #fff;
        border: 1.5px solid var(--border);
        border-radius: 12px;
        padding: 0;
        transition: var(--transition);
        overflow: hidden;
    }

    .permission-group:hover {
        border-color: var(--primary);
        box-shadow: 0 4px 20px rgba(46, 125, 50, 0.08);
    }

    .group-header {
        background: linear-gradient(135deg, var(--primary-light) 0%, rgba(102, 187, 106, 0.05) 100%);
        padding: 14px 18px;
        border-bottom: 1.5px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .group-title {
        display: flex;
        align-items: center;
        gap: 10px;
        flex: 1;
    }

    .group-icon {
        width: 28px;
        height: 28px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 12px;
        flex-shrink: 0;
    }

    .group-label {
        font-size: 14px;
        font-weight: 700;
        color: #1a2e1b;
        text-transform: capitalize;
        margin: 0;
    }

    .group-count {
        font-size: 11px;
        color: var(--muted);
        font-weight: 600;
    }

    .group-toggle {
        width: 44px;
        height: 24px;
        background: var(--border);
        border: none;
        border-radius: 12px;
        cursor: pointer;
        position: relative;
        transition: var(--transition);
        padding: 0;
        flex-shrink: 0;
    }

    .group-toggle::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        background: #fff;
        border-radius: 10px;
        top: 2px;
        left: 2px;
        transition: var(--transition);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .group-toggle.active {
        background: var(--success);
    }

    .group-toggle.active::after {
        left: 22px;
    }

    .group-content {
        padding: 14px 18px;
    }

    .permission-item {
        display: flex;
        align-items: flex-start;
        padding: 8px;
        margin: -8px -8px 4px -8px;
        border-radius: 6px;
        transition: var(--transition);
        cursor: pointer;
    }

    .permission-item:hover {
        background: var(--primary-light);
    }

    .permission-item input[type="checkbox"] {
        margin-top: 3px;
        margin-right: 10px;
        width: 16px;
        height: 16px;
        cursor: pointer;
        accent-color: var(--primary);
        flex-shrink: 0;
    }

    .permission-label {
        flex: 1;
        cursor: pointer;
    }

    .permission-name {
        font-size: 13px;
        font-weight: 600;
        color: #1a2e1b;
        margin: 0;
        margin-bottom: 2px;
    }

    .permission-desc {
        font-size: 11px;
        color: var(--muted);
        margin: 0;
        line-height: 1.3;
    }

    /* ============================================
       SELECTED PERMISSIONS SUMMARY
       ============================================ */
    .selected-summary {
        background: var(--primary-light);
        border: 1.5px solid rgba(46, 125, 50, 0.2);
        border-radius: 8px;
        padding: 14px 18px;
        margin-bottom: 24px;
        display: none;
    }

    .selected-summary.active {
        display: block;
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .summary-title {
        font-size: 12px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .permission-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }

    .permission-chip {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 16px;
        padding: 4px 10px;
        font-size: 12px;
        font-weight: 500;
        color: #1a2e1b;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .permission-chip .remove {
        cursor: pointer;
        color: var(--muted);
        font-weight: 700;
        transition: var(--transition);
        font-size: 14px;
    }

    .permission-chip .remove:hover {
        color: var(--danger);
    }

    /* ============================================
       BUTTONS
       ============================================ */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding-top: 24px;
        border-top: 2px solid var(--light);
    }

    .btn-cancel {
        background: transparent;
        border: 1.5px solid var(--border);
        color: #2d4a2f;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 13px;
        transition: var(--transition);
        cursor: pointer;
        text-decoration: none;
    }

    .btn-cancel:hover {
        background: var(--light);
        border-color: var(--primary);
        color: var(--primary);
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border: none;
        color: #fff;
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 13px;
        transition: var(--transition);
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(46, 125, 50, 0.2);
    }

    .btn-submit:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(46, 125, 50, 0.3);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 768px) {
        .page-header {
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .permission-groups {
            grid-template-columns: 1fr;
        }

        .permissions-header {
            flex-direction: column;
            gap: 12px;
        }

        .permissions-search {
            margin-right: 0;
            width: 100%;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .form-actions button,
        .form-actions a {
            width: 100%;
            text-align: center;
        }
    }

    .no-results {
        text-align: center;
        padding: 30px 20px;
        color: var(--muted);
    }

    .no-results i {
        font-size: 36px;
        margin-bottom: 12px;
        opacity: 0.3;
    }
</style>

<div class="container-fluid py-4">

    <!-- Header -->
    <div class="page-header d-flex justify-content-between align-items-start">
        <div style="flex: 1;">
            <h2 class="mb-2">
                <i class="fas fa-shield-alt me-3" style="font-size: 22px;"></i>
                Modifier le rôle : {{ $role->name }}
            </h2>
            <p class="mb-0">
                Mettez à jour les paramètres et permissions d'accès de ce rôle.
            </p>
        </div>

        <a href="{{ route('admin.roles.index') }}" class="btn-back">
            <i class="fas fa-chevron-left me-2"></i> Retour
        </a>
    </div>

    <!-- Erreurs -->
    @if($errors->any())
        <div class="alert-custom">
            <strong>
                <i class="fas fa-exclamation-circle me-2"></i>
                Des erreurs ont été détectées :
            </strong>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="custom-card">
        <div class="card-body">

            <form method="POST" action="{{ route('admin.roles.update', $role) }}" id="roleForm">
                @csrf
                @method('PATCH')

                <!-- Informations du rôle -->
                <div class="form-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h3 class="section-title">Informations du rôle</h3>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
                        <div class="form-group">
                            <label class="form-label">Nom du rôle</label>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name"
                                   value="{{ old('name', $role->name) }}"
                                   placeholder="Ex: Modérateur"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Slug (identifiant) - Non modifiable</label>
                            <input type="text"
                                   class="form-control"
                                   name="slug"
                                   value="{{ $role->slug }}"
                                   style="background: #f0f4f1; cursor: not-allowed;"
                                   disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  name="description"
                                  placeholder="Décrivez le rôle et ses responsabilités...">{{ old('description', $role->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Gestion des permissions -->
                <div class="form-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h3 class="section-title">Permissions d'accès</h3>
                    </div>

                    <!-- Barre de recherche -->
                    <div class="permissions-header">
                        <div class="permissions-search">
                            <div class="search-input">
                                <i class="fas fa-search"></i>
                                <input type="search" id="permission-search" 
                                       placeholder="Rechercher une permission..."
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="search-counter">
                            <span id="search-count">{{ count($permissions) }}</span> groupes
                        </div>
                    </div>

                    <!-- Résumé des permissions sélectionnées -->
                    <div class="selected-summary" id="selectedSummary">
                        <div class="summary-title">
                            <i class="fas fa-check-circle me-2"></i>
                            Permissions sélectionnées
                        </div>
                        <div class="permission-chips" id="permissionChips"></div>
                    </div>

                    <!-- Groupes de permissions -->
                    <div class="permission-groups" id="permissionGroups">
                        @foreach($permissions as $group => $groupPermissions)
                            <div class="permission-group permission-wrapper" data-group="{{ $group }}">

                                <div class="group-header">
                                    <div class="group-title">
                                        <div class="group-icon">
                                            <i class="fas fa-folder"></i>
                                        </div>
                                        <div>
                                            <p class="group-label">{{ $group }}</p>
                                            <span class="group-count">{{ count($groupPermissions) }} permissions</span>
                                        </div>
                                    </div>
                                    <button type="button" class="group-toggle" data-group="{{ $group }}"
                                            aria-label="Sélectionner tout le groupe">
                                    </button>
                                </div>

                                <div class="group-content">
                                    @foreach($groupPermissions as $permission)
                                        <label class="permission-item">
                                            <input class="form-check-input permission-checkbox"
                                                   type="checkbox"
                                                   name="permissions[]"
                                                   value="{{ $permission->id }}"
                                                   data-name="{{ $permission->name }}"
                                                   data-group="{{ $group }}"
                                                   {{ in_array($permission->id, old('permissions', $rolePermissions)) ? 'checked' : '' }}>

                                            <div class="permission-label">
                                                <p class="permission-name">{{ $permission->name }}</p>
                                                @if($permission->description)
                                                    <p class="permission-desc">{{ $permission->description }}</p>
                                                @endif
                                            </div>
                                        </label>
                                    @endforeach
                                </div>

                            </div>
                        @endforeach
                    </div>

                    <div class="no-results" id="noResults" style="display: none;">
                        <i class="fas fa-search"></i>
                        <p>Aucune permission ne correspond à votre recherche</p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="form-actions">
                    <a href="{{ route('admin.roles.index') }}" class="btn-cancel">
                        <i class="fas fa-times me-2"></i>
                        Annuler
                    </a>

                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save me-2"></i>
                        Enregistrer les modifications
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('permission-search');
    const searchCounter = document.getElementById('search-count');
    const noResults = document.getElementById('noResults');
    const permissionChips = document.getElementById('permissionChips');
    const selectedSummary = document.getElementById('selectedSummary');
    const permissionGroups = document.querySelectorAll('.permission-group');
    const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');
    const groupToggles = document.querySelectorAll('.group-toggle');

    // ============ SEARCH FUNCTIONALITY ============
    searchInput.addEventListener('input', function () {
        const searchTerm = this.value.toLowerCase().trim();
        let visibleGroups = 0;

        permissionGroups.forEach(group => {
            const groupName = group.dataset.group.toLowerCase();
            const permissions = group.querySelectorAll('.permission-item');
            let visiblePermissions = 0;

            permissions.forEach(permission => {
                const text = permission.innerText.toLowerCase();
                const matches = text.includes(searchTerm);
                permission.style.display = matches ? '' : 'none';
                if (matches) visiblePermissions++;
            });

            if (searchTerm === '' || visiblePermissions > 0 || groupName.includes(searchTerm)) {
                group.style.display = '';
                visibleGroups++;
            } else {
                group.style.display = 'none';
            }
        });

        searchCounter.textContent = visibleGroups;
        noResults.style.display = visibleGroups === 0 ? 'block' : 'none';
    });

    // ============ GROUP TOGGLE ============
    groupToggles.forEach(toggle => {
        updateGroupToggle(toggle);

        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            const groupName = this.dataset.group;
            const checkboxes = Array.from(document.querySelectorAll(`input[data-group="${groupName}"]`));
            const enabled = checkboxes.filter(ch => !ch.disabled);
            const allChecked = enabled.length > 0 && enabled.every(ch => ch.checked);

            enabled.forEach(ch => ch.checked = !allChecked);
            updateGroupToggle(this);
            updateSelectedPermissions();
        });
    });

    // ============ CHECKBOX CHANGE ============
    permissionCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const groupToggle = document.querySelector(`[data-group="${this.dataset.group}"]`);
            updateGroupToggle(groupToggle);
            updateSelectedPermissions();
        });
    });

    // ============ UPDATE GROUP TOGGLE STATE ============
    function updateGroupToggle(toggle) {
        const groupName = toggle.dataset.group;
        const checkboxes = Array.from(document.querySelectorAll(`input[data-group="${groupName}"]`));
        const enabled = checkboxes.filter(ch => !ch.disabled);
        const checkedCount = enabled.filter(ch => ch.checked).length;
        const totalCount = enabled.length;

        if (checkedCount === totalCount && totalCount > 0) {
            toggle.classList.add('active');
        } else {
            toggle.classList.remove('active');
        }
    }

    // ============ UPDATE SELECTED PERMISSIONS DISPLAY ============
    function updateSelectedPermissions() {
        const selected = Array.from(permissionCheckboxes)
            .filter(ch => ch.checked)
            .map(ch => ({
                id: ch.value,
                name: ch.dataset.name
            }));

        permissionChips.innerHTML = '';

        if (selected.length > 0) {
            selectedSummary.classList.add('active');

            selected.forEach(perm => {
                const chip = document.createElement('div');
                chip.className = 'permission-chip';
                chip.innerHTML = `
                    ${perm.name}
                    <span class="remove" data-id="${perm.id}">×</span>
                `;

                chip.querySelector('.remove').addEventListener('click', function () {
                    const checkbox = document.querySelector(`input[value="${perm.id}"]`);
                    checkbox.checked = false;
                    updateGroupToggle(document.querySelector(`[data-group="${checkbox.dataset.group}"]`));
                    updateSelectedPermissions();
                });

                permissionChips.appendChild(chip);
            });
        } else {
            selectedSummary.classList.remove('active');
        }
    }

    // Initialize on page load
    updateSelectedPermissions();
});
</script>
@endpush