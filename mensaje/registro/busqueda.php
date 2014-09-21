<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/mensajes.php';
	extract($_POST);

	$mensa=new mensa;
	$mod=$mensa->mostrarTodo("mensaje LIKE '%$mensaje%'");
	$titulo=array("mensaje"=>"Mensaje");
	//$rep="ver.php";
	$modi="modificar.php";
	$eli="eliminar.php";
	
	switch($nivel){
		case 1:{//$modi="";//SuperAdmin
				//$eli="";
				//$rep="";
				}break;
		case 2:{//$modi="";//Dirección
				//$eli="";
				$rep="";
				}break;
		case 3:{//$modi="";//Unidad de Trafico
				//$eli="";
				$rep="";
				}break;
		case 4:{$modi="";//Tecnico
				$eli="";
				$rep="";
				}break;
		case 5:{$modi="";//Secretaria
				$eli="";
				$rep="";
				}break;
	}
	listadoTabla($titulo,$mod,1,$modi,$eli,"");
}
?>