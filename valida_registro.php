<?php
require 'conecta.php';
$con = conecta();

$nombre = $_REQUEST['nombre'];
$apellido = $_REQUEST['apellido'];
$tel = $_REQUEST['tel'];
$mail = $_REQUEST['mail'];
$pass = $_REQUEST['pass'];

// Utiliza consultas preparadas para evitar SQL injection
$sql = "INSERT INTO usuario (nombre, apellido, correo, pass, telefono) VALUES (?, ?, ?, ?, ?)";

if ($stmt = $con->prepare($sql)) {
    // Vincula los parámetros
    $stmt->bind_param("sssss", $nombre, $apellido, $mail, $pass, $tel);

    // Ejecuta la consulta
    if ($stmt->execute()) {
        echo "Registro exitoso.";
    } else {
        echo "Error al ejecutar la consulta: " . $stmt->error;
    }

    // Cierra la consulta preparada
    $stmt->close();
} else {
    echo "Error en la preparación de la consulta: " . $con->error;
}

// Cierra la conexión a la base de datos
$con->close();
?>
