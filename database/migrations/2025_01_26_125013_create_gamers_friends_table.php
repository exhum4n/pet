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
            $table->uuid('gamer_id');
            $table->uuid('friend_id');

            $table->unique(['gamer_id', 'friend_id']);

            $table->foreign('gamer_id')
                ->references('id')
                ->on('gamers.gamers');

            $table->foreign('friend_id')
                ->references('id')
                ->on('gamers.gamers');
        });
    }

    protected function name(): string
    {
        return 'friends';
    }

    protected function schema(): string
    {
        return 'gamers';
    }
};
