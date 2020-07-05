<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('scheduledTime')->nullable();
            $table->timestamp('endTime')->nullable();
            $table->string('appointmentDuration')->nullable();
            $table->boolean('isCurrentlyActive');
            $table->string('tips')->nullable();
            $table->string('isbooked');
            $table->boolean('isCancelled');
            $table->integer('serial');
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
        Schema::dropIfExists('appointments');
    }
}
