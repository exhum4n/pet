<?php

use App\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->createTable(function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('game_id');
            $table->uuid('gamer_id');

            $table->unique(['gamer_id', 'game_id']);

            $table->foreign('game_id')
                ->references('id')
                ->on('games.games')
                ->cascadeOnDelete();

            $table->foreign('gamer_id')
                ->references('id')
                ->on('gamers.gamers')
                ->cascadeOnDelete();
        });
    }

    protected function name(): string
    {
        return 'games';
    }

    protected function schema(): string
    {
        return 'gamers';
    }
};
