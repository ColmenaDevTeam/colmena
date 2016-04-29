<?php
/*
Author: QSoto
*/
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_roles', function (Blueprint $table) {
            $table->increments('idRol');
            $table->string('nombre',20)->unique();
            //$table->$table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('t_roles');
    }
}
