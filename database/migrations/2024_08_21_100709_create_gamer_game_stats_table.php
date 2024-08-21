<?php

use App\Models\Game;
use App\Models\Gamer;
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
        Schema::create('gamer_game_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Gamer::class);
            $table->foreignIdFor(Game::class);
            $table->integer('goals')->default(0);
            $table->integer('assists')->default(0);
            $table->bigInteger('yellow_cards')->default(0);
            $table->bigInteger('red_cards')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gamer_game_stats');
    }
};
