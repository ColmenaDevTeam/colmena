<?php
/**
* @author Elias D. Peraza @tesoner
*/
use Illuminate\Database\Seeder;
//use Faker\Factory as Faker;
use Colmena\Crol as Crol;
//use Colmena\Caccion as Caccion;

class TAutorizacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Orol = Crol::find(1);
        $acciones = [
            'roles.registrar',
            'roles.modificar',
            'roles.listar',
            'roles.eliminar',
            'usuarios.registrar',
            'usuarios.modificar',
            'usuarios.listar',
            'usuarios.eliminar'
        ];
        $i=1;
        foreach($acciones as $accion){
        	DB::table('t_autorizaciones') -> insert([
        	'idRol' => $Orol->idRol,
        	'idAcc' => $i
        	]);
            $i+=1;
        }
    }
}
