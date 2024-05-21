<?php
////////////////////////////////////////////////////////////////////////////////
function DBDropSenderTable() {
         $c = DBConnect();
         $r = DBExec($c, "drop table \"sendertable\"", "DBDropLogTable(drop table)");
}
//tabla documento
function DBCreateSenderTable() {
         $c = DBConnect();
	       $conf = globalconf();

         if($conf["dbuser"]=="") $conf["dbuser"]="siseuser";
         $r = DBExec($c, "
         CREATE TABLE `sendertable` (
                `senderid` int(11) NOT NULL AUTO_INCREMENT,   -- (auto_incrementado para el registro)
                `sendername` varchar(100),                         -- (nombre del remitente)
                `senderdetail` text,          -- (detalle del remitente)
                `senderdatetime` int(11) NOT NULL,                   -- (dia/hora de registro)
                PRIMARY KEY (`senderid`)
        )", "DBCreateSenderTable(create table)");

        $r = DBExec($c, "GRANT ALL PRIVILEGES ON `".$conf["dbname"]."`.`sendertable` TO '".$conf["dbuser"]."'@'localhost'", "DBCreateSenderTable(grant siseuser)");
        $r = DBExec($c, "CREATE INDEX `sender_index` ON `sendertable` (`senderid`)", "DBCreateSenderTable(create user_indexname)");

}


////////funciones para tabla de remitente///////////
function DBNewSender($name, $detail, $datetime, $c=null) {
  $t = time();
  if($datetime <= 0)
    $datetime = $t;
  $detail = str_replace("'", "\"", $detail);

  $cw = false;
	if($c == null) {
		$cw = true;
		$c = DBConnect();
		DBExec($c, "begin work", "DBNewSender(begin)");
	}

  DBExec($c, "LOCK TABLES sendertable WRITE", "DBNewSender(lock tables sendertable)");

  $a = DBGetRow ("select senderid from sendertable where sendername = '$name'", 0, $c);
  if($a == null){
    $sql = "insert into sendertable (sendername, senderdetail, senderdatetime) values " .
      "('$name','$detail', $datetime)";
    $r = DBExec ($c, $sql, "DBNewSender(insert)");
    if($r){
      $idp = mysqli_insert_id($c);
      DBExec($c, "UNLOCK TABLES", "DBNewSender(unlock tables)");
      if($cw) DBExec($c, "commit work");
      return $idp;
    }else{
      DBExec($c, "ROLLBACK", "DBNewSender(rollback tables)");
      return null;
    }
  }else{
    if($cw) DBExec($c, "commit work");
    return $a['senderid'];
  }


}





function DBDropDocumentTable() {
         $c = DBConnect();
         $r = DBExec($c, "drop table \"documenttable\"", "DBDropLogTable(drop table)");
}
//tabla documento
function DBCreateDocumentTable() {
         $c = DBConnect();
	       $conf = globalconf();

         if($conf["dbuser"]=="") $conf["dbuser"]="siseuser";
         $r = DBExec($c, "
         CREATE TABLE `documenttable` (
                `documentid` int(11) NOT NULL AUTO_INCREMENT,       -- (auto_incrementado para el registro)
                `routenumber` int(11) NOT NULL,                     -- (numero de ruta)
                `senderid` int(11) NOT NULL,                        -- (id del remitente)
                `userid` int(11) NOT NULL,                          -- (id del usuario)
                `reference` varchar(100) NOT NULL,                  -- (referencia)
                `unitreceived` int(11) NOT NULL,               -- (unidad recibida)
                `documentcount` int(11) NOT NULL,                   -- (numero de hojas)
                `documenttype` varchar(50) NOT NULL,                -- (tipo de documento)
                `documentaffair` text NOT NULL,                     -- (asunto del documento)
                `documentdetail` text NOT NULL,                     -- (detalle del documento)
                `documentimg` text NOT NULL,                        -- (imagen)
                `documentstatus` varchar(20) DEFAULT '',            -- (estado del documento)
                `updatetime` int NOT NULL DEFAULT UNIX_TIMESTAMP(), -- (indica la ultima actualizacion del registro)
                PRIMARY KEY (`documentid`),
                FOREIGN KEY (`senderid`)
                        REFERENCES `sendertable` (`senderid`)
                        ON DELETE CASCADE ON UPDATE CASCADE,
                FOREIGN KEY (`unitreceived`)
                        REFERENCES `unittable` (`unitnumber`)
                        ON DELETE CASCADE ON UPDATE CASCADE,
                FOREIGN KEY (`userid`)
                        REFERENCES `usertable` (`usernumber`)
                        ON DELETE CASCADE ON UPDATE CASCADE
        )", "DBCreateDocumentTable(create table)");

        $r = DBExec($c, "GRANT ALL PRIVILEGES ON `".$conf["dbname"]."`.`documenttable` TO '".$conf["dbuser"]."'@'localhost'", "DBCreateDocumentTable(grant siseuser)");
        $r = DBExec($c, "CREATE INDEX `document_index` ON `documenttable` (`documentid`)", "DBCreateDocumentTable(create user_indexdocument)");

}

function DBNewDocument($param, $c=null){

  if(isset($param['usernumber']) && !isset($param['user'])) $param['user']=$param['usernumber'];
	if(isset($param['routenumber']) && !isset($param['route'])) $param['route']=$param['routenumber'];
	if(isset($param['senderid']) && !isset($param['sender'])) $param['sender']=$param['senderid'];
  if(isset($param['unitreceived']) && !isset($param['received'])) $param['received']=$param['unitreceived'];

  if(isset($param['documentreference']) && !isset($param['reference'])) $param['reference']=$param['documentreference'];
  if(isset($param['documentaffair']) && !isset($param['affair'])) $param['affair']=$param['documentaffair'];
  if(isset($param['documentcount']) && !isset($param['count'])) $param['count']=$param['documentcount'];
  if(isset($param['documenttype']) && !isset($param['type'])) $param['type']=$param['documenttype'];
  if(isset($param['documentdetail']) && !isset($param['detail'])) $param['detail']=$param['documentdetail'];
  if(isset($param['documentimg']) && !isset($param['img'])) $param['img']=$param['documentimg'];
  if(isset($param['documentstatus']) && !isset($param['status'])) $param['status']=$param['documentstatus'];

  $ac=array('route', 'sender', 'user', 'received');

	$ac1=array('reference', 'count', 'affair','type', 'detail', 'img', 'status', 'updatetime');

	$typei['route']=1;
	$typei['updatetime']=1;
	$typei['user']=1;
	$typei['received']=1;
	$typei['sender']=1;
	$typei['count']=1;
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

  $reference = NULL;
  $type = NULL;
  $detail = NULL;
  $img = NULL;
  $status = NULL;
	$updatetime=-1;

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

	$cw = false;
	if($c == null) {
		$cw = true;
		$c = DBConnect();
		DBExec($c, "begin work", "DBNewDocument(begin)");
	}
  $ret=1;
  if(!isset($param['documentid'])){
    $ret=2;

    $sql = "insert into documenttable (routenumber, senderid, userid, reference, unitreceived, documentcount,
     documenttype, documentaffair, documentdetail, documentimg, documentstatus, updatetime) values " .
      "($route, $sender, $user, '$reference', $received, $count, '$type', '$affair' ,'$detail', '$img', '$status', $updatetime)";
    DBExec ($c, $sql, "DBNewDocument(insert)");

    LOGLevel ("Registrado documento.",2);

  }else{
    echo "Update en desarrollo..."; //para update
    //$r = DBExec($c, "select * from usertable where username='$username' and usernumber!=$user", "DBNewUser(get user)");

  	//$n = DBnlines ($r);
    //if($cw)
	  //   DBExec ($c, "rollback work");
  }

	if($cw) DBExec($c, "commit work");
	return $ret;
}
//funcion para listar todos los documentos registrados
function DBAllDocuments() {

	$sql = "select *from documenttable as d inner join sendertable as s on d.senderid=s.senderid";

	$sql .= " order by d.documentid desc";
	$c = DBConnect();
	$r = DBExec ($c, $sql, "DBAllDocuments(get users)");
	$n = DBnlines($r);
	if ($n == 0) {
		LOGError("Unable to find users in the database. SQL=(" . $sql . ")");
		MSGError("¡No se pueden encontrar documentos en la base de datos!");
	}
	$a = array();
	$a = DBAllRow($r);
	return $a;
}

function DBDropDocumenthistoryTable() {
         $c = DBConnect();
         $r = DBExec($c, "drop table \"documenthistorytable\"", "DBDropLogTable(drop table)");
}
//tabla documento
function DBCreateDocumenthistoryTable() {
         $c = DBConnect();
	       $conf = globalconf();

         if($conf["dbuser"]=="") $conf["dbuser"]="siseuser";
         $r = DBExec($c, "
         CREATE TABLE `documenthistorytable` (
                `historyid` int(11) NOT NULL AUTO_INCREMENT,        -- (auto_incrementado para el registro)
                `documentid` int(11) NOT NULL,                      -- (id del documento)
                `userid` int(11) NOT NULL,                          -- (id del usuario)
                `historyacction` varchar(100) NOT NULL,             -- (accion)
                `stdatetime` int(11) NOT NULL,                      -- (fecha de inicio)
                `endatetime` int(11) NOT NULL,                      -- (fecha de salida)
                `updatetime` int NOT NULL DEFAULT UNIX_TIMESTAMP(), -- (indica la ultima actualizacion del registro)
                PRIMARY KEY (`historyid`),
                FOREIGN KEY (`documentid`)
                        REFERENCES `documenttable` (`documentid`)
                        ON DELETE CASCADE ON UPDATE CASCADE,
                FOREIGN KEY (`userid`)
                        REFERENCES `usertable` (`usernumber`)
                        ON DELETE CASCADE ON UPDATE CASCADE
        )", "DBCreateDocumenthistoryTable(create table)");

        $r = DBExec($c, "GRANT ALL PRIVILEGES ON `".$conf["dbname"]."`.`documenthistorytable` TO '".$conf["dbuser"]."'@'localhost'", "DBCreateDocumenthistoryTable(grant siseuser)");
        $r = DBExec($c, "CREATE INDEX `documenthistory_index` ON `documenthistorytable` (`historyid`)", "DBCreateDocumenthistoryTable(create user_indexdocumenthistory)");

}




















?>
