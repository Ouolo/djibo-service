@extends('admin.layouts.app')

@section('title', 'Publications')
@section('page-title', 'Gestion des Publications')
@section('breadcrumb', 'Admin / Publications')

@section('topbar-actions')
    <a href="{{ route('admin.actualites.create') }}" class="adm-btn adm-btn-primary">
        <i class="fas fa-plus"></i> Nouvelle publication
    </a>
@endsection

@section('content')

    <style>
        /* Search bar responsive */
        .adm-search {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .adm-search .adm-input {
            flex: 1;
            min-width: 200px;
        }

        .adm-search select.adm-input {
            min-width: 160px;
            max-width: 160px;
        }

        .adm-search .adm-btn {
            white-space: nowrap;
        }

        /* Table wrapper pour mobile */
        .adm-table-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Card actions mobile */
        .adm-card-actions {
            display: flex;
            gap: 6px;
            justify-content: flex-end;
        }

        /* Badge button fix */
        .adm-badge-btn {
            border: none;
            background: none;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .adm-badge-btn:hover {
            opacity: 0.8;
            transform: translateY(-1px);
        }

        .adm-badge-btn.published {
            background: #e8f5e9;
            color: #1b5e20;
        }

        .adm-badge-btn.draft {
            background: #fff8e1;
            color: #e65100;
        }

        /* Mobile responsive */
        @media (max-width: 1024px) {
            .adm-search {
                gap: 8px;
            }

            .adm-search .adm-input {
                min-width: 120px;
            }
        }

        @media (max-width: 768px) {
            .adm-search {
                flex-direction: column;
                gap: 12px;
            }

            .adm-search .adm-input,
            .adm-search select.adm-input,
            .adm-search .adm-btn {
                width: 100%;
                min-width: auto;
                max-width: none;
            }

            /* Table mobile - card view */
            .adm-table {
                display: block;
            }

            .adm-table thead {
                display: none;
            }

            .adm-table tbody {
                display: block;
            }

            .adm-table tr {
                display: block;
                border: 1px solid #e8ede9;
                border-radius: 8px;
                margin-bottom: 12px;
                overflow: hidden;
            }

            .adm-table td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 12px;
                border-bottom: 1px solid #f0f4f1;
                position: relative;
                padding-left: 50%;
            }

            .adm-table td:last-child {
                border-bottom: none;
            }

            .adm-table td:before {
                content: attr(data-label);
                position: absolute;
                left: 12px;
                font-weight: 700;
                color: #7a9a7d;
                font-size: 11px;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            /* Image column */
            .adm-table td:first-child {
                justify-content: center;
                padding-left: 12px;
            }

            .adm-table td:first-child:before {
                display: none;
            }

            /* Titre & extrait */
            .adm-table td:nth-child(2) {
                flex-direction: column;
                align-items: flex-start;
            }

            .adm-table td:nth-child(2):before {
                content: "Titre & extrait";
            }

            /* Date */
            .adm-table td:nth-child(3):before {
                content: "Date";
            }

            /* Statut */
            .adm-table td:nth-child(4):before {
                content: "Statut";
            }

            /* Actions */
            .adm-table td:nth-child(5) {
                flex-direction: column;
                align-items: flex-start;
            }

            .adm-table td:nth-child(5):before {
                content: "Actions";
            }

            .adm-card-actions {
                width: 100%;
            }

            /* Ajustements de texte */
            .adm-table td {
                font-size: 13px;
            }

            .adm-card__title {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .adm-card__header {
                padding: 12px 16px;
            }

            .adm-search .adm-input,
            .adm-search .adm-btn {
                font-size: 12px;
            }

            .adm-table td {
                padding: 10px;
                padding-left: 45%;
                font-size: 12px;
            }

            .adm-btn-sm {
                padding: 5px 10px;
                font-size: 11px;
            }

            .adm-badge-btn {
                font-size: 10px;
                padding: 2px 8px;
            }

            /* Rendre les images plus petites */
            .adm-table td img {
                width: 40px !important;
                height: 40px !important;
            }

            .adm-table td div[style*="width:52px"] {
                width: 40px !important;
                height: 40px !important;
            }
        }
    </style>

    {{-- Search & filter --}}
    <form method="GET" action="{{ route('admin.actualites.index') }}" class="adm-search">
        <input type="text" name="search" class="adm-input" placeholder="🔍 Rechercher par titre..."
            value="{{ request('search') }}">
        <select name="statut" class="adm-input">
            <option value="">Tous les statuts</option>
            <option value="publie" {{ request('statut') === 'publie' ? 'selected' : '' }}>✅ En ligne</option>
            <option value="brouillon" {{ request('statut') === 'brouillon' ? 'selected' : '' }}>📝 Brouillon</option>
        </select>
        <button type="submit" class="adm-btn adm-btn-outline">Filtrer</button>
        @if(request('search') || request('statut'))
            <a href="{{ route('admin.actualites.index') }}" class="adm-btn adm-btn-sm"
                style="background:#f0f4f1; color:#7a9a7d; border:1.5px solid #d4dfd5;">Réinitialiser</a>
        @endif
    </form>

    <div class="adm-card">
        <div class="adm-card__header">
            <span class="adm-card__title">
                <i class="fas fa-newspaper" style="color:#2E7D32; margin-right:8px;"></i>
                {{ $actualites->total() }} publication(s)
            </span>
        </div>
        <div class="adm-card__body" style="padding:0;">
            @if($actualites->isEmpty())
                <div style="padding:56px; text-align:center; color:#7a9a7d;">
                    <i class="fas fa-newspaper" style="font-size:40px; margin-bottom:14px; display:block; opacity:0.4;"></i>
                    Aucune publication trouvée.
                    <br><br>
                    <a href="{{ route('admin.actualites.create') }}" class="adm-btn adm-btn-primary">Créer la première</a>
                </div>
            @else
                <div class="adm-table-wrapper">
                    <table class="adm-table">
                        <thead>
                            <tr>
                                <th style="width:60px;">Image</th>
                                <th>Titre & extrait</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th style="text-align:right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($actualites as $actu)
                                <tr>
                                    <td data-label="Image">
                                        @if($actu->image)
                                            <img src="{{ Str::startsWith($actu->image, 'assets/') ? asset($actu->image) : Storage::url($actu->image) }}"
                                                alt="{{ $actu->titre }}"
                                                style="width:52px; height:52px; object-fit:cover; border-radius:8px; border:1px solid #e8ede9;">
                                        @else
                                            <div
                                                style="width:52px;height:52px;background:#e8f5e9;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#66BB6A;">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td data-label="Titre & extrait">
                                        <div style="font-weight:600; color:#1a2e1b; margin-bottom:3px;">
                                            {{ Str::limit($actu->titre, 70) }}</div>
                                        <div style="font-size:12px; color:#7a9a7d;">{{ Str::limit($actu->extrait, 100) }}</div>
                                    </td>
                                    <td data-label="Date" style="color:#7a9a7d; font-size:13px; white-space:nowrap;">
                                        {{ $actu->date_formattee }}
                                    </td>
                                    <td data-label="Statut">
                                        <form method="POST" action="{{ route('admin.actualites.toggle', $actu) }}"
                                            style="margin:0;">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="adm-badge-btn {{ $actu->publie ? 'published' : 'draft' }}"
                                                title="{{ $actu->publie ? 'Cliquer pour mettre en brouillon' : 'Cliquer pour publier' }}">
                                                <i class="fas fa-circle" style="font-size:6px;"></i>
                                                <span>{{ $actu->publie ? 'En ligne' : 'Brouillon' }}</span>
                                            </button>
                                        </form>
                                    </td>
                                    <td data-label="Actions">
                                        <div class="adm-card-actions">
                                            <a href="{{ route('admin.actualites.edit', $actu) }}"
                                                class="adm-btn adm-btn-outline adm-btn-sm" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                                <span class="hide-sm">Modifier</span>
                                            </a>
                                            <form method="POST" action="{{ route('admin.actualites.destroy', $actu) }}"
                                                onsubmit="return confirm('Supprimer cette publication ?');" style="margin:0;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                    <span class="hide-sm">Supprimer</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($actualites->hasPages())
                    <div style="padding:16px 24px;">
                        {{ $actualites->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>

    <style>
        /* Masquer le texte sur petit écran */
        @media (max-width: 480px) {
            .hide-sm {
                display: none;
            }
        }
    </style>

@endsection