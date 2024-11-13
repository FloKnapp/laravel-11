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
        Schema::create('episodes_episode_symptoms', function (Blueprint $table) {
            $table->foreignId('episode_id')->constrained('episodes');
            $table->foreignId('episode_symptom_id')->constrained('episode_symptoms');
            $table->unique(['episode_id', 'episode_symptom_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes_episode_symptoms');
    }
};
