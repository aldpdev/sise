<?php
include 'conexion.php';

$sql="CREATE DATABASE HojaDeRuta";

if($conexion->query($sql)==TRUE){
    echo"base de datos creada";

}
else{
    echo"Error".$conexion->error;
}
?>
