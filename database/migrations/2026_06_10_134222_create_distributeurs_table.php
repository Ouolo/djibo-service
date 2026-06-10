<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('distributeurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');         // Nom du magasin / coopérative
            $table->string('nom_contact');  // Nom du gérant
            $table->string('telephone');
            $table->string('localisation'); // Ville / Quartier
            $table->string('adresse')->nullable();
            $table->string('zones_couvertes')->nullable(); // "Ségou, Markala"
            $table->boolean('actif')->default(true);
            $table->integer('ordre')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('distributeurs');
    }
};
