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

            $table->string('type');
            $table->jsonb('data');
            $table->timestamps();

            $table->foreign('chat_id')
                ->references('id')
                ->on('chats.chats')
                ->cascadeOnDelete();
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
