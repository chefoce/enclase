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

//Alumno
$alumno = $documento->getActiveSheet();
$alumno->getStyle('A')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$alumno->getStyle('B')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$alumno->getStyle('C')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$alumno->getStyle('D')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$alumno->getStyle('E')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$alumno->getStyle('F')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$alumno->getStyle('G')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$alumno->getStyle('H')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$alumno->getStyle('I')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$alumno->mergeCells('A1:I1'); 
$alumno->setCellValue('A1', 'ALUMNO');
$alumno->setCellValue('A2', 'NOMBRE(S) ALUMNO');
$alumno->setCellValue('B2', 'APELLIDO(S) ALUMNO');
$alumno->setCellValue('C2', 'MATRICULA');
$alumno->setCellValue('D2', 'EMAIL');
$alumno->setCellValue('E2', 'PASSWORD');
$alumno->setCellValue('F2', 'TELEFONO');
$alumno->setCellValue('G2', 'FECHA INGRESO');
$alumno->setCellValue('H2', 'FECHA NACIMIENTO');
$alumno->setCellValue('I2', 'CARRERA ID');
$alumno->getStyle('A1:I2')->applyFromArray($encabezados);
$alumno->getStyle('A1:I2')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);  

$alumno->getColumnDimension('A')->setWidth(40);
$alumno->getColumnDimension('B')->setWidth(40);
$alumno->getColumnDimension('C')->setWidth(20);
$alumno->getColumnDimension('D')->setWidth(40);
$alumno->getColumnDimension('E')->setWidth(20);
$alumno->getColumnDimension('F')->setWidth(20);
$alumno->getColumnDimension('G')->setWidth(20);
$alumno->getColumnDimension('H')->setWidth(20);
$alumno->getColumnDimension('I')->setWidth(20);
$alumno->setTitle('PRINCIPAL');

///Carrera
$alumno->mergeCells('K1:L1');  
$alumno->setCellValue('K1', 'CARRERA');
$alumno->setCellValue('K2', 'ID');
$alumno->setCellValue('L2', 'CARRERA');
$alumno->getStyle('K1:L2')->applyFromArray($encabezados);
$query = $conn->query("SELECT * FROM carrera");
if($query->num_rows > 0) {
    $i = 3;
    while($row = $query->fetch_assoc()) {
        $alumno->setCellValue('K'.$i , $row['id_carrera']);
        $alumno->getStyle('K'.$i )->applyFromArray($campos);
        $alumno->setCellValue('L'.$i , $row['carrera']);
        $alumno->getStyle('L'.$i )->applyFromArray($campos);
        $i++;
    }
}
$alumno->getColumnDimension('K')->setAutoSize(true);
$alumno->getColumnDimension('L')->setAutoSize(true);

$documento->getActiveSheet()->getProtection()->setSheet(true);

$writer = new Xlsx($documento);

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment;filename=\"ENCLASE-alumno.xlsx\"");
header("Cache-Control: max-age=0");
header("Cache-Control: cache, must-revalidate");
header("Pragma: public");
$writer->save("php://output");
?>