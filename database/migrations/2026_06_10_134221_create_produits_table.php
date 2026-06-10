<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('slug')->unique();
            $table->string('categorie'); // Activateurs, Fertilisants, Biopesticides, Semences
            $table->boolean('en_vedette')->default(false);
            $table->text('description_courte');
            $table->text('description')->nullable();
            $table->json('avantages')->nullable();  // liste d'avantages
            $table->text('mode_emploi')->nullable();
            $table->string('prix')->nullable();
            $table->string('image')->nullable();
            $table->boolean('actif')->default(true);
            $table->integer('ordre')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void 
    
    {
        Schema::dropIfExists('produits');
    }
};
