<?php

use App\Enum\EpisodeStateType;
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
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->uuid('public_id')->nullable(false)->unique()->default(null);
            $table->enum('state', [EpisodeStateType::DRAFT->value, EpisodeStateType::PUBLISHED->value]);
            $table->smallInteger('intensity', false, true)->nullable();
            $table->smallInteger('duration', false, true)->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes');
    }
};
