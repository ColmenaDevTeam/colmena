<?php
/**
* @author QSoto
*/
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Colmena\Crol as Crol;
use Colmena\Cusuario as Cusuario;

class TRoleUsuasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Crol::find(1);
        $usuario = Cusuario::find(1);
    	DB::table('t_role_usuas') -> insert([
        	'idRol' => $role->idRol,
        	'idUsu' => $usuario->idUsu
    	]);
    }
}
