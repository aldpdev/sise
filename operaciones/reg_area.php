<?php
session_start();
header('Content-type: text/html; charset=utf-8');
include_once("../enlace.php");
$datos = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$nombre = strtoupper($_POST['nombre']);
	$sigla = strtoupper($_POST['sigla']);
	$codigo = strtoupper($_POST['codigo']);
	$idusuario = $_SESSION['id'];

	$sql = "INSERT INTO clasificacion(nombrearea_clasificacion,	sigla_clasificacion,codigo_clasificacion,usuario_idusuario) 
		values('".$nombre."','".$sigla."','".$codigo."',".$idusuario.");";
		$resulttemp = $conn->query($sql);
		if (!$resulttemp) {
			$datos['operacion'] = "error";		
		}else{
			$datos['operacion'] = "okey";
		} 

	$json = json_encode($datos);	
	header('Content-type: application/json; charset=utf-8');
	echo $json;
  }

?>