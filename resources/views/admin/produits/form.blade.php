@extends('admin.layouts.app')

@section('title', $produit->exists ? 'Modifier le produit' : 'Nouveau produit')
@section('page-title', $produit->exists ? 'Modifier le produit' : 'Nouveau produit')
@section('breadcrumb', 'Admin / Produits / ' . ($produit->exists ? 'Modifier' : 'Créer'))

@section('topbar-actions')
    <a href="{{ route('admin.produits.index') }}" class="adm-btn adm-btn-outline">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
@endsection

@section('content')

<style>
    /* Layout responsive pour le formulaire produit */
    .adm-form-layout {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 20px;
        align-items: start;
    }

    .adm-form-left {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .adm-form-right {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    /* Flex row pour nom + catégorie */
    .adm-form-row {
        display: flex;
        gap: 16px;
    }

    .adm-form-row .adm-form-group {
        flex: 1;
    }

    .adm-form-row .adm-form-group:first-child {
        flex: 2;
    }

    /* Textareas */
    .adm-textarea {
        min-height: 80px;
        line-height: 1.6;
        resize: vertical;
    }

    .adm-textarea[rows="6"] {
        min-height: 200px;
    }

    .adm-textarea[rows="4"] {
        min-height: 150px;
    }

    /* Bouton submit */
    .adm-btn-submit {
        width: 100%;
        justify-content: center;
    }

    /* Responsive breakpoints */
    @media (max-width: 1200px) {
        .adm-form-layout {
            grid-template-columns: 1fr 320px;
            gap: 16px;
        }
    }

    @media (max-width: 1024px) {
        .adm-form-layout {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .adm-form-right {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .adm-form-row {
            gap: 12px;
        }

        .adm-textarea {
            min-height: 100px;
        }

        .adm-textarea[rows="6"] {
            min-height: 180px;
        }
    }

    @media (max-width: 768px) {
        .adm-form-layout {
            gap: 16px;
        }

        .adm-form-right {
            grid-template-columns: 1fr;
        }

        .adm-form-row {
            flex-direction: column;
            gap: 16px;
        }

        .adm-form-row .adm-form-group {
            flex: none;
        }

        .adm-textarea {
            min-height: 80px;
        }

        .adm-textarea[rows="6"] {
            min-height: 150px;
        }

        .adm-card__header {
            padding: 14px 18px;
        }

        .adm-card__title {
            font-size: 14px;
        }

        .adm-form-group {
            margin-bottom: 16px;
        }
    }

    @media (max-width: 480px) {
        .adm-form-layout {
            gap: 12px;
        }

        .adm-card__body {
            padding: 16px;
        }

        .adm-card__header {
            padding: 12px 16px;
        }

        .adm-label {
            font-size: 12px;
        }

        .adm-input,
        .adm-textarea {
            font-size: 13px;
            padding: 8px 12px;
        }

        .adm-textarea {
            min-height: 70px;
        }

        .adm-textarea[rows="6"] {
            min-height: 120px;
        }

        .adm-textarea[rows="4"] {
            min-height: 100px;
        }

        .adm-help {
            font-size: 11px;
        }

        .adm-btn {
            font-size: 12px;
            padding: 8px 14px;
        }

        .adm-form-group {
            margin-bottom: 14px;
        }

        .adm-img-preview,
        .adm-img-placeholder {
            max-height: 160px;
        }
    }
</style>

<form method="POST"
      action="{{ $produit->exists ? route('admin.produits.update', $produit) : route('admin.produits.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($produit->exists) @method('PUT') @endif

    <div class="adm-form-layout">

        {{-- Left column : main content --}}
        <div class="adm-form-left">
            <div class="adm-card">
                <div class="adm-card__header">
                    <span class="adm-card__title">📦 Informations du produit</span>
                </div>
                <div class="adm-card__body">

                    <div class="adm-form-row">
                        <div class="adm-form-group">
                            <label class="adm-label" for="nom">Nom du produit <span>*</span></label>
                            <input type="text" id="nom" name="nom" class="adm-input"
                                   value="{{ old('nom', $produit->nom) }}" required>
                            @error('nom') <div class="adm-error">{{ $message }}</div> @enderror
                        </div>
                        <div class="adm-form-group">
                            <label class="adm-label" for="categorie">Catégorie <span>*</span></label>
                            <input type="text" id="categorie" name="categorie" class="adm-input"
                                   value="{{ old('categorie', $produit->categorie) }}" required>
                            @error('categorie') <div class="adm-error">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="adm-form-group">
                        <label class="adm-label" for="description_courte">Description courte <span>*</span></label>
                        <textarea id="description_courte" name="description_courte" class="adm-textarea" rows="2" maxlength="500" required>{{ old('description_courte', $produit->description_courte) }}</textarea>
                        @error('description_courte') <div class="adm-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="adm-form-group">
                        <label class="adm-label" for="description">Description détaillée <span>*</span></label>
                        <textarea id="description" name="description" class="adm-textarea" rows="6" required>{{ old('description', $produit->description) }}</textarea>
                        @error('description') <div class="adm-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="adm-form-group">
                        <label class="adm-label" for="avantages">Avantages clés (un par ligne)</label>
                        <textarea id="avantages" name="avantages" class="adm-textarea" rows="4">{{ old('avantages', is_array($produit->avantages) ? implode("\n", $produit->avantages) : $produit->avantages) }}</textarea>
                        <div class="adm-help">Séparez chaque avantage par un saut de ligne (Entrée).</div>
                        @error('avantages') <div class="adm-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="adm-form-group">
                        <label class="adm-label" for="mode_emploi">Mode d'emploi</label>
                        <textarea id="mode_emploi" name="mode_emploi" class="adm-textarea" rows="3">{{ old('mode_emploi', $produit->mode_emploi) }}</textarea>
                        @error('mode_emploi') <div class="adm-error">{{ $message }}</div> @enderror
                    </div>

                </div>
            </div>
        </div>

        {{-- Right column : settings & image --}}
        <div class="adm-form-right">
            <div class="adm-card">
                <div class="adm-card__header">
                    <span class="adm-card__title">⚙️ Paramètres</span>
                </div>
                <div class="adm-card__body">

                    <div class="adm-form-group">
                        <label class="adm-label" for="prix">Prix</label>
                        <input type="text" id="prix" name="prix" class="adm-input"
                               value="{{ old('prix', $produit->prix) }}" placeholder="Ex: 5000 FCFA">
                        @error('prix') <div class="adm-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="adm-form-group">
                        <label class="adm-label" for="ordre">Ordre d'affichage</label>
                        <input type="number" id="ordre" name="ordre" class="adm-input" min="0"
                               value="{{ old('ordre', $produit->ordre ?? 0) }}" placeholder="0">
                    </div>

                    <div class="adm-form-group">
                        <label class="adm-toggle" for="en_vedette">
                            <input type="checkbox" id="en_vedette" name="en_vedette" value="1"
                                   {{ old('en_vedette', $produit->en_vedette) ? 'checked' : '' }}>
                            <span>Produit en vedette</span>
                        </label>
                        <div class="adm-help" style="margin-top:6px; margin-left:28px;">Sera mis en avant sur la page d'accueil.</div>
                    </div>

                    <div class="adm-form-group" style="margin-bottom:10px;">
                        <label class="adm-toggle" for="actif">
                            <input type="checkbox" id="actif" name="actif" value="1"
                                   {{ old('actif', $produit->exists ? $produit->actif : true) ? 'checked' : '' }}>
                            <span>Produit actif (visible)</span>
                        </label>
                    </div>

                    <div style="display:flex; gap:10px; margin-top:10px;">
                        <button type="submit" class="adm-btn adm-btn-primary adm-btn-submit">
                            <i class="fas fa-save"></i>
                            <span>{{ $produit->exists ? 'Enregistrer' : 'Créer le produit' }}</span>
                        </button>
                    </div>

                </div>
            </div>

            <div class="adm-card">
                <div class="adm-card__header">
                    <span class="adm-card__title">🖼️ Image du produit</span>
                </div>
                <div class="adm-card__body">

                    {{-- Current image preview --}}
                    @if($produit->exists && $produit->image)
                        <img id="img-preview"
                             src="{{ Str::startsWith($produit->image, 'assets/') ? asset($produit->image) : Storage::url($produit->image) }}"
                             alt="Aperçu" class="adm-img-preview" style="object-fit:contain; background:#fff;">
                    @else
                        <div class="adm-img-placeholder" id="img-placeholder">
                            <span><i class="fas fa-box" style="display:block; font-size:24px; margin-bottom:6px;"></i> Aucune image</span>
                        </div>
                        <img id="img-preview" class="adm-img-preview" style="display:none; object-fit:contain; background:#fff;" alt="Aperçu">
                    @endif

                    <div class="adm-form-group" style="margin-top:14px; margin-bottom:0;">
                        <label class="adm-label" for="image">
                            {{ $produit->exists && $produit->image ? 'Changer l\'image' : 'Choisir une image' }}
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