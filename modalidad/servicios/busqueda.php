<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/servicio.php';
	extract($_POST);

	$servicio=new servicio;
	$ser=$servicio->mostrarTodo("nombre LIKE '%$nombre%'");
	$titulo=array("nombre"=>"Nombre","descripcion"=>"Descripción","observacion"=>"Observación");
	listadoTabla($titulo,$ser,1,"modificar.php","eliminar.php","");
}
?>