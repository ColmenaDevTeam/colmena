<?php
/*
Author: QSoto
*/
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTRoleUsuasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_role_usuas', function (Blueprint $table) {
            $table->increments('idRolUsu');
            $table->integer('idRol')->unsigned();
            $table->foreign('idRol')->references('idRol')->on('t_roles')->onDelete('cascade');
            $table->integer('idUsu')->unsigned();
            $table->foreign('idUsu')->references('idUsu')->on('t_usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('t_role_usuas');
    }
}
