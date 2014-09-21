<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/modalidad.php';
	extract($_POST);

	$modalidad=new modalidad;
	$mod=$modalidad->mostrarTodo("nombre LIKE '%$nombre%'");
	$titulo=array("nombre"=>"Nombre","descripcion"=>"Descripción","observacion"=>"Observación");
	$nivel=$_SESSION['nivel'];
	
	//$rep="ver.php";
	$modi="modificar.php";
	$eli="eliminar.php";
	
	switch($nivel){
		case 1:{//$modi="";//SuperAdmin
				//$eli="";
				//$rep="";
				}break;
		case 2:{$modi="";//Dirección
				$eli="";
				$rep="";
				}break;
		case 3:{$modi="";//Unidad de Trafico
				$eli="";
				$rep="";
				}break;
		case 4:{$modi="";//Tecnico
				//$eli="";
				$rep="";
				}break;
		case 5:{$modi="";//Secretaria
				$eli="";
				$rep="";
				}break;
	}
	listadoTabla($titulo,$mod,1,$modi,$eli,$rep);
}
?>