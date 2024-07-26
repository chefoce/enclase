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

$docente = $documento->getActiveSheet();
$docente->getStyle('A')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$docente->getStyle('B')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$docente->getStyle('C')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$docente->getStyle('D')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$docente->getStyle('E')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$docente->mergeCells('A1:E1');
$docente->setCellValue('A1', 'DOCENTE');
$docente->setCellValue('A2', 'NOMBRE(S)');
$docente->setCellValue('B2', 'APELLIDO(S)');
$docente->setCellValue('C2', '# EMPLEADO');
$docente->setCellValue('D2', 'EMAIL');
$docente->setCellValue('E2', 'PASSWORD');
$docente->getStyle('A1:E2')->applyFromArray($encabezados);
$docente->getStyle('A1:E2')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);  

$docente->getColumnDimension('A')->setWidth(40);
$docente->getColumnDimension('B')->setWidth(40);
$docente->getColumnDimension('C')->setWidth(20);
$docente->getColumnDimension('D')->setWidth(40);
$docente->getColumnDimension('E')->setWidth(20);
$docente->setTitle('PRINCIPAL');

$documento->getActiveSheet()->getProtection()->setSheet(true);

$writer = new Xlsx($documento);

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment;filename=\"ENCLASE-docente.xlsx\"");
header("Cache-Control: max-age=0");
header("Cache-Control: cache, must-revalidate");
header("Pragma: public");
$writer->save("php://output");
?>