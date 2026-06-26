# Guide d'Utilisation - Gestion Dynamique des Témoignages

## Vue d'ensemble
Le système de témoignages a été complètement refactorisé pour permettre la publication de témoignages dynamiques en **texte**, **image** ou **vidéo**.

## Fonctionnalités

### 1. Types de témoignages supportés

#### 📝 **Texte uniquement**
- Simple citation/témoignage en texte
- Affichage avec le nom, rôle et localisation

#### 🖼️ **Image avec texte**
- Image de la personne ou du projet (jusqu'à 50 MB)
- Formats: JPEG, PNG, WebP
- Affichage en taille 140x140px

#### 🎬 **Vidéo avec texte**
- Vidéo de témoignage (jusqu'à 50 MB)
- Formats: MP4, MOV, AVI, MKV
- Lecteur vidéo intégré avec contrôles

### 2. Informations capturées pour chaque témoignage

| Champ | Type | Description |
|-------|------|-------------|
| Nom complet | Texte | Nom de la personne qui témoigne |
| Rôle/Titre | Texte | Ex: "Maraîcher professionnel", "Présidente de coopérative" |
| Localisation | Texte | Lieu/Zone géographique (ex: "Mopti") |
| Type | Select | text / image / video |
| Contenu | Texte long | Le témoignage/citation |
| Média | Fichier | Image ou vidéo (optionnel selon type) |
| Situation avant | Texte | Contexte avant intervention (optionnel) |
| Situation après | Texte | Résultats obtenus (optionnel) |
| Ordre d'affichage | Nombre | 0 = première position |
| Publié | Booléen | Active/Inactive la publication sur le site |

## Comment publier un témoignage

### Accès à l'interface d'administration

1. Allez à `/admin/temoignages`
2. Connectez-vous avec vos identifiants d'administrateur
3. Cliquez sur "Nouveau témoignage"

### Créer un nouveau témoignage

1. **Informations du client**
   - Saisissez le nom complet (ex: "Amadou Diallo")
   - Le rôle/titre professionnel
   - La localisation

2. **Type & Contenu**
   - Choisissez le type: Texte, Image ou Vidéo
   - Rédigez le contenu du témoignage (citation, expérience, résultats)
   - Si Image/Vidéo sélectionné, uploadez le fichier média

3. **Avant/Après** (optionnel)
   - Situation avant: contexte initial
   - Situation après: résultats/amélioration

4. **Paramètres**
   - Ordre d'affichage (0 = priorité)
   - Cochez "Publier sur le site" pour activer
   - Cliquez "Créer"

### Modifier un témoignage

1. Cliquez l'icône ✏️ à côté du témoignage
2. Modifiez les informations
3. Pour changer le média, uploadez un nouveau fichier
4. Cliquez "Enregistrer"

### Changer le statut de publication

1. Sur la liste, cliquez le bouton de statut (✅ ou ❌)
2. Le témoignage apparaît/disparaît du site

### Supprimer un témoignage

1. Cliquez l'icône 🗑️ de suppression
2. Confirmez la suppression
3. Le fichier média est automatiquement supprimé

## Affichage public

### Page des témoignages (`/temoignages`)

La page affiche tous les témoignages publiés avec:
- La photo/vidéo (si applicable)
- Le nom, rôle et localisation
- Le type (badge 📝/🖼️/🎬)
- La citation complète
- La section avant/après (si remplie)

### Apparence selon le type

**Type Texte:**
- Avatar circulaire avec le logo par défaut
- Nom + localisation
- Citation centrée

**Type Image:**
- Photo en 140x140px avec bordure verte
- Badge "🖼️ Photo"
- Nom + localisation sous la photo

**Type Vidéo:**
- Lecteur vidéo responsive
- Badge "🎬 Vidéo"
- Nom + localisation sous la vidéo

## Filtrage et recherche

Sur la page d'administration (`/admin/temoignages`):
- Recherchez par nom, rôle ou localisation
- Filtrez par type (Texte, Image, Vidéo)
- Filtrez par statut (Publié, Brouillon)

## Base de données

### Table: `temoignages`

```sql
- id (PK)
- nom_client (string)
- role (string)
- localisation (string)
- type (enum: text, image, video)
- contenu (text) - le témoignage
- media (string) - chemin vers l'image/vidéo
- avant (text) - nullable
- apres (text) - nullable
- publie (boolean)
- ordre (integer)
- timestamps
```

## Stockage des fichiers

- **Images:** `/storage/temoignages/images/`
- **Vidéos:** `/storage/temoignages/videos/`

Les fichiers sont automatically supprimés lors de la suppression du témoignage.

## Limitations

- Taille maximale: 50 MB par fichier
- Formats image: JPEG, PNG, WebP
- Formats vidéo: MP4, MOV, AVI, MKV
- Maximum 500 caractères pour "Avant" et "Après"

## Points techniques

- **Modèle:** `App\Models\Temoignage`
- **Contrôleur:** `App\Http\Controllers\Admin\TemoignageController`
- **Routes:** `/admin/temoignages/*`
- **Scopes disponibles:**
  - `->publie()` - Récupère seulement les publiés
  - `->ordre()` - Trie par ordre d'affichage

## Exemples de cas d'usage

### 1. Témoignage simple (texte)
- Titre: "Maraîcher professionnel"
- Type: Texte
- Contenu: "Les solutions de Djibo Services ont transformé mes rendements..."

### 2. Témoignage avec photo
- Titre: "Présidente de coopérative"
- Type: Image
- Média: Photo de la personne
- Avant/Après: Statistiques de rendement

### 3. Témoignage vidéo
- Titre: "Entrepreneur agricole"
- Type: Vidéo
- Média: Clip vidéo de la personne témoignant
- Contenu: Transcription ou résumé

## Support et aide

Pour toute question sur:
- La création de témoignages: Consultez ce guide
- Les erreurs d'upload: Vérifiez le type et la taille du fichier
- L'affichage public: Vérifiez que le statut "Publié" est coché
