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
            $table->datetime('start_time')->nullable();
            $table->datetime('finish_time')->nullable();
            $table->boolean('isCurrentlyActive')->nullable();
            $table->string('isbooked')->nullable();
            $table->boolean('isCancelled')->nullable();

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
