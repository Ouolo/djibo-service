@extends('admin.layouts.app')

@section('title', $realisation->exists ? 'Modifier la réalisation' : 'Nouvelle réalisation')
@section('page-title', $realisation->exists ? 'Modifier la réalisation' : 'Nouvelle réalisation')
@section('breadcrumb', 'Admin / Réalisations / ' . ($realisation->exists ? 'Modifier' : 'Créer'))

@section('topbar-actions')
    <a href="{{ route('admin.realisations.index') }}" class="adm-btn adm-btn-outline">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
@endsection

@section('content')

<form method="POST"
      action="{{ $realisation->exists ? route('admin.realisations.update', $realisation) : route('admin.realisations.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($realisation->exists) @method('PUT') @endif

    <div style="display:grid; grid-template-columns:1fr 340px; gap:20px; align-items:start;">

        {{-- Colonne gauche : contenu principal --}}
        <div>
            <div class="adm-card" style="margin-bottom:20px;">
                <div class="adm-card__header">
                    <span class="adm-card__title">🏆 Informations de la réalisation</span>
                </div>
                <div class="adm-card__body">

                    <div class="adm-form-group">
                        <label class="adm-label" for="titre">Titre du projet <span>*</span></label>
                        <input type="text" id="titre" name="titre" class="adm-input"
                               value="{{ old('titre', $realisation->titre) }}"
                               placeholder="Ex : Restauration des Sols à Segouboughou…" required>
                        @error('titre') <div class="adm-error">{{ $message }}</div> @enderror
                    </div>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                        <div class="adm-form-group">
                            <label class="adm-label" for="localisation">Localisation <span>*</span></label>
                            <input type="text" id="localisation" name="localisation" class="adm-input"
                                   value="{{ old('localisation', $realisation->localisation) }}"
                                   placeholder="Ex : Ségou (Mali)" required>
                            @error('localisation') <div class="adm-error">{{ $message }}</div> @enderror
                        </div>
                        <div class="adm-form-group">
                            <label class="adm-label" for="impact">Impact / Résultat clé <span>*</span></label>
                            <input type="text" id="impact" name="impact" class="adm-input"
                                   value="{{ old('impact', $realisation->impact) }}"
                                   placeholder="Ex : 150 hectares restaurés" required>
                            @error('impact') <div class="adm-error">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="adm-form-group">
                        <label class="adm-label" for="description">Description complète <span>*</span></label>
                        <textarea id="description" name="description" class="adm-textarea" rows="8"
                                  placeholder="Décrivez le contexte, les actions menées et les résultats obtenus…" required>{{ old('description', $realisation->description) }}</textarea>
                        <div class="adm-help">Affiché sur la page des réalisations. Les 120 premiers caractères sont affichés en aperçu sur l'accueil.</div>
                        @error('description') <div class="adm-error">{{ $message }}</div> @enderror
                    </div>

                </div>
            </div>
        </div>

        {{-- Colonne droite : paramètres & image --}}
        <div>
            <div class="adm-card" style="margin-bottom:16px;">
                <div class="adm-card__header">
                    <span class="adm-card__title">⚙️ Paramètres</span>
                </div>
                <div class="adm-card__body">

                    <div class="adm-form-group">
                        <label class="adm-label" for="date_projet">Date du projet</label>
                        <input type="date" id="date_projet" name="date_projet" class="adm-input"
                               value="{{ old('date_projet', $realisation->date_projet?->format('Y-m-d')) }}">
                        @error('date_projet') <div class="adm-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="adm-form-group">
                        <label class="adm-label" for="ordre">Ordre d'affichage</label>
                        <input type="number" id="ordre" name="ordre" class="adm-input" min="0"
                               value="{{ old('ordre', $realisation->ordre ?? 0) }}" placeholder="0">
                        <div class="adm-help">Les plus petits numéros apparaissent en premier.</div>
                    </div>

                    <div class="adm-form-group">
                        <label class="adm-toggle" for="actif">
                            <input type="checkbox" id="actif" name="actif" value="1"
                                   {{ old('actif', $realisation->actif ?? true) ? 'checked' : '' }}>
                            <span>Visible sur le site</span>
                        </label>
                        <div class="adm-help" style="margin-top:6px;">Si décoché, la réalisation est masquée du public.</div>
                    </div>

                    <div style="display:flex; gap:10px; margin-top:4px;">
                        <button type="submit" class="adm-btn adm-btn-primary" style="flex:1; justify-content:center;">
                            <i class="fas fa-save"></i>
                            {{ $realisation->exists ? 'Enregistrer' : 'Créer' }}
                        </button>
                    </div>

                </div>
            </div>

            {{-- Image --}}
            <div class="adm-card">
                <div class="adm-card__header">
                    <span class="adm-card__title">🖼️ Photo du projet</span>
                </div>
                <div class="adm-card__body">

                    @if($realisation->exists && $realisation->image)
                        <img id="img-preview"
                             src="{{ Str::startsWith($realisation->image, 'assets/') ? asset($realisation->image) : Storage::url($realisation->image) }}"
                             alt="Aperçu" class="adm-img-preview">
                    @else
                        <div class="adm-img-placeholder" id="img-placeholder">
                            <span><i class="fas fa-image" style="display:block; font-size:24px; margin-bottom:6px;"></i> Aucune image</span>
                        </div>
                        <img id="img-preview" class="adm-img-preview" style="display:none;" alt="Aperçu">
                    @endif

                    <div class="adm-form-group" style="margin-top:14px; margin-bottom:0;">
                        <label class="adm-label" for="image">
                            {{ $realisation->exists && $realisation->image ? 'Changer la photo' : 'Choisir une photo' }}
                        </label>
                        <input type="file" id="image" name="image" class="adm-input" accept="image/*"
                               style="padding:8px;" onchange="previewImage(this)">
                        <div class="adm-help">JPEG, PNG, WebP — Max 3 Mo</div>
                        @error('image') <div class="adm-error">{{ $message }}</div> @enderror
                    </div>

                </div>
            </div>
        </div>
    </div>

</form>

@endsection

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('img-preview');
    const placeholder = document.getElementById('img-placeholder');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            if (placeholder) placeholder.style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
