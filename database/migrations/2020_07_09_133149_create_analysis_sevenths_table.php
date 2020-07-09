<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalysisSeventhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analysis_sevenths', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patient_id')->unsigned();
            $table->foreign('patient_id')
                    ->references('id')->on('patients')->onDelete('cascade');
            $table->string("first_disease")->nullable();
            $table->string("additional_disease")->nullable();
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
        Schema::dropIfExists('analysis_sevenths');
    }
}
