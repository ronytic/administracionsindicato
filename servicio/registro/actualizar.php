<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/servicio.php");
$servicio=new servicio;
extract($_POST);
//empieza la copia de archivos
$valores=array(	"nombre"=>"'$nombre'",
				"descripcion"=>"'$descripcion'",
				"observacion"=>"'$observacion'",
				);
				$servicio->actualizar($valores,$id);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>