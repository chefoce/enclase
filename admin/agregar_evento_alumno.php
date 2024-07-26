<?php
 
include('../config/constants.php'); 
 
if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['time']) && isset($_POST['end']) && isset($_POST['color']) && isset($_POST['grupo']) && isset($_POST['id_admin'])){
	
	$title = $_POST['title'];
	$start = $_POST['start'];
	$time = $_POST['time'];
	$start = $start." ".$time;
	$end = $_POST['end'];
	$end = $end." "."00:00:00";
	$color = $_POST['color'];
	$grupo = $_POST['grupo'];
	$id_admin = $_POST['id_admin'];
 
	$sql = "INSERT INTO eventos(titulo, color, inicio, fin, grupo_id, admin_id, rol_autor) values ('$title', '$color', '$start', '$end', $grupo, $id_admin, 'admin')";
	
	echo $sql;
	
	$query = $conn->prepare( $sql );
	if ($query == false) {
	 print_r($query->errorInfo());
	 die ('Error prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($sth->errorInfo());
	 die ('Error execute');
	}
 
}
header("location:" . SITEURL . 'admin/index.php');
 
	
?>