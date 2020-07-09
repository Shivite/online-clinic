<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalysisEightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analysis_eights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patient_id')->unsigned();
            $table->foreign('patient_id')
                    ->references('id')->on('patients')->onDelete('cascade');
            $table->text("first_disease")->nullable();
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
        Schema::dropIfExists('analysis_eights');
    }
}
