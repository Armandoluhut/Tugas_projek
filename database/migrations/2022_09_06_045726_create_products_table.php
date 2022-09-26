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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('code', 200);
            $table->foreignId('product_categories_id');
            $table->decimal('price', 18, 2)->default(0);
            $table->decimal('purchase_price', 18, 2)->default(0);
            $table->string('short_description', 250)->nullable();
            $table->text('description');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('new_product')->default(0);
            $table->tinyInteger('best_seller')->default(0);
            $table->tinyInteger('featured')->default(0);
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
        Schema::dropIfExists('products');
    }
};
