<?php
    session_start();
    require 'conecta.php';
    $con = conecta();
    $mail = $_REQUEST['mail'];
    $pass = $_REQUEST['pass'];
    //$pass = md5($pass);

    $sql = "SELECT * FROM usuario WHERE correo = '$mail' AND pass = '$pass'";
    $res = mysqli_query($con, $sql) or die (mysql_error());
    $count = $res->num_rows;
    if($count){
        $row = $res->fetch_array();
        $idU = $row["id"];
        $nombre = $row["nombre"] . ' ' . $row["apellido"];
        $correo = $row["correo"];
        $telefono = $row["telefono"];
        $_SESSION['idU']      = $idU;
        $_SESSION['nombre']   = $nombre;
        $_SESSION['correo']   = $correo;
        $_SESSION['telefono'] = $telefono;
    }

    $idU = $_SESSION['idU'];
    $res = $con->query($sql);

    echo $count;
?>