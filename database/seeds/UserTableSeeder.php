<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'personals_id' => '1',
            'email' => 'anahi@gmail.com',
            'password' => Hash::make('12345'),
        ]);

        factory(App\User::class, 20)->create();
    }
}
