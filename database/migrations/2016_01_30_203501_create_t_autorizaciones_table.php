<?php
/*
Author: QSoto
*/
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTAutorizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_autorizaciones', function (Blueprint $table) {
            $table->increments('idAut');
            $table->integer('idRol')->unsigned();
            $table->foreign('idRol')->references('idRol')->on('t_roles')->onDelete('cascade');
            $table->integer('idAcc')->unsigned();
            $table->foreign('idAcc')->references('idAcc')->on('t_acciones')->onDelete('cascade');
            //$table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('t_autorizaciones');
    }
}
