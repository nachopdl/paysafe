<?php
    session_start();
    require 'conecta.php';
    $con = conecta();
    $mail = $_REQUEST['mail'];
    $pass = $_REQUEST['pass'];
    //$pass = md5($pass);
    //de aqui se agrega a la session los demas datos para hacer la carga dinamica de las fotos y nombre acorde al usuario


    $sql = "SELECT * FROM usuario WHERE correo = '$mail' AND pass = '$pass'";
    $res = mysqli_query($con, $sql);
    $count = $res->num_rows;
    if($count){
        $row = $res->fetch_array();
        $idU = $row["id"];
        $nombre = $row["nombre"];
        $apellido = $row["apellido"];
        $correo = $row["correo"];
        $telefono = $row["telefono"];
        $archivo = $row["archivo"];
        $_SESSION['idU']      = $idU;
        $_SESSION['nombre']   = $nombre;
        $_SESSION['apellido']   = $apellido;
        $_SESSION['correo']   = $correo;
        $_SESSION['telefono'] = $telefono;
        $_SESSION['archivo'] =$archivo;
    }

    $idU = $_SESSION['idU'];
    $res = $con->query($sql);

    echo $count;
?>