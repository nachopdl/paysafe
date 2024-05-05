<?php
define ("HOST", 'localhost');
define ("BD", 'id21371185_paysafe');
define ("USER_BD", 'id21371185_admin');
define ("PASS_BD", 'Paysafe123.');
session_start(); // start the session
$user=$_SESSION['idU'];

$conn=mysqli_connect(HOST, USER_BD, PASS_BD, BD);//este se tiene que cambiar a la info del server
if ($conn) {
    if ($user == 0) {
        $consulta = "SELECT * FROM pagos";
    } else if ($user != 0) {
        $consulta = "SELECT * FROM pagos WHERE id_usuario = '$user'";
    }
    
}
$resultados=mysqli_query($conn,$consulta);
$num_rows = mysqli_num_rows($resultados); //Obtiene el total de registros

?>
<head>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<div class="table-container">
    <table>
        <thead>

        </thead>
        <?php
        for($i=0; $i<$num_rows; $i++){
            $mostrar = mysqli_fetch_array($resultados);
            echo "<tbody>";
            echo    "<tr>";
            echo       "<td class='idpanel'>".$mostrar['id_pago']."</td>";
            echo       "<td class='idpanel'>".$mostrar['id_cliente']."</td>";
            echo        "<td class='idpanel'>".$mostrar['id_usuario']."</td>";
            echo        "<td class='date'>".$mostrar['fecha_pago']."</td>";
            echo        "<td class='monto'>$".$mostrar['monto_pago']."</td>";
            echo        "<td class='description'>".$mostrar['descripcion']."</td>";
            echo        "<td class='status'>".$mostrar['status']."</td>";

            if ($mostrar['categoria'] == 1) {
                echo        "<td class='category'>Efectivo</td>";
            } else {
                echo        "<td class='category'>Transaccion</td>";
            }
            
            echo    "</tr>";
            echo "</tbody>";}
            ?>
        <?php 

        ?>
    </table>
</div>