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

///Docente/MAteria
$docente_materia = $documento->getActiveSheet();
$docente_materia->getStyle('A')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$docente_materia->getStyle('B')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$docente_materia->getStyle('C')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$docente_materia->getStyle('D')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$docente_materia->mergeCells('A1:D1');  
$docente_materia->setCellValue('A1', 'DOCENTE MATERIA');
$docente_materia->setCellValue('A2', 'DOCENTE ID');
$docente_materia->setCellValue('B2', 'GRUPO ID');
$docente_materia->setCellValue('C2', 'MATERIA ID');
$docente_materia->setCellValue('D2', 'PERIODO ID');  
$docente_materia->getStyle('A1:D2')->applyFromArray($encabezados);
$docente_materia->getStyle('A1:D2')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);


$docente_materia->getColumnDimension('A')->setWidth(20);
$docente_materia->getColumnDimension('B')->setWidth(20);
$docente_materia->getColumnDimension('C')->setWidth(20);
$docente_materia->getColumnDimension('D')->setWidth(20);
$docente_materia->getColumnDimension('E')->setWidth(2);
$docente_materia->getColumnDimension('I')->setWidth(2);
$docente_materia->getColumnDimension('L')->setWidth(2);
$docente_materia->getColumnDimension('P')->setWidth(2);
$docente_materia->setTitle('PRINCIPAL');

///Docentes
$docente_materia->mergeCells('F1:H1');  
$docente_materia->setCellValue('F1', 'DOCENTES');
$docente_materia->setCellValue('F2', 'ID');
$docente_materia->setCellValue('G2', 'NOMBRE(S)');
$docente_materia->setCellValue('H2', 'APELLIDO(S)');
$docente_materia->getStyle('F1:H2')->applyFromArray($encabezados);
$query = $conn->query("SELECT * FROM docente WHERE activo = 1");
if($query->num_rows > 0) {
    $i = 3;
    while($row = $query->fetch_assoc()) {
        $docente_materia->setCellValue('F'.$i , $row['id_docente']);
        $docente_materia->getStyle('F'.$i )->applyFromArray($campos);
        $docente_materia->setCellValue('G'.$i , $row['nombre']);
        $docente_materia->getStyle('G'.$i )->applyFromArray($campos);
        $docente_materia->setCellValue('H'.$i , $row['apellido']);
        $docente_materia->getStyle('H'.$i )->applyFromArray($campos);
        $i++;
    }
}
$docente_materia->getColumnDimension('F')->setAutoSize(true);
$docente_materia->getColumnDimension('G')->setAutoSize(true);
$docente_materia->getColumnDimension('H')->setAutoSize(true);

///Grupos
$docente_materia->mergeCells('J1:K1');  
$docente_materia->setCellValue('J1', 'GRUPOS');
$docente_materia->setCellValue('J2', 'ID');
$docente_materia->setCellValue('K2', 'NOMBRE');
$docente_materia->getStyle('J1:K2')->applyFromArray($encabezados);
$query = $conn->query("SELECT * FROM grupo WHERE activo = 1");
if($query->num_rows > 0) {
    $i = 3;
    while($row = $query->fetch_assoc()) {
        $docente_materia->setCellValue('J'.$i , $row['id_grupo']);
        $docente_materia->getStyle('J'.$i )->applyFromArray($campos);
        $docente_materia->setCellValue('K'.$i , $row['nombre']);
        $docente_materia->getStyle('K'.$i )->applyFromArray($campos);
        $i++;
    }
}
$docente_materia->getColumnDimension('J')->setAutoSize(true);
$docente_materia->getColumnDimension('K')->setAutoSize(true);

///Materia
$docente_materia->mergeCells('M1:O1');  
$docente_materia->setCellValue('M1', 'MATERIAS');
$docente_materia->setCellValue('M2', 'ID');
$docente_materia->setCellValue('N2', 'NOMBRE');
$docente_materia->setCellValue('O2', 'SEMESTRE');
$docente_materia->getStyle('M1:O2')->applyFromArray($encabezados);
$query = $conn->query("SELECT * FROM materia WHERE activo = 1 ORDER BY nombre ASC");
if($query->num_rows > 0) {
    $i = 3;
    while($row = $query->fetch_assoc()) {
        $docente_materia->setCellValue('M'.$i , $row['id_materia']);
        $docente_materia->getStyle('M'.$i )->applyFromArray($campos);
        $docente_materia->setCellValue('N'.$i , $row['nombre']);
        $docente_materia->getStyle('N'.$i )->applyFromArray($campos);
        $docente_materia->setCellValue('O'.$i , $row['semestre']);
        $docente_materia->getStyle('O'.$i )->applyFromArray($campos);
        $i++;
    }
}
$docente_materia->getColumnDimension('M')->setAutoSize(true);
$docente_materia->getColumnDimension('N')->setAutoSize(true);
$docente_materia->getColumnDimension('O')->setAutoSize(true);

///Periodos
$docente_materia->mergeCells('Q1:R1');  
$docente_materia->setCellValue('Q1', 'PERIODOS');
$docente_materia->setCellValue('Q2', 'ID');
$docente_materia->setCellValue('R2', 'NOMBRE');
$docente_materia->getStyle('Q1:R2')->applyFromArray($encabezados);
$query = $conn->query("SELECT * FROM periodo WHERE activo = 1");
if($query->num_rows > 0) {
    $i = 3;
    while($row = $query->fetch_assoc()) {
        $docente_materia->setCellValue('Q'.$i , $row['id_periodo']);
        $docente_materia->getStyle('Q'.$i )->applyFromArray($campos);
        $docente_materia->setCellValue('R'.$i , $row['nombre']);
        $docente_materia->getStyle('R'.$i )->applyFromArray($campos);
        $i++;
    }
}
$docente_materia->getColumnDimension('Q')->setAutoSize(true);
$docente_materia->getColumnDimension('R')->setAutoSize(true);

$documento->getActiveSheet()->getProtection()->setSheet(true);

$writer = new Xlsx($documento);

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment;filename=\"ENCLASE-docente-materia.xlsx\"");
header("Cache-Control: max-age=0");
header("Cache-Control: cache, must-revalidate");
header("Pragma: public");
$writer->save("php://output");
?>