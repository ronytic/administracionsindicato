<?php  
include_once("../../login/check.php");
if (!empty($_GET)) {
	$nombre="mensajes";
	include_once '../../class/'.$nombre.'.php';
	$mensa=new mensa;
	$id=$_GET['id'];
	$mensa->eliminar($id);
}
?>