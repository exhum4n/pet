<?php

use Illuminate\Database\Schema\Blueprint;
use App\Database\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $this->createTable(function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuidMorphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    public function name(): string
    {
        return 'personal_access_tokens';
    }

    public function schema(): string
    {
        return 'auth';
    }
};
