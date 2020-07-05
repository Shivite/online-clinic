<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                    ->references('id')->on('users')->onDelete('cascade');;
            $table->string('title');
            $table->string('name');
            $table->string('number')->unique();;
            $table->string('alt_number')->nullable();
            $table->string('email')->unique();
            $table->longText('address');
            $table->string('pin', 6);
            $table->string('legalgaurdian');
            $table->string('country');
            $table->timestamp('dob');
            $table->string('docname')->nullable();
            $table->string('age');
            $table->string('gender');
            $table->string('language');
            $table->string('religion');
            $table->string('occupaton');
            $table->string('marital');
            $table->binary('photo');
            $table->binary('proof');
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
