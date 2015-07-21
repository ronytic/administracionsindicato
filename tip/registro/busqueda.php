<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/tip.php';
	include_once '../../class/sindicato.php';
	include_once '../../class/servicio.php';
	include_once '../../class/modalidad.php';
	extract($_POST);

	$codsindicato=$codsindicato!=''?" and codsindicato='$codsindicato'":'';
	$codmodalidad=$codmodalidad!=''?" and codmodalidad='$codmodalidad'":'';
	$codservicio=$codservicio!=''?" and codservicio='$codservicio'":'';
	$codbarravehiculo=$codbarravehiculo!=''?$codbarravehiculo:'%';
	$codbarrapropetario=$codbarrapropetario!=''?$codbarrapropetario:'%';
	
	$tip=new tip;
	$modalidad=new modalidad;
	$servicio=new servicio;
	$sindicato=new sindicato;
	$ti=$tip->mostrarTodo("placa LIKE '%$placa%' $codsindicato $codmodalidad  and propetario LIKE '%$propetario%' and cipropetario LIKE '%$cipropetario%' and nombreconductor LIKE '%$nombreconductor%' and ciconductor LIKE '%$ciconductor%' and (codbarravehiculo LIKE '$codbarravehiculo' and codbarrapropetario LIKE '$codbarrapropetario')","placa");
	
	foreach($ti as $t){$i++;
		$mod=array_shift($modalidad->mostrar($t['codmodalidad']));
		$sin=array_shift($sindicato->mostrar($t['codsindicato']));
		$datos[$i]['codtip']=$t['codtip'];
		$datos[$i]['placa']=$t['placa'];
		$datos[$i]['propetario']=$t['propetario'];
		$datos[$i]['cipropetario']=$t['cipropetario'];
		$datos[$i]['nombreconductor']=$t['nombreconductor'];
		$datos[$i]['ciconductor']=$t['ciconductor'];


		$datos[$i]['codmodalidad']=$mod['nombre'];
		$datos[$i]['codsindicato']=$sin['nombre'];
		$datos[$i]['codservicio']=$ser['nombre'];
	}
	$titulo=array("placa"=>"Placa","propetario"=>"Propetario","cipropetario"=>"CI Propetario","nombreconductor"=>"Nombre del Conductor","ciconductor"=>"CI Conductor","codmodalidad"=>"Modalidad","codsindicato"=>"Sindicato");
	
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
		case 4:{//$modi="";//Tecnico
				//$eli="";
				$rep="";
				}break;
		case 5:{$modi="";//Secretaria
				$eli="";
				$rep="";
				}break;
	}
	
	listadoTabla($titulo,$datos,1,$modi,$eli,"ver.php","","","_blank");
}
?>