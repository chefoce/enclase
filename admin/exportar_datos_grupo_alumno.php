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
$alumno_grupo = $documento->getActiveSheet();
$alumno_grupo->getStyle('A')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$alumno_grupo->getStyle('B')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);

$alumno_grupo->mergeCells('A1:B1');  
$alumno_grupo->setCellValue('A1', 'GRUPO ALUMNO');
$alumno_grupo->setCellValue('A2', 'ALUMNO ID');
$alumno_grupo->setCellValue('B2', 'GRUPO ID'); 
$alumno_grupo->getStyle('A1:B2')->applyFromArray($encabezados);
$alumno_grupo->getStyle('A1:B2')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);

$alumno_grupo->getColumnDimension('A')->setWidth(20);
$alumno_grupo->getColumnDimension('B')->setWidth(20);
$alumno_grupo->setTitle('PRINCIPAL');

///ALUMNOS
$alumno_grupo->mergeCells('D1:G1');  
$alumno_grupo->setCellValue('D1', 'ALUMNOS');
$alumno_grupo->setCellValue('D2', 'ID');
$alumno_grupo->setCellValue('E2', 'NOMBRE(S)');
$alumno_grupo->setCellValue('F2', 'APELLIDO(S)');
$alumno_grupo->getStyle('D1:F2')->applyFromArray($encabezados);
$query = $conn->query("SELECT a.id_alumno,  
                            a.nombre AS nombre_alumno,
                            a.apellido AS apellido_alumno
                        FROM alumno a 
                        WHERE a.activo = 1 ORDER BY a.apellido ASC;");
if($query->num_rows > 0) {
    $i = 3;
    while($row = $query->fetch_assoc()) {
        $alumno_grupo->setCellValue('D'.$i , $row['id_alumno']);
        $alumno_grupo->getStyle('D'.$i )->applyFromArray($campos);
        $alumno_grupo->setCellValue('E'.$i , $row['nombre_alumno']);
        $alumno_grupo->getStyle('E'.$i )->applyFromArray($campos);
        $alumno_grupo->setCellValue('F'.$i , $row['apellido_alumno']);
        $alumno_grupo->getStyle('F'.$i )->applyFromArray($campos);
        $i++;
    }
}
$alumno_grupo->getColumnDimension('D')->setAutoSize(true);
$alumno_grupo->getColumnDimension('E')->setAutoSize(true);
$alumno_grupo->getColumnDimension('F')->setAutoSize(true);

///Grupos
$alumno_grupo->mergeCells('H1:I1');  
$alumno_grupo->setCellValue('H1', 'GRUPO');
$alumno_grupo->setCellValue('H2', 'ID');
$alumno_grupo->setCellValue('I2', 'NOMBRE');
$alumno_grupo->getStyle('H1:I2')->applyFromArray($encabezados);
$query = $conn->query("SELECT id_grupo,nombre FROM grupo WHERE activo = 1 ORDER BY nombre ASC;");
if($query->num_rows > 0) {
    $i = 3;
    while($row = $query->fetch_assoc()) {
        $alumno_grupo->setCellValue('H'.$i , $row['id_grupo']);
        $alumno_grupo->getStyle('H'.$i )->applyFromArray($campos);
        $alumno_grupo->setCellValue('I'.$i , $row['nombre']);
        $alumno_grupo->getStyle('I'.$i )->applyFromArray($campos);
        $i++;
    }
}
$alumno_grupo->getColumnDimension('H')->setAutoSize(true);
$alumno_grupo->getColumnDimension('I')->setAutoSize(true);
$alumno_grupo->getColumnDimension('G')->setWidth(3);

$documento->getActiveSheet()->getProtection()->setSheet(true);

$writer = new Xlsx($documento);

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment;filename=\"ENCLASE-alumno-grupo.xlsx\"");
header("Cache-Control: max-age=0");
header("Cache-Control: cache, must-revalidate");
header("Pragma: public");
$writer->save("php://output");

?>  