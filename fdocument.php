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
                `routenumber` int(11) NOT NULL,                              -- (numero de ruta)
                `senderid` int(11) NOT NULL,                    -- (id del remitente)
                `reference` varchar(100) NOT NULL,                       -- (referencia)
                `addressee` varchar(100) NOT NULL,                   -- (destinatario)
                `documenttype` varchar(50) NOT NULL,                       -- (tipo de documento)
                `documentdetail` text NOT NULL,                     -- (detalle del documento)
                `documentimg` text NOT NULL,                        -- (imagen)
                `documentstatus` varchar(20) DEFAULT '',            -- (estado del documento)
                `updatetime` int NOT NULL DEFAULT UNIX_TIMESTAMP(), -- (indica la ultima actualizacion del registro)
                PRIMARY KEY (`documentid`),
                FOREIGN KEY (`senderid`)
                        REFERENCES `sendertable` (`senderid`)
                        ON DELETE CASCADE ON UPDATE CASCADE
        )", "DBCreateDocumentTable(create table)");

        $r = DBExec($c, "GRANT ALL PRIVILEGES ON `".$conf["dbname"]."`.`documenttable` TO '".$conf["dbuser"]."'@'localhost'", "DBCreateDocumentTable(grant siseuser)");
        $r = DBExec($c, "CREATE INDEX `document_index` ON `documenttable` (`documentid`)", "DBCreateDocumentTable(create user_indexdocument)");

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
