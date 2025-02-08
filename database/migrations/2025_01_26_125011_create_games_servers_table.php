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
            $table->string('name');
            $table->date('deleted_at');

            $table->unique(['game_id', 'name']);

            $table->foreign('game_id')
                ->references('id')
                ->on('games.games')
                ->cascadeOnDelete();
        });
    }

    protected function name(): string
    {
        return 'servers';
    }

    protected function schema(): string
    {
        return 'games';
    }
};
