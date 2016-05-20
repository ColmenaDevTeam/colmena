<?php
/*
Author: QSoto
*/
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTTareasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_tareas', function (Blueprint $table) {
            $table->increments('idTar');
            $table->string('titulo');
            $table->date('fecEst');
            $table->date('fecEnt')->nullable();
            $table->text('detalle');
            $table->integer('prioridad');
            $table->integer('complejidad');
            $table->enum('estTar',['Asignada','Revision','Cumplida','Cancelada','Diferida','Retardada']);
            $table->enum('tipTar',['Academico-Docente','Administrativas','Creacion intelectual','Integracion Social','Administrativo-Docente','Produccion']);
            $table->integer('idUsu')->unsigned();
            $table->foreign('idUsu')->references('idUsu')->on('t_usuarios')->onDelete('cascade');
            $table->boolean('visto')->default(false);
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
        Schema::drop('t_tareas');
    }
}
