<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Asociado;
use Faker\Generator as Faker;

$factory->define(Asociado::class, function (Faker $faker) {

    $nombre = $faker->firstName;
    $apellido_paterno = $faker->lastName;
    $apellido_materno = $faker->lastName;
    $nombre_completo = $nombre.' '.$apellido_paterno.' '.$apellido_materno;

    return [
        'nombre' => $nombre,
        'apellido_paterno' => $apellido_paterno,
        'apellido_materno' => $apellido_materno,
        'fecha_nacimiento' => $faker->firstName,
        'ciudad_nacimiento' => $faker->firstName,
        'estado_nacimiento' => $faker->firstName,
        'genero' => $faker->randomElement(['Femenino', 'Masculino', 'Indistinto']),
        'rfc' => Str::random(10),
        'curp' => Str::random(10),
        'edad' => rand(22,79),
        'tipo_vivienda' => Str::random(10),
        'direccion' => Str::random(10),
        'cp' => Str::random(10),
        'colonia' => $faker->streetName,
        'ciudad' => $faker->city,
        'estado' => $faker->state,
        'celular' => $faker->phoneNumber,
        'puesto' => Str::random(10),
        'fecha_alta' => Str::random(10),
        'escolaridad' => Str::random(10),
        'profesion' => Str::random(10),
        'religion' => Str::random(10),
        'estado_civil' => Str::random(10),
        'clave_elector' => $faker->firstName,
        'folio_ine' => $faker->firstName,
        'ocr' => Str::random(10),
        'numero_tarjeta' => $faker->creditCardNumber,
        'numero_cuenta' => $faker->unixTime,
        'clave_interbancaria' => $faker->creditCardNumber,
        'banco' => Str::random(10),
        'numero_clientes' => rand(10,99),
        // 'nombre_operador' => $faker->name,
    ];
});
