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
            $table->uuid('service_id');
            $table->uuid('gamer_id');
            $table->float('price')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('service_id')
                ->references('id')
                ->on('services.services')
                ->cascadeOnDelete();

            $table->foreign('gamer_id')
                ->references('id')
                ->on('gamers.gamers')
                ->cascadeOnDelete();
        });
    }

    protected function name(): string
    {
        return 'services';
    }

    protected function schema(): string
    {
        return 'gamers';
    }
};
