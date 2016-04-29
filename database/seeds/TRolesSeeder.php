<?php
/**
*@author Victor Hidalgo @konh
*/
use Illuminate\Database\Seeder;
class TRolesSeeder extends seeder {
    public function run() {
        $roles = array(
            array('nombre' => 'Administrador'),
            array('nombre' => 'Jefe de Departamento'),
            array('nombre' => 'Asis Administrativo'),
            array('nombre' => 'Docente')
            );
        DB::table('t_roles')->insert($roles);
    }
}
