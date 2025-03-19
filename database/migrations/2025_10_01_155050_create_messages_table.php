<?php

use App\Database\Migration;
use App\Enums\Chat\MessageType;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        $this->createTable(function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('chat_id');
            $table->uuid('gamer_id');
            $table->enum('type', enum_to_array(MessageType::class));
            $table->jsonb('content');
            $table->timestamps();

            $table->foreign('chat_id')
                ->references('id')
                ->on('chats.chats')
                ->onDelete('cascade');
        });
    }

    protected function name(): string
    {
        return 'messages';
    }

    protected function schema(): string
    {
        return 'chats';
    }
};
