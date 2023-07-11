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
        Schema::table('sales', function (Blueprint $table) {
            $table->string('request_status')->nullable()->after('total_price');
            $table->bigInteger('submit_by')->nullable()->after('request_status');
            $table->string('approve_status')->nullable()->after('submit_by');
            $table->bigInteger('approve_by')->nullable()->after('approve_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('request_status');
            $table->dropColumn('submit_by');
            $table->dropColumn('approve_status');
            $table->dropColumn('approve_by');
        });
    }
};
