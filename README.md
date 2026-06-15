# 🌿 Djibo Service — Site Web Corporate

Site web corporate de **DJIBO SERVICES**, entreprise malienne spécialisée dans les biofertilisants, biopesticides et l'accompagnement agricole durable.

---

## 🚀 Stack Technique

| Couche | Technologie |
|--------|-------------|
| Backend | Laravel (PHP) |
| Frontend | Blade Templates |
| CSS | Vanilla CSS (design system centralisé) |
| Build | Vite |
| Icônes | Font Awesome |
| Animations | Animate.css + WOW.js |

---

## 📁 Structure du Projet

```
resources/views/
├── layouts/
│   └── app.blade.php          # Layout principal + Design System CSS (:root variables)
├── partials/
│   ├── header.blade.php       # Navbar + logo SVG + menu mobile
│   └── footer.blade.php       # Footer + liens + horaires
├── pages/
│   ├── about.blade.php        # À Propos, Histoire, Équipe, Valeurs
│   ├── products.blade.php     # Catalogue produits (activateur bio + autres intrants)
│   ├── services.blade.php     # Services agricoles (formation, appui, suivi)
│   ├── realisations.blade.php # Projets et statistiques d'impact
│   ├── testimonials.blade.php # Témoignages clients + partenaires
│   ├── distributors.blade.php # Réseau de distributeurs agréés
│   └── contact.blade.php      # Formulaire de contact + carte
└── home.blade.php             # Page d'accueil (hero, stats, services, produits, témoignages)

app/Http/Controllers/
├── PageController.php         # Contrôleur public (fetch depuis la BDD)
└── Admin/
    ├── AuthController.php     # Authentification administrateur
    ├── DashboardController.php# Tableau de bord et statistiques
    ├── ActualiteController.php# CRUD complet des actualités
    └── ProduitController.php  # CRUD complet des produits

routes/
└── web.php                    # Routes GET/POST publiques + Routes Admin (protégées)
```

---

## 🎨 Palette Nature — Design System

Toutes les couleurs sont centralisées dans les **variables CSS** (`:root`) de `layouts/app.blade.php`. Aucune couleur n'est hardcodée dans les vues.

### Couleurs Principales

| Variable | Hex | Utilisation |
|----------|-----|-------------|
| `--vert` | `#2E7D32` | Logo, boutons principaux, titres |
| `--vert-dark` | `#1B5E20` | Navbar, footer, dégradés profonds |
| `--vert-clair` | `#66BB6A` | Icônes, cartes de services, checkmarks |
| `--vert-light-bg` | `#E8F5E9` | Arrière-plans doux, encadrés |

### Couleurs Secondaires

| Variable | Hex | Utilisation |
|----------|-----|-------------|
| `--brun-terre` | `#8D6E63` | Sections compost, fertilité des sols |
| `--jaune-agri` | `#F9A825` | Statistiques, chiffres clés, boutons d'action |
| `--bleu-confiance` | `#1565C0` | Liens, éléments institutionnels, formations |

### Couleurs Neutres

| Variable | Hex | Utilisation |
|----------|-----|-------------|
| `--blanc` | `#FFFFFF` | Fonds de cartes, formulaires |
| `--gris-fonce` | `#263238` | Texte principal |
| `--gris-clair` | `#F5F7F8` | Fonds de sections |
| `--bordure` | `#E0E4E6` | Séparateurs et bordures |

---

## 📐 Conventions de Mise en Page

### Breadcrumbs (toutes les pages intérieures)
```css
background-image: linear-gradient(135deg, var(--vert-dark), var(--vert));
```
- Titre `<h1>` : blanc
- Sous-titre : `color: var(--jaune-agri)` + `font-weight: 700`

### Labels de Section (`<h6>`)
```css
color: var(--vert); letter-spacing: 1px; font-weight: 700;
```

### Boutons
| Classe | Style |
|--------|-------|
| `.btn-dj-primary` | Fond `var(--vert)`, texte blanc |
| `.btn-dj-orange` | Fond `var(--jaune-agri)`, texte sombre |
| `.btn-dj-outline` | Transparent, bordure `var(--vert)` |

---

## 🗺️ Pages & Routes

| URL | Nom | Vue |
|-----|-----|-----|
| `/` | `home` | `home.blade.php` |
| `/apropos` | `about` | `pages/about.blade.php` |
| `/produits` | `products` | `pages/products.blade.php` |
| `/services` | `services` | `pages/services.blade.php` |
| `/realisations` | `realisations` | `pages/realisations.blade.php` |
| `/temoignages` | `testimonials` | `pages/testimonials.blade.php` |
| `/distributeurs` | `distributors` | `pages/distributors.blade.php` |
| `/contact` | `contact` | `pages/contact.blade.php` |
| `POST /contact` | `contact.submit` | — |

---

## 🔒 Espace Administration (Backoffice)

Un panneau d'administration sécurisé a été développé pour gérer dynamiquement le contenu du site public.

**Fonctionnalités :**
- **Sécurité** : Protégé par un `AdminMiddleware` (accès réservé si `is_admin = true`).
- **Tableau de bord** : Statistiques globales, raccourcis et publications récentes.
- **Gestion des Actualités** : CRUD complet, upload d'images, toggle Publier/Brouillon.
- **Gestion des Produits** : CRUD complet, attributs multiples (avantages, prix), gestion des produits "En vedette" et toggle Actif/Inactif.

**Accès par défaut (Seeder) :**
- URL : `/admin/login`
- Email : `admin@djiboservice.com`
- Mot de passe : `djibo@2026`

---

## 🔄 Changelog — Refactoring Nature Palette (Juin 2026)

Migration complète de l'ancienne "Sahel Palette" vers la nouvelle "Nature Palette".

### Fichiers Modifiés

| Fichier | Changements |
|---------|-------------|
| `layouts/app.blade.php` | Centralisation des variables CSS `:root`, refactoring navbar/footer/boutons |
| `partials/header.blade.php` | SVG logo mis à jour (`#1b5e3a` → `var(--vert)`, `#a5d6a7` → `var(--vert-clair)`) |
| `partials/footer.blade.php` | SVG logo + badge horaires mis à jour |
| `home.blade.php` | Hero gradient, stalks SVG (épi `#E65100` → `#8D6E63`), stats, cartes, témoignages |
| `pages/about.blade.php` | Breadcrumb, valeurs, équipe dirigeante |
| `pages/products.blade.php` | Breadcrumb, badge vedette (`--brun-terre`), prix (`--vert`), boutons WhatsApp |
| `pages/services.blade.php` | Couleur dynamique par type (formations → `--bleu-confiance`, autres → `--vert`) |
| `pages/realisations.blade.php` | Stats (`--jaune-agri`), badges localisation, liens (`--bleu-confiance`) |
| `pages/testimonials.blade.php` | Cartes témoignages, badges rôles (`--bleu-confiance`), avant/après (`--vert`) |
| `pages/distributors.blade.php` | Badges agréés (`--bleu-confiance`), boutons téléphone/WhatsApp |
| `pages/contact.blade.php` | Icônes de contact (`--vert-clair`) |

### Règles de Remplacement Appliquées

| Ancien | Nouveau | Contexte |
|--------|---------|----------|
| `linear-gradient(#1b5e3a, #10251e)` | `linear-gradient(var(--vert-dark), var(--vert))` | Tous les breadcrumbs |
| `text-warning` | `color: var(--jaune-agri)` | Sous-titres breadcrumb |
| `text-color-primary` / `text-success` | `color: var(--vert)` | Labels h6, titres |
| `bg-success` | `background-color: var(--vert)` ou `var(--bleu-confiance)` | Badges |
| `bg-warning` | `background-color: var(--jaune-agri)` | Badges localisation |
| `#E65100` | `#8D6E63` (Brun Terre) | Épi de mil SVG hero |
| `#a5d6a7` | `var(--vert-clair)` | Feuilles SVG logo |

---

## 🚀 Changelog — Backoffice & UI Premium (Juin 2026)

Mise à niveau majeure du site avec un panneau d'administration et une interface utilisateur repensée.

### 1. Développement du Backoffice (Laravel)
- **Base de données** : Création des migrations et modèles pour `User` (ajout de `is_admin`), `Actualite`, et `Produit`.
- **Controllers CRUD** : Implémentation des contrôleurs dans `App\Http\Controllers\Admin`.
- **Interface Admin** : Création d'un layout `admin/layouts/app.blade.php` ultra-moderne avec sidebar sombre, cards de statistiques, et data tables.
- **Liaison Frontend** : Le `PageController` récupère désormais les actualités et les produits actifs depuis la base de données au lieu d'un tableau en dur.

### 2. Refonte Premium UI/UX (Frontend)
- **Page d'Accueil** : Intégration des nouvelles "News Cards" (`dj-news-card`) avec effet de zoom au survol, date-badge et styles harmonisés.
- **Page À Propos** : Redesign complet avec un Hero majestueux, une section Histoire asymétrique, une bannière de Chiffres Clés animée, et des "Valeurs" sous forme de cartes avec effets de lévitation (`hover-lift`).
- **Page Témoignages** : Transformation des avis clients en cartes flottantes stylisées avec des encarts "Avant/Après" distincts et des badges de rôles.

---

## ⚙️ Démarrage Local

```bash
# Installer les dépendances PHP
composer install

# Copier et configurer l'environnement
cp .env.example .env
php artisan key:generate

# Lancer le serveur de développement
php artisan serve

# (Optionnel) Compiler les assets front-end
npm install && npm run dev
```

Le site sera accessible sur **http://127.0.0.1:8000**

---

## 📬 Contact

**DJIBO SERVICES**
Route de Ségou, Sébougou, Ségou, République du Mali
📞 (+223) 92 69 24 48
✉️ djiboservices@gmail.com
🌐 WhatsApp : [wa.me/22376543210](https://wa.me/22376543210)
