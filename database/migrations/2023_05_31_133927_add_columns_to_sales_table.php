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
        Schema::table('sale_details', function (Blueprint $table) {
            $table->decimal('discount',8,2)->nullable()->after('price');
            $table->string('unit')->nullable()->after('qty');
            $table->string('photo')->nullable()->after('unit');
            $table->decimal('amount',8,2)->nullable()->after('unit');
        });

        Schema::table('add_carts', function (Blueprint $table) {
            $table->decimal('discount',8,2)->nullable()->after('price');
            $table->string('unit')->nullable()->after('qty');
            $table->string('photo')->nullable()->after('unit');
            $table->decimal('amount',8,2)->nullable()->after('unit');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sale_details', function (Blueprint $table) {
            $table->dropColumn('discount');
            $table->dropColumn('unit');
            $table->dropColumn('photo');
            $table->dropColumn('amount');
        });
        Schema::table('add_carts', function (Blueprint $table) {
            $table->dropColumn('discount');
            $table->dropColumn('unit');
            $table->dropColumn('photo');
            $table->dropColumn('amount');
        });
    }
};
