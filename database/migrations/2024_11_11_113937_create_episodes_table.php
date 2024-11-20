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
        $states = array_column(EpisodeStateType::cases(), 'value');

        Schema::create('episodes', function (Blueprint $table) use ($states) {
            $table->id();
            $table->uuid('public_id')->nullable()->unique();
            $table->enum('state', $states)->default(EpisodeStateType::DRAFT->value);
            $table->foreignId('user_id')->nullable()->constrained('users');
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
