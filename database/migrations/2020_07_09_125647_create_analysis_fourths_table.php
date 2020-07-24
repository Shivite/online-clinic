<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalysisFourthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analysis_fourths', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patient_id')->unsigned();
            $table->foreign('patient_id')
                    ->references('id')->on('patients')->onDelete('cascade');
            $table->string("periodic_mental")->nullable();
            $table->string("hobby")->nullable();
            $table->string("afraid")->nullable();
            $table->string("fear")->nullable();
            $table->string("anger")->nullable();
            $table->string("control_anger")->nullable();
            $table->string("speak_hurt")->nullable();
            $table->string("alone")->nullable();
            $table->string("event_joy")->nullable();
            $table->string("saddened")->nullable();
            $table->string("noticed")->nullable();
            $table->string("curriculam")->nullable();
            $table->string("conclussion")->nullable();
            $table->string("fairful_object")->nullable();
            $table->string("embarrassing")->nullable();
            $table->string('_token',100);          
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
        Schema::dropIfExists('analysis_fourths');
    }
}