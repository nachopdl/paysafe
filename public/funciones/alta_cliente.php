
<?php

require "conecta.php";

// Recuperar los datos del formulario o de alguna otra fuente
$id_usuario = $_REQUEST['id_usuario'];
$nombre = $_REQUEST["nombre"];
$apellido = $_REQUEST["apellido"];
$correo = $_REQUEST["correo"];
$telefono = $_REQUEST["telefono"];
$direccion = $_REQUEST["direccion"];

// Crear la conexión a la base de datos
$con = conecta();

if ($con) {
    // Preparar la consulta SQL con parámetros para evitar SQL injection
    $sql = "INSERT INTO clientes (id_usuario, nombre, apellido, correo, telefono, direccion) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);

    if ($stmt) {
        // Vincular los parámetros a la consulta preparada
        $stmt->bind_param("ssssss", $id_usuario, $nombre, $apellido, $correo, $telefono, $direccion);

        // Ejecutar la consulta preparada
        if ($stmt->execute()) {
            echo "Registro exitoso.";
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }

        // Cerrar la consulta preparada
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $con->error;
    }

    // Cerrar la conexión a la base de datos
    $con->close();
} else {
    echo "Error al conectar a la base de datos: " . mysqli_connect_error();
}
?>