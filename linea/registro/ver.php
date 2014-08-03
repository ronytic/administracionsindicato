<?php
include_once("../../impresion/pdf.php");
$titulo="Reporte de Registro de Linea";
$id=$_GET['id'];
class PDF extends PPDF{
	
}

include_once("../../class/linea.php");
$linea=new linea;
$lin=array_shift($linea->mostrar($id));

include_once '../../class/sindicato.php';
include_once '../../class/servicio.php';
include_once '../../class/modalidad.php';
$modalidad=new modalidad;
$servicio=new servicio;
$sindicato=new sindicato;
	
$mod=array_shift($modalidad->mostrar($lin['codmodalidad']));
$sin=array_shift($sindicato->mostrar($lin['codsindicato']));
$ser=array_shift($servicio->mostrar($lin['codservicio']));

$pdf=new PDF("P","mm","letter");

$pdf->AddPage();
if($mod['tiporeporte']=="reporte1" || $mod['tiporeporte']=="reporte4"){
	mostrarI(array("Número de Linea"=>$lin['numerolinea'],
					"Color"=>$lin['color'],
					"Sindicato"=>$sin['nombre'],
					"Parada Inicial"=>$lin['paradainicial'],
					
				));
	$pdf->CuadroCuerpoPersonalizado(182,"Trayecto de Ida",1,"C",1,"B");
	$pdf->Ln();
	$pdf->CuadroCuerpoMulti(182,$lin['trayectoida'],0,"",1);
	
	mostrarI(array("Parada Final"=>$lin['paradafinal'],
					));
	$pdf->CuadroCuerpoPersonalizado(182,"Trayecto de Vuelta",1,"C",1,"B");
	$pdf->Ln();
	$pdf->CuadroCuerpoMulti(182,$lin['trayectovuelta'],0,"",1);
	$pdf->CuadroCuerpoPersonalizado(182,"Características del Vehículo",1,"C",1,"B");
	$pdf->Ln();
	$pdf->CuadroCuerpoMulti(182,$lin['caracteristicasvehiculo'],0,"",1);
	mostrarI(array(
					"Modalidad"=>$mod['nombre'],
					"Servicio"=>$ser['nombre']));
	$pdf->CuadroCuerpoPersonalizado(182,"Observación",1,"C",1,"B");
	$pdf->Ln();
	$pdf->CuadroCuerpoMulti(182,$lin['observacion'],0,"",0);
}

if($mod['tiporeporte']=="reporte3" || $mod['tiporeporte']=="reporte2"){
	mostrarI(array("Número de Linea"=>$lin['numerolinea'],
					"Sindicato"=>$sin['nombre'],
					"Modalidad"=>$mod['nombre'],
					"Parada Inicial"=>$lin['paradainicial'],
					"Servicio"=>$ser['nombre']
					
				));
	$pdf->CuadroCuerpoPersonalizado(182,"Parada Autorizada",1,"C",1,"B");
	$pdf->Ln();
	$pdf->CuadroCuerpoMulti(182,$lin['paradainicial'],0,"",1);
	
	mostrarI(array("Vehiculos Autorizados"=>$lin['vehiculosautorizados'],
					));
	
	$pdf->CuadroCuerpoPersonalizado(182,"Observaciones",1,"C",1,"B");
	$pdf->Ln();
	$pdf->CuadroCuerpoMulti(182,$lin['observacion'],0,"",0);
}
/*$foto="../foto/".$emp['foto'];
if(!empty($emp['foto']) && file_exists($foto)){
	$pdf->Image($foto,140,50,40,40);	
}
*/
$pdf->Output("reporte","I");
?>