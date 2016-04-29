<?php
/*
Author: tesoner Senpai
*/
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_usuarios', function (Blueprint $table) {
            $table->increments('idUsu');
            $table->string('cedula',15)->unique();
            $table->string('username',15)->unique();
            $table->string('nombres',45);
            $table->string('apellidos',45);
            $table->enum('tipUsu',['Docente','Administrativo','Mantenimiento']);
            $table->string('email',45);
            $table->string('clave',60);
            $table->string('telefono',15);
            $table->date('fecNac');
            $table->boolean('sexo');
            $table->rememberToken();
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
        Schema::drop('t_usuarios');
    }
}
