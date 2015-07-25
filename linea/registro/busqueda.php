<?php 
include_once '../../login/check.php';
if (!empty($_POST)) {
	$folder="../../";
	include_once '../../class/linea.php';
	include_once '../../class/sindicato.php';
	include_once '../../class/servicio.php';
	include_once '../../class/modalidad.php';
	extract($_POST);

	//$codsindicato=$codsindicato!=''?" and codsindicato='$codsindicato'":'';
    
    $codsindicato=$codsindicato!=''?$codsindicato:'%';
    $codsindicato="and codsindicato IN(SELECT codsindicato FROM sindicato WHERE activo=1  and codsindicato LIKE '".$codsindicato."')";
	$codmodalidad=$codmodalidad!=''?" and codmodalidad='$codmodalidad'":'';
	$codservicio=$codservicio!=''?" and codservicio='$codservicio'":'';
	
	$linea=new linea;
	$modalidad=new modalidad;
	$servicio=new servicio;
	$sindicato=new sindicato;
	$lin=$linea->mostrarTodo("numerolinea LIKE '%$numerolinea%' $codsindicato $codmodalidad $codservicio and paradainicial LIKE '%$paradainicial%' and paradafinal LIKE '%$paradafinal%' and trayectoida LIKE '%$trayectoida%' and trayectovuelta LIKE '%$trayectovuelta%' ","numerolinea");
	
	foreach($lin as $l){$i++;
		$mod=array_shift($modalidad->mostrar($l['codmodalidad']));
		$sin=array_shift($sindicato->mostrar($l['codsindicato']));
		$ser=array_shift($servicio->mostrar($l['codservicio']));
		$datos[$i]['codlinea']=$l['codlinea'];
		$datos[$i]['paradainicial']=$l['paradainicial'];
		$datos[$i]['paradafinal']=$l['paradafinal'];
		$datos[$i]['numerolinea']=$l['numerolinea'];
		$datos[$i]['color']=$l['color'];
		$datos[$i]['longitudtramo']=$l['longitudtramo'];
		$datos[$i]['numeropasajeros']=$l['numeropasajeros'];
		$datos[$i]['codmodalidad']=$mod['nombre'];
		$datos[$i]['codsindicato']=$sin['nombre'];
		$datos[$i]['codservicio']=$ser['nombre'];
	}
	$titulo=array("numerolinea"=>"Número de Línea","color"=>"Color","paradainicial"=>"Parada Inicial","paradafinal"=>"Parada Final","longitudtramo"=>"Longitud Tramo","numeropasajeros"=>"Número de Pasajeros","codmodalidad"=>"Modalidad","codservicio"=>"Servicio","codsindicato"=>"Sindicato");
	
	
	
	$rep="ver.php";
	$modi="modificar.php";
	$eli="eliminar.php";
	
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
	
	listadoTabla($titulo,$datos,1,$modi,$eli,$rep,array("Ver Datos General"=>"reportegeneral.php"),"","_blank");
}
?>