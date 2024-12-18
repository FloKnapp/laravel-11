<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('episode_symptoms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('episode_id')->constrained('episodes')->onDelete('cascade');
            $table->foreignId('symptom_id')->constrained('symptoms')->onDelete('cascade');
            $table->unique(['episode_id', 'symptom_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episode_symptoms');
    }
};
