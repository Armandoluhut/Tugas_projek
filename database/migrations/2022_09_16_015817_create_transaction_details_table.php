<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transactions_id');
            $table->foreignId('products_id');
            $table->integer('qty')->default(0);
            $table->decimal('price_satuan', 18, 2)->default(0);
            $table->decimal('price_total', 18, 2)->default(0);
            $table->decimal('price_purchase_satuan', 18, 2)->default(0);
            $table->decimal('price_purchase_total', 18, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_details');
    }
};
