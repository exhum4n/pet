<?php

use App\Database\Migration;
use App\Enums\Trade\OfferStatus;
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
            $table->uuid('buyer_id');
            $table->uuid('seller_id');
            $table->uuid('item_id');
            $table->enum('status', enum_to_array(OfferStatus::class));
            $table->timestamps();

            $table->foreign('buyer_id')
                ->references('id')
                ->on('gamers.gamers')
                ->cascadeOnDelete();

            $table->foreign('seller_id')
                ->references('id')
                ->on('gamers.gamers')
                ->cascadeOnDelete();

            $table->foreign('item_id')
                ->references('id')
                ->on('gamers.items')
                ->cascadeOnDelete();
        });
    }

    protected function name(): string
    {
        return 'offers';
    }

    protected function schema(): string
    {
        return 'trade';
    }
};
