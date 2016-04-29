<?php
/*
 * Author: QSoto
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTEncargadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_encargados', function (Blueprint $table) {
            $table->increments('idEnc');
            $table->integer('idUsu')->unsigned();
            $table->foreign('idUsu')->references('idUsu')->on('t_usuarios')->onDelete('cascade');
            $table->integer('idActRec')->unsigned();
            $table->foreign('idActRec')->references('idActRec')->on('t_acti_recus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('t_encargados');
    }
}
