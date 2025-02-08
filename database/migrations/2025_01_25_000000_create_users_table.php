<?php

use App\Database\Migration;
use App\Enums\UserRole;
use Illuminate\Database\Schema\Blueprint;
use App\Enums\UserStatus;

return new class extends Migration
{
    public function up(): void
    {
        $this->createTable(function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email')->unique();
            $table->enum('role', enum_to_array(UserRole::class));
            $table->enum('status', enum_to_array(UserStatus::class));
            $table->string('password');
            $table->timestamps();
        });
    }

    protected function name(): string
    {
        return 'users';
    }

    protected function schema(): string
    {
        return 'auth';
    }
};
