<?php

use App\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        $this->createTable(function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('message_id');
            $table->string('url');
            $table->string('name');
            $table->timestampTz('created_at')->useCurrent();

            $table->foreign('message_id')
                ->references('id')
                ->on('chats.messages')
                ->onDelete('cascade');
        });
    }

    protected function name(): string
    {
        return 'files';
    }

    protected function schema(): string
    {
        return 'chats';
    }
};
