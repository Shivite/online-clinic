<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalysisSecondsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analysis_seconds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patient_id')->unsigned();
            $table->foreign('patient_id')
                    ->references('id')->on('patients')->onDelete('cascade');
            $table->string("tongue_layer")->nullable();
            $table->string("thirst")->nullable();
            $table->string("sweet_increase_pain")->nullable();
            $table->string("sweet_tendency")->nullable();
            $table->string("bath_tendency")->nullable();
            $table->string("appetite")->nullable();
            $table->string("bath_desire")->nullable();
            $table->text("sweet_reduce_pain")->nullable();
            $table->string("during_sleep")->nullable();
            $table->text("position_sleep")->nullable();
            $table->text("after_sleep")->nullable();
            $table->text("frequency")->nullable();
            $table->text("character")->nullable();
            $table->text("U_frequency")->nullable();
            $table->text("U_character")->nullable();
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
        Schema::dropIfExists('analysis_seconds');
    }
}