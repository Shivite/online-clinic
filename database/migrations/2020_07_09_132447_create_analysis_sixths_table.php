<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnalysisSixthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analysis_sixths', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('patient_id')->unsigned();
            $table->foreign('patient_id')
                    ->references('id')->on('patients')->onDelete('cascade');
            $table->text("m_gm_f_disease")->nullable();
            $table->text("m_gm_f_death_cause")->nullable();
            $table->text("m_gm_disease")->nullable();
            $table->text("m_gm_death_cause")->nullable();
            $table->text("m_f_disease")->nullable();
            $table->text("m_f_death_cause")->nullable();
            $table->text("m_u_disease")->nullable();
            $table->text("m_u_death_cause")->nullable();
            $table->text("m_a_disease")->nullable();
            $table->text("m_a_death_cause")->nullable();
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
        Schema::dropIfExists('analysis_sixths');
    }
}
