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
        Schema::create('episodes_symptom_timings', function (Blueprint $table) {
            $table->foreignId('episode_id')->constrained('episodes')->onDelete('cascade');
            $table->foreignId('symptom_timing_id')->constrained('symptom_timings')->onDelete('cascade');
            $table->unique(['episode_id', 'symptom_timing_id'], 'symptom_timing_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes_symptom_timings');
    }
};
