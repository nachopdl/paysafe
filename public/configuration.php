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
            <li>
                <a href="stats.php">
                    <i class="fas fa-chart-bar"></i>
                    <span>Estadisticas</span>
                </a>
            </li>
            <li >
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

            <li class="active">
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

                <h2>Configuracion</h2>
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
        <div class="nopay light-red">
            <h1>Contacte con el administrador del sistema</h1>
        </div>
        </div>
    </div>
</body>

</html>