
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen</title>
    <link rel="stylesheet" href="../css/details_style.css">
</head>
<body>
<?php
// Asegúrate de que la conexión a la base de datos esté configurada correctamente
define ("HOST", 'localhost');
define ("BD", 'id21371185_paysafe');
define ("USER_BD", 'id21371185_admin');
define ("PASS_BD", 'Paysafe123.');
$con = new mysqli(HOST, USER_BD, PASS_BD, BD);

// Verifica si la conexión es exitosa
if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtén el ID del cliente del parámetro GET
$id = intval($_GET['id']);
// Realiza una consulta a la base de datos para obtener los detalles del cliente
$query = "SELECT * FROM pagos WHERE id_cliente = '$id'";
$result = mysqli_query($con, $query);

// Verifica si se obtuvo un resultado válido
if ($result && mysqli_num_rows($result) > 0) {
    // Si se obtuvo un resultado válido, crea un array para almacenar los detalles del cliente
    $client_details = array();
    echo "<h2>Historial de pagos</h2>";
    echo "<table>";
    echo "<tr>";
    echo "    <th>ID PAGO</th>";
    echo "    <th>ID CLIENTE</th>";
    echo "    <th>ID EMPLEADO</th>";
    echo "    <th>FECHA</th>";
    echo "    <th>MONTO</th>";
    echo "    <th>DESCRIPCION</th>  ";
    echo "</tr>";
    
    

    // Itera sobre los resultados de la consulta y crea un array asociativo con los detalles del cliente
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "    <td>" . $row['id_pago'] . "</td>";
        echo "    <td>" . $row['id_cliente'] . "</td>";
        echo "    <td>" . $row['id_usuario'] . "</td>";
        echo "    <td>" . $row['fecha_pago'] . "</td>";
        echo "    <td>" . $row['monto_pago'] . "</td>";
        echo "    <td>" . $row['descripcion'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    // Si no se obtuvo un resultado válido, devuelve un mensaje de error
    echo "<h1>No se encontraron detalles del cliente</h1>";
}

// Cierra la conexión a la base de datos
mysqli_close($con);
?>
</body>
</html>