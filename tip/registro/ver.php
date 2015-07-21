<?php
include_once("../../impresion/pdf.php");
$titulo="Tarjeta de Operación";
$id=$_GET['id'];
class PDF extends PPDF{
	
}

include_once("../../class/tip.php");
$tip=new tip;
$t=array_shift($tip->mostrar($id));

include_once '../../class/sindicato.php';
include_once '../../class/servicio.php';
include_once '../../class/modalidad.php';
$modalidad=new modalidad;
$servicio=new servicio;
$sindicato=new sindicato;
	
$mod=array_shift($modalidad->mostrar($t['codmodalidad']));
$sin=array_shift($sindicato->mostrar($t['codsindicato']));
$ser=array_shift($servicio->mostrar($t['codservicio']));

$pdf=new PDF("P","mm","letter");

$pdf->AddPage();
mostrarI(array(
					"Sindicato"=>$sin['nombre'],
					"Modalidad"=>$mod['nombre'],
					
				));
$pdf->CuadroCuerpoPersonalizado(60,"Placa",1,"C",1,"B");
$pdf->CuadroCuerpoPersonalizado(60,"Nombre del Propietario",1,"C",1,"B");
$pdf->CuadroCuerpoPersonalizado(62,"C.I. Propietario",1,"C",1,"B");
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(60,$t['placa'],0,"C",1,"");
$pdf->CuadroCuerpoPersonalizado(60,$t['propetario'],0,"C",1,"");
$pdf->CuadroCuerpoPersonalizado(62,$t['cipropetario'],0,"C",1,"");
$pdf->Ln();
mostrarI(array(
					"Dirección del Propetario"=>$t['direccion'],
				));
                
                
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(60,"Poliza de Seguro",1,"C",1,"B");
$pdf->CuadroCuerpoPersonalizado(60,"Marca",1,"C",1,"B");
$pdf->CuadroCuerpoPersonalizado(62,"Modelo",1,"C",1,"B");
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(60,$t['polizaseguro'],0,"C",1,"");
$pdf->CuadroCuerpoPersonalizado(60,$t['marca'],0,"C",1,"");
$pdf->CuadroCuerpoPersonalizado(62,$t['modelo'],0,"C",1,"");
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(60,"Color ",1,"C",1,"B");
$pdf->CuadroCuerpoPersonalizado(60,"Clase de Vehículo",1,"C",1,"B");
$pdf->CuadroCuerpoPersonalizado(62,"Nº de Asientos",1,"C",1,"B");
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(60,$t['color'],0,"C",1,"");
$pdf->CuadroCuerpoPersonalizado(60,$t['clasevehiculo'],0,"C",1,"");
$pdf->CuadroCuerpoPersonalizado(62,$t['nasientos'],0,"C",1,"");
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(60,"Nº de Motor",1,"C",1,"B");
$pdf->CuadroCuerpoPersonalizado(60,"Nº de Chasis",1,"C",1,"B");
$pdf->CuadroCuerpoPersonalizado(62,"Licencia Valida Hasta",1,"C",1,"B");
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(60,$t['nmotor'],0,"C",1,"");
$pdf->CuadroCuerpoPersonalizado(60,$t['nchasis'],0,"C",1,"");
$pdf->CuadroCuerpoPersonalizado(62,fecha2str($t['licenciavalida']),0,"C",1,"");
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(60,"Fecha de Registro",1,"C",1,"B");
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(60,fecha2str($t['fechaderegistro']),0,"C",1,"");
$pdf->Ln();
$pdf->Ln();

$pdf->CuadroCuerpoPersonalizado(182,"Tarjeta de Identificación Personal",1,"C",1,"B");
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(91,"Nombre del Conductor",1,"C",1,"B");
$pdf->CuadroCuerpoPersonalizado(91,"C.I. Conductor",1,"C",1,"B");
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(91,$t['nombreconductor'],0,"C",1,"");
$pdf->CuadroCuerpoPersonalizado(91,$t['ciconductor'],0,"C",1,"");
$pdf->Ln();
mostrarI(array(
					"Dirección del Conductor"=>$t['direccionconductor'],
				));

$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(91,"Categoria de la Licencia",1,"C",1,"B");
$pdf->CuadroCuerpoPersonalizado(91,"Número Gratuito",1,"C",1,"B");
$pdf->Ln();
$pdf->CuadroCuerpoPersonalizado(91,$t['categoriaconductor'],0,"C",1,"");
$pdf->CuadroCuerpoPersonalizado(91,$t['numerogratuito'],0,"C",1,"");
$pdf->Ln();
/*$foto="../foto/".$emp['foto'];
if(!empty($emp['foto']) && file_exists($foto)){
	$pdf->Image($foto,140,50,40,40);	
}
*/
$pdf->Output("reporte","I");
?>