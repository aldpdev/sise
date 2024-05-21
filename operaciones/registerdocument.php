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

  //$nombre_archivo = $_FILES['archivo']['name'];
  //$tipo_archivo = $_FILES['archivo']['type'];
  //$tamaño_archivo = $_FILES['archivo']['size'];
  //$temp_archivo = $_FILES['archivo']['tmp_name'];
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
  DBNewDocument($param);
  echo "yes";
    //ForceLoad("user.php");

}else{
  echo "nononono";
}
exit;
?>
