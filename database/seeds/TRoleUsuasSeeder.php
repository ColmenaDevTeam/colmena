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
        $roles = Crol::all();
        $usuario = Cusuario::find(1);
        foreach ($roles as $role) {
        	DB::table('t_role_usuas') -> insert([
            	'idRol' => $role->idRol,
            	'idUsu' => $usuario->idUsu
        	]);
        }
    }
}
