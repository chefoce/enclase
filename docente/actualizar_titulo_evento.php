<?php
include('../config/constants.php');
if (isset($_POST['delete']) && isset($_POST['id'])){
	
	
	$id = $_POST['id'];
	
	$sql = "DELETE FROM eventos WHERE id_evento = $id";
	$query = $conn->prepare( $sql );
	if ($query == false) {
	 print_r($conn->errorInfo());
	 die ('Error prepare');
	}
	$res = $query->execute();
	if ($res == false) {
	 print_r($query->errorInfo());
	 die ('Error execute');
	}
	
}elseif (isset($_POST['title']) && isset($_POST['time']) && isset($_POST['color']) && isset($_POST['id']) && isset($_POST['start'])){
	
	$id = $_POST['id'];
	$title = $_POST['title'];
	$start = $_POST['start'];
	$time = $_POST['time'];
	$start = $start." ".$time;
	$color = $_POST['color'];
	
	$sql = "UPDATE eventos SET  titulo = '$title', color = '$color', inicio = '$start' WHERE id_evento = $id ";

	
	$query = $conn->prepare( $sql );
	if ($query == false) {
	 print_r($conn->errorInfo());
	 die ('Error prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Error execute');
	}

}
header("location:" . SITEURL . 'docente/index.php');

	
?>