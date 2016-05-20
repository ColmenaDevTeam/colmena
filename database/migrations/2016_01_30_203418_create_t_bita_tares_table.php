<?php
/*
Author: QSoto
*/
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTBitaTaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_bita_tares', function (Blueprint $table) {
            $table->increments('idBitTar');
            $table->integer('idTar')->unsigned();
            $table->foreign('idTar')->references('idTar')->on('t_tareas')->onDelete('cascade');
            $table->string('estado',45);
            $table->timestamp('fecInc');
            $table->string('nombreUsu',45);
            $table->text('detalle');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('t_bita_tares');
    }
}
