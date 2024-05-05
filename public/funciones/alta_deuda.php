<?php
require "conecta.php";
$con = conecta();
$id_cliente = $_REQUEST['id_cliente'];
$status = $_REQUEST['status'];
$fecha = $_REQUEST['fecha'];
$monto = $_REQUEST['monto'];

// Utiliza consultas preparadas para evitar SQL injection
$sql = "INSERT INTO deudas (id_cliente, fecha_deuda, monto_deuda, status) VALUES (?, ?, ?, ?)";

if ($stmt = $con->prepare($sql)) {
    // Vincula los parámetros
    $stmt->bind_param("issi", $id_cliente, $fecha, $monto, $status);

    // Ejecuta la consulta
    if ($stmt->execute()) {
        echo "";
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