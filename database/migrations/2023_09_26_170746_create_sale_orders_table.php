<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_orders', function (Blueprint $table) {
            $table->id();
            $table->string('sale_order_no')->nullable();
            $table->bigInteger('customer_id');
            $table->string('sale_order');
            $table->string('reference');
            $table->date('sale_order_date');
            $table->date('expected_shipment_date');
            $table->string('warehouse')->nullable();
            $table->string('sale_person')->nullable();
            $table->string('delivery_method')->nullable();
            $table->bigInteger('user_id')->nullable();
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
        Schema::dropIfExists('sale_orders');
    }
}
