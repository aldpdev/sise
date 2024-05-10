<?php

//configuracion global
function globalconf() {
  $conf["dbencoding"]="UTF8";
  $conf["dbclientenc"]="UTF8";
  $conf['doenc']=false;

  //$conf["dblocal"]="false"; // usar unix socket para conectar?
  $conf["dbhost"]="localhost";
  $conf["dbport"]="3306";

  $conf["dbname"]="sisedb"; // nombre de db de sise

  $conf["dbuser"]="siseuser"; // nombre de usuario de sise
  $conf["dbpass"]="system2024";

  $conf["dbsuperuser"]="siseuser"; // privelegio de usuario de sise
  $conf["dbsuperpass"]="system2024";

// tenga en cuenta que está bien usar el mismo usuario

  // contraseña inicial que se usa para el administrador del usuario: configúrela
  // a algo difícil de adivinar si el servidor está disponible

  $conf["basepass"]="sise";

  $conf["key"]="GG56KFJtNDBGjJprR6ex";//tambien se utiliza para QR


  $conf["ip"]='local';

  return $conf;
}
?>
