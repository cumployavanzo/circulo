<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use Maatwebsite\Excel\Concerns\FromCollection;

class ClientesExport implements FromView, withEvents
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
                $event->sheet->getStyle('A1:L1')->applyFromArray($headerArray);// Color magenta de titulo y letras blancas
                $sizeOfQueryData = sizeof($this->data) + 1;
                $startToFinishBorders = 'A1' . ':' . 'L' . $sizeOfQueryData;
                $totalColor = 'A' . $sizeOfQueryData . ':' . 'L' . $sizeOfQueryData;
                $event->sheet->getStyle($startToFinishBorders)->applyFromArray($styleArray); // Poner bordes a la tabla
                $event->sheet->getStyle($startToFinishBorders)->getAlignment()->setWrapText(true); // Adjuntar texto
                $event->sheet->getColumnDimension('A')->setWidth(6);//Tamaño de la columna N°
                $event->sheet->getColumnDimension('B')->setWidth(15);//Tamaño de la columna Fecha de alta cliente
                $event->sheet->getColumnDimension('C')->setWidth(55);//Tamaño de la columna del Nombre completo
                $event->sheet->getColumnDimension('D')->setWidth(50);//Tamaño de la columna del Asociado
                $event->sheet->getColumnDimension('E')->setWidth(15);//Tamaño de la columna del Telefono
                $event->sheet->getColumnDimension('F')->setWidth(25);//Tamaño de la columna del Monto autorizado
                $event->sheet->getColumnDimension('G')->setWidth(10);//Tamaño de la columna del Monto Ciclo
                $event->sheet->getColumnDimension('H')->setWidth(20);//Tamaño de la columna del NUM cuenta
                $event->sheet->getColumnDimension('I')->setWidth(20);//Tamaño de la columna del Nombre cuenta contable
                $event->sheet->getColumnDimension('J')->setWidth(20);//Tamaño de la columna del Numero cuenta contable
                $event->sheet->getColumnDimension('K')->setWidth(55);//Tamaño de la columna del Aval
                $event->sheet->getColumnDimension('L')->setWidth(15);//Tamaño de la columna del Tel aval
                $event->sheet->setAutoFilter($event->sheet->calculateWorksheetDimension()); // Aplicar filtros
            },
        ];
    }

    public function view(): View
    {
        return view('admin.reportes.clientesexport', [
            'data' => $this->data
        ]);
    }
}
