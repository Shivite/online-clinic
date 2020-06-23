<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->unsignedBigInteger('user_id');
          $table->unsignedBigInteger('department_id');
          $table->string('specialization', 50)->nullable();
          $table->text('about')->nullable();
          $table->boolean('is_active')->default(true);
          $table->string('sign', 100)->default('sign.png');
          $table->string('profile_pic', 100)->default('doctor.png');
          $table->foreign('user_id')
                  ->references('id')->on('users');
          $table->foreign('department_id')
                  ->references('id')->on('departments');
            $table->softDeletes();
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
        Schema::dropIfExists('doctors');
    }
}
