<?php
/*
Author: QSoto
*/
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTPermReposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_perm_repos', function (Blueprint $table) {
            $table->increments('idPerRep');
            $table->boolean('perRep');
            $table->date('fecIni');
            $table->date('fecFin');
            $table->text('detalle');
            $table->integer('idUsu')->unsigned();
            $table->foreign('idUsu')->references('idUsu')->on('t_usuarios');
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
        Schema::drop('t_perm_repos');
    }
}
