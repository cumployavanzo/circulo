<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use Maatwebsite\Excel\Concerns\FromCollection;

class PrestamosExport implements FromView, withEvents
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
                $event->sheet->getStyle('A1:H1')->applyFromArray($headerArray);// Color magenta de titulo y letras blancas
                $sizeOfQueryData = sizeof($this->data) + 1;
                $startToFinishBorders = 'A1' . ':' . 'H' . $sizeOfQueryData;
                $totalColor = 'A' . $sizeOfQueryData . ':' . 'H' . $sizeOfQueryData;
                $event->sheet->getStyle($startToFinishBorders)->applyFromArray($styleArray); // Poner bordes a la tabla
                $event->sheet->getStyle($startToFinishBorders)->getAlignment()->setWrapText(true); // Adjuntar texto
                $event->sheet->getColumnDimension('A')->setWidth(20);//Tamaño de la columna Fecha del prestamo
                $event->sheet->getColumnDimension('B')->setWidth(55);//Tamaño de la columna del Nombre del empleado
                $event->sheet->getColumnDimension('C')->setWidth(55);//Tamaño de la columna de Concepto
                $event->sheet->getColumnDimension('D')->setWidth(25);//Tamaño de la columna de Monto del prestamo
                $event->sheet->getColumnDimension('E')->setWidth(20);//Tamaño de la columna de Monto descontado
                $event->sheet->getColumnDimension('F')->setWidth(20);//Tamaño de la columna de Saldo
                $event->sheet->getColumnDimension('G')->setWidth(20);//Tamaño de la columna de Plazo
                $event->sheet->getColumnDimension('H')->setWidth(20);//Tamaño de la columna de Pagos descontados
                $event->sheet->setAutoFilter($event->sheet->calculateWorksheetDimension()); // Aplicar filtros
            },
        ];
    }

    public function view(): View
    {
        return view('admin.prestamos_personal.prestamosexport', [
            'data' => $this->data
        ]);
    }
}
