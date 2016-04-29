<?php
/**
*@author: Qsoto
*/
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class TUsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
	    DB::table('t_usuarios') -> insert([
        'cedula'=>$faker->unique()->randomNumber($nbDigits=8),
        'username'=>env('APP_DEV_USERNAME', 'colmenadevteam'),
        'nombres'=>'Colmena',
        'apellidos'=>'Dev Team',
        'tipUsu'=>'Administrativo',
        'email'=>'devteam@colmena.uptaeb.edu.ve',
        'clave'=>Hash::make("0000"),
        'telefono'=>$faker->randomNumber($nbDigits=9),
        'fecNac'=>$faker->unique()->date($format = 'Y-m-d', $max = 'now'),
        'sexo'=>$faker->boolean($chanceOfGettingTrue = 50),
        'created_at'=>Carbon::now(),
        'updated_at'=>Carbon::now()
    	]);
    }
}
