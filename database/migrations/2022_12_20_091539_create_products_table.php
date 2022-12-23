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
            $table->bigInteger('product_category_id');
            $table->string('product_code')->nullable();
            $table->string('product_name');
            $table->decimal('buying_price',8,2);
            $table->decimal('salling_price',8,2);
            $table->string('buying_date')->nullable();
            $table->tinyInteger('product_quantity')->default(0);
            $table->string('photo')->nullable();
            $table->longText('description')->nullable();
            $table->string('note')->nullable();
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
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
