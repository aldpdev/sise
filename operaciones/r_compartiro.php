<?php
header('Content-type: text/html; charset=utf-8');
include_once("../enlace.php");
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$nombresolicitante = mb_strtoupper($_POST['nombresolicitante']);
	$unidad = $_POST['unidad'];
	$id_documento = $_POST['id_documento'];
	$documentodetalle = mb_strtoupper($_POST['documentodetalle']);
	$fechaprestamo = $_POST['fechaprestamo'];
	$fechalimite = $_POST['fechalimite'];
	$motivo = mb_strtoupper($_POST['motivo']);
	$observacion = mb_strtoupper($_POST['observacion']);
	$idusuario = $_SESSION['id'];
	$unidadtext = $_POST['unidadtext'];
	$archivo = $_POST['archivo'];
	$usuariodato = "";

	$datos['USUARIO'] = "";
	$datos['PASSWORD'] = "";

	$sql = "SELECT * FROM clasificacion WHERE idclasificacion=" . $unidad . "";
	$resultconsult = $conn->query($sql);
	if (!$resultconsult) {
		$datos['OPERACION'] = "ERROR";
	} else {
		$row = mysqli_fetch_assoc($resultconsult);
		$usuariodato = $row['sigla_clasificacion'];
	}


	$gestion = mb_strtoupper($_POST['gestion']);
	$fojas = mb_strtoupper($_POST['fojas']);
	$tipoarchivo = mb_strtoupper($_POST['tipo_archivo']);
	$fechaingreso = mb_strtoupper($_POST['fecha_ingreso']);


	$sql = "INSERT INTO formularioo (
		descripcion_formularioo,
		gestion_formularioo,
		fojas_formularioo,
		tipo_formularioo,
		fecha_formularioo,
		fecha_prestamo_formularioo,
		fecha_limite_formularioo,
		usuario_idusuario,
		unidad_formularioo,
		nombre_formularioo,
		motivo_formularioo,
		archivo_formularioo,
		sigla_formularioo,
		observacion_formularioo,
		id_documento_formularioo
	)
	VALUES (
	'" . utf8_decode($documentodetalle) . "',
	" . $gestion . ",
	" . $fojas . ",
	'" . $tipoarchivo . "',
	'" . $fechaingreso . "',
	'" . $fechaprestamo . "',
	'" . $fechalimite . "',
	" . $idusuario . ",
	'" . utf8_decode($unidadtext) . "',
	'" . utf8_decode($nombresolicitante) . "',
	'" . utf8_decode($motivo) . "',
	'" . $archivo . "',
	'" . utf8_decode($usuariodato) . "',
	'" . utf8_decode($observacion) . "',
	" . $id_documento . ")";


	$datos = array();
	$conn->autocommit(FALSE);

	$resultconsult = $conn->query($sql);
	if (!$resultconsult) {
		$datos['OPERACION'] = "ERROR";
		$conn->rollback();
	} else {

		$sql = "UPDATE controlentradao SET estado_controlentradao='COMPARTIDO' WHERE idcontrolentradao=" . $id_documento . "";
		$resultconsult = $conn->query($sql);

		if (!$resultconsult) {
			$datos['OPERACION'] = "ERROR";
			$conn->rollback();
		} else {

			$sql = "SELECT * FROM clasificacion WHERE idclasificacion=" . $unidad . "";
			$resultconsult = $conn->query($sql);
			if (!$resultconsult) {
				$datos['OPERACION'] = "ERROR";
				$conn->rollback();
			} else {
				$row = mysqli_fetch_assoc($resultconsult);
				$usuariodato = $row['sigla_clasificacion'];
				$contra = generarCodigo(4);
				$devuelto = verificiarusuario($usuariodato, $conn);

				if ($devuelto[0] == null) {
					$sql = "INSERT INTO usuario(usuario_usuario,password_usuario,nivel_usuario,persona_idpersona) 
				values(
				'" . $usuariodato . "','" . $contra . "','INVITADO',2)";
					$resultconsult = $conn->query($sql);
					if (!$resultconsult) {
						$datos['OPERACION'] = "ERROR";
						$conn->rollback();
					} else {
						$datos['OPERACION'] = "OK";

						$datos['USUARIO'] = $usuariodato;
						$datos['PASSWORD'] = $contra;
						$conn->commit();
					}
				} else {
					$datos['USUARIO'] = $devuelto[0];
					$datos['PASSWORD'] = $devuelto[1];
					$datos['OPERACION'] = "OK";
					$conn->commit();
				}
			}
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

function generarCodigo($longitud)
{
	$key = '';
	$pattern = '1234567890';
	$max = strlen($pattern) - 1;

	for ($i = 0; $i < $longitud; $i++) $key .= $pattern{
		mt_rand(0, $max)};
	return $key;
}

function verificiarusuario($usuario, $conn)
{

	$sql = "SELECT * FROM usuario WHERE usuario_usuario='" . $usuario . "'";
	$resultconsult = $conn->query($sql);
	if (!$resultconsult) {
		return null;
	} else {
		$row = mysqli_fetch_assoc($resultconsult);
		return  array($row['usuario_usuario'], $row['password_usuario']);
	}
}
exit();
