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

            $table->bigInteger('patient_id')->unsigned()->nullable();
            $table->bigInteger('doctor_id')->unsigned()->nullable();
            $table->foreign('patient_id')
                    ->references('id')->on('patients')->onDelete('cascade');;
            $table->foreign('doctor_id')
                            ->references('id')->on('doctors')->onDelete('cascade');;
            $table->date('date')->nullable();
            $table->string('start_time')->nullable();
            $table->string('status')->default('pending');
            $table->boolean('reschedule_req')->default(0);
            $table->boolean('reschedule_status')->default(0);
            $table->boolean('isCurrentlyActive')->nullable();
            $table->string('isalopathy')->nullable();
            $table->string('isrefered')->nullable();
            $table->string('isactive')->nullable();
            $table->string('isbooked')->default("booked");
            $table->boolean('isCancelled')->default(false);

            $table->timestamps();
            $table->softDeletes();
            $table->index(['deleted_at']);
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