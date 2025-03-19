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
            $table->uuid('gamer_id');
            $table->uuid('server_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->uuid('category_id');
            $table->integer('count');
            $table->integer('stock');
            $table->integer('price');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('gamer_id')
                ->references('id')
                ->on('gamers.gamers')
                ->cascadeOnDelete();

            $table->foreign('server_id')
                ->references('id')
                ->on('games.servers')
                ->cascadeOnDelete();

            $table->foreign('category_id')
                ->references('id')
                ->on('games.items_categories')
                ->cascadeOnDelete();
        });
    }

    protected function name(): string
    {
        return 'items';
    }

    protected function schema(): string
    {
        return 'gamers';
    }
};
