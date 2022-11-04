<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use Maatwebsite\Excel\Concerns\FromCollection;

class AsociadosExport implements FromView, withEvents
{
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $headerArray = [
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                        'color' => [
                            'argb' => 'FFFFFFFF'
                        ]
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'rotation' => 90,
                        'color' => [
                            'argb' => '337286',
                        ],
                    ],
                ];
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ];
                $event->sheet->getStyle('A1:K1')->applyFromArray($headerArray);// Color magenta de titulo y letras blancas
                $sizeOfQueryData = sizeof($this->data) + 1;
                $startToFinishBorders = 'A1' . ':' . 'K' . $sizeOfQueryData;
                $totalColor = 'A' . $sizeOfQueryData . ':' . 'K' . $sizeOfQueryData;
                $event->sheet->getStyle($startToFinishBorders)->applyFromArray($styleArray); // Poner bordes a la tabla
                $event->sheet->getStyle($startToFinishBorders)->getAlignment()->setWrapText(true); // Adjuntar texto
                $event->sheet->getColumnDimension('A')->setWidth(6);//Tamaño de la columna N°
                $event->sheet->getColumnDimension('B')->setWidth(30);//Tamaño de la columna numero ruta
                $event->sheet->getColumnDimension('C')->setWidth(55);//Tamaño de la columna nombre
                $event->sheet->getColumnDimension('D')->setWidth(20);//Tamaño de la columna fecha de nacimiento
                $event->sheet->getColumnDimension('E')->setWidth(20);//Tamaño de la columna del genero
                $event->sheet->getColumnDimension('F')->setWidth(30);//Tamaño de la columna del curp
                $event->sheet->getColumnDimension('G')->setWidth(25);//Tamaño de la columna del ciudad
                $event->sheet->getColumnDimension('H')->setWidth(25);//Tamaño de la columna del Estado
                $event->sheet->getColumnDimension('I')->setWidth(10);//Tamaño de la columna del cp
                $event->sheet->getColumnDimension('J')->setWidth(30);//Tamaño de la columna del direccion
                $event->sheet->getColumnDimension('K')->setWidth(15);//Tamaño de la columna del celular
                $event->sheet->setAutoFilter($event->sheet->calculateWorksheetDimension()); // Aplicar filtros
            },
        ];
    }

    public function view(): View
    {
        return view('admin.asociados.asociadosexport', [
            'data' => $this->data
        ]);
    }
}
