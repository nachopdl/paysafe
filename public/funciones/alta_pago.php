<?php
session_start();
require 'conecta.php';
$con = conecta();

$id_cliente = $_REQUEST['id_cliente'];
$id_usuario = $_SESSION['idU'];
$fecha = $_REQUEST['fecha'];
$monto = $_REQUEST['monto'];
$descripcion = $_REQUEST['descripcion'];
$categoria = $_REQUEST['category'];
// Utiliza consultas preparadas para evitar SQL injection
$sql = "INSERT INTO pagos (id_cliente, id_usuario, fecha_pago, monto_pago, descripcion, categoria) VALUES (?, ?, ?, ?, ?, ?)";

if ($stmt = $con->prepare($sql)) {
    // Vincula los parámetros
    $stmt->bind_param("ssssss", $id_cliente, $id_usuario, $fecha, $monto, $descripcion, $categoria);

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