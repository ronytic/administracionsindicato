<?php  
include_once("../../login/check.php");
if (!empty($_GET)) {
	$nombre="inventario";
	include_once '../../class/'.$nombre.'.php';
	${$nombre}=new $nombre;
	$id=$_GET['id'];
	${$nombre}->eliminar($id);
}
?>