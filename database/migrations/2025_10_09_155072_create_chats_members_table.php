<?php

use App\Database\Migration;
use App\Enums\Chat\MemberRole;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        $this->createTable(function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('chat_id');
            $table->uuid('gamer_id');
            $table->enum('role', enum_to_array(MemberRole::class));

            $table->unique(['chat_id', 'gamer_id']);

            $table->foreign('chat_id')
                ->references('id')
                ->on('chats.chats')
                ->onDelete('cascade');

            $table->foreign('gamer_id')
                ->references('id')
                ->on('gamers.gamers')
                ->onDelete('cascade');
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
