<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use Maatwebsite\Excel\Concerns\FromCollection;

class ProductosExport implements FromView, withEvents
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
                $event->sheet->getStyle('A1:F1')->applyFromArray($headerArray);// Color magenta de titulo y letras blancas
                $sizeOfQueryData = sizeof($this->data) + 1;
                $startToFinishBorders = 'A1' . ':' . 'F' . $sizeOfQueryData;
                $totalColor = 'A' . $sizeOfQueryData . ':' . 'F' . $sizeOfQueryData;
                $event->sheet->getStyle($startToFinishBorders)->applyFromArray($styleArray); // Poner bordes a la tabla
                $event->sheet->getStyle($startToFinishBorders)->getAlignment()->setWrapText(true); // Adjuntar texto
                $event->sheet->getColumnDimension('A')->setWidth(6);//Tamaño de la columna N°
                $event->sheet->getColumnDimension('B')->setWidth(45);//Tamaño de la columna nombre
                $event->sheet->getColumnDimension('C')->setWidth(15);//Tamaño de la columna frecuencia
                $event->sheet->getColumnDimension('D')->setWidth(50);//Tamaño de la columna de tasa
                $event->sheet->getColumnDimension('E')->setWidth(35);//Tamaño de la columna del plazo
                $event->sheet->getColumnDimension('F')->setWidth(15);//Tamaño de la columna del cuenta
                $event->sheet->setAutoFilter($event->sheet->calculateWorksheetDimension()); // Aplicar filtros
            },
        ];
    }

    public function view(): View
    {
        return view('admin.productos.productosexport', [
            'data' => $this->data
        ]);
    }
}
