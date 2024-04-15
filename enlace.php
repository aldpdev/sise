<?php
$conn = new mysqli('localhost', 'root', '', 'archivos');
//$conn = @mysqli_connect("connect_timeout=10 host=localhost port=3306 dbname=archivos user=root password=");

//if(mysqli_connect_errno()){
//  die("Error de conexión: " . mysqli_connect_error());
//}
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}
?>
