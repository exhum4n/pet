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
            $table->id();
            $table->uuid('user_id')->unique();
            $table->timestamps();
        });
    }

    protected function name(): string
    {
        return 'moderators';
    }

    protected function schema(): string
    {
        return 'moderators';
    }
};
