#!/usr/bin/php
<?php
//FABIAN SIERRA ACARAPI
if(is_readable('../db.php')) {
	require_once('../db.php');
} else {
  echo "no encontrado archivo db.php";
  exit;
}
/*if (getIP()!="UNKNOWN" || php_sapi_name()!=="cli") exit;
ini_set('memory_limit','600M');
ini_set('output_buffering','off');
ini_set('implicit_flush','on');
@ob_end_flush();

if(system('test "`id -u`" -eq "0"',$retval)===false || $retval!=0) {
	echo "Debe ejecutar como root\n";
	exit;
}
echo "\nThis will erase all the data in your sisedb database.";
echo "\n***** YOU WILL LOSE WHATEVER YOU HAVE THERE!!! *****";
echo "\nType YES and press return to continue or anything else will abort it: ";
$resp = strtoupper(trim(fgets(STDIN)));
if($resp != 'YES') exit;
*/


echo "\ndropping database\n";
DBDropDatabase();
echo "creating database\n";
DBCreateDatabase();

echo "creating tables\n";
DBCreateUserTable();
DBCreateLogTable();
/*
DBCreateLogTable();
*/
echo "creating initial fake admin\n";
DBFakeUser();
?>
