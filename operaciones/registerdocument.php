<?php
session_start();//para iniciar session_sta
require_once("../globals.php");
require_once("../db.php");

if (isset($_POST["origen"])&& isset($_POST["nhr"]) &&
    isset($_POST["referencia"]) && isset($_POST["nhojas"]) && isset($_POST["tipodocumento"]) &&
    isset($_SESSION['usertable']['usernumber'])&& is_numeric($_SESSION['usertable']['usernumber'])) {

  $param['sendername'] = htmlspecialchars($_POST["origen"]);//userci
  $param['routenumber'] = htmlspecialchars($_POST["nhr"]);
  //$param['documentaddressee'] = htmlspecialchars($_POST["destinatario"]);
	$param['documentreference'] = htmlspecialchars($_POST["referencia"]);
	$param['documentaffair'] = htmlspecialchars($_POST["asunto"]);
	//$param['detail'] = htmlspecialchars($_POST["descripcion"]);
	$param['documentcount'] = htmlspecialchars($_POST["nhojas"]);

  $param['documentstatus'] = '';
  $param['documenttype'] = htmlspecialchars($_POST["tipodocumento"]);

  $param['usernumber'] = htmlspecialchars($_SESSION['usertable']['usernumber']);
  //echo $param['sendername']."-";
  $nombre_archivo = NULL;
  if(isset($_FILES['archivo']['name'])&&$_FILES['archivo']['name']!=""){
    $nombre_archivo = $_FILES['archivo']['name'];
  }

  //$tipo_archivo = $_FILES['archivo']['type'];
  //$tamaño_archivo = $_FILES['archivo']['size'];
  $temp_archivo = NULL;
  if(isset($_FILES['archivo']['tmp_name'])&&$_FILES['archivo']['tmp_name']!=""){
    $temp_archivo = $_FILES['archivo']['tmp_name'];
  }
  //$error_archivo = $_FILES['archivo']['error'];

  //echo "name: ".$param['sendername']."archivo:".$_FILES['archivo']['name'];
  //$name, $detail, $datetime,

  $r = DBNewSender($param['sendername'], '', time());
  if($r != null && is_numeric($r)){
    $param['senderid'] = $r;
  }
  $userinfo=DBUserInfo($param['usernumber']);
  if($userinfo == NULL){
    echo "No existe el usuario";
    exit;
  }
  $param['unitreceived'] = $userinfo['userunit'];
  //$uploadDir = "../uploads/";
  //if (!file_exists($uploadDir)) {
  //      mkdir($uploadDir, 0777, true); // Puedes ajustar los permisos según tus necesidades
  //}
  //$fileName = uniqid() . '_' . basename($nombre_archivo);
  //$targetFilePath = $uploadDir . $fileName;
  //if (move_uploaded_file($temp_archivo, $targetFilePath)){
  $param['filename'] = $nombre_archivo;
  //  $param['imgurl'] = $targetFilePath;
  $contenido_pdf = '';
  if(isset($temp_archivo)&& $temp_archivo!=""){
    $contenido_pdf = file_get_contents($temp_archivo);
    $param['file'] = $contenido_pdf;
    $conf=globalconf();
    $param['file'] = encryptData($param['file'], $conf["key"], false);
  }

  // Escapar el contenido para evitar problemas de SQL Injection
  //$contenido_pdf = $conn->real_escape_string($contenido_pdf);
  //$contenido_pdf = htmlspecialchars($contenido_pdf);

  //echo $param['file'];

  //echo $param['file'];
  //echo $param['file']='/+23/+/+/- or /';
  DBNewDocument($param);


  //}else{
  //  echo "Ha ocurrido un error al subir la imagen.";
  //}



  echo "yes";
  //ForceLoad("user.php");

}else{
  echo "nononono";
}
exit;
?>
