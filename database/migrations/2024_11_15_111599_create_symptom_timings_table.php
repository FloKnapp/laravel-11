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
        Schema::create('symptom_timings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('symptom_id')->constrained('episode_symptoms');
            $table->foreignId('timing_id')->constrained('timings');
            $table->unique(['symptom_id', 'timing_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('symptom_timings');
    }
};
