<?php
session_start();//para iniciar session_sta
require_once("../globals.php");
require_once("../db.php");

if (isset($_POST["username"]) && isset($_POST["userci"]) && isset($_POST["userfullname"]) && isset($_POST["userdesc"]) && isset($_POST["userip"]) &&
    isset($_POST["usernumber"]) && isset($_POST["userenabled"]) &&
    isset($_POST["usermultilogin"]) && isset($_POST["usertype"]) && isset($_POST["userunit"]) &&
    isset($_POST["passwordn1"]) && isset($_POST["passwordn2"]) && isset($_POST["passwordo"])) {


	$param['user'] = htmlspecialchars($_POST["usernumber"]);
  if(!is_numeric($param['user'])){
    $param['user']=-1;
  }
  $param['userci'] = htmlspecialchars($_POST["userci"]);//userci
	$param['username'] = htmlspecialchars($_POST["username"]);
	$param['enabled'] = 0;
  if(htmlspecialchars($_POST["userenabled"])=='t')  $param['enabled'] = 1;
  $param['multilogin'] = 0;
  if(htmlspecialchars($_POST["usermultilogin"])=='t')  $param['multilogin'] = 1;
	$param['userfull'] = htmlspecialchars($_POST["userfullname"]);
	//$param['useremail'] = htmlspecialchars($_POST["useremail"]);
	$param['userdesc'] = htmlspecialchars($_POST["userdesc"]);
	$param['type'] = htmlspecialchars($_POST["usertype"]);
	$param['unit'] = htmlspecialchars($_POST["userunit"]);
	$param['permitip'] = htmlspecialchars($_POST["userip"]);

	  $param['changepass']=0;

    $nombre_archivo = NULL;
    $param['imgname']='';
	  $param['img']='';

    if(isset($_FILES['profile']['name'])&&$_FILES['profile']['name']!=""&&$_FILES['profile']['tmp_name']!=""){
      $param['imgname'] = $_FILES['profile']['name'];
      $conf=globalconf();
      $param['img'] = encryptData(file_get_contents($_FILES['profile']['tmp_name']), $conf["key"], false);
    }




    if(htmlspecialchars($_POST["changepass"])=='t')  $param['changepass'] = 1;

    $passcheck = $_POST["passwordo"];
    ////esta funcion retorna el registro de usuario y tambien si cambio o no hashpass = true
    $a = DBUserInfo($_SESSION["usertable"]["usernumber"], null, false);

    if(myhash($a['userpassword'] . session_id()) != $passcheck) {
        MSGError('Admin password is incorrect');
    } else {
        if ($_POST["passwordn1"] == $_POST["passwordn2"]) {
            //si son iguales retorna 0 si no retorna sub en resto de dos str.
            //pasa nuevopass1 datapass2

            $param['pass'] = bighexsub($_POST["passwordn1"],$a['userpassword']);
            while(strlen($param['pass']) < strlen($a['userpassword']))
                $param['pass'] = '0' . $param['pass'];
            if($param['user'] != 0)
                DBNewUser($param);//funcion para actulizar o insertar un nuevo usuario segun los datos que pasa

        } else MSGError ("Passwords don't match.");
    }
    echo "yes";
    //ForceLoad("user.php");

}else{
  echo "nononono";
}
exit;
?>
