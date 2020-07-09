<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalysisFirstsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analysis_firsts', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('patient_id')->unsigned();
          $table->foreign('patient_id')
                  ->references('id')->on('patients')->onDelete('cascade');
          $table->string('blood_group')->nullable();
          $table->string('season_suffer')->nullable();
          $table->text('s1_effected_areas')->nullable();
          $table->text('s1_sensations')->nullable();
          $table->string('s1_increas_decrease')->nullable();
          $table->text('s1_related_symptoms')->nullable();
          $table->text('s2_effected_areas')->nullable();
          $table->text('s2_sensations')->nullable();
          $table->text('s2_increas_decrease')->nullable();
          $table->text('s2_related_symptoms')->nullable();
          $table->text('s3_effected_areas')->nullable();
          $table->text('s3_sensations')->nullable();
          $table->text('s3_increas_decrease')->nullable();
          $table->text('s3_related_symptoms')->nullable();
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
        Schema::dropIfExists('analysis_firsts');
    }
}
