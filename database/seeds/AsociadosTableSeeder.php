<?php

use Illuminate\Database\Seeder;

class AsociadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Asociado::class, 20)->create();
    }
}
