<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Modifier la table existante pour ajouter les nouvelles colonnes
        Schema::table('temoignages', function (Blueprint $table) {
            // Ajouter la colonne 'type' si elle n'existe pas
            if (!Schema::hasColumn('temoignages', 'type')) {
                $table->enum('type', ['text', 'image', 'video'])->default('text')->after('localisation');
            }

            // Renommer 'citation' en 'contenu' et ajouter la colonne 'media'
            if (!Schema::hasColumn('temoignages', 'contenu')) {
                if (Schema::hasColumn('temoignages', 'citation')) {
                    $table->renameColumn('citation', 'contenu');
                } else {
                    $table->text('contenu')->nullable()->after('localisation');
                }
            }

            // Renommer 'photo' en 'media' pour plus de généralité
            if (!Schema::hasColumn('temoignages', 'media')) {
                if (Schema::hasColumn('temoignages', 'photo')) {
                    $table->renameColumn('photo', 'media');
                } else {
                    $table->string('media')->nullable()->after('contenu');
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('temoignages', function (Blueprint $table) {
            // Rollback: renommer media en photo
            if (Schema::hasColumn('temoignages', 'media') && !Schema::hasColumn('temoignages', 'photo')) {
                $table->renameColumn('media', 'photo');
            }

            // Rollback: renommer contenu en citation
            if (Schema::hasColumn('temoignages', 'contenu') && !Schema::hasColumn('temoignages', 'citation')) {
                $table->renameColumn('contenu', 'citation');
            }

            // Rollback: supprimer la colonne type
            if (Schema::hasColumn('temoignages', 'type')) {
                $table->dropColumn('type');
            }
        });
    }
};
