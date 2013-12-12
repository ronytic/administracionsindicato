<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/sindicato.php");
$sindicato=new sindicato;
extract($_POST);
//empieza la copia de archivos
$valores=array(	"nombre"=>"'$nombre'",
				"personeriajuridica"=>"'$personeriajuridica'",
				"nombreresponsable"=>"'$nombreresponsable'",
				"ciresponsable"=>"'$ciresponsable'",
				"telefono"=>"'$telefono'",
				"direccion"=>"'$direccion'",
				"observacion"=>"'$observacion'",
				"fechamodificacion"=>"'".date("Y-m-d")."'",
				"horamodificacion"=>"'".date("H:i:s")."'",
				);
				$sindicato->actualizar($valores,$id);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>