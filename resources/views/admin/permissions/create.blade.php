@extends('admin.layouts.app')

@section('title', 'Créer Permission')
@section('page-title', 'Ajouter une Permission')
@section('breadcrumb', 'Admin / Permissions / Créer')

@section('topbar-actions')
    <a href="{{ route('admin.permissions.index') }}" class="adm-btn adm-btn-outline">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
@endsection

@section('content')

@if($errors->any())
    <div class="adm-alert adm-alert-error">
        <div>
            <strong><i class="fas fa-exclamation-circle"></i> Erreurs de validation :</strong>
            <ul style="margin: 8px 0 0 16px; padding: 0; font-size: 13px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<div class="adm-card">
    <div class="adm-card__header">
        <span class="adm-card__title">
            <i class="fas fa-key" style="color:#2E7D32; margin-right:8px;"></i>
            Nouvelle clé de permission
        </span>
    </div>
    <div class="adm-card__body">
        <form method="POST" action="{{ route('admin.permissions.store') }}">
            @csrf

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 20px;">
                <div class="adm-form-group">
                    <label for="name" class="adm-label">Nom de la permission <span>*</span></label>
                    <input type="text" class="adm-input @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name') }}" placeholder="Ex: Créer des publications" required>
                    <small class="adm-help">Nom convivial affiché dans les rôles</small>
                    @error('name')
                        <span class="adm-error"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="adm-form-group">
                    <label for="slug" class="adm-label">Slug (identifiant système) <span>*</span></label>
                    <input type="text" class="adm-input @error('slug') is-invalid @enderror" 
                           id="slug" name="slug" value="{{ old('slug') }}" placeholder="Ex: create_actualites" required>
                    <small class="adm-help">Identifiant unique utilisé dans le code (ex: create_users)</small>
                    @error('slug')
                        <span class="adm-error"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 20px;">
                <div class="adm-form-group">
                    <label for="group" class="adm-label">Groupe de permissions <span>*</span></label>
                    <input type="text" class="adm-input @error('group') is-invalid @enderror" 
                           id="group" name="group" value="{{ old('group') }}" placeholder="Ex: actualites, produits, users..." required>
                    <small class="adm-help">Sert à regrouper les permissions dans l'interface des rôles</small>
                    @error('group')
                        <span class="adm-error"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="adm-form-group">
                    <label for="action" class="adm-label">Type d'action <span>*</span></label>
                    <select class="adm-select @error('action') is-invalid @enderror" id="action" name="action" required>
                        <option value="">-- Sélectionner une action --</option>
                        <option value="create" {{ old('action') === 'create' ? 'selected' : '' }}>Create (Ajouter)</option>
                        <option value="read" {{ old('action') === 'read' ? 'selected' : '' }}>Read (Consulter / Lire)</option>
                        <option value="update" {{ old('action') === 'update' ? 'selected' : '' }}>Update (Modifier)</option>
                        <option value="delete" {{ old('action') === 'delete' ? 'selected' : '' }}>Delete (Supprimer)</option>
                    </select>
                    <small class="adm-help">Indique l'opération CRUD visée</small>
                    @error('action')
                        <span class="adm-error"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="adm-form-group" style="margin-bottom: 30px;">
                <label for="description" class="adm-label">Description détaillée</label>
                <textarea class="adm-textarea @error('description') is-invalid @enderror" 
                          id="description" name="description" placeholder="Description du rôle ou de ce que permet cette permission...">{{ old('description') }}</textarea>
                @error('description')
                    <span class="adm-error"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; gap: 10px; border-top: 1px solid #e8ede9; padding-top: 20px;">
                <button type="submit" class="adm-btn adm-btn-primary">
                    <i class="fas fa-save"></i> Créer la permission
                </button>
                <a href="{{ route('admin.permissions.index') }}" class="adm-btn adm-btn-outline" style="border-color: #d4dfd5; color: #7a9a7d;">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
