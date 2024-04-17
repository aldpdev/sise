<?php
include 'conexion.php';



$sql0="CREATE TABLE remitentes(
    idRemitente int auto_increment primary key,
    nombre varchar(30) not null,
    ci varchar(15),
    detalles text
);";

$sql1="CREATE TABLE persona(
    idPersona int  auto_increment primary key,
    nombre varchar(30) not null,
    ap_pat varchar(30) not null,
    ap_mat varchar(30) not null,
    ci varchar(15) not null,
    cargo varchar(30) not null,
    detalles text
);";

$sql2="CREATE TABLE departamento(
    idDepartamento int  auto_increment primary key,
    NombreDepartamento varchaR(30) NOT NULL,
    idPersona int not  null,                    
    FOREIGN KEY(idPersona)  REFERENCES persona (idPersona)
);";

$sql3="CREATE TABLE usuario(
    idUsuario int  auto_increment primary key,
    login varchar(30) not null,
    password varchar(30) not null,
    permisos varchar(30) not null,
    idPersona int not  null,
    FOREIGN KEY(idPersona)  REFERENCES persona (idPersona)

);";


$sql4="CREATE TABLE documento(
    NroRuta int auto_increment primary key,
    idRemitente int not  null,
    referencia varchar(200) not null,
    destinatario varchar(30) not null,
    tipo varchar(30) not null,
    detalles varchar(30) not null,
    imagen varchar(30) not null,
    estado varchar(30) not null,
    FOREIGN KEY(idRemitente)  REFERENCES remitentes (idRemitente)
);";
$sql5="CREATE TABLE ubicacion(
    idUbicacion int auto_increment primary key,
    horaRecepcion time,
    fechaInicio date,
    fechaSalida time,
    idUsuario int not null,
    FOREIGN KEY(idUsuario)  REFERENCES usuario (idUsuario),
    NroRuta int not null,
    FOREIGN KEY(NroRuta)  REFERENCES documento (NroRuta)
);";



if($conexion->query($sql0)==TRUE){
    echo"tablas remitente creada <br> ";
}else{
    echo"error<br>".$conexion->error;
}

if($conexion->query($sql1)==TRUE){
    echo"tablas persona creada <br> ";
}else{
    echo"error<br>".$conexion->error;
}
if($conexion->query($sql2)==TRUE){
    echo"tablas departament creada <br> ";
}else{
    echo"error<br>".$conexion->error;
}
if($conexion->query($sql3)==TRUE){
    echo"tablas usuario creada <br> ";
}else{
    echo"error<br>".$conexion->error;
}
if($conexion->query($sql4)==TRUE){
    echo"tablas documento creada <br> ";
}else{
    echo"error<br>".$conexion->error;
}
if($conexion->query($sql5)==TRUE){
    echo"tablas ubicacion creadas <br> ";
}else{
    echo"error<br>".$conexion->error;
}
$sqlA="alter table documento 
ADD anio INT DEFAULT YEAR(CURRENT_TIMESTAMP);";
if($conexion->query($sqlA)==TRUE){
    echo"tabla alterada <br> ";
}else{
    echo"error<br>".$conexion->error;
}
?>