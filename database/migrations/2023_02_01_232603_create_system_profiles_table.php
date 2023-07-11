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
        Schema::create('system_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('photo');
            $table->string('tel');
            $table->string('email');
            $table->longText('address');
            $table->longText('descrip_contract_invoice');
            $table->longText('descrip_contract_quote');
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
        Schema::dropIfExists('system_profiles');
    }
};
