<?php
session_start();
if(!$_SESSION['nombre']){
    header("location:index.php");
}
$nombre = $_SESSION['nombre'];
$archivo= $_SESSION['archivo'];

?>
<html>

<head>
    <meta charset="UTF-8" />
    <title>PaySafe</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/profile_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</head>

<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li>
                <a href="dashboard.php">
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
            <li class="active">
                <a href="stats.php">
                    <i class="fas fa-chart-bar"></i>
                    <span>Estadísticas</span>
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
                    <span>Informes </span>
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

                <h2>Estadisticas</h2>
                <!--<span>Bienvenido <?php echo $nombre;?></span>-->
            </div>
            <div class="user--info">
                <div class="search--box">
                    <i class="fa-solid fa-search"></i>
                    <input type="text" placeholder="Buscar">
                </div>
                <img src="./images/<?php echo $archivo; ?>" alt="">
            </div>
        </div>



        <div class="tabular--wrapper">
        <?php
define ("HOST", 'localhost');
define ("BD", 'id21371185_paysafe');
define ("USER_BD", 'id21371185_admin');
define ("PASS_BD", 'Paysafe123.');

$con = new mysqli(HOST, USER_BD, PASS_BD, BD);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$result = $con->query("SELECT nombre,apellido FROM clientes ORDER BY id_cliente DESC LIMIT 1;
");

$registro = $result->fetch_assoc();
$ultimo_cliente = implode(" ", $registro);
$con->close();
?>
<!------consulta ultima deuda---->
<?php
$con = new mysqli(HOST, USER_BD, PASS_BD, BD);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$result = $con->query("SELECT
deudas.monto_deuda,
clientes.nombre,
clientes.apellido
FROM
deudas
INNER JOIN
clientes
ON
deudas.id_cliente = clientes.id_cliente
WHERE
deudas.status = '1'
ORDER BY
deudas.id_deuda DESC
LIMIT 1
;
");

$registro = $result->fetch_assoc();
$ultimo_deuda = implode(" ", $registro);
$con->close();
?>
<!----------ultimo pago-------->
<?php
$con = new mysqli(HOST, USER_BD, PASS_BD, BD);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$result = $con->query("SELECT

pagos.monto_pago,
pagos.fecha_pago
FROM
pagos
ORDER BY
pagos.fecha_pago DESC
LIMIT
1;
");

$registro = $result->fetch_assoc();
$ultimo_pago = implode(" ", $registro);
$con->close();
?>
        <div class="tablaresumen" role="region" tabindex="0">
                <table>
                    <caption>
                        <p><br></p>
                    </caption>
                    <thead>
                        <tr>
                            <th><h2>Ultimo cliente registrado</h2></th>
                            <th><h2>Ultimo adeudo registrado</h2></th>
                            <th><h2>Ultimo pago registrado</h2></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><h3>Nombre</h3><br><?php echo $ultimo_cliente ?></td>
                            <td><h3>Monto/Cliente</h3><br>$<?php echo $ultimo_deuda ?></td>
                            <td><h3>Monto/Fecha</h3><br>$<?php echo $ultimo_pago ?></td>
                        </tr>
                    </tbody>
                </table>
                
            </div>



            <div class="tablaresumen" role="region" tabindex="0" >
                <table class="tablaresumen2">
                    <caption>
                        <p><br></p>
                    </caption>
                    <tbody>
                        <tr>
                            <th>
                            <?php 
            
            $con = new mysqli(HOST, USER_BD, PASS_BD, BD);  $query = $con->query("SELECT MONTHNAME(fecha_pago) as monthname, SUM(monto_pago) as monto FROM pagos WHERE YEAR(fecha_pago) = YEAR(CURDATE()) GROUP BY monthname ORDER BY MONTH(fecha_pago);");
            foreach($query as $data){
                $month[] = $data['monthname'];
                $amount[] = $data['monto'];
              }
            
              ?>


            <div style="width: 500px;">
                <canvas id="myChart"></canvas>
            </div>

            <script>
            // === include 'setup' then 'config' above ===
            const labels = <?php echo json_encode($month) ?>;
            const data = {
                labels: labels,
                datasets: [{
                    label: 'Pagos Recibidos',
                    data: <?php echo json_encode($amount) ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
            };

            const config3 = {
                type: 'bar',
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                },
            };

            var myChart = new Chart(
                document.getElementById('myChart'),
                config3
            );
            </script>
                            </th>
                            <th>
                                <?php 
                                $con = new mysqli(HOST, USER_BD, PASS_BD, BD);  $query = $con->query("SELECT 'Empleados', COUNT(DISTINCT id) AS numero_usuarios FROM usuario
                                UNION
                                SELECT 'Clientes', COUNT(DISTINCT id_cliente) AS numero_clientes FROM clientes;
                                ");
                                foreach($query as $data){
                                    $users[] = $data['Empleados'];
                                    $numberttl[] = $data['numero_usuarios'];
                                }
                                ?>
                                <div style="width: 300px;">
                                    <canvas id="Usuarios"></canvas>
                                </div>
                                <script>
                                // === include 'setup' then 'config' above ===
                                const labels2 = <?php echo json_encode($users) ?>;
                                const data2 = {
                                    labels: labels2,
                                    datasets: [{
                                        label: 'Total de Registros',
                                        data: <?php echo json_encode($numberttl) ?>,
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(255, 159, 64, 0.2)',
                                            'rgba(255, 205, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(201, 203, 207, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(255, 159, 64)',
                                            'rgb(255, 205, 86)',
                                            'rgb(75, 192, 192)',
                                            'rgb(54, 162, 235)',
                                            'rgb(153, 102, 255)',
                                            'rgb(201, 203, 207)'
                                        ],
                                        borderWidth: 1
                                    }]
                                };

                                const config2 = {
                                    type: 'bar',
                                    data: data2,
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    },
                                };

                                var Usuarios = new Chart(
                                    document.getElementById('Usuarios'),
                                    config2
                                );
                                </script>


                             </th>
                             <th>
                                <!--///////////GRAFICA3/////////-->

                                <?php
                                $con = new mysqli(HOST, USER_BD, PASS_BD, BD); 

                                $monthact = array();
                                $amountact = array();

                                $query = $con->query("SELECT MONTHNAME(fecha_pago) as monthname, SUM(monto_pago) as monto
                                FROM pagos
                                WHERE fecha_pago >= CURDATE() - INTERVAL 1 MONTH
                                GROUP BY monthname ORDER BY MONTH(fecha_pago);");

                                while ($row = $query->fetch_assoc()) {
                                    $monthact[] = $row['monthname'];
                                    $amountact[] = $row['monto'];
                                }

                                ?>


                                <div style="width: 500px;">
                                    <canvas id="myChart3"></canvas>
                                </div>

                                <script>
                                // === include 'setup' then 'config' above ===
                                const labels3 = <?php echo json_encode($monthact) ?>;
                                const data3 = {
                                    labels: labels3,
                                    datasets: [{
                                        label: 'Ingresos ultimos 30 dias',
                                        data: <?php echo json_encode($amountact) ?>,
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(255, 159, 64, 0.2)',
                                            'rgba(255, 205, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(201, 203, 207, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(255, 159, 64)',
                                            'rgb(255, 205, 86)',
                                            'rgb(75, 192, 192)',
                                            'rgb(54, 162, 235)',
                                            'rgb(153, 102, 255)',
                                            'rgb(201, 203, 207)'
                                        ],
                                        borderWidth: 1
                                    }]
                                };

                                const config = {
                                    type: 'bar',
                                    data: data3,
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    },
                                };

                                var myChart3 = new Chart(
                                    document.getElementById('myChart3'),
                                    config
                                );
                                </script>
                            </th>
                        </tr>
                    </tbody>
                    
                </table>
                
            </div>
            <!--///////////GRAFICA/////////-->

            
            <!--///////////GRAFICA/////////-->
            <?php
            $con = new mysqli(HOST, USER_BD, PASS_BD, BD);
            $query = $con->query("SELECT SUM(monto_deuda) AS total_deuda_pendiente FROM deudas;");
            $total_deuda = 0;
            foreach ($query as $data) {
                $total_deuda += $data['total_deuda_pendiente'];
                }
            $deudaactual = $total_deuda;
            ?>
            <div class="tablaresumen" role="region" tabindex="0">
                <table>
                    <caption>
                        <p><br></p>
                    </caption>
                    <thead>
                        <tr>
                            <th><h1>Pendiente de pago</h1></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><p>El total de adeudo pendiente es de $<?php echo $deudaactual?></p></td>
                            
                        </tr>
                    </tbody>
                </table>
                
            </div>
            
        </div>
    </div>
</body>

</html>