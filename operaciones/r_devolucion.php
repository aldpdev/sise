<?php
header('Content-type: text/html; charset=utf-8');
include_once("../enlace.php");
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


	$id_compartido = $_POST['id_compartido'];
	$id_entrada = $_POST['id_entrada'];


	$datos = array();
	$conn->autocommit(FALSE);

	$sql = "UPDATE formulario SET fecha_devolucion_formulario='".date('Y-m-d')."' WHERE idformulario=" . $id_compartido . "";
		
	$resultconsult = $conn->query($sql);
	if (!$resultconsult) {
		$datos['OPERACION'] = "ERROR";
		$conn->rollback();
	} else {

		$sql = "UPDATE controlentrada SET estado_controlentrada='ARCHIVADO' WHERE idcontrolentrada=" . $id_entrada . "";
		$resultconsult = $conn->query($sql);
		if (!$resultconsult) {
			$datos['OPERACION'] = "ERROR";
			$conn->rollback();
		} else {
			$datos['OPERACION'] = "OK";
			$conn->commit();
		}
	}

	$conn->close();
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($datos);
	exit();
} else {
	header("Location: ../index");
	exit();
}
exit();