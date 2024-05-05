<?php
// Ubicacion del archivo: 
// ./funciones/conecta.php
define ("HOST", 'localhost');
define ("BD", 'id21371185_paysafe');
define ("USER_BD", 'id21371185_admin');
define ("PASS_BD", 'Paysafe123.');

function conecta(){
	$con = new mysqli(HOST, USER_BD, PASS_BD, BD);
	return $con;
}
?>