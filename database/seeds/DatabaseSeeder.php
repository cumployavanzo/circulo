<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(PuestoTableSeeder::class);
        $this->call(AsociadosTableSeeder::class);
        $this->call(ClientesTableSeeder::class);
        $this->call(SolicitudesTableSeeder::class);
    }
}
