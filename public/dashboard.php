<?php
session_start();
if(!$_SESSION['nombre']){
    header("location:index.php");
}
$id_u = $_SESSION['idU'];
$nombre = $_SESSION['nombre'];
$archivo= $_SESSION['archivo'];
$total= $_SESSION['total'];
?>
<html>

<head>
    <meta charset="UTF-8" />
    <title>PaySafe</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</head>

<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li class="active">
                <a href="#">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Inicio</span>
                </a>
            </li>
            <li>
                <a href="profile.php">
                    <i class="fas fa-user"></i>
                    <span>Perfil</span>
                </a>
            </li>
            <li>
                <a href="stats.php">
                    <i class="fas fa-chart-bar"></i>
                    <span>Estadisticas</span>
                </a>
            </li>
            <li>
                <a href="clients.php">
                    <i class="fas fa-briefcase"></i>
                    <span>Clientes</span>
                </a>
            </li>
            <li>
                <a href="informe.php">
                    <i class="fas fa-question-circle"></i>
                    <span>Informes</span>
                </a>
            </li>

            <li>
                <a href="configuration.php">
                    <i class="fas fa-cog"></i>
                    <span>Configuracion</span>
                </a>
            </li>
            <li class="logout">

                <a href="./funciones/cerrarsesion.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--title">

                <h2>Inicio</h2>
                <span>Bienvenido <?php echo $nombre;?></span>
            </div>
            <div>
                <button class="btn" id='pay'>Registrar Pago</button>
                <script>
                    document.getElementById("pay").onclick = function() {
                    window.open("regpago.php", "_blank", "width=500,height=600");
                };
                </script>
                <button class="btn" id='debt'>Registrar Deuda</button>
                <script>
                    document.getElementById("debt").onclick = function() {
                    window.open("regdebt.php", "_blank", "width=500,height=600");
                };
                </script>
            </div>
            <div class="user--info">
                <div class="search--box">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" placeholder="Buscar">
                </div>
                <img src="./images/<?php echo $archivo; ?>" alt="">
            </div>
        </div>


        <?php //funcion donde se verifica si hay pagos del dia o no, para imprimir las tarjetas de arriba o un aviso de que no se han
        define ("HOST", 'localhost');
        define ("BD", 'id21371185_paysafe');
        define ("USER_BD", 'id21371185_admin');
        define ("PASS_BD", 'Paysafe123.');
        $con = new mysqli(HOST, USER_BD, PASS_BD, BD);
                if ($con->connect_error) {
                die("Connection failed: " . $con->connect_error);
            }
            $result = $con->query("SELECT
            pagos.monto_pago,
            pagos.fecha_pago,
            clientes.nombre AS nombre_cliente
            FROM
            pagos
            INNER JOIN
            clientes ON pagos.id_cliente = clientes.id_cliente
            WHERE
            pagos.fecha_pago = CURRENT_DATE() AND pagos.id_usuario = '$id_u' 
            ORDER BY
            pagos.fecha_pago DESC
            LIMIT 3;");
            echo'<div class="card-container" id="tarjetas">';
            echo'';
            echo'<h1 class="main--title">Datos de hoy</h1>';
            echo '<div class="card--wrapper">';
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $nombre=$row['nombre_cliente'];
                                $monto=$row['monto_pago'];
                                $fecha=$row['fecha_pago'];
                                    
                                    echo '  <div class="payment--card light-green">';
                                    echo '      <div class="card--header">';
                                    echo '          <div class="amount">';
                                    echo '          <span class="title">Pago Registrado</span>';
                                    echo '          <span class="amount-value">$'.$monto.'</span>';
                                    echo '     </div>';
                                    echo '     <i class="fas fa-dollar-sign icon dark-green"></i>';
                                    echo '  </div>';
                                    echo '  <span class="card-detail">'.$nombre.'/'.$fecha.'</span>';
                                    echo '</div>';
                                
                            }
                            $ultimo_pago = $row;
                            echo '</div>';
                            $con->close();
                        } else{
                            echo '<div class="nopay light-red">';
                            echo '<h1>No se han registrado pagos hoy</h1>';
                            echo '</div>';
                        }
                            ?>
                </div>
        
        </script>
        <div class="tabular--wrapper">
            <h3 class="main--title">Datos Financieros</h3>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <td class='idpanel' id="tdhd">ID <br>Pago</td>
                            <td class='idpanel' id="tdhd">ID <br>Cliente</td>
                            <td class='idpanel' id="tdhd">ID <br>Usuario</td>
                            <td class='date' id="tdhd">Fecha</td>
                            <td class='monto' id="tdhd">Monto</td>
                            <td class="description" id="tdhd">Descripcion</td>
                            <td class="status" id="tdhd"> </td>
                            <td class="category" id="tdhd">Categoria</td>
                        </tr>
                    </thead>
                </table>
                <table>

                    <iframe width="100%" height="40%" src="./funciones/muestra_pagos.php" frameborder="1"></iframe>
                    <tfoot>
                        <tr>
                            <td colspan="7"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>

</html>