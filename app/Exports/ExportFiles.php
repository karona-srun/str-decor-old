<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ExportFiles implements FromView, WithHeadings,  ShouldAutoSize, WithEvents
{

    protected $myDatas, $myHeadings, $myTitle, $option;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($option,$myDatas, $myHeadings, $myTitle)
    {
        $this->option = $option;
        $this->myDatas = $myDatas;
        $this->myHeadings = $myHeadings;
        $this->myTitle = $myTitle;
    }

    public function view(): View
    {
        $view = '';
        if($this->option == 'expend'){
            $view = 'view_export_expend';
        }else{
            $view = 'view_export_income';
        }

        return view('partials.'.$view, [
            'datas' => $this->myDatas
        ]);
    }
    // public function properties(): array
    // {
    //     return [
    //         'creator'        => 'STR Furniture Co,.LTD',
    //         'title'          => $this->myTitle. ' Export',
    //         'description'    => $this->myTitle.' List export to excel',
    //         'subject'        => $this->myTitle,
    //         'company'        => 'STR Furniture Co,.LTD',
    //     ];
    // }

    // public function collection()
    // {
    //     return $this->myDatas;
    // }

    public function headings(): array
    {
        return $this->myHeadings;
    }

    public function ShouldAutoSize()
    {
        return true;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function (AfterSheet $event) {

                $active_sheet = $event->sheet->getDelegate();

                $styleArray = [
                    'font' => [
                        'size' => 12,
                        'name' => 'Khmer OS System',
                        'bold' => true,
                        'color' => [
                            'argb' => 'FFFFFF'
                        ]
                    ],
                    'fill' => [
                        'color' => [
                            'argb' => '808080'
                        ],
                        'fillType' => Fill::FILL_SOLID
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ];
                $active_sheet->getStyle('A1:F1')->applyFromArray($styleArray);

                $active_sheet->getDefaultRowDimension()->setRowHeight(50, 'px');

                // Create Style Arrays
                $default_font_style = [
                    'font' => ['name' => 'Khmer OS System', 'size' => 12]
                ];

                $strikethrough = [
                    'font' => ['strikethrough' => true],
                ];

                // Get Worksheet
                $active_sheet = $event->sheet->getDelegate();

                // Apply Style Arrays
                $active_sheet->getParent()->getDefaultStyle()->applyFromArray($default_font_style);

                // strikethrough group of cells (A10 to B12) 
                $active_sheet->getStyle('A10:B12')->applyFromArray($strikethrough);
                // or
                $active_sheet->getStyle('A10:B12')->getFont()->setStrikethrough(true);

                // single cell
                $active_sheet->getStyle('A13')->getFont()->setStrikethrough(true);
            },
        ];
    }
}
