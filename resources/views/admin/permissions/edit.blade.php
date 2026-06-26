@extends('admin.layouts.app')

@section('title', 'Modifier Permission')
@section('page-title', 'Modifier une Permission')
@section('breadcrumb', 'Admin / Permissions / Modifier')

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
            Modifier la permission : <strong>{{ $permission->name }}</strong>
        </span>
    </div>
    <div class="adm-card__body">
        <form method="POST" action="{{ route('admin.permissions.update', $permission) }}">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 20px;">
                <div class="adm-form-group">
                    <label for="name" class="adm-label">Nom de la permission <span>*</span></label>
                    <input type="text" class="adm-input @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name', $permission->name) }}" required>
                    @error('name')
                        <span class="adm-error"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="adm-form-group">
                    <label for="slug" class="adm-label">Slug (identifiant système) - Non modifiable</label>
                    <input type="text" class="adm-input" id="slug" value="{{ $permission->slug }}" style="background: #f0f4f1; cursor: not-allowed;" disabled>
                    <small class="adm-help">L'identifiant système ne peut pas être modifié car il est lié au code source.</small>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 20px;">
                <div class="adm-form-group">
                    <label for="group" class="adm-label">Groupe de permissions <span>*</span></label>
                    <input type="text" class="adm-input @error('group') is-invalid @enderror" 
                           id="group" name="group" value="{{ old('group', $permission->group) }}" required>
                    @error('group')
                        <span class="adm-error"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>
                    @enderror
                </div>

                <div class="adm-form-group">
                    <label for="action" class="adm-label">Type d'action <span>*</span></label>
                    <select class="adm-select @error('action') is-invalid @enderror" id="action" name="action" required>
                        <option value="">-- Sélectionner une action --</option>
                        <option value="create" {{ old('action', $permission->action) === 'create' ? 'selected' : '' }}>Create (Ajouter)</option>
                        <option value="read" {{ old('action', $permission->action) === 'read' ? 'selected' : '' }}>Read (Consulter / Lire)</option>
                        <option value="update" {{ old('action', $permission->action) === 'update' ? 'selected' : '' }}>Update (Modifier)</option>
                        <option value="delete" {{ old('action', $permission->action) === 'delete' ? 'selected' : '' }}>Delete (Supprimer)</option>
                    </select>
                    @error('action')
                        <span class="adm-error"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="adm-form-group" style="margin-bottom: 30px;">
                <label for="description" class="adm-label">Description détaillée</label>
                <textarea class="adm-textarea @error('description') is-invalid @enderror" 
                          id="description" name="description" rows="3">{{ old('description', $permission->description) }}</textarea>
                @error('description')
                    <span class="adm-error"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; gap: 10px; border-top: 1px solid #e8ede9; padding-top: 20px;">
                <button type="submit" class="adm-btn adm-btn-primary">
                    <i class="fas fa-save"></i> Enregistrer les modifications
                </button>
                <a href="{{ route('admin.permissions.index') }}" class="adm-btn adm-btn-outline" style="border-color: #d4dfd5; color: #7a9a7d;">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
