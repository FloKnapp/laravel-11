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
        Schema::create('episodes_episode_types', function (Blueprint $table) {
            $table->foreignId('episode_id')->constrained('episodes')->onDelete('cascade');
            $table->foreignId('episode_type_id')->constrained('episode_types')->onDelete('cascade');
            $table->unique(['episode_id', 'episode_type_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes_episode_types');
    }
};
