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
            $table->string('first_name_kh');
            $table->string('last_name_kh');
            $table->string('gender');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->longText('photo')->nullable();
            $table->dateTime('birth_of_date');
            $table->longText('birth_of_place');
            $table->longText('current_place');
            $table->bigInteger('position');
            $table->bigInteger('work_place');
            $table->bigInteger('base_salary');
            $table->bigInteger('work_time')->nullable();
            $table->dateTime('start_work');
            $table->dateTime('stop_work')->nullable();
            $table->longText('note')->nullable();
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
