<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;

class ExportFiles implements FromCollection, WithHeadings, WithEvents, ShouldAutoSize
{
    protected $myDatas, $myHeadings, $myTitle;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($myDatas, $myHeadings, $myTitle){
        $this->myDatas = $myDatas;
        $this->myHeadings = $myHeadings;
        $this->myTitle = $myTitle;
    }

    public function properties(): array
    {
        return [
            'creator'        => 'STR Furniture Co,.LTD',
            'title'          => $this->myTitle. ' Export',
            'description'    => $this->myTitle.' List export to excel',
            'subject'        => $this->myTitle,
            'company'        => 'STR Furniture Co,.LTD',
        ];
    }

    public function collection()
    {
        return $this->myDatas;
    }

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
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:Z1'; // All headers
                $event->sheet->getDelegate()->getStyle('A:Z')->getFont()->setSize(13)->setName('Hanuman');
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14)->setName('Hanuman');
                $event->sheet->getDelegate()->getRowDimension(1)->setRowHeight(30);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);
                $event->sheet->getDelegate()->getStyle('A:Z')->getAlignment()->setHorizontal('center');
                $event->sheet->getDelegate()->getStyle('A:Z')->getAlignment()->setVertical('center');
            },
        ];
    }
}
