<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('user_id')->unsigned()->nullable();
          $table->foreign('user_id')
                  ->references('id')->on('users')->onDelete('cascade');;
          $table->string('specialization', 50)->nullable();
          $table->text('about')->nullable();
          $table->boolean('is_active')->default(true);
          $table->string('sign', 100)->default('sign.png');
          $table->string('profile_pic', 100)->default('doctor.png');
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
        Schema::dropIfExists('profiles');
    }
}
