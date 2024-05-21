
<?php
$host = 'localhost'; // o la IP del servidor de bases de datos
$user = 'root'; // usuario de la base de datos
$password = ''; // contraseña del usuario

// Crear conexión
$conn = new mysqli($host, $user, $password);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
// Verificar si la base de datos existe
$dbname = "sisedb";

$sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // La base de datos existe, proceder a eliminarla
    $sql = "DROP DATABASE $dbname";
    if ($conn->query($sql) === TRUE) {
        echo "Base de datos eliminada exitosamente\n";
    } else {
        echo "Error al eliminar la base de datos: " . $conn->error."\n";
    }
}

// Crear base de datos
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Base de datos creada exitosamente\n";
} else {
    echo "Error al crear la base de datos: " . $conn->error."\n";
}



$conn->close();
?>
