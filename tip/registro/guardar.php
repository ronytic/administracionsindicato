<?php
include_once("../../login/check.php");
if(!empty($_POST)):
include_once("../../class/tip.php");
$tip=new tip;

extract($_POST);
//empieza la copia de archivos
if($_FILES['fotografiapropetario']['name']!=""){
	if((1==1) && $_FILES['fotografiapropetario']['size']<="500000000"){
		@$fotografiapropetario=$_FILES['fotografiapropetario']['name'];
		copy($_FILES['fotografiapropetario']['tmp_name'],"../../imagenes/fotografiapropetario/".$_FILES['fotografiapropetario']['name']);
	}else{
		//mensaje que no es valido el tipo de archivo	
		$mensaje[]="Archivo de imagen del propietario no valido . Verifique e intente nuevamente";
	}
}

if($_FILES['fotografiaconductor']['name']!=""){
	if((1==1) && $_FILES['fotografiaconductor']['size']<="500000000"){
		@$fotografiaconductor=$_FILES['fotografiaconductor']['name'];
		copy($_FILES['fotografiaconductor']['tmp_name'],"../../imagenes/fotografiaconductor/".$_FILES['fotografiaconductor']['name']);
	}else{
		//mensaje que no es valido el tipo de archivo	
		$mensaje[]="Archivo de imagen del conductor no valido. Verifique e intente nuevamente";
	}
}
//$t=$tip->mostrarTodo("codsindicato='$codsindicato' and codmodalidad='$codmodalidad' and placa='$placa'");
$t=$tip->mostrarTodo("placa='$placa'");
if(count($t)==0){
$valores=array(	"codsindicato"=>"'$codsindicato'",
				"codmodalidad"=>"'$codmodalidad'",
				"placa"=>"'$placa'",
				"propetario"=>"'$propetario'",
				"cipropetario"=>"'$cipropetario'",
                "direccion"=>"'$direccion'",
                
				"polizaseguro"=>"'$polizaseguro'",
				"marca"=>"'$marca'",
				"modelo"=>"'$modelo'",
				"color"=>"'$color'",
				
				"clasevehiculo"=>"'$clasevehiculo'",
				"nasientos"=>"'$nasientos'",
				"nmotor"=>"'$nmotor'",
				"nchasis"=>"'$nchasis'",
				"licenciavalida"=>"'$licenciavalida'",
				"fechaderegistro"=>"'$fechaderegistro'",
				
				"nombreconductor"=>"'$nombreconductor'",
				"ciconductor"=>"'$ciconductor'",
                "direccionconductor"=>"'$direccionconductor'",
                
				"categoriaconductor"=>"'$categoriaconductor'",
				"numerogratuito"=>"'$numerogratuito'",
				"fotografiapropetario"=>"'$fotografiapropetario'",
				"fotografiaconductor"=>"'$fotografiaconductor'",
				
				"codbarrapropetario"=>"'$codbarrapropetario'",
				"codbarravehiculo"=>"'$codbarravehiculo'",
				
				
				);
				$tip->insertar($valores);
				$mensaje[]="SUS DATOS SE GUARDARON CORRECTAMENTE";
}else{
	$mensaje[]="El número de placa del vehículo ya se encuentra Registrado";
}


$titulo="Mensaje de Respuesta";
$folder="../../";
include_once '../../mensajeresultado.php';
endif;?>