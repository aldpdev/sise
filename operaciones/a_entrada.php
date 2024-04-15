<?php
header('Content-type: text/html; charset=utf-8');
include_once("../enlace.php");
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$nhoja = $_POST['nhoja'];
	$tipodocumento = $_POST['tipodocumento'];
	$gestion = $_POST['gestion'];
	$fingreso = $_POST['fingreso'];
	$beneficiario = mb_strtoupper($_POST['beneficiario']);

	$nfactura = $_POST['nfactura'];
	if ($_POST['nfactura'] == "") {
		$nfactura = 0;
	}

	$nrecibo = $_POST['nrecibo'];
	if ($_POST['nrecibo'] == "") {
		$nrecibo = 0;
	}

	$nhojas = $_POST['nhojas'];
	$ndocumento = $_POST['ndocumento'];
	$descripcion = mb_strtoupper($_POST['descripcion']);
	$objeto = mb_strtoupper($_POST['objeto']);
	$observacion = mb_strtoupper($_POST['observacion']);

	if (isset($_POST['nuevoarchivo'])) {
		$nombrenuevo = md5(date('YmdHis')) . ".pdf";
	} else {
		$nombrenuevo = $_POST['archivoold'];
	}

	$idusuario = $_SESSION['id'];

	$sql = "UPDATE controlentrada SET hoja_controlentrada=" . $nhoja . ",numdoc_controlentrada=" . $ndocumento . ",categoria_controlentrada='" . $tipodocumento . "',gestion_controlentrada=" . $gestion . ",fechafecha_controlentrada='" . $fingreso . "',
		beneficiario_controlentrada='" . utf8_decode($beneficiario) . "',factura_controlentrada='" . $nfactura . "',recibo_controlentrada='" . $nrecibo . "',fojas_controlentrada=" . $nhojas . ",
		descripcion_controlentrada='" . utf8_decode($descripcion) . "',gasto_controlentrada='" . utf8_decode($objeto) . "',observacion_controlentrada='" . utf8_decode($observacion) . "',archivo='" . $nombrenuevo . "',usuario_idusuario=" . $idusuario . " WHERE idcontrolentrada='" . $_POST['identrada'] . "';";

	$datos = array();
	$conn->autocommit(FALSE);
	
	if (isset($_POST['nuevoarchivo'])) {
		
		$filename = $_FILES['archivo']['name'];
		$temporal = $_FILES['archivo']['tmp_name'];
		$directorio = "../digitalizados";
		if (!file_exists($directorio)) {
			mkdir($directorio, 0777);
		}
		$dir = opendir($directorio);
		$ruta = $directorio . '/' . $nombrenuevo;
		if (move_uploaded_file($temporal, $ruta)) {
			$resultconsult = $conn->query($sql);
			if (!$resultconsult) {
				$datos['OPERACION'] = "ERROR";
				unlink($ruta);
				$conn->rollback();
			} else {
				unlink($directorio.'/'.$_POST['archivoold']);
				$datos['OPERACION'] = "OK";				
				$conn->commit();
			}

		} else {
			$conn->rollback();
			$datos['OPERACION'] =  "ERROR";
		}
		closedir($dir);
	}else{
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