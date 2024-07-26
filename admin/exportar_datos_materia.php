<?php
include('../config/constants.php'); 
require_once "../vendor/autoload.php";
  
use PhpOffice\PhpSpreadsheet\Spreadsheet; 
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$documento = new Spreadsheet(); 
$encabezados = [
    'font' => [
        'bold' => true,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];
$campos = [
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

$materia = $documento->getActiveSheet();
$materia->getStyle('A')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$materia->getStyle('B')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$materia->mergeCells('A1:B1');
$materia->setCellValue('A1', 'MATERIA'); 
$materia->setCellValue('A2', 'NOMBRE');
$materia->setCellValue('B2', 'SEMESTRE');
$materia->getStyle('A1:B2')->applyFromArray($encabezados);
$materia->getStyle('A1:B2')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);  

$materia->getColumnDimension('A')->setWidth(40);
$materia->getColumnDimension('B')->setWidth(20);
$materia->setTitle('PRINCIPAL');

$documento->getActiveSheet()->getProtection()->setSheet(true);

$writer = new Xlsx($documento);

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment;filename=\"ENCLASE-materia.xlsx\"");
header("Cache-Control: max-age=0");
header("Cache-Control: cache, must-revalidate");
header("Pragma: public");
$writer->save("php://output");
?>