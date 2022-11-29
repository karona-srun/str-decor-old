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
        Schema::create('staff_infos', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->longText('photo');
            $table->dateTime('bod');
            $table->longText('bop');
            $table->longText('cop');
            $table->bigInteger('position');
            $table->bigInteger('work_place');
            $table->bigInteger('base_salary');
            $table->integer('time_work');
            $table->dateTime('start_work');
            $table->dateTime('stop_work');
            $table->longText('note');
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
        Schema::dropIfExists('staff_infos');
    }
};
