<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('temoignages', function (Blueprint $table) {
            $table->id();
            $table->string('nom_client');
            $table->string('role'); // ex: "Maraîcher professionnel"
            $table->string('localisation');
            $table->text('citation');
            $table->string('photo')->nullable();
            $table->string('avant')->nullable(); // situation avant
            $table->string('apres')->nullable();  // situation après
            $table->boolean('publie')->default(true);
            $table->integer('ordre')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('temoignages');
    }
};
