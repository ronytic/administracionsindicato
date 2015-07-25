<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/sindicato.php';
	extract($_POST);

	$sindicato=new sindicato;
	$sin=$sindicato->mostrarTodo("nombre LIKE '%$nombre%'","nombre");
	$titulo=array("nombre"=>"Nombre","personeriajuridica"=>"Personería Jurídica","nombreresponsable"=>"Nombre Responsable","ciresponsable"=>"C.I. Responsable","telefono"=>"Teléfono","direccion"=>"Dirección");
	
	$rep="ver.php";
	$modi="modificar.php";
	$eli="eliminar.php";
	
    
    // Le quitas Comentario Le Bloqueas
    // Lo comentas le habilitas
    //echo $nivel;
	switch($nivel){
		case 1:{//$modi="";//SuperAdmin
				//$eli="";
				//$rep="";
				}break;
		case 2:{$modi="";//Dirección
				$eli="";
				//$rep="";
				}break;
		case 3:{$modi="";//Unidad de Trafico
				$eli="";
				//$rep="";
				}break;
		case 4:{//$modi="";//Tecnico
				//$eli="";
				//$rep="";
				}break;
		case 5:{$modi="";//Secretaria
				$eli="";
				//$rep="";
				}break;
	}
	listadoTabla($titulo,$sin,1,$modi,$eli,$rep);
}
?>