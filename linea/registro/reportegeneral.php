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


if($mod['tiporeporte']=="reporte1"){//Minibuses,microbus,carrys
	$pdf->CuadroCuerpoPersonalizado(30,"Pers. Jurídica",1,"",1,"B");
	$pdf->CuadroCuerpoPersonalizado(60,$sin['personeriajuridica'],0,"",1,"");
	$pdf->CuadroCuerpoPersonalizado(30,"Responsable",1,"",1,"B");
	$pdf->CuadroCuerpoPersonalizado(62,$sin['nombreresponsable'],0,"",1,"");
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(30,"Dirección",1,"",1,"B");
	$pdf->CuadroCuerpoPersonalizado(60,$sin['direccion'],0,"",1,"");
	$pdf->CuadroCuerpoPersonalizado(30,"C.I. Responsable",1,"",1,"B");
	$pdf->CuadroCuerpoPersonalizado(62,$sin['ciresponsable'],0,"",1,"");
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(30,"Teléfono",1,"",1,"B");
	$pdf->CuadroCuerpoPersonalizado(60,$sin['telefono'],0,"",1,"");
	$pdf->CuadroCuerpoPersonalizado(30,"Nº Pasajeros",1,"",1,"B");
	$pdf->CuadroCuerpoPersonalizado(62,$lin['numeropasajeros'],0,"",1,"");
	$pdf->Ln(10);
	
	$pdf->CuadroCuerpoPersonalizado(90,"MODALIDAD",1,"C",1,"B");
	$pdf->CuadroCuerpoPersonalizado(92,"SERVICIO",1,"C",1,"B");
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(90,$mod['nombre'],0,"",1,"");
	$pdf->CuadroCuerpoPersonalizado(92,$ser['nombre'],0,"",1,"");
	
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(90,"ORIGEN",1,"C",1,"B");
	$pdf->CuadroCuerpoPersonalizado(92,"DESTINO",1,"C",1,"B");
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(90,$lin['paradainicial'],0,"",1,"");
	$pdf->CuadroCuerpoPersonalizado(92,$lin['paradafinal'],0,"",1,"");
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(182,"LONGITUD DE TRAMO",1,"C",1,"B");
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(182,$lin['longitudtramo'],0,"",1,"");
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(90,"TRAYECTO DE IDA",1,"C",1,"B");
	$pdf->Line($pdf->GetX(),$pdf->GetY(),$pdf->GetX(),180);
	$pdf->CuadroCuerpoPersonalizado(92,"TRAYECTO DE RETORNO",1,"C",1,"B");
	$pdf->Ln();
	
	$y=$pdf->GetY();
	$pdf->CuadroCuerpoMulti(90,$lin['trayectoida'],9,"J",0);
	$x=$pdf->GetY();
	$pdf->SetXY(108,$y);
	$pdf->CuadroCuerpoMulti(92,$lin['trayectovuelta'],9,"J",0);
	$pdf->Ln();
	$pdf->SetY(180);
	$pdf->CuadroCuerpoPersonalizado(182,"OBSERVACIONES",1,"C",1,"B");
	$pdf->Ln();
	$pdf->CuadroCuerpoMulti(182,$lin['observacion'],0,"J",0);
	$pdf->ln();$pdf->ln();
}

if($mod['tiporeporte']=="reporte3" || $mod['tiporeporte']=="reporte2"){//TAXIS, RADIO TAXIS, TAXI FONOS Y CARGA
	$pdf->CuadroCuerpoPersonalizado(30,"Pers. Jurídica",1,"",1,"B");
	$pdf->CuadroCuerpoPersonalizado(60,$sin['personeriajuridica'],0,"",1,"");
	$pdf->CuadroCuerpoPersonalizado(30,"Responsable",1,"",1,"B");
	$pdf->CuadroCuerpoPersonalizado(62,$sin['nombreresponsable'],0,"",1,"");
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(30,"Dirección",1,"",1,"B");
	$pdf->CuadroCuerpoPersonalizado(60,$sin['direccion'],0,"",1,"");
	$pdf->CuadroCuerpoPersonalizado(30,"C.I. Responsable",1,"",1,"B");
	$pdf->CuadroCuerpoPersonalizado(62,$sin['ciresponsable'],0,"",1,"");
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(30,"Teléfono",1,"",1,"B");
	$pdf->CuadroCuerpoPersonalizado(60,$sin['telefono'],0,"",1,"");
	$pdf->CuadroCuerpoPersonalizado(30,"Nº Pasajeros",1,"",1,"B");
	$pdf->CuadroCuerpoPersonalizado(62,$lin['numeropasajeros'],0,"",1,"");
	$pdf->Ln(10);
	
	$pdf->CuadroCuerpoPersonalizado(90,"MODALIDAD",1,"C",1,"B");
	$pdf->CuadroCuerpoPersonalizado(92,"SERVICIO",1,"C",1,"B");
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(90,$mod['nombre'],0,"",1,"");
	$pdf->CuadroCuerpoPersonalizado(92,$ser['nombre'],0,"",1,"");
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(182,"LONGITUD DE TRAMO",1,"C",1,"B");
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(182,$lin['longitudtramo'],0,"",1,"");
	$pdf->Ln();
	
	$pdf->CuadroCuerpoPersonalizado(90,"PARADA DETALLADA",1,"C",1,"B");
	$pdf->Line($pdf->GetX(),$pdf->GetY(),$pdf->GetX(),160);
	$pdf->CuadroCuerpoPersonalizado(92,"VEHÍCULOS AUTORIZADOS",1,"C",1,"B");
	$pdf->Ln();
	
	$y=$pdf->GetY();
	$pdf->CuadroCuerpoMulti(90,$lin['paradaautorizadadetallada'],9,"J",0);
	$x=$pdf->GetY();
	$pdf->SetXY(108,$y);
	$pdf->CuadroCuerpoMulti(92,$lin['vehiculosautorizados'],9,"J",0);
	$pdf->Ln();
	$pdf->SetY(160);
	
	$pdf->CuadroCuerpoPersonalizado(182,"CARACTERÍSTICAS DEL VEHICULO",1,"C",1,"B");
	$pdf->Ln();
	$pdf->CuadroCuerpoMulti(182,$lin['caracteristicasvehiculo'],0,"J",0);
	$pdf->SetY(200);
	$pdf->CuadroCuerpoPersonalizado(182,"OBSERVACIONES",1,"C",1,"B");
	$pdf->Ln();
	$pdf->CuadroCuerpoMulti(182,$lin['observacion'],0,"J",0);
}

if($mod['tiporeporte']=="reporte4"){//Trufi
	$pdf->CuadroCuerpoPersonalizado(30,"Pers. Jurídica",1,"",1,"B");
	$pdf->CuadroCuerpoPersonalizado(60,$sin['personeriajuridica'],0,"",1,"");
	$pdf->CuadroCuerpoPersonalizado(30,"Responsable",1,"",1,"B");
	$pdf->CuadroCuerpoPersonalizado(62,$sin['nombreresponsable'],0,"",1,"");
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(30,"Dirección",1,"",1,"B");
	$pdf->CuadroCuerpoPersonalizado(60,$sin['direccion'],0,"",1,"");
	$pdf->CuadroCuerpoPersonalizado(30,"C.I. Responsable",1,"",1,"B");
	$pdf->CuadroCuerpoPersonalizado(62,$sin['ciresponsable'],0,"",1,"");
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(30,"Teléfono",1,"",1,"B");
	$pdf->CuadroCuerpoPersonalizado(60,$sin['telefono'],0,"",1,"");
	$pdf->CuadroCuerpoPersonalizado(30,"Nº Pasajeros",1,"",1,"B");
	$pdf->CuadroCuerpoPersonalizado(62,$lin['numeropasajeros'],0,"",1,"");
	$pdf->Ln(10);
	$pdf->CuadroCuerpoPersonalizado(90,"MODALIDAD",1,"C",1,"B");
	$pdf->CuadroCuerpoPersonalizado(92,"SERVICIO",1,"C",1,"B");
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(90,$mod['nombre'],0,"",1,"");
	$pdf->CuadroCuerpoPersonalizado(92,$ser['nombre'],0,"",1,"");
	
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(90,"ORIGEN",1,"C",1,"B");
	$pdf->CuadroCuerpoPersonalizado(92,"DESTINO",1,"C",1,"B");
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(90,$lin['paradainicial'],0,"",1,"",8);
	$pdf->CuadroCuerpoPersonalizado(92,$lin['paradafinal'],0,"",1,"",8);
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(182,"LONGITUD DE TRAMO",1,"C",1,"B");
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(182,$lin['longitudtramo'],0,"",1,"");
	$pdf->Ln();
	$pdf->CuadroCuerpoPersonalizado(90,"TRAYECTO DE IDA",1,"C",1,"B");
	$pdf->Line($pdf->GetX(),$pdf->GetY(),$pdf->GetX(),160);
	$pdf->CuadroCuerpoPersonalizado(92,"TRAYECTO VUELTA",1,"C",1,"B");
	$pdf->Ln();
	
	$y=$pdf->GetY();
	$pdf->CuadroCuerpoMulti(90,$lin['trayectoida'],9,"J",0);
	$x=$pdf->GetY();
	$pdf->SetXY(108,$y);
	$pdf->CuadroCuerpoMulti(92,$lin['trayectovuelta'],9,"J",0);
	$pdf->Ln();
	$pdf->SetY(160);
	
	$pdf->CuadroCuerpoPersonalizado(182,"CARACTERÍSTICAS DEL VEHÍCULO",1,"C",1,"B");
	$pdf->Ln();
	$pdf->CuadroCuerpoMulti(182,$lin['caracteristicasvehiculo'],0,"J",0);
	$pdf->SetY(200);
	$pdf->CuadroCuerpoPersonalizado(182,"OBSERVACIONES",1,"C",1,"B");
	$pdf->Ln();
	$pdf->CuadroCuerpoMulti(182,$lin['observacion'],0,"J",0);
}

$pdf->Output("reporte","I");
?>