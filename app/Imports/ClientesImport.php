<?php

namespace App\Imports;

use App\Cliente;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsErrors;
// class ClientesImport implements ToModel
class ClientesImport implements ToModel, WithHeadingRow 

{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
        return new Cliente([
            'user_id'       => $row['user_id'] ?? '1',
            'aval_id'       => $row['aval_id'] ?? '1',
            'asociado_id'   => $row['asociado_id'] ?? '1',
            'cuentas_id'    => $row['cuentas_id'] ?? '1',
            'nombre'        => mb_strtoupper($row['nombre'], 'UTF-8'),
            'apellido_paterno'        => mb_strtoupper($row['apellido_paterno'], 'UTF-8'),
            'apellido_materno'        => mb_strtoupper($row['apellido_materno'], 'UTF-8'),
            // 'fecha_nacimiento'        => $row['fecha_nacimiento'] ?? '',
            'fecha_nacimiento'        => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_nacimiento'])->format('d/m/Y'),
            'ciudad_nacimiento'        => mb_strtoupper($row['ciudad_nacimiento'], 'UTF-8'),
            'estado_nacimiento'        => mb_strtoupper($row['estado_nacimiento'], 'UTF-8'),
            'estados_nacimientos_clave' => $row['estados_nacimientos_clave'] ?? '7',
            'genero' => mb_strtoupper($row['genero'], 'UTF-8') ?? 'x',
            'rfc'        => mb_strtoupper($row['rfc'], 'UTF-8'),
            'curp'        => mb_strtoupper($row['curp'], 'UTF-8'),
            'edad' => $row['edad'] ?? '',
            'tipo_vivienda'        => mb_strtoupper($row['tipo_vivienda'], 'UTF-8'),
            'direccion'        => mb_strtoupper($row['direccion'], 'UTF-8'),
            'anios_residencia' => $row['anios_residencia'] ?? '',
            'referencia'        => mb_strtoupper($row['referencia'], 'UTF-8'),
            'cp' => $row['cp'] ?? '',
            'colonia'        => mb_strtoupper($row['colonia'], 'UTF-8'),
            'ciudad'        => mb_strtoupper($row['ciudad'], 'UTF-8'),
            'estado'        => mb_strtoupper($row['estado'], 'UTF-8'),
            'celular' => $row['celular'] ?? '',
            'fecha_alta' => $row['fecha_alta'],
            'escolaridad'        => mb_strtoupper($row['escolaridad'], 'UTF-8'),
            'profesion'        => mb_strtoupper($row['profesion'], 'UTF-8'),
            'religion'        => mb_strtoupper($row['religion'], 'UTF-8'),
            'estado_civil'        => mb_strtoupper($row['estado_civil'], 'UTF-8'),
            'clave_elector'        => mb_strtoupper($row['clave_elector'], 'UTF-8'),
            'anio_vencimiento_ine' => $row['anio_vencimiento_ine'] ?? '',
            'folio_ine'        => mb_strtoupper($row['folio_ine'], 'UTF-8'),
            'ocr'        => mb_strtoupper($row['ocr'], 'UTF-8'),
            'numero_tarjeta' => $row['numero_tarjeta'] ?? '',
            'numero_cuenta' => $row['numero_cuenta'] ?? '',
            'clave_interbancaria' => $row['clave_interbancaria'] ?? '',
            'banco'        => mb_strtoupper($row['banco'], 'UTF-8'),
            'tipo_cliente' => $row['tipo_cliente'] ?? 'Nuevo',
            'nacionalidad'        => mb_strtoupper($row['nacionalidad'], 'UTF-8'),
            'tipo_vialidad' => $row['tipo_vialidad'] ?? '',
            'entre_calles'        => mb_strtoupper($row['entre_calles'], 'UTF-8'),
        ]);
    }
}
