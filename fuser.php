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

?>
