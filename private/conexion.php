<?php

$servidor="localhost";
$usuario="root";
$password="";
$baseDedatos="HojaDeRuta";
$conexion= new mysqli($servidor,$usuario,$password, $baseDedatos);


if($conexion->connect_error){
    echo "error de conexion".$conexion->connect_error;
    //die("error de conexion: ".$conexion->connect_error);
}else{
  echo "conexion establecida....";
}
echo "\n";


?>
