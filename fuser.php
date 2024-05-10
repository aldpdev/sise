<?php
//eliminar la tabla de usuarios...
function DBDropUserTable() {
    //conexcion de la base de datos..
	 $c = DBConnect();
	 $r = DBExec($c, "drop table \"usertable\"", "DBDropUserTable(drop table)");
}
function DBCreateUserTable() {
	 $c = DBConnect();
	 $conf = globalconf();
	 if($conf["dbuser"]=="") $conf["dbuser"]="siseuser";
	 $r = DBExec($c, "
CREATE TABLE `usertable` (
				`usernumber` int(11) AUTO_INCREMENT NOT NULL,                   -- (id de usuario)
				`userci` varchar(20) DEFAULT '',												-- (ci de usuario)
				`username` varchar(20) NOT NULL,                -- (nombre de usuario)
        `userfullname` varchar(200) NOT NULL,           -- (nombre completo de usuario)
        `userdesc` varchar(300),                        -- (descripcion del usuario etc)
        `usertype` varchar(20) NOT NULL,                -- (admin, admission, teacher, student)
				`userenabled` tinyint(1) DEFAULT 1 NOT NULL,        -- (usuario activo)
				`userpermitlogin` tinyint(1) DEFAULT 1 NOT NULL,		-- (usuario esta permitido logueos)
        `usermultilogin` tinyint(1) DEFAULT 0 NOT NULL,     -- (usuario puede loguearse multiples veces)
        `userpassword` varchar(200) DEFAULT '',         -- (password)
        `userip` varchar(300),                          -- (ip de ult accesso)
        `userlastlogin` int(11),                           -- (ultima session)
        `usersession` varchar(50) DEFAULT '',           -- (session de usuario)
        `usersessionextra` varchar(50) DEFAULT '',      -- (dos session de usuario)
        `userlastlogout` int(11),                          -- (ultima vez logout)
        `userpermitip` varchar(300),                    -- (acceso de ip permitido)
        `userinfo` varchar(300) DEFAULT '',
        `updatetime` int NOT NULL DEFAULT UNIX_TIMESTAMP(), -- (indica la ultima actualizacion del registro)
        PRIMARY KEY (`usernumber`)
)", "DBCreateUserTable(create table)");

	$r = DBExec($c, "GRANT ALL PRIVILEGES ON `".$conf["dbname"]."`.`usertable` TO '".$conf["dbuser"]."'@'localhost'", "DBCreateUserTable(grant siseuser)");
	$r = DBExec($c, "CREATE UNIQUE INDEX `user_index` ON `usertable` (`usernumber`)", "DBCreateUserTable(create user_index)");
	$r = DBExec($c, "CREATE INDEX `user_indexname` ON `usertable` (`username`)", "DBCreateUserTable(create user_indexname)");

}

//////////////////////////////funciones de usuarios///////////////////////////////////////
function DBFakeUser() {
	$c = DBConnect();
	DBExec($c, "begin work");

	$cf = globalconf();
	$pass = myhash($cf["basepass"]);
	DBExec($c, "insert into usertable (userci, username, userfullname, ".
		"userdesc, usertype, userenabled, userpermitlogin, usermultilogin, userpassword, userip, userlastlogin, usersession, ".
		"userlastlogout, userpermitip) ".
		"values ('8161243', 'admin', 'Administrador', NULL, 'admin', 1, 1, ".
           "1, '$pass', NULL, NULL, '', NULL, NULL)", "DBFakeUser(insert admin user)");

	DBExec($c, "insert into usertable (userci, username, userfullname, ".
		"userdesc, usertype, userenabled, userpermitlogin, usermultilogin, userpassword, userip, userlastlogin, usersession, ".
		"userlastlogout, userpermitip) ".
		"values ('832345-E0', 'fabian', 'fabian sierra', NULL, 'secretary', 1, 1, ".
           "1, '$pass', NULL, NULL, '', NULL, NULL)", "DBFakeUser(insert secretary user)");


	DBExec($c, "commit work");
}

//funcion para actulizar usuario y modificacion de password
//ac1
function DBUserUpdate($user, $username, $userfull, $userdesc, $passo, $passn){
    $a = DBUserInfo($user, null, false);//esta funcion retorna el registro de usuario y tambien si cambio o no hashpass = true
    $p = myhash($a["userpassword"].session_id());
    if($a["userpassword"] != "" && $p != $passo){
        LOGLevel("User ".$_SESSION["usertable"]["username"].
            "tried to change settings, but password was incorrect. ",2);
            //intentó cambiar la configuración, pero la contraseña era incorrecta.
        MSGError("Incorrect password");
    }else{
        if(!$a['changepassword']){
            //El cambio de contraseña está DESHABILITADO
            MSGError('Password change is DISABLED'); return;
        }
        if($a["userpassword"] == "") $temp = myhash("");
        else $temp=$a["userpassword"];
        $lentmp = strlen($temp);//para saber el tamano de la cadena
        $temp = bighexsub($passn, $temp);///si son iguales retorna 0 si no retorna sub en resto de dos str.

        if($lentmp>strlen($temp)){//esperar...
            $newpass='0'.$temp;
            while(strlen($newpass)<$lentmp) $newpass='0'.$newpass;
        }else{
            $newpass=substr($temp,strlen($temp)-$lentmp);
        }
        $c=DBConnect();
        DBExec($c,"begin work");
        DBExec($c,"lock table usertable");
        $r=DBExec($c,"select *from usertable where username='$username' and usernumber!=$user");
        $n=DBnlines($r);
        if($n == 0){
						if($userfull!='') $userfull=strtolower($userfull);
            $sql="update usertable set username='$username', userdesc='$userdesc', userfullname='$userfull', updatetime=".time();
            if($newpass !=myhash("")) $sql.=", userpassword='$newpass'";
            $sql .= " where usernumber=$user";
            $r=DBExec($c,$sql);
            DBExec($c,"commit work");
            LOGLevel("User ".$_SESSION["usertable"]["username"]." changed his settings (newname=$username) ",2);

            $_SESSION["usertable"]["userfullname"]=$userfull;//para cambiar el session de userfull
            MSGError("Data updated.");
            //ForceLoad("index.php");//index.php
        }else{
            DBExec($c,"rollback work");
            //no pudo cambiar su configuración
            LOGLevel("User ".$_SESSION["usertable"]["username"]." couldn't change his settings ",2);
            MSGError("Update problem (maybe username already in use). No data was changed.");
        }
    }

}

//funcion para sacar la informacion de usuario
function DBUserInfo($user, $c=null,$hashpass=true) {

	$sql = "select * from usertable where usernumber=$user";
	//funcion para capturar la fila del usuario
	$a = DBGetRow ($sql, 0, $c);
	if ($a == null) {
		LOGError("Unable to find the user in the database. SQL=(" . $sql . ")");
		MSGError("Unable to find the user in the database. Contact an admin now!");
	}
	$a['changepassword']=true;
	if(substr($a['userpassword'],0,1)=='!') {
		$a['userpassword'] = substr($a['userpassword'],1);
		$a['changepassword']=false;
	}
	if($a['userfullname']!=''){
		$a['userfullname']=ucwords($a['userfullname']);
	}
	if($hashpass)
		$a['userpassword'] = myhash($a['userpassword'] . $a['usersessionextra']);
	return $a;
}


//seleccion la todos los usuario de la base de datos si pasa sitio de ese
function DBAllUserInfo() {

	$sql = "select * from usertable where usertype!='admin'";

	$sql .= "order by usernumber";
	$c = DBConnect();
	$r = DBExec ($c, $sql, "DBAllUserInfo(get users)");
	$n = DBnlines($r);
	if ($n == 0) {
		LOGError("Unable to find users in the database. SQL=(" . $sql . ")");
		MSGError("¡No se pueden encontrar usuarios en la base de datos!");
	}

	$a = array();
	for ($i=0;$i<$n;$i++) {
		$a[$i] = DBRow($r,$i);
		$a[$i]['changepassword']=true;
		$a[$i]['userfullname']=ucwords($a[$i]['userfullname']);
		if(substr($a[$i]['userpassword'],0,1)=='!') {
			$a[$i]['userpassword'] = substr($a[$i]['userpassword'],1);
			$a[$i]['changepassword']=false;
		}
		$a[$i]['userpassword'] = myhash($a[$i]['userpassword'] . $a[$i]['usersessionextra']);
	}
	return $a;
}

//funcion para actulizar o insertar un nuevo usuario segun los datos que pasa
//actualizado1
function DBNewUser($param, $c=null, $import=false){

  //if(isset($param['contestnumber']) && !isset($param['contest'])) $param['contest']=$param['contestnumber'];
	//if(isset($param['sitenumber']) && !isset($param['site'])) $param['site']=$param['sitenumber'];
	//if(isset($param['usersitenumber']) && !isset($param['site'])) $param['site']=$param['usersitenumber'];
	if(isset($param['usernumber']) && !isset($param['user'])) $param['user']=$param['usernumber'];
	if(isset($param['number']) && !isset($param['user'])) $param['user']=$param['number'];

	if(isset($param['userpassword']) && !isset($param['pass'])) $param['pass']=$param['userpassword'];
	if(isset($param['userenabled']) && !isset($param['enabled'])) $param['enabled']=$param['userenabled'];
	if(isset($param['usermultilogin']) && !isset($param['multilogin'])) $param['multilogin']=$param['usermultilogin'];
	if(isset($param['userpermitip']) && !isset($param['permitip'])) $param['permitip']=$param['userpermitip'];
	if(isset($param['userfullname']) && !isset($param['userfull'])) $param['userfull']=$param['userfullname'];
	if(isset($param['usertype']) && !isset($param['type'])) $param['type']=$param['usertype'];
	if(isset($param['userpermitip']) && !isset($param['permitip'])) $param['permitip']=$param['userpermitip'];
	if(isset($param['userpermitip']) && !isset($param['permitip'])) $param['permitip']=$param['userpermitip'];

	$ac=array('user');
	//$ac=array('contest','site','user');
	$ac1=array('updatetime','userci','username','userfull','userdesc','type','enabled','multilogin','pass','permitip','changepass',
			   'userip','userlastlogin','userlastlogout','usersession','usersessionextra');

	//$typei['contest']=1;
	$typei['updatetime']=1;
	//$typei['site']=1;
	$typei['user']=1;
	foreach($ac as $key) {
		if(!isset($param[$key]) || $param[$key]=="") {
			MSGError("DBNewUser param error: $key not found");
			return false;
		}
		if(isset($typei[$key]) && !is_numeric($param[$key])) {
			MSGError("DBNewUser param error: $key is not numeric");
			return false;
		}
		$$key = myhtmlspecialchars($param[$key]);
	}
	$userci=0;
	$username= "team" . $user;
	$updatetime=-1;
	$pass = null;

	$userfull='';
	$userdesc='';
	$type='secretary';
	$enabled=0;
	$changepass=0;
	$multilogin=0;
	$permitip='';
	$usersession=null;
	$usersessionextra=null;
	$userip=null;
	$userlastlogin=null;
	$userlastlogout=null;
	foreach($ac1 as $key) {
		if(isset($param[$key])) {
			$$key = myhtmlspecialchars($param[$key]);
			if(isset($typei[$key]) && !is_numeric($param[$key])) {
				MSGError("DBNewUser param error: $key is not numeric");
				return false;
			}
		}
	}
	$t = time();
	if($updatetime <= 0)
		$updatetime=$t;

	if ($type != "admin")
		$type = "secretary";
	if ($type == "admin") $changepass = 0;
	if ($enabled != 0) $enabled = 0;
	if ($multilogin != 1) $multilogin = 0;
	if ($changepass != 1) $changepass = 0;
	$userfull=strtolower($userfull);
	$cw = false;
	if($c == null) {
		$cw = true;
		$c = DBConnect();
		DBExec($c, "begin work", "DBNewUser(begin)");
	}
	DBExec($c, "lock table usertable", "DBNewUser(lock)");

	if($pass != myhash("") && $type != "admin" && $changepass != "t" && substr($pass,0,1) != "!") $pass='!'.$pass;
	$r = DBExec($c, "select * from usertable where (username='$username') and usernumber!=$user", "DBNewUser(get user)");

	$n = DBnlines ($r);
	$ret=1;

	if ($n == 0) {

		$sql = "select * from usertable where usernumber=$user";
		$a = DBGetRow ($sql, 0, $c);
        //para insercion o actulizacion
		if ($a == null) {
			  	$ret=2;

    		 	$sql = "insert into usertable (usernumber, userci, username, userfullname, " .
    				"userdesc, usertype, userenabled, usermultilogin, userpassword, userpermitip) values " .
    				"($user, $userci,'$username', '$userfull', '$userdesc', '$type', '$enabled', " .
    				"'$multilogin', '$pass', '$permitip')";
    			DBExec ($c, $sql, "DBNewUser(insert)");
					if($type=='admission'){
						DBExec($c, "insert into specialtytable (userid, clinicalid, coursenumber) values ".
								"($user,1,3)","DBFakeUser(insert specialty)");
					}
					if($cw) {
    				DBExec ($c, "commit work");
    			}
    			LOGLevel ("Usuario $user registrado.",2);
		} else {
			if($updatetime > $a['updatetime']) {
				$ret=2;
				$sql = "update usertable set userci=$userci, username='$username', userdesc='$userdesc', updatetime=$updatetime, " .
					"userfullname='$userfull', usertype='$type', userpermitip='$permitip', ";

                //if($useremail!='') $sql .= "useremail='$useremail', ";
                if($pass != null && $pass != myhash("")) $sql .= "userpassword='$pass', ";
				if($usersession != null) $sql .= "usersession='$usersession', ";
				if($usersessionextra != null) $sql .= "usersessionextra='$usersessionextra', ";
				if($userip != null) $sql .= "userip='$userip', ";
				if($userlastlogin != null) $sql .= "userlastlogin='$userlastlogin', ";
				if($userlastlogout != null) $sql .= "userlastlogout='$userlastlogout', ";
				$sql .= "userenabled='$enabled', usermultilogin='$multilogin'";
				$sql .=	" where usernumber=$user";
				$r = DBExec ($c, $sql, "DBNewUser(update)");
				if($cw) {
					DBExec ($c, "commit work");
				}
				LOGLevel("Usuario $user actualizado.",2);
			}
		}
	} else {
	  if($cw)
	     DBExec ($c, "rollback work");
	  LOGLevel ("Problema de actualizacion para el usuario  $user (tal vez el nombre de usuario ya esté en uso).",1);
//Problema de actualización para el usuario $ usuario, sitio $ sitio (tal vez el nombre de usuario ya esté en uso).
      MSGError ("Problema de actualizacion para el usuario  $user, (tal vez el nombre de usuario ya esté en uso).");
		if($import){
			$a= DBRow($r,0);
			return $a['usernumber'];
		}else{
			return false;
		}
	}
	if($cw) DBExec($c, "commit work");
	return $ret;
}
?>
