<?php
header('Content-type: text/html; charset=utf-8');
include_once("../enlace.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$descripcion = mb_strtoupper($_POST['descripcion']);
	$gestion = $_POST['gestion'];
	$nhojas = $_POST['nhojas'];
	$tipoarchivo = $_POST['tipoarchivo'];
	$fingreso = $_POST['fingreso'];
	$observacion = mb_strtoupper($_POST['observacion']);
	$nombrenuevo = md5(date('YmdHis')) . ".pdf";
	$idusuario = $_SESSION['id'];
	$grupo = $_POST['grupo'];
	$unidad = $_POST['unidad'];

	$sql = "INSERT INTO controlentradao(descripcion_controlentradao	,
	gestion_controlentradao,
	fojas_controlentradao,
	tipo_controlentradao,
	fecha_controlentradao,
	observacion_controlentradao,
	archivo_controlentrada,
	usuario_idusuario,
	estado_controlentradao,
	grupo_controlentradao,
	unidad_controlentradao) 
	VALUES ('".utf8_decode($descripcion)."',
	".$gestion.",
	".$nhojas.",
	'".$tipoarchivo."',
	'".$fingreso."',
	'".utf8_decode($observacion)."',
	'".utf8_decode($nombrenuevo)."',
	".$idusuario.",'ARCHIVADO',
	'".$grupo."',
	'".$unidad."');";
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