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
            $table->bigInteger('product_category_id')->nullable();
            $table->string('product_code')->nullable();
            $table->string('product_name');
            $table->string('scale')->nullable();
            $table->decimal('buying_price',8,2);
            $table->string('salling_price');
            $table->string('buying_date')->nullable();
            $table->tinyInteger('store_stock');
            $table->tinyInteger('warehouse');
            $table->tinyInteger('sold_out')->nullable();
            $table->string('photo')->nullable();
            $table->longText('description')->nullable();
            $table->string('note')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
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
