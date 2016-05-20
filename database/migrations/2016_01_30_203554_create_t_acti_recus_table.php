<?php
/*
Author: QSoto
*/
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTActiRecusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_acti_recus', function (Blueprint $table) {
            $table->increments('idActRec');
            $table->string('titulo',45);
            $table->enum('tipFrec',['Semanal','Mensual','Bimensual','Trimestral','Semestral']);
            $table->integer('tieEnt');
            $table->text('detalle');
            $table->integer('prioridad');
            $table->integer('complejidad');
            $table->enum('tipTar',['Academico-Docente','Administrativas','Creacion intelectual','Integracion Social','Administrativo-Docente','Produccion']);
            $table->date('fecIni');
            $table->date('ultLan')->nullable();
            $table->boolean('activa')->nullable();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('t_acti_recus');
    }
}
