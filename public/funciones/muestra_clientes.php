<?php
session_start();
define ("HOST", 'localhost');
define ("BD", 'id21371185_paysafe');
define ("USER_BD", 'id21371185_admin');
define ("PASS_BD", 'Paysafe123.');
$total= $_SESSION['total'];
$user= $_SESSION['idU'];

$conn = mysqli_connect(HOST, USER_BD, PASS_BD, BD);

if ($conn) {
    if ($user == 0) {
        $consulta = "SELECT * FROM clientes";
    } else {
        $consulta = "SELECT * FROM clientes WHERE id_usuario = $user";
    }

    $resultados = mysqli_query($conn, $consulta);

    if ($resultados) {
        while ($mostrar = mysqli_fetch_array($resultados)) {
                echo '<div class="containercl">';
                echo '<img src="../images/img.png" class="imagecl" />';
            
                echo '<div class="user-info">';
                echo '<span>ID:</span>'.$mostrar['id_cliente'].'<br />';
                echo '<span>Nombre:</span>'.$mostrar['nombre'].'<br />';
                echo '<span>Apellido:</span>'.$mostrar['apellido'].'<br />';
                echo '<span>Correo:</span>'.$mostrar['correo'].'<br />';
                echo '<button class="button" onclick="window.open(\'get_clients_details.php?id='.$mostrar['id_cliente'].'\', \'_blank\')">Mostrar detalles</button>';
                echo '</div>';
                echo '</div>';
                echo '<br>';
                
        }
        
        mysqli_free_result($resultados);
    } else {
        echo "Error al ejecutar la consulta: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Error al conectar a la base de datos: " . mysqli_connect_error();
}

?>
<body>

</body>