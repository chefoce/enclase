<?php
include('../../config/constants.php');
$id_alumno = $_SESSION['alumno_id'];
$sql = "UPDATE notificaciones SET estado = 1 WHERE estado = 0 AND alumno_id = $id_alumno";
$res = mysqli_query($conn, $sql);

$sql = "SELECT * FROM notificaciones WHERE alumno_id = $id_alumno AND rol_notificacion = 2 ORDER BY id_notificacion DESC limit 5";
$res = mysqli_query($conn, $sql);
$response = '';
$mensaje = "<a class='dropdown-item' href='#'>
			<i class='fas fa-bell-slash mr-2' aria-hidden='true'></i>
			<span>No tienes notificaciones</span></a>
			<a class='dropdown-item' href='consultar_notificaciones.php'>
			<i class='fas fa-external-link-alt mr-2' aria-hidden='true'></i>
			<span>Ver todas las Notificaciones</span></a>";
$verNotificaciones = "<a class='dropdown-item' href='consultar_notificaciones.php'>
						<i class='fas fa-external-link-alt mr-2' aria-hidden='true'></i>
						<span>Ver todas las Notificaciones</span></a>";
while ($row = mysqli_fetch_array($res)) {
	/* Formatear fecha */
	$fechaOriginal = $row["fecha"];
	$fechaFormateada = date("j/n/y-h:iA", strtotime($fechaOriginal));
	/*$row["autor"]*/

	$response = $response . "<a class='dropdown-item' href='consultar_notificaciones.php'>
							<i class='fas fa-check mr-2' aria-hidden='true'></i>" .
							"<span>" . $row["mensaje"] . "</span>" .
							"<span class='float-right'><i class='far fa-clock mr-2' aria-hidden='true'></i>" . $fechaFormateada . "</span></a>";
}
if (!empty($response)) {
	print $response;
	print $verNotificaciones;
} else {
	print $mensaje;
}
