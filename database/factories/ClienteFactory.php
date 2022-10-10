<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cliente;
use Faker\Generator as Faker;

$factory->define(Cliente::class, function (Faker $faker) {

    $nombre = $faker->firstName;
    $apellido_paterno = $faker->lastName;
    $apellido_materno = $faker->lastName;

    return [
        // 'user_id' => rand(1,20), // \App\User::all()->random()->id,
        // 'cliente_id' => rand(1,20), // \App\Cliente::all()->random()->id,
        'asociado_id' => rand(1,20), // \App\Asociado::all()->random()->id,

        // 'numero_operador' => rand(1,20),
        // 'nombre_operador' => $faker->name,
        // 'numero_asociado' => rand(1,20),
        // 'nombre_asociado' => $faker->name,
        // 'numero_cliente' => rand(1,20),

        'nombre' => $nombre,
        'apellido_paterno' => $apellido_paterno,
        'apellido_materno' => $apellido_materno,
        'rfc' => Str::random(10),
        'curp' => Str::random(10),
    ];
});
