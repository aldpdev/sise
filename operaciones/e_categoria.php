<?php
header('Content-type: text/html; charset=utf-8');
include_once("../enlace.php");
$id_clasificacion = addslashes($_POST['id_clasificacion']);
$datos = array();
$conn->autocommit(FALSE);
$sql = "DELETE FROM clasificacion where idclasificacion='" . $id_clasificacion . "'";
$resultconsult = $conn->query($sql);
if (!$resultconsult) {
	$datos['OPERACION'] = "ERROR";
	$conn->rollback();
} else {	
	$conn->commit();
	$datos['OPERACION'] = "OK";			
}
$conn->close();
header('Content-type: application/json; charset=utf-8');
echo json_encode($datos);

exit();
