<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prodcuts', function (Blueprint $table) {
            $table->string('standard_cost')->nullable()->after('sold_out');
            $table->string('unitprice')->nullable()->after('standard_cost');
            $table->string('unit_in_stock')->nullable()->after('unitprice');
            $table->string('recorder_level')->nullable()->after('unit_in_stock');
            $table->string('quantity')->nullable()->after('recorder_level');
            $table->string('product_unit')->nullable()->after('quantity');
            $table->string('sub_total')->nullable()->after('product_unit');
            $table->string('sub_price')->nullable()->after('sub_total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prodcuts', function (Blueprint $table) {
            $table->dropColumn('standard_cost');
            $table->dropColumn('unitprice');
            $table->dropColumn('unit_in_stock');
            $table->dropColumn('recorder_level');
            $table->dropColumn('quantity');
            $table->dropColumn('product_unit');
            $table->dropColumn('sub_total');
            $table->dropColumn('sub_price');
        });
    }
}
