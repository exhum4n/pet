<?php

use App\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        $this->createTable(function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('status');
            $table->timestamps();
        });
    }

    protected function name(): string
    {
        return 'chats';
    }

    protected function schema(): string
    {
        return 'chats';
    }
};
