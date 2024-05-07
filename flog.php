<?php
////////////////////////////////////////////////////////////////////////////////
function DBDropLogTable() {
         $c = DBConnect();
         $r = DBExec($c, "drop table \"logtable\"", "DBDropLogTable(drop table)");
}

function DBCreateLogTable() {
         $c = DBConnect();
	       $conf = globalconf();

         if($conf["dbuser"]=="") $conf["dbuser"]="siseuser";
         $r = DBExec($c, "
         CREATE TABLE `logtable` (
                `lognumber` int(11) NOT NULL AUTO_INCREMENT,  -- (auto_incrementado para el registro)
                `loguser` int(11),                            -- (registro de usuario)
                `logip` varchar(20) NOT NULL,                 -- (numero de site de usuario registrado)
                `logdate` int(11) NOT NULL,                   -- (dia/hora de registro)
                `logtype` varchar(20) NOT NULL,               -- (tipo de registro: error, warn, info, debug)
                `logdata` text NOT NULL,                      -- (descripcion de registro)
                `logstatus` varchar(20) DEFAULT '',           -- (status de registro)
                PRIMARY KEY (`lognumber`),
                FOREIGN KEY (`loguser`)
                        REFERENCES `usertable` (`usernumber`)
                        ON DELETE CASCADE ON UPDATE CASCADE
        )", "DBCreateLogTable(create table)");

        $r = DBExec($c, "GRANT ALL PRIVILEGES ON `".$conf["dbname"]."`.`logtable` TO '".$conf["dbuser"]."'@'localhost'", "DBCreateUserTable(grant siseuser)");
        $r = DBExec($c, "CREATE INDEX `log_index` ON `logtable` (`loguser`, `logdate`)", "DBCreateUserTable(create user_indexname)");

}


////////////////////funciones para loguear////////////////////////////////////////////////////////////////
function DBNewLog($user, $type, $ip, $data, $status) {
	$t = time();
	$data = str_replace("'", "\"", $data);
  //
	DBExecNoSQLLog ("insert into logtable (loguser, logdate, logtype, " .
        "logip, logdata, logstatus) values ($user, $t, '$type', '$ip', '$data', '$status')",
	"DBNewLog(insert log)");
}



// función para iniciar sesión de un usuario. Ve a buscar un concurso activo, comprueba qué sitio
//local, y luego busca al usuario en el sitio local del concurso activo. Además, consulte otros
//indicadores, como inicios de sesión habilitados, ip correcta, si el usuario ya inició sesión, etc.
//$nombre es el nombre de usuario
//$pass es la contraseña

function DBLogIn($name,$pass,$msg=true) {

  $a = DBGetRow("select * from usertable where username='$name'", 0, null, "DBLogIn(get user)");
	if ($a == null) {
		if($msg) {
			LOGLevel("El usuario $name intentó iniciar sesión pero no existe.",2);
			MSGError("El usuario no existe o la contraseña es incorrecta.");
		}
		return false;
	}
  //informacion del usuario
	$a = DBUserInfo($a['usernumber'],null,false);
	$_SESSION['usertable'] = $a;
	$_SESSION['usertable']['usersession']='';
	$_SESSION['usertable']['userip']='';

	$p = myhash($a["userpassword"] . session_id());
	$_SESSION['usertable']['userpassword'] = $p;//con hash y id

	if ($a["userpermitlogin"]==0 && $a["usertype"] != "admin") {
		LOGLevel("El usuario $name intentó iniciar sesión pero se deniega el inicio de sesión.",2);
		if($msg) MSGError("No se permiten inicio de sesión.");
		unset($_SESSION["usertable"]);
		return false;
  }
	if ($a["userenabled"] != 1) {
		LOGLevel("El usuario $name intentó iniciar sesión pero está deshabilitado.",2);
		if($msg) MSGError("Usuario deshabilitado");
		unset($_SESSION["usertable"]);
		return false;
	}
	if ($a["userpassword"] != "" && $p != $pass) {
		LOGLevel("El usuario $name intentó iniciar sesión pero la contraseña es incorrecta.",2);
		if($msg) MSGError("Contraseña incorrecta.");
		unset($_SESSION["usertable"]);
		return false;
	}
  //Chequea si todos los caracteres en la string entregada, texto, son alfanuméricos.
	if(!ctype_alnum($name)) {
	  LOGLevel("El usuario $name intentó iniciar sesión pero el nombre de usuario no es alfanum.",2);
	  if($msg) MSGError("El nombre de usuario debe ser alfanumérico.");
	  unset($_SESSION["usertable"]);
	  return false;
	}


	$gip=getIP();
	if ($a["userip"] != $gip && $a["userip"] != "") {
		LOGLevel("El usuario $name está usando dos direcciones IP diferentes: " . $a["userip"] .
			 "(" . dateconv($a["userlastlogin"]) .") and " . $gip,1);
		if($msg && $a["usertype"] != "admin" && $a["usermultilogin"] != "t") MSGError("Está utilizando dos direcciones IP distintas. Administrador notificado.");
	}
	if ($a["userpermitip"] != "") {
		$ips=explode(';',$a["userpermitip"]);
		$gips=explode(';',$gip);
		if(count($gips) < count($ips)) {
			IntrusionNotify("Invalid IP: " . $gip);
			ForceLoad("index.php");
		}
		for($ipss=0;$ipss<count($ips);$ipss++) {
			$gipi=$gips[$ipss];
			$ipi=$ips[$ipss];
			if(!match_network($ipi, $gipi)) {
				IntrusionNotify("Invalid IP: " . $gip);
				ForceLoad("index.php");
			}
		}
	}
	$_SESSION['usertable']['usersession']=session_id();
	$_SESSION['usertable']['userip']=$gip;
	$c = DBConnect();
	$t = time();
  //==team
	if($a["usertype"] != "admin" && $a["usermultilogin"] != 1 && $a["userpermitip"] == "") {

	  $r = DBExec($c,"update usertable set userip='" . $gip . "', updatetime=" . time() . ", userpermitip='" . $gip . "'," .
		"userlastlogin=$t, usersession='".session_id()."' where username='$name'", "DBLogIn(update session)");
	} else {
		DBExec($c,"begin work");
		$sql = "update usertable set usersessionextra='".session_id()."' where username='$name' and (usersessionextra='' or userip != '" . $gip ."' or userlastlogin<=" . ($t-86400) . ")";
		DBExec($c,$sql);

		DBExec($c,"update usertable set userip='" . $gip . "', updatetime=" . time() . ", userlastlogin=$t, ".
			   "usersession='".session_id()."' where username='$name'", "DBLogIn(update user)");

		DBExec($c,"commit work");
	}
	LOGLevel("Usuario $name autentificado (" . $gip . ")",2);

	return $a;
}

//funcion para capturar los registros ordenados
function DBGetLogs($o,$user, $type, $ip, $limit) {
	$c = DBConnect();
	$where = "";

    if($user != ""){
        $where .= "where loguser=$user";
    }
    if($type!=""){
        if($where!=""){
            $where .= " and logtype='$type'";
        }else{
            $where = "where logtype='$type'";
        }
    }
    if($ip!=""){
        if($where!=""){
            $where.=" and logip='$ip'";
        }else{
            $where="where logip='$ip'";
        }
    }


	switch ($o) {
		case "user": $order="lognumber, loguser, logdate desc"; break;
		case "type": $order="lognumber, logtype, logdate desc"; break;
		case "ip": $order="lognumber, logip, logdate desc"; break;
		default: $order="lognumber, logdate desc"; break;
	}
	$r = DBExec ($c, "select lognumber as number, loguser as user, logdate as date, " .
			"logtype as type, logip as ip, logdata as data, logstatus as status from logtable " .
			" $where order by $order limit $limit", "DBGetLogs(get logs)");
	$n = DBnlines($r);
	$a = array();
	for ($i=0;$i<$n;$i++)
		$a[$i] = DBRow($r,$i);
	return $a;
}


// cerrar sesión. Tenga en cuenta que la marca de tiempo de cierre de sesión no tiene sentido cuando el usuario
// es de tipo multilogin
function DBLogOut($user, $isadmin=false) {
	$c = DBConnect();
	$r = DBExec($c,"update usertable set usersession='', usersessionextra='', updatetime=".time().", " .
		"userlastlogout=".time()." where usernumber=$user " , "DBLogOut(update user)");
	/*if($isadmin) {
		list($clockstr,$clocktime)=siteclock();
		if($clocktime < -600) {
			DBExec($c,"update contesttable set contestunlockkey='' where contestnumber=$contest", "DBLogOut(update contest)");
			DBExec($c,"update problemtable set problemfullname='', problembasefilename='' where problemfullname !~ '(DEL)' and contestnumber=$contest", "DBLogOut(update problems)");

			$ds = DIRECTORY_SEPARATOR;
			if($ds=="") $ds = "/";
			$dir=$_SESSION["locr"] . $ds . "private" . $ds . "problemtmp" . $ds;
			foreach(glob($dir . '*') as $file) {
				cleardir($file,false,true);
			}
		}
	}*/
	LOGLevel("User $user logged out.",2);
}
// eof
?>
