@extends('admin.layouts.app')

@section('title', $actualite->exists ? 'Modifier la publication' : 'Nouvelle publication')
@section('page-title', $actualite->exists ? 'Modifier la publication' : 'Nouvelle publication')
@section('breadcrumb', 'Admin / Publications / ' . ($actualite->exists ? 'Modifier' : 'Créer'))

@section('topbar-actions')
    <a href="{{ route('admin.actualites.index') }}" class="adm-btn adm-btn-outline">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
@endsection

@section('content')

<form method="POST"
      action="{{ $actualite->exists ? route('admin.actualites.update', $actualite) : route('admin.actualites.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($actualite->exists) @method('PUT') @endif

    <div style="display:grid; grid-template-columns:1fr 340px; gap:20px; align-items:start;">

        {{-- Left column : main content --}}
        <div>
            <div class="adm-card" style="margin-bottom:20px;">
                <div class="adm-card__header">
                    <span class="adm-card__title">📝 Contenu de la publication</span>
                </div>
                <div class="adm-card__body">

                    <div class="adm-form-group">
                        <label class="adm-label" for="titre">Titre <span>*</span></label>
                        <input type="text" id="titre" name="titre" class="adm-input"
                               value="{{ old('titre', $actualite->titre) }}"
                               placeholder="Ex : Lancement de notre nouveau catalogue…" required>
                        @error('titre') <div class="adm-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="adm-form-group">
                        <label class="adm-label" for="extrait">Extrait / Résumé <span>*</span></label>
                        <textarea id="extrait" name="extrait" class="adm-textarea" rows="3"
                                  maxlength="500"
                                  placeholder="Courte description affichée sur la page d'accueil…" required>{{ old('extrait', $actualite->extrait) }}</textarea>
                        <div class="adm-help">Maximum 500 caractères. Affiché sur la page d'accueil.</div>
                        @error('extrait') <div class="adm-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="adm-form-group">
                        <label class="adm-label" for="contenu">Contenu complet <span>*</span></label>
                        <textarea id="contenu" name="contenu" class="adm-textarea" rows="12"
                                  placeholder="Rédigez ici le contenu complet de votre article…" required>{{ old('contenu', $actualite->contenu) }}</textarea>
                        <div class="adm-help">Vous pouvez utiliser des balises HTML basiques (&lt;p&gt;, &lt;strong&gt;, &lt;ul&gt;, &lt;h3&gt;…)</div>
                        @error('contenu') <div class="adm-error">{{ $message }}</div> @enderror
                    </div>

                </div>
            </div>
        </div>

        {{-- Right column : settings & image --}}
        <div>
            <div class="adm-card" style="margin-bottom:16px;">
                <div class="adm-card__header">
                    <span class="adm-card__title">⚙️ Paramètres</span>
                </div>
                <div class="adm-card__body">

                    <div class="adm-form-group">
                        <label class="adm-label" for="date_publication">Date de publication <span>*</span></label>
                        <input type="date" id="date_publication" name="date_publication" class="adm-input"
                               value="{{ old('date_publication', $actualite->date_publication?->format('Y-m-d') ?? date('Y-m-d')) }}" required>
                        @error('date_publication') <div class="adm-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="adm-form-group">
                        <label class="adm-label" for="ordre">Ordre d'affichage</label>
                        <input type="number" id="ordre" name="ordre" class="adm-input" min="0"
                               value="{{ old('ordre', $actualite->ordre ?? 0) }}" placeholder="0">
                        <div class="adm-help">0 = plus récent en premier</div>
                    </div>

                    <div class="adm-form-group">
                        <label class="adm-toggle" for="publie">
                            <input type="checkbox" id="publie" name="publie" value="1"
                                   {{ old('publie', $actualite->publie) ? 'checked' : '' }}>
                            <span>Publier sur le site</span>
                        </label>
                        <div class="adm-help" style="margin-top:6px;">Si décoché, la publication reste en brouillon.</div>
                    </div>

                    <div style="display:flex; gap:10px; margin-top:4px;">
                        <button type="submit" class="adm-btn adm-btn-primary" style="flex:1; justify-content:center;">
                            <i class="fas fa-save"></i>
                            {{ $actualite->exists ? 'Enregistrer' : 'Publier' }}
                        </button>
                    </div>

                </div>
            </div>

            <div class="adm-card">
                <div class="adm-card__header">
                    <span class="adm-card__title">🖼️ Image de couverture</span>
                </div>
                <div class="adm-card__body">

                    {{-- Current image preview --}}
                    @if($actualite->exists && $actualite->image)
                        <img id="img-preview"
                             src="{{ Str::startsWith($actualite->image, 'assets/') ? asset($actualite->image) : Storage::url($actualite->image) }}"
                             alt="Aperçu" class="adm-img-preview">
                    @else
                        <div class="adm-img-placeholder" id="img-placeholder">
                            <span><i class="fas fa-image" style="display:block; font-size:24px; margin-bottom:6px;"></i> Aucune image</span>
                        </div>
                        <img id="img-preview" class="adm-img-preview" style="display:none;" alt="Aperçu">
                    @endif

                    <div class="adm-form-group" style="margin-top:14px; margin-bottom:0;">
                        <label class="adm-label" for="image">
                            {{ $actualite->exists && $actualite->image ? 'Changer l\'image' : 'Choisir une image' }}
                        </label>
                        <input type="file" id="image" name="image" class="adm-input" accept="image/*"
                               style="padding:8px;" onchange="previewImage(this)">
                        <div class="adm-help">JPEG, PNG, WebP — Max 2 Mo</div>
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
