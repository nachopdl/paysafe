<?php
session_start();
if(!$_SESSION['nombre']){
    header("location:index.php");
}
$id = $_SESSION['idU'];
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];
$correo = $_SESSION['correo'];
$archivo= $_SESSION['archivo'];

?>
<!DOCTYPE html>
<html>
<head>
    <title>Generar Informe en PDF con TCPDF</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/informe_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
            <li class="active">
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

                <h2>Perfil</h2>
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

    <div class="container">
        <form class="form" method="post" action="generar_informe_pagos.php">
            <input type="submit" name="generar_informe" value="Generar Informe de pagos en PDF">
        </form>

        <form class="form" method="post" action="generar_informe_deudas.php">
            <input type="submit" name="generar_informe" value="Generar Informe de deudas en PDF">
        </form>
    </div>

</body>
</html>
