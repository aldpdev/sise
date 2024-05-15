<?php
session_start();//para iniciar session_sta
require_once("../globals.php");
require_once("../db.php");


if (isset($_POST["origen"]) && isset($_POST["destinatario"]) && isset($_POST["instruccion"]) &&
    isset($_POST["asunto"]) && isset($_POST["descripcion"]) && isset($_POST["nhojas"])) {

  $param['sendername'] = htmlspecialchars($_POST["origen"]);//userci
	$param['destinatario'] = htmlspecialchars($_POST["destinatario"]);
	$param['instruccion'] = htmlspecialchars($_POST["instruccion"]);
	$param['asunto'] = htmlspecialchars($_POST["asunto"]);
	$param['descripcion'] = htmlspecialchars($_POST["descripcion"]);
	$param['nhojas'] = htmlspecialchars($_POST["nhojas"]);

  //$nombre_archivo = $_FILES['archivo']['name'];
  //$tipo_archivo = $_FILES['archivo']['type'];
  //$tamaño_archivo = $_FILES['archivo']['size'];
  //$temp_archivo = $_FILES['archivo']['tmp_name'];
  //$error_archivo = $_FILES['archivo']['error'];

  //echo "name: ".$param['sendername']."archivo:".$_FILES['archivo']['name'];
  //$name, $detail, $datetime,
  echo DBNewSender($param['sendername'], '', time());

  echo "yes";
    //ForceLoad("user.php");

}else{
  echo "nononono";
}
exit;
?>
