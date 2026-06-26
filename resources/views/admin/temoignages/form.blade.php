@extends('admin.layouts.app')

@section('title', $temoignage->exists ? 'Modifier le témoignage' : 'Nouveau témoignage')
@section('page-title', $temoignage->exists ? 'Modifier le témoignage' : 'Nouveau témoignage')
@section('breadcrumb', 'Admin / Témoignages / ' . ($temoignage->exists ? 'Modifier' : 'Créer'))

@section('topbar-actions')
    <a href="{{ route('admin.temoignages.index') }}" class="adm-btn adm-btn-outline">
        <i class="fas fa-arrow-left"></i> Retour
    </a>
@endsection

@section('content')

<form method="POST"
      action="{{ $temoignage->exists ? route('admin.temoignages.update', $temoignage) : route('admin.temoignages.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($temoignage->exists) @method('PUT') @endif

    <!-- Modification ici : Remplacement du style en ligne par la classe adm-grid-layout -->
    <div class="adm-grid-layout">

        {{-- Left column : main content --}}
        <div>
            <div class="adm-card" style="margin-bottom:20px;">
                <div class="adm-card__header">
                    <span class="adm-card__title">👤 Informations du client</span>
                </div>
                <div class="adm-card__body">

                    <div class="adm-form-group">
                        <label class="adm-label" for="nom_client">Nom complet <span>*</span></label>
                        <input type="text" id="nom_client" name="nom_client" class="adm-input"
                               value="{{ old('nom_client', $temoignage->nom_client) }}"
                               placeholder="Ex : Amadou Diallo" required>
                        @error('nom_client') <div class="adm-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="adm-form-group">
                        <label class="adm-label" for="role">Rôle / Titre professionnel <span>*</span></label>
                        <input type="text" id="role" name="role" class="adm-input"
                               value="{{ old('role', $temoignage->role) }}"
                               placeholder="Ex : Maraîcher professionnel" required>
                        @error('role') <div class="adm-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="adm-form-group">
                        <label class="adm-label" for="localisation">Localisation <span>*</span></label>
                        <input type="text" id="localisation" name="localisation" class="adm-input"
                               value="{{ old('localisation', $temoignage->localisation) }}"
                               placeholder="Ex : Mopti" required>
                        @error('localisation') <div class="adm-error">{{ $message }}</div> @enderror
                    </div>

                </div>
            </div>

            <div class="adm-card" style="margin-bottom:20px;">
                <div class="adm-card__header">
                    <span class="adm-card__title">📣 Type & Contenu du témoignage</span>
                </div>
                <div class="adm-card__body">

                    <div class="adm-form-group">
                        <label class="adm-label" for="type">Type de témoignage <span>*</span></label>
                        <select id="type" name="type" class="adm-input" required onchange="updateMediaLabel()">
                            <option value="">-- Choisir un type --</option>
                            <option value="text" {{ old('type', $temoignage->type) === 'text' ? 'selected' : '' }}>📝 Texte uniquement</option>
                            <option value="image" {{ old('type', $temoignage->type) === 'image' ? 'selected' : '' }}>🖼️ Image avec texte</option>
                            <option value="video" {{ old('type', $temoignage->type) === 'video' ? 'selected' : '' }}>🎬 Vidéo avec texte</option>
                        </select>
                        @error('type') <div class="adm-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="adm-form-group">
                        <label class="adm-label" for="contenu">Contenu du témoignage <span>*</span></label>
                        <textarea id="contenu" name="contenu" class="adm-textarea" rows="8"
                                  placeholder="Rédigez le témoignage du client (citation, expérience, résultats, etc.)…" required>{{ old('contenu', $temoignage->contenu) }}</textarea>
                        <div class="adm-help">Soyez spécifique et mettez en avant les résultats concrets.</div>
                        @error('contenu') <div class="adm-error">{{ $message }}</div> @enderror
                    </div>

                    <div class="adm-form-group" id="mediaGroup" style="{{ old('type', $temoignage->type) === 'text' ? 'display:none;' : '' }}">
                        <label class="adm-label" for="media" id="mediaLabel">Fichier (image ou vidéo)</label>
                        <div class="adm-file-input" id="fileInputContainer" onclick="document.getElementById('media').click()">
                            <input type="file" id="media" name="media" accept="image/jpeg,image/png,image/webp,video/mp4,video/quicktime,video/x-msvideo,video/x-matroska" onchange="previewMedia()" style="display:none;">
                            <div class="adm-file-input__placeholder">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span>Cliquez pour choisir un fichier ou glissez-le ici</span>
                            </div>
                        </div>
                        <div class="adm-help">
                            <strong>Images :</strong> JPEG, PNG, WebP (max 50 MB)<br>
                            <strong>Vidéos :</strong> MP4, MOV, AVI, MKV (max 50 MB)
                        </div>
                        @if($temoignage->exists && $temoignage->media)
                            <div style="margin-top:10px; padding:10px; background:#f0f4f1; border-radius:6px;">
                                <strong>Fichier actuel :</strong>
                                @if($temoignage->type === 'image')
                                    <div style="margin-top:8px;">
                                        <img src="{{ $temoignage->media_url }}" alt="Prévisualisation" style="max-width:100%; height:auto; border-radius:4px; max-height:200px;">
                                    </div>
                                @elseif($temoignage->type === 'video')
                                    <div style="margin-top:8px;">
                                        <video controls style="max-width:100%; height:auto; border-radius:4px; max-height:200px;">
                                            <source src="{{ $temoignage->media_url }}" type="video/mp4">
                                            Votre navigateur ne supporte pas la vidéo.
                                        </video>
                                    </div>
                                @endif
                                <small style="display:block; margin-top:6px; color:#666;">
                                    Laissez vide pour conserver le fichier actuel, ou choisissez un nouveau fichier pour le remplacer.
                                </small>
                            </div>
                        @endif
                        @error('media') <div class="adm-error">{{ $message }}</div> @enderror
                    </div>

                </div>
            </div>

            <div class="adm-card" style="margin-bottom:20px;">
                <div class="adm-card__header">
                    <span class="adm-card__title">📊 Avant/Après (optionnel)</span>
                </div>
                <div class="adm-card__body">

                    <div class="adm-form-group">
                        <label class="adm-label" for="avant">Situation avant</label>
                        <textarea id="avant" name="avant" class="adm-textarea" rows="3"
                                  placeholder="Ex : Terre compacte, rendement de 8 tonnes/ha…" maxlength="500">{{ old('avant', $temoignage->avant) }}</textarea>
                        <div class="adm-help">Maximum 500 caractères</div>
                    </div>

                    <div class="adm-form-group">
                        <label class="adm-label" for="apres">Situation après</label>
                        <textarea id="apres" name="apres" class="adm-textarea" rows="3"
                                  placeholder="Ex : Terre riche et meuble, rendement de 14.5 tonnes/ha…" maxlength="500">{{ old('apres', $temoignage->apres) }}</textarea>
                        <div class="adm-help">Maximum 500 caractères</div>
                    </div>

                </div>
            </div>

        </div>

        {{-- Right column : settings --}}
        <div>
            <div class="adm-card">
                <div class="adm-card__header">
                    <span class="adm-card__title">⚙️ Paramètres</span>
                </div>
                <div class="adm-card__body">

                    <div class="adm-form-group">
                        <label class="adm-label" for="ordre">Ordre d'affichage</label>
                        <input type="number" id="ordre" name="ordre" class="adm-input" min="0"
                               value="{{ old('ordre', $temoignage->ordre ?? 0) }}" placeholder="0">
                        <div class="adm-help">0 = premier en priorité</div>
                    </div>

                    <div class="adm-form-group">
                        <label class="adm-toggle" for="publie">
                            <input type="checkbox" id="publie" name="publie" value="1"
                                   {{ old('publie', $temoignage->publie) ? 'checked' : '' }}>
                            <span>Publier sur le site</span>
                        </label>
                        <div class="adm-help" style="margin-top:6px;">Si décoché, le témoignage reste en brouillon.</div>
                    </div>

                    <div style="display:flex; gap:10px; margin-top:16px;">
                        <button type="submit" class="adm-btn adm-btn-primary" style="flex:1; justify-content:center;">
                            <i class="fas fa-save"></i>
                            {{ $temoignage->exists ? 'Enregistrer' : 'Créer' }}
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>

</form>

<style>
    /* --- AJOUT POUR LA RESPONSIVITÉ --- */
    .adm-grid-layout {
        display: grid;
        grid-template-columns: 1fr; /* 1 colonne par défaut sur mobile */
        gap: 20px;
        align-items: start;
    }

    /* Écrans de taille moyenne et grande (Tablettes paysage et ordinateurs) */
    @media (min-width: 992px) {
        .adm-grid-layout {
            grid-template-columns: 1fr 340px; /* Retour aux 2 colonnes initiales */
        }
    }
    
    /* Ajustements mineurs de confort pour les petits écrans */
    @media (max-width: 576px) {
        .adm-card__body {
            padding: 15px;
        }
        .adm-file-input {
            padding: 25px 15px;
        }
    }
    /* ---------------------------------- */

    .adm-form-group {
        margin-bottom: 20px;
    }

    .adm-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
        font-size: 14px;
    }

    .adm-label span {
        color: #dc3545;
    }

    .adm-input,
    .adm-textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #d4dfd5;
        border-radius: 6px;
        font-size: 14px;
        font-family: inherit;
        color: #333;
        box-sizing: border-box; /* Évite les débordements d'inputs */
    }

    .adm-input:focus,
    .adm-textarea:focus {
        outline: none;
        border-color: #2E7D32;
        box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
    }

    .adm-textarea {
        resize: vertical;
    }

    .adm-help {
        font-size: 12px;
        color: #7a9a7d;
        margin-top: 4px;
    }

    .adm-error {
        color: #dc3545;
        font-size: 12px;
        margin-top: 4px;
    }

    .adm-toggle {
        display: flex;
        align-items: center;
        cursor: pointer;
        user-select: none;
    }

    .adm-toggle input[type="checkbox"] {
        width: 18px;
        height: 18px;
        margin-right: 8px;
        cursor: pointer;
        accent-color: #2E7D32;
    }

    .adm-toggle span {
        font-weight: 500;
        color: #333;
    }

    .adm-file-input {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        border: 2px dashed #d4dfd5;
        border-radius: 6px;
        background: #f9fafb;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .adm-file-input:hover {
        border-color: #2E7D32;
        background: #f0f4f1;
    }

    .adm-file-input.drag-over {
        border-color: #2E7D32;
        background: #e8f5e9;
        box-shadow: 0 0 0 3px rgba(46, 125, 50, 0.1);
    }

    .adm-file-input input[type="file"] {
        display: none;
    }

    .adm-file-input__placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        color: #7a9a7d;
        pointer-events: none;
        text-align: center;
    }

    .adm-file-input__placeholder i {
        font-size: 32px;
        margin-bottom: 10px;
    }

    .adm-btn {
        padding: 10px 20px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .adm-btn-primary {
        background: #2E7D32;
        color: white;
    }

    .adm-btn-primary:hover {
        background: #1b5e20;
    }

    .adm-btn-outline {
        background: transparent;
        color: #2E7D32;
        border: 1.5px solid #2E7D32;
    }

    .adm-btn-outline:hover {
        background: #f0f4f1;
    }

    .adm-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .adm-card__header {
        padding: 16px 20px;
        border-bottom: 1px solid #eee;
        background: #f9fafb;
    }

    .adm-card__title {
        font-size: 14px;
        font-weight: 600;
        color: #333;
    }

    .adm-card__body {
        padding: 20px;
    }
</style>

<script>
    // Initialiser les gestionnaires de drag-drop
    const fileInputContainer = document.getElementById('fileInputContainer');
    const fileInput = document.getElementById('media');

    if (fileInputContainer && fileInput) {
        // Drag and drop events
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            fileInputContainer.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            fileInputContainer.addEventListener(eventName, () => {
                fileInputContainer.classList.add('drag-over');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            fileInputContainer.addEventListener(eventName, () => {
                fileInputContainer.classList.remove('drag-over');
            }, false);
        });

        fileInputContainer.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            if (files && files.length > 0) {
                fileInput.files = files;
                previewMedia();
            }
        }
    }

    function updateMediaLabel() {
        const typeSelect = document.getElementById('type');
        const mediaGroup = document.getElementById('mediaGroup');
        const mediaLabel = document.getElementById('mediaLabel');
        const fileInput = document.getElementById('media');
        const type = typeSelect.value;

        if (type === 'text') {
            mediaGroup.style.display = 'none';
            fileInput.required = false;
        } else {
            mediaGroup.style.display = 'block';
            fileInput.required = true;
            // Mettre à jour l'accept selon le type
            if (type === 'image') {
                mediaLabel.textContent = '🖼️ Choisir une image';
                fileInput.accept = 'image/jpeg,image/png,image/webp';
            } else if (type === 'video') {
                mediaLabel.textContent = '🎬 Choisir une vidéo';
                fileInput.accept = 'video/mp4,video/quicktime,video/x-msvideo,video/x-matroska';
            }
        }
    }

    function previewMedia() {
        const file = document.getElementById('media').files[0];
        if (!file) return;

        // Vérifier la taille du fichier (max 50 MB)
        const maxSize = 50 * 1024 * 1024; // 50 MB
        if (file.size > maxSize) {
            alert('⚠️ Le fichier est trop volumineux. Taille max: 50 MB');
            document.getElementById('media').value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            const fileSizeMB = (file.size / 1024 / 1024).toFixed(2);
            console.log('✅ Fichier sélectionné: ' + file.name + ' (' + fileSizeMB + ' MB)');
        };
        reader.readAsDataURL(file);
    }

    // Initialiser au chargement
    document.addEventListener('DOMContentLoaded', function() {
        updateMediaLabel();
    });
</script>

@endsection