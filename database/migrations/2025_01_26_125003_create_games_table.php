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
            $table->string('name');
            $table->string('image_url')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    protected function name(): string
    {
        return 'games';
    }

    protected function schema(): string
    {
        return 'games';
    }
};
