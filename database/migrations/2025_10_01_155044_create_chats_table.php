<?php

use App\Database\Migration;

use App\Enums\Chat\ChatStatus;
use App\Enums\Chat\ChatType;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        $this->createTable(function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('type', enum_to_array(ChatType::class));
            $table->enum('status', enum_to_array(ChatStatus::class));
            $table->uuid('subject_id');
            $table->string('name');
            $table->timestampTz('created_at')->useCurrent();
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
