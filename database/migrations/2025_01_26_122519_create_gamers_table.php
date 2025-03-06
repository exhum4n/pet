<?php

use App\Enums\Gamer\Gender;
use App\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        $this->createTable(function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->unique();
            $table->string('username');
            $table->smallInteger('tag');
            $table->enum('gender', enum_to_array(Gender::class));
            $table->string('avatar_url')->nullable();
            $table->date('birthday');
            $table->string('timezone');
            $table->json('languages');
            $table->timestamps();
        });
    }

    protected function name(): string
    {
        return 'gamers';
    }

    protected function schema(): string
    {
        return 'gamers';
    }
};
