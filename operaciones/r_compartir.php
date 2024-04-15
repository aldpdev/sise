<?php
header('Content-type: text/html; charset=utf-8');
include_once("../enlace.php");
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

	$nombresolicitante = mb_strtoupper($_POST['nombresolicitante']);
	$unidad = $_POST['unidad'];
	$documentodetalle = mb_strtoupper($_POST['documentodetalle']);
	$id_documento = $_POST['id_documento'];
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

	$hr = $_POST['hr'];
	$num_doc = $_POST['num_doc'];
	$categoria = $_POST['categoria'];

	$sql = "SELECT * FROM clasificacion WHERE idclasificacion=" . $unidad . "";
	$resultconsult = $conn->query($sql);
	if (!$resultconsult) {
		$datos['OPERACION'] = "ERROR";
	} else {
		$row = mysqli_fetch_assoc($resultconsult);
		$usuariodato = $row['sigla_clasificacion'];
	}
	
	

	$sql = "INSERT INTO formulario (nombre_formulario, clasificacion_idclasificacion, documento_formulario, id_documento_formulario, fecha_formulario, fecha_limite_formulario, motivo_formulario, observacion_formulario,usuario_idusuario,unidad_formulario,archivo_formulario,sigla_formulario,hoja_formulario,numdoc_formulario,categoria_formulario)
VALUES ('" . utf8_decode($nombresolicitante) . "'," . $unidad . ", '" . utf8_decode($documentodetalle) . "', " . $id_documento . ", '" . $fechaprestamo . "', '" . $fechalimite . "', '" . utf8_decode($motivo) . "', '" . utf8_decode($observacion) . "'," . $idusuario . ",'" . $unidadtext . "','" . $archivo . "','" . $usuariodato . "','.$hr.','.$num_doc.','".$categoria."')";

	$datos = array();
	$conn->autocommit(FALSE);

	$resultconsult = $conn->query($sql);
	if (!$resultconsult) {
		$datos['OPERACION'] = "ERROR";
		$conn->rollback();
	} else {

		$sql = "UPDATE controlentrada SET estado_controlentrada='COMPARTIDO' WHERE idcontrolentrada=" . $id_documento . "";
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
		return  array($row['usuario_usuario'],$row['password_usuario']);
	}
	
}
exit();
