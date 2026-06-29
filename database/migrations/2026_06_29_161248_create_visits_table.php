<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('page_url')->nullable();
            $table->string('session_id')->nullable();
            $table->timestamp('visited_at');
            $table->timestamps();
            
            // Index pour de meilleures performances
            $table->index('visited_at');
            $table->index('ip_address');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};