<?php
include_once("../../impresion/pdf.php");

$id=$_GET['id'];
class PDF extends PPDF{
	
}
//="Registro de Linea con datos de Sindicato";
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
$titulo="Linea: ".$lin['numerolinea'];
$pdf->AddPage();
$pdf->CuadroCuerpoPersonalizado($pdf->w-40,mb_strtoupper($sin['nombre'],"utf8"),0,"C",0,"UB");$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado($pdf->w-40,"RECORRIDO AUTORIZADO",0,"C",0,"B");$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado($pdf->w-40,"COMISIÓN INTERINSTITUCIONAL \"EL ALTO\"",0,"C",0,"B");
$pdf->Ln(10);
$pdf->CuadroCuerpoPersonalizado(30,"Responsable",1,"",1,"B");
$pdf->CuadroCuerpoPersonalizado(60,$sin['nombreresponsable'],0,"",1,"");
$pdf->CuadroCuerpoPersonalizado(30,"C.I.",1,"",1,"B");
$pdf->CuadroCuerpoPersonalizado(60,$sin['ciresponsable'],0,"",1,"");
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(30,"Dirección",1,"",1,"B");
$pdf->CuadroCuerpoPersonalizado(60,$sin['direccion'],0,"",1,"");
$pdf->CuadroCuerpoPersonalizado(30,"Pers. Jurídica",1,"",1,"B");
$pdf->CuadroCuerpoPersonalizado(60,$sin['personeriajuridica'],0,"",1,"");
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(30,"Teléfono",1,"",1,"B");
$pdf->CuadroCuerpoPersonalizado(60,$sin['telefono'],0,"",1,"");
if($mod['tiporeporte']=="reporte1" or $mod['tiporeporte']=="reporte3" or $mod['tiporeporte']=="reporte4"){
	$pdf->CuadroCuerpoPersonalizado(30,"Nº Pasajeros",1,"",1,"B");
	$pdf->CuadroCuerpoPersonalizado(60,$lin['numeropasajeros'],0,"",1,"");
}
$pdf->Ln(10);

$pdf->CuadroCuerpoPersonalizado(90,"MODALIDAD",1,"C",1,"B");
$pdf->CuadroCuerpoPersonalizado(90,"SERVICIO",1,"C",1,"B");
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(90,$mod['nombre'],0,"",1,"");
$pdf->CuadroCuerpoPersonalizado(90,$ser['nombre'],0,"",1,"");
$pdf->Ln();
if($mod['tiporeporte']=="reporte1" or $mod['tiporeporte']=="reporte4"){
	$pdf->CuadroCuerpoPersonalizado(90,"PARADA INICIAL",1,"C",1,"B");
	$pdf->CuadroCuerpoPersonalizado(90,"PARADA FINAL",1,"C",1,"B");
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(90,$lin['paradainicial'],0,"",1,"");
	$pdf->CuadroCuerpoPersonalizado(90,$lin['paradafinal'],0,"",1,"");
	$pdf->Ln();
}
if($mod['tiporeporte']=="reporte2" or $mod['tiporeporte']=="reporte3"){
	$pdf->CuadroCuerpoPersonalizado(90,"PARADA AUTORIZADA",1,"C",1,"B");
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(90,$lin['paradaautorizada'],0,"",1,"");
	$pdf->Ln();
}
$pdf->Ln();
if($mod['tiporeporte']=="reporte1" or $mod['tiporeporte']=="reporte4"){
	$pdf->CuadroCuerpoPersonalizado(180,"LONGITUD DE TRAMO",1,"C",1,"B");
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(180,$lin['longitudtramo'],0,"",1,"");
	$pdf->Ln();
}
$pdf->Ln(10);
if($mod['tiporeporte']=="reporte1" or $mod['tiporeporte']=="reporte4"){
	$pdf->CuadroCuerpoPersonalizado(90,"IDA",1,"C",1,"B");
	$pdf->CuadroCuerpoPersonalizado(90,"RETORNO",1,"C",1,"B");
	$pdf->Ln();
	$y=$pdf->GetY();
	$pdf->CuadroCuerpoMulti(90,$lin['trayectoida'],9,"",1);
	$x=$pdf->GetY();
	$pdf->SetXY(108,$y);
	$pdf->CuadroCuerpoMulti(90,$lin['trayectovuelta'],9,"",1);
}
if($mod['tiporeporte']=="reporte2" or $mod['tiporeporte']=="reporte3"){
	$pdf->CuadroCuerpoPersonalizado(90,"PARADA AUTORIZADA",1,"C",1,"B");
	if($mod['tiporeporte']=="reporte2"){
		$pdf->CuadroCuerpoPersonalizado(90,"VEHICULOS AUTORIZADOS",1,"C",1,"B");
	}else{
		$pdf->CuadroCuerpoPersonalizado(90,"CARACTERISTICAS DEL VEHICULO",1,"C",1,"B");	
	}
	$pdf->Ln();
	$y=$pdf->GetY();
	$pdf->CuadroCuerpoMulti(90,$lin['paradaautorizadadetallada'],9,"",1);
	$x=$pdf->GetY();
	$pdf->SetXY(108,$y);
	if($mod['tiporeporte']=="reporte2"){
		$pdf->CuadroCuerpoMulti(90,$lin['vehiculosautorizados'],9,"",1);
	}else{
		$pdf->CuadroCuerpoMulti(90,$lin['caracteristicasvehiculo'],9,"",1);
	}
}
if($mod['tiporeporte']=="reporte4"){
	$pdf->CuadroCuerpoPersonalizado(180,"CARACTERISTICAS DEL VEHICULO",1,"C",1,"B");	
	$pdf->Ln();
	$pdf->CuadroCuerpoMulti(180,$lin['caracteristicasvehiculo'],9,"",1);
}
$pdf->Ln(20);
$pdf->CuadroCuerpoPersonalizado(180,"OBSERVACIONES",1,"C",1,"B");
$pdf->Ln();
$pdf->CuadroCuerpoMulti(180,$lin['observacion'],0,"",0);
$pdf->ln();$pdf->ln();

/*$foto="../foto/".$emp['foto'];
if(!empty($emp['foto']) && file_exists($foto)){
	$pdf->Image($foto,140,50,40,40);	
}
*/
$pdf->Output();
?>