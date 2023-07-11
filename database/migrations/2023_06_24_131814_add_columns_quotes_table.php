<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->string('request_status')->nullable()->after('total_amount');
            $table->bigInteger('submit_by')->nullable()->after('request_status');
            $table->string('approve_status')->nullable()->after('submit_by');
            $table->bigInteger('approve_by')->nullable()->after('approve_status');
        });

        Schema::table('quote_details', function (Blueprint $table) {
            $table->decimal('discount',8,2)->nullable()->after('qty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropColumn('request_status');
            $table->dropColumn('submit_by');
            $table->dropColumn('approve_status');
            $table->dropColumn('approve_by');
        });

        Schema::table('quote_details', function (Blueprint $table) {
            $table->dropColumn('discount');
        });
    }
}
