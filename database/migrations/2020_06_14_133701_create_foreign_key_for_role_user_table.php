<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeyForRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('role_user', function (Blueprint $table) {
       $table->foreign('user_id')->references('id')->on('users');
       $table->foreign('role_id')->references('id')->on('roles');
       // $table->softDeletes();
     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('role_user');
      Schema::table('role_user', function(Blueprint $table){
            $table->dropForeign('role_user_user_id_foreign');
            $table->dropForeign('role_user_role_id_foreign');
          });
    }
}
