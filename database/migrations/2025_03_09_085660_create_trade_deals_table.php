<?php

use App\Database\Migration;
use App\Enums\Trade\DealStatus;
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
            $table->uuid('offer_id');
            $table->enum('status', enum_to_array(DealStatus::class));
            $table->integer('count');
            $table->decimal('price');
            $table->decimal('total_price');
            $table->timestamps();

            $table->foreign('offer_id')
                ->references('id')
                ->on('trade.offers')
                ->cascadeOnDelete();
        });
    }

    protected function name(): string
    {
        return 'deals';
    }

    protected function schema(): string
    {
        return 'trade';
    }
};
