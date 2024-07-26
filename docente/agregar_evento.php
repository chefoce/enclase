<?php
 
include('../config/constants.php'); 
 
if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['time']) && isset($_POST['end']) && isset($_POST['color']) && isset($_POST['grupo']) && isset($_POST['id_docente'])){
	
	$title = $_POST['title'];
	$start = $_POST['start'];
	$time = $_POST['time'];
	$start = $start." ".$time;
	$end = $_POST['end'];
	$end = $end." "."00:00:00";
	$color = $_POST['color'];
	$grupo = $_POST['grupo'];
	$grupo = explode(" ", $grupo);
	$grupo[0];
	$grupo[1];
	$id_docente = $_POST['id_docente'];
	$materia = $_POST['materia'];
 
	$sql = "INSERT INTO eventos(titulo, inicio, fin, color, docente_id, dm_id, grupo_id, rol_autor) values ('$title', '$start', '$end', '$color', '$id_docente', '$grupo[0]', '$grupo[1]', 'docente')";
	$res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

	$mensaje = "Tienes un nuevo evento en tu calendario";
	$mensaje2 = "Nuevo evento: ".$title." Fecha/Hora: ".$start." Materia: ".$materia." Autor: ".$_SESSION['nombre_sesion']." ".$_SESSION['apellido_sesion'];
	
	$sql2 = "SELECT ad.alumno_id 
			FROM alumno_docente ad
			JOIN docente_materia dm ON ad.dm_id = dm.id_dm
			WHERE ad.dm_id = $grupo[0]";
	$res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
	if ($res2 == TRUE) {
		$count = mysqli_num_rows($res2);
		if ($count > 0) {
			while ($rows = mysqli_fetch_assoc($res2)) {
				$id_alumno = $rows['alumno_id'];
				$sql3 = "INSERT INTO notificaciones SET
				mensaje = '$mensaje',
				mensaje_2 = '$mensaje2',
				estado = 0,
				docente_id = $id_docente,
				alumno_id= $id_alumno,
				rol_notificacion = 2";
				$res3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
			}
		}
	}
	
}
header("location:" . SITEURL . 'docente/index.php');
 
	
?>