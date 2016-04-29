<?php
/**
* @author: Qsoto
*/
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class FakerUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i = 0; $i < 10; $i++){
            $cedula = $faker->unique()->randomNumber($nbDigits=8);
    	    DB::table('t_usuarios') -> insert([

                'cedula'=>$cedula,
                'username'=>$cedula,
                'nombres'=>$faker->name(),
                'apellidos'=>$faker->lastName(),
                'tipUsu'=>'Administrativo',
                'email'=>$faker->email(),
                'clave'=>Hash::make("0000"),
                'telefono'=>$faker->randomNumber($nbDigits=9),
                'fecNac'=>$faker->unique()->date($format = 'Y-m-d', $max = 'now'),
                'sexo'=>$faker->boolean($chanceOfGettingTrue = 50),
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
        	]);
        }
    }
}
