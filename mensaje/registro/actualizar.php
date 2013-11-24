<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/mensajes.php");
$mensa=new mensa;
extract($_POST);
//empieza la copia de archivos
$valores=array(	"mensaje"=>"'$nombre'",
				);
				$mensa->actualizar($valores,$id);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>