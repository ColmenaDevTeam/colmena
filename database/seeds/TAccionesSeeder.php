<?php
/**
*@author Victor Hidalgo @konh
*/
use Illuminate\Database\Seeder;
class TAccionesSeeder extends Seeder
{
  public function run(){
    $action = array(
        array('nombre' => 'roles.registrar', 'navegacion' => true),
        array('nombre' => 'roles.modificar', 'navegacion' => false),
        array('nombre' => 'roles.listar', 'navegacion' => true),
        array('nombre' => 'roles.eliminar', 'navegacion' => false),

        array('nombre' => 'usuarios.registrar', 'navegacion' => true),
        array('nombre' => 'usuarios.modificar', 'navegacion' => false),
        array('nombre' => 'usuarios.listar', 'navegacion' => true),
        array('nombre' => 'usuarios.eliminar', 'navegacion' => false),

        array('nombre' => 'tareas.registrar', 'navegacion' => true),
        array('nombre' => 'tareas.modificar', 'navegacion' => false),
        array('nombre' => 'tareas.listar', 'navegacion' => true),
        array('nombre' => 'tareas.eliminar', 'navegacion' => false),


        array('nombre' => 'permisos_y_reposos.eliminar', 'navegacion' => false),
        array('nombre' => 'permisos_y_reposos.registrar', 'navegacion' => true),
        array('nombre' => 'permisos_y_reposos.modificar', 'navegacion' => false),
        array('nombre' => 'permisos_y_reposos.listar', 'navegacion' => true),

        //Desde la version 0.5.0A
        array('nombre' => 'calendario.actualizar', 'navegacion' => true),

        //Desde la version 0.6.0A
        array('nombre' => 'actividades_recurrentes.registrar', 'navegacion' => true),
        array('nombre' => 'actividades_recurrentes.modificar', 'navegacion' => false),
        array('nombre' => 'actividades_recurrentes.listar', 'navegacion' => true),
        array('nombre' => 'actividades_recurrentes.eliminar', 'navegacion' => false),
        );
    DB::table('t_acciones')->insert($action);
  }
}
