<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/mensajes.php';
	extract($_POST);

	$mensa=new mensa;
	$mod=$mensa->mostrarTodo("mensaje LIKE '%$mensaje%'");
	$titulo=array("mensaje"=>"Mensaje");
	listadoTabla($titulo,$mod,1,"modificar.php","eliminar.php","");
}
?>