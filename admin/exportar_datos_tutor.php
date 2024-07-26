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

///Tutor
$tutor = $documento->getActiveSheet();
$tutor->getStyle('A')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$tutor->getStyle('B')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$tutor->getStyle('C')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$tutor->getStyle('D')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$tutor->getStyle('E')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$tutor->getStyle('F')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$tutor->mergeCells('A1:F1');  
$tutor->setCellValue('A1', 'TUTOR');
$tutor->setCellValue('A2', 'NOMBRE TUTOR');
$tutor->setCellValue('B2', 'APELLIDO TUTOR');
$tutor->setCellValue('C2', 'EMAIL');
$tutor->setCellValue('D2', 'PASSWORD');  
$tutor->setCellValue('E2', 'TELEFONO');  
$tutor->setCellValue('F2', 'ALUMNO ID');  
$tutor->getStyle('A1:F2')->applyFromArray($encabezados);
$tutor->getStyle('A1:F2')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);  

$tutor->getColumnDimension('A')->setWidth(40);
$tutor->getColumnDimension('B')->setWidth(40);
$tutor->getColumnDimension('C')->setWidth(40);
$tutor->getColumnDimension('D')->setWidth(20);
$tutor->getColumnDimension('E')->setWidth(20);
$tutor->getColumnDimension('F')->setWidth(20);
$tutor->setTitle('PRINCIPAL');

///Alumnos
$tutor->mergeCells('H1:K1');  
$tutor->setCellValue('H1', 'ALUMNOS');
$tutor->setCellValue('H2', 'ID');
$tutor->setCellValue('I2', 'NOMBRE(S)');
$tutor->setCellValue('J2', 'APELLIDO(S)');
$tutor->setCellValue('K2', 'MATRICULA');
$tutor->getStyle('H1:K2')->applyFromArray($encabezados);
$query = $conn->query("SELECT * FROM alumno WHERE activo = 1");
if($query->num_rows > 0) {
    $i = 3;
    while($row = $query->fetch_assoc()) {
        $tutor->setCellValue('H'.$i , $row['id_alumno']);
        $tutor->getStyle('H'.$i )->applyFromArray($campos);
        $tutor->setCellValue('I'.$i , $row['nombre']);
        $tutor->getStyle('I'.$i )->applyFromArray($campos);
        $tutor->setCellValue('J'.$i , $row['apellido']);
        $tutor->getStyle('J'.$i )->applyFromArray($campos);
        $tutor->setCellValue('K'.$i , $row['matricula']);
        $tutor->getStyle('K'.$i )->applyFromArray($campos);
        $i++;
    }
}
$tutor->getColumnDimension('H')->setAutoSize(true);
$tutor->getColumnDimension('I')->setAutoSize(true);
$tutor->getColumnDimension('J')->setAutoSize(true);
$tutor->getColumnDimension('K')->setAutoSize(true);

$documento->getActiveSheet()->getProtection()->setSheet(true);

$writer = new Xlsx($documento);

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment;filename=\"ENCLASE-tutor.xlsx\"");
header("Cache-Control: max-age=0");
header("Cache-Control: cache, must-revalidate");
header("Pragma: public");
$writer->save("php://output");