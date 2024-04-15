<?php
include_once("../enlace.php");

$usuario = addslashes($_POST['usuario']);
$password = addslashes($_POST['password']);

$datos = array();

$sql = "select * FROM usuario INNER JOIN persona ON usuario.persona_idpersona = persona.idpersona where usuario.usuario_usuario='" . $usuario . "' AND usuario.password_usuario='" . $password . "';";
$resultuser = $conn->query($sql);

if (!$resultuser) {
	die(mysqli_error($conn));
} else {
	if ($resultuser->num_rows > 0) {
		session_start();
		while ($row = $resultuser->fetch_assoc()) {
			$datos['NOMBRE'] = utf8_encode($row['nombres_persona']);
			$_SESSION['nombre']=utf8_encode($row['nombres_persona']);
			$_SESSION['rol']=utf8_encode($row['nivel_usuario']);
			$_SESSION['id']=utf8_encode($row['persona_idpersona']);
			$_SESSION['usuario']=utf8_encode($row['usuario_usuario']);
		}
	} else {
		$datos['NOMBRE'] = "";
	}
	$conn->close();
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($datos);
	exit();
}
