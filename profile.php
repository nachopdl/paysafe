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
                <a href="#">
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



        <div class="tabular--wrapper">
        <div class="containerpp">
                <div class="image-container" onclick="document.getElementById('myModal').style.display='block'">
                    <img src="./images/<?php echo $archivo; ?>" alt="Imagen del usuario" class="imagepp" />
                </div>
                <div class="user-info">
                    <span>ID:</span> <?php echo $id;?>
                    <br />
                    <span>Nombre:</span> <?php echo $nombre;?>
                    <br />
                    <span>Apellido:</span> <?php echo $apellido;?>
                    <br />
                    <span>Correo:</span> <?php echo $correo;?>
                    <br />
                    <span>Contraseña:</span> ************
                    <br />
                    <!--<button class="button" onclick="changeImage()">Eliminar usuario</button>-->
                </div>
            </div>

            <div id="myModal" class="modal">
                <span class="close"><i class="fa-solid fa-circle-xmark fa-bounce"></i></span>
                <img class="modal-content" src="./images/<?php echo $archivo; ?>">
                <button class="button" onclick="changeImage()">Cambiar Imagen</button>
            </div>

            <script>
            var modal = document.getElementById('myModal');
            var span = document.getElementsByClassName("close")[0];
            span.onclick = function() {
                modal.style.display = "none";
            }
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            function changeImage() {
                var currentImage = document.querySelector(".modal-content");
                if (currentImage.src.endsWith("imagen_usuario.jpg")) {
                    currentImage.src = "nueva_imagen.jpg";
                } else {
                    currentImage.src = "imagen_usuario.jpg";
                }
            }
            </script>
            

        </div>
    </div>
</body>

</html>