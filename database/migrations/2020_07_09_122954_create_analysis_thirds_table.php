<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalysisThirdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analysis_thirds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patient_id')->unsigned();
            $table->foreign('patient_id')
                    ->references('id')->on('patients')->onDelete('cascade');
            $table->string("desire_food")->nullable();
            $table->string("greedy_food")->nullable();
            $table->string("ideal_food")->nullable();
            $table->string("donot_tolerate_food")->nullable();
            $table->string("season_increase")->nullable();
            $table->string("season_like")->nullable();
            $table->string("cloth_choice")->nullable();
            $table->string("inflamanation")->nullable();
            $table->string("bedsheet")->nullable();
            $table->string("periodic_symptoms")->nullable();
            $table->string("moon")->nullable();
            $table->string("sun")->nullable();
            $table->string("thunderstrom")->nullable();
            $table->string("seeside_area")->nullable();
            $table->string("while_reading")->nullable();
            $table->string("while_writing")->nullable();
            $table->string("while_thinking")->nullable();
            $table->string("while_listening")->nullable();
            $table->string("while_practicing")->nullable();
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
        Schema::dropIfExists('analysis_thirds');
    }
}
