<?php

use Illuminate\Database\Seeder;

class PuestoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $puestos = [
            ['puesto' => 'Socio Fundador', 'areas_id' => '1', 'sueldo_inicial' => 1000, 'sueldo_final' => 10000, 'comisiones' => 0],
            ['puesto' => 'Operador de Asociado', 'areas_id' => '2', 'sueldo_inicial' =>  6000, 'sueldo_final' => 12000, 'comisiones' => 0],
            ['puesto' => 'Asociado', 'areas_id' => '2', 'sueldo_inicial' => 10, 'sueldo_final' => 20, 'comisiones' => 150],
            ['puesto' => 'Administrador', 'areas_id' => '3', 'sueldo_inicial' => 3000, 'sueldo_final' => 8000, 'comisiones' => 0],
            ['puesto' => 'Contador', 'areas_id' => '3', 'sueldo_inicial' => 3000, 'sueldo_final' => 8000, 'comisiones' => 0],
            // ['puesto' => '', 'area' => '', 'sueldo_inicial' => '', 'sueldo_final' => '', 'comisiones' => ''],
        ];
        foreach($puestos as $puesto) {
            App\Puesto::create($puesto);
        }
    }
}
