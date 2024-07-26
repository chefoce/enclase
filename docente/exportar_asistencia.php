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
$dm_id = $_GET['dm_id'];
$fecha = $_GET['fecha'];

//Datos Generales
$reporte = $documento->getActiveSheet();
$reporte->mergeCells('A1:C1'); 
$reporte->setCellValue('A1', 'REPORTE ASISTENCIA');
$reporte->setCellValue('A2', 'NOMBRE(S) DOCENTE');
$reporte->setCellValue('B2', 'APELLIDO(S) DOCENTE');
$reporte->setCellValue('C2', 'GRUPO');
$reporte->setCellValue('D1', 'FECHA');
$reporte->setCellValue('D2', 'MATERIA');
$reporte->setCellValue('E1', $fecha);
$reporte->getStyle('E1' )->applyFromArray($campos);
$reporte->setCellValue('E2', 'PERIODO');
$reporte->getStyle('A1:D1')->applyFromArray($encabezados);  
$reporte->getStyle('A2:E2')->applyFromArray($encabezados);  
$query = $conn->query("SELECT d.nombre AS nombre_docente,
                                d.apellido AS apellido_docente,
                                g.nombre AS grupo,
                                m.nombre AS materia,
                                p.nombre AS periodo
                                FROM docente_materia dm
                                JOIN docente d ON dm.docente_id = d.id_docente
                                JOIN grupo g ON dm.grupo_id = g.id_grupo
                                JOIN materia m ON dm.materia_id = m.id_materia
                                JOIN periodo p ON dm.periodo_id = p.id_periodo
                                WHERE dm.id_dm = $dm_id AND dm.activo = 1");
if($query->num_rows > 0) {
    $i = 3;
    while($row = $query->fetch_assoc()) {
        $reporte->setCellValue('A'.$i , $row['nombre_docente']);
        $reporte->getStyle('A'.$i )->applyFromArray($campos);
        $reporte->setCellValue('B'.$i , $row['apellido_docente']);
        $reporte->getStyle('B'.$i )->applyFromArray($campos);
        $reporte->setCellValue('C'.$i , $row['grupo']);
        $reporte->getStyle('C'.$i )->applyFromArray($campos);
        $reporte->setCellValue('D'.$i , $row['materia']);
        $reporte->getStyle('D'.$i )->applyFromArray($campos);
        $reporte->setCellValue('E'.$i , $row['periodo']);
        $reporte->getStyle('E'.$i )->applyFromArray($campos);
        $i++;
    }
}
$reporte->getColumnDimension('A')->setAutoSize(true);
$reporte->getColumnDimension('B')->setAutoSize(true);
$reporte->getColumnDimension('C')->setAutoSize(true);
$reporte->getColumnDimension('D')->setAutoSize(true);
$reporte->getColumnDimension('E')->setAutoSize(true);
$reporte->setTitle('PRINCIPAL');

///Asistencia 
$reporte->setCellValue('A5', '#');
$reporte->setCellValue('B5', 'MATRICULA');
$reporte->setCellValue('C5', 'APELLIDO(S)');
$reporte->setCellValue('D5', 'NOMBRE(S)');
$reporte->setCellValue('E5', 'ASISTENCIA');
$reporte->getStyle('A5:E5')->applyFromArray($encabezados);
$query = $conn->query("SELECT a.matricula,
                                a.nombre,
                                a.apellido,
                                asi.asistencia
                                FROM asistencia asi
                                JOIN alumno a ON asi.alumno_id = a.id_alumno
                                WHERE asi.dm_id = $dm_id AND asi.fecha = '$fecha' ORDER BY a.apellido");
if($query->num_rows > 0) {
    $i = 6;
    $num = 0;
    while($row = $query->fetch_assoc()) {
        $num++;
        $reporte->setCellValue('A'.$i , $num);
        $reporte->getStyle('A'.$i )->applyFromArray($campos);
        $reporte->setCellValue('B'.$i , $row['matricula']);
        $reporte->getStyle('B'.$i )->applyFromArray($campos);
        $reporte->setCellValue('C'.$i , $row['apellido']);
        $reporte->getStyle('C'.$i )->applyFromArray($campos);
        $reporte->setCellValue('D'.$i , $row['nombre']);
        $reporte->getStyle('D'.$i )->applyFromArray($campos);
        $reporte->setCellValue('E'.$i , $row['asistencia']);
        $reporte->getStyle('E'.$i )->applyFromArray($campos);
        $i++;
    }
}

$writer = new Xlsx($documento);

header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attachment;filename=\"ENCLASE-Reporte_Asistencia_$fecha.xlsx\"");
header("Cache-Control: max-age=0");
header("Cache-Control: cache, must-revalidate");
header("Pragma: public");
$writer->save("php://output");
?>