<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/linea.php");
$linea=new linea;
extract($_POST);
//empieza la copia de archivos
$valores=array(	"numerolinea"=>"'$numerolinea'",
				"color"=>"'$color'",
				"codsindicato"=>"'$codsindicato'",
				"paradainicial"=>"'$paradainicial'",
				"paradafinal"=>"'$paradafinal'",
				"trayectoida"=>"'$trayectoida'",
				"trayectovuelta"=>"'$trayectovuelta'",
				"longitudtramo"=>"'$longitudtramo'",
				"numeropasajeros"=>"'$numeropasajeros'",
				"codmodalidad"=>"'$codmodalidad'",
				"codservicio"=>"'$codservicio'",
				"observacion"=>"'$observacion'",
				"paradaautorizada"=>"'$paradaautorizada'",
				"paradaautorizadadetallada"=>"'$paradaautorizadadetallada'",
				"vehiculosautorizados"=>"'$vehiculosautorizados'",
				"caracteristicasvehiculo"=>"'$caracteristicasvehiculo'",
				"fechamodificacion"=>"'".date("Y-m-d")."'",
				"horamodificacion"=>"'".date("H:i:s")."'",
				);
				$linea->actualizar($valores,$id);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>