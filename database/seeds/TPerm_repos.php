<?php
/**
*@author: Konh
*/
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Colmena\Cusuario as Cusuario;

class TPerm_repos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $idUsu = CUsuario::lists('idUsu')->All();

    	for ($i=0; $i < 1; $i++)
    	{
	    	DB::table('t_perm_repos') -> insert([

            'perRep'=>$faker->boolean($chanceOfGettingTrue = 50),
            'fecIni'=>$faker->unique()->date($format = 'Y-m-d', $max = 'now'),
            'fecFin'=>$faker->unique()->date($format = 'Y-m-d', $max = 'now'),
	        'detalle'=>'pan tostado con queso y jugo de naranja :D',
            'idUsu' => $faker->randomElement($idUsu)
            'created_at'=>$faker->date($format = 'Y-m-d', $max = 'now'),
            'updated_at'=>$faker->date($format = 'Y-m-d', $max = 'now')
	    	]);
    	}
    }
}
