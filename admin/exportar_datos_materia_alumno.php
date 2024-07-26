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
$alumno_materia = $documento->getActiveSheet();
$alumno_materia->getStyle('A')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
$alumno_materia->getStyle('B')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);

$alumno_materia->mergeCells('A1:B1');  
$alumno_materia->setCellValue('A1', 'ALUMNOS MATERIAS');
$alumno_materia->setCellValue('A2', 'ALUMNO ID');
$alumno_materia->setCellValue('B2', 'DOCENTE MATERIA ID'); 
$alumno_materia->getStyle('A1:B2')->applyFromArray($encabezados);
$alumno_materia->getStyle('A1:B2')->getProtection()->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);

$alumno_materia->getColumnDimension('A')->setWidth(20);
$alumno_materia->getColumnDimension('B')->setWidth(20);
$alumno_materia->setTitle('PRINCIPAL');

///ALUMNOS
$alumno_materia->mergeCells('D1:G1');  
$alumno_materia->setCellValue('D1', 'ALUMNOS');
$alumno_materia->setCellValue('D2', 'ID');
$alumno_materia->setCellValue('E2', 'NOMBRE(S)');
$alumno_materia->setCellValue('F2', 'APELLIDO(S)');
$alumno_materia->getStyle('D1:F2')->applyFromArray($encabezados);
$query = $conn->query("SELECT a.id_alumno,  
                            a.nombre AS nombre_alumno,
                            a.apellido AS apellido_alumno
                        FROM alumno a 
                        WHERE a.activo = 1 ORDER BY a.apellido ASC;");
if($query->num_rows > 0) {
    $i = 3;
    while($row = $query->fetch_assoc()) {
        $alumno_materia->setCellValue('D'.$i , $row['id_alumno']);
        $alumno_materia->getStyle('D'.$i )->applyFromArray($campos);
        $alumno_materia->setCellValue('E'.$i , $row['nombre_alumno']);
        $alumno_materia->getStyle('E'.$i )->applyFromArray($campos);
        $alumno_materia->setCellValue('F'.$i , $row['apellido_alumno']);
        $alumno_materia->getStyle('F'.$i )->applyFromArray($campos);
        $i++;
    }
}
$alumno_materia->getColumnDimension('D')->setAutoSize(true);
$alumno_materia->getColumnDimension('E')->setAutoSize(true);
$alumno_materia->getColumnDimension('F')->setAutoSize(true);

///Grupos
$alumno_materia->mergeCells('H1:M1');  
$alumno_materia->setCellValue('H1', 'DOCENTES MATERIAS');
$alumno_materia->setCellValue('H2', 'ID');
$alumno_materia->setCellValue('I2', 'MATERIA');
$alumno_materia->setCellValue('J2', 'DOCENTE NOMBRE');
$alumno_materia->setCellValue('K2', 'DOCENTE APELLIDO');
$alumno_materia->setCellValue('L2', 'GRUPO');
$alumno_materia->setCellValue('M2', 'PERIODO');
$alumno_materia->getStyle('H1:M2')->applyFromArray($encabezados);
$query = $conn->query("SELECT dm.id_dm,  
                            m.nombre AS materia,
                            d.nombre AS nombre_docente,
                            d.apellido AS apellido_docente,
                            g.nombre AS grupo,
                            p.nombre as periodo
                        FROM docente_materia dm 
                        JOIN docente d ON dm.docente_id = d.id_docente
                        JOIN grupo g ON dm.grupo_id = g.id_grupo
                        JOIN materia m ON dm.materia_id = m.id_materia
                        JOIN periodo p ON dm.periodo_id = p.id_periodo
                        WHERE dm.activo = 1 ORDER BY materia ASC;");
if($query->num_rows > 0) {
    $i = 3;
    while($row = $query->fetch_assoc()) {
        $alumno_materia->setCellValue('H'.$i , $row['id_dm']);
        $alumno_materia->getStyle('H'.$i )->applyFromArray($campos);
        $alumno_materia->setCellValue('I'.$i , $row['materia']);
        $alumno_materia->getStyle('I'.$i )->applyFromArray($campos);
        $alumno_materia->setCellValue('J'.$i , $row['nombre_docente']);
        $alumno_materia->getStyle('J'.$i )->applyFromArray($campos);
        $alumno_materia->setCellValue('K'.$i , $row['apellido_docente']);
        $alumno_materia->getStyle('K'.$i )->applyFromArray($campos);
        $alumno_materia->setCellValue('L'.$i , $row['grupo']);
        $alumno_materia->getStyle('L'.$i )->applyFromArray($campos);
        $alumno_materia->setCellValue('M'.$i , $row['periodo']);
        $alumno_materia->getStyle('M'.$i )->applyFromArray($campos);
        $i++;
    }
}
$alumno_materia->getColumnDimension('H')->setAutoSize(true);
$alumno_materia->getColumnDimension('I')->setAutoSize(true);
$alumno_materia->getColumnDimension('J')->setAutoSize(true);
$alumno_materia->getColumnDimension('K')->setAutoSize(true);
$alumno_materia->getColumnDimension('L')->setAutoSize(true);
$alumno_materia->getColumnDimension('M')->setAutoSize(true);
$alumno_materia->getColumnDimension('C')->setWidth(3);
$alumno_materia->getColumnDimension('G')->setWidth(3);

$documento->getActiveSheet()->getProtection()->setSheet(true);

$writer = new Xlsx($documento);

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment;filename=\"ENCLASE-alumno-materia.xlsx\"");
header("Cache-Control: max-age=0");
header("Cache-Control: cache, must-revalidate");
header("Pragma: public");
$writer->save("php://output");

?>  