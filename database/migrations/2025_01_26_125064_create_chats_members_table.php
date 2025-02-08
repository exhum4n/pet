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
            $table->uuid('chat_id');
            $table->uuid('gamer_id');
            $table->timestamps();

            $table->foreign('chat_id')
                ->references('id')
                ->on('chats.chats')
                ->cascadeOnDelete();

            $table->foreign('gamer_id')
                ->references('id')
                ->on('gamers.gamers')
                ->cascadeOnDelete();
        });
    }

    protected function name(): string
    {
        return 'members';
    }

    protected function schema(): string
    {
        return 'chats';
    }
};
