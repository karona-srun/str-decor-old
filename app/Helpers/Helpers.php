<?php

namespace App\Helpers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class Helpers
{
    public static function shout(string $string)
    {
        return strtoupper($string);
    }


    public static function exportExcel($datas, $headers, $fileName) 
    {
            $LetterCell = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
            $rangCell = "Z";
            $dataArray[] = $headers;

            $rangCell = @$LetterCell[count($dataArray[0])-1] ? $LetterCell[count($dataArray[0])-1] : "Z";

            $spreadSheet = new Spreadsheet();
            $spreadSheet->createSheet();
            $workSheet = new Worksheet($spreadSheet, 'export_sheet');
            $spreadSheet->addSheet($workSheet, 0);

            $i = 1;
            foreach($datas as $data){
                $data = (array) $data;
                if(isset($data['id'])){
                    $data['id'] = $i;
                }
                $dataArray[] = $data;
                ++$i;
            };

            $workSheet->fromArray(
                $dataArray,
                null,
                'A1'
            );

            $spreadSheet->getDefaultStyle()->getFont()->setName('Khmer OS System');
            $spreadSheet->getDefaultStyle()->getFont()->setSize(12);
            $workSheet->getDefaultRowDimension()->setRowHeight(50, 'px');
            
            for ($i = 'A'; $i!='Z'; $i++){
                $workSheet->getColumnDimension($i)->setAutoSize(TRUE);
            }

            $styleArray = [
                'font'=>[
                    'bold' => true,
                    'color' => [
                        'argb'=> 'FFFFFF'
                    ]
                ],
                'fill' => [
                    'color' => [
                        'argb' => '808080'
                    ],
                    'fillType' => Fill::FILL_SOLID
                ]
            ];
            $workSheet->getStyle('A1:'.$rangCell.'1')->applyFromArray($styleArray);

            $styleArray1 = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical'=> Alignment::VERTICAL_CENTER,
                ],
                'font' => [

                ]
            ];
            $workSheet->getStyle('A1:'.$rangCell.count($dataArray))->applyFromArray($styleArray1);

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename='.$fileName.".xlsx");
            header('Cache-Control: max-age=0');

            $writer = IOFactory::createWriter($spreadSheet, 'Xlsx');
            $writer->save('php://output');
    }
}
