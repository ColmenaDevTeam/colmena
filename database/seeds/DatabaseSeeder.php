<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('TUsuariosSeeder');
        $this->call('TAccionesSeeder');
        $this->call('TRolesSeeder');
        $this->call('TAutorizacionesSeeder');
        $this->call('TRoleUsuasSeeder');
    }
}
