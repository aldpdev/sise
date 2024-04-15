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
	if($_POST['nfactura']==""){
		$nfactura = 0;
	}

	$nrecibo = $_POST['nrecibo'];
	if($_POST['nrecibo']==""){
		$nrecibo = 0;
	}
	
	$nhojas = $_POST['nhojas'];
	$ndocumento = $_POST['ndocumento'];
	$descripcion = mb_strtoupper($_POST['descripcion']);
	$objeto = mb_strtoupper($_POST['objeto']);
	$observacion = mb_strtoupper($_POST['observacion']);
	$nombrenuevo = md5(date('YmdHis')) . ".pdf";
	$idusuario = $_SESSION['id'];

	$sql = "INSERT INTO controlentrada(	hoja_controlentrada,numdoc_controlentrada,
	categoria_controlentrada,	gestion_controlentrada,	fechafecha_controlentrada,
	beneficiario_controlentrada,	factura_controlentrada,	recibo_controlentrada,
	fojas_controlentrada,	descripcion_controlentrada,	gasto_controlentrada,
	observacion_controlentrada,	archivo, usuario_idusuario,estado_controlentrada) 
	VALUES (
		" . $nhoja . "," . $ndocumento . ",'" . $tipodocumento . "'," . $gestion . ",'" . $fingreso . "',
		'" . utf8_decode($beneficiario) . "','" . $nfactura . "','".$nrecibo."',".$nhojas.",
		'".utf8_decode($descripcion)."','".utf8_decode($objeto)."','".utf8_decode($observacion)."','" .$nombrenuevo."',".$idusuario.",'ARCHIVADO');";

	$datos = array();
	$conn->autocommit(FALSE);

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
					$datos['OPERACION'] = "OK";
					$conn->commit();
				}
			} else {
				$conn->rollback();
				$datos['OPERACION'] = "ERROR";
			}
			closedir($dir);			
	$conn->close();
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($datos);
	exit();
} else {
	header("Location: ../index");
	exit();
}

exit();