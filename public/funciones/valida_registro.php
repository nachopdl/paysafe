<?php
require 'conecta.php';
$con = conecta();

$nombre = $_REQUEST['nombre'];
$apellido = $_REQUEST['apellido'];
$tel = $_REQUEST['tel'];
$mail = $_REQUEST['mail'];
$pass = $_REQUEST['pass'];

// Verificar si el correo electrónico ya existe en la base de datos
$sql_verificacion = "SELECT COUNT(*) AS count FROM usuario WHERE correo = ?";
if ($stmt_verificacion = $con->prepare($sql_verificacion)) {
    // Vincula el parámetro del correo electrónico para la consulta de verificación
    $stmt_verificacion->bind_param("s", $mail);
    $stmt_verificacion->execute();
    $stmt_verificacion->store_result();

    $stmt_verificacion->bind_result($count);
    $stmt_verificacion->fetch();

    // Si count es mayor a cero, significa que el correo ya está registrado
    if ($count > 0) {
        echo "El correo electrónico ya está registrado";
    } else {
        // Si count es cero, el correo no está registrado y se procede con la inserción
        $sql_insercion = "INSERT INTO usuario (nombre, apellido, correo, pass, telefono) VALUES (?, ?, ?, ?, ?)";
        if ($stmt_insercion = $con->prepare($sql_insercion)) {
            // Vincula los parámetros para la consulta de inserción
            $stmt_insercion->bind_param("sssss", $nombre, $apellido, $mail, $pass, $tel);
            
            // Ejecuta la consulta de inserción
            if ($stmt_insercion->execute()) {
                echo "Registro exitoso.";
            } else {
                echo "Error al ejecutar la consulta de inserción: " . $stmt_insercion->error;
            }

            // Cierra la consulta preparada de inserción
            $stmt_insercion->close();
        } else {
            echo "Error en la preparación de la consulta de inserción: " . $con->error;
        }
    }

    // Cierra la consulta preparada de verificación
    $stmt_verificacion->close();
} else {
    echo "Error en la preparación de la consulta de verificación: " . $con->error;
}

// Cierra la conexión a la base de datos
$con->close();
?>
