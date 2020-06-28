<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                    ->references('id')->on('users')->onDelete('cascade');;
            $table->string('name');
            $table->string('number')->unique();;
            $table->string('alt_number')->nullable();
            $table->string('password');
            $table->string('email')->unique();
            $table->longText('address');
            $table->string('pin', 6);
            $table->string('legalgaurdian');
            $table->string('country');
            $table->timestamp('dob');
            $table->string('docname');
            $table->string('age');
            $table->string('gender');
            $table->string('language');
            $table->string('religion');
            $table->string('occupaton');
            $table->string('marital');
            $table->string('photo');
            $table->string('proof');
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
        Schema::dropIfExists('patient_details');
    }
}
