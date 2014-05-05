<?php
include_once("../../impresion/fpdf/fpdf.php");
$id=$_GET['id'];

include_once("../../class/tip.php");
$tip=new tip;
$t=array_shift($tip->mostrar($id));

include_once '../../class/sindicato.php';
include_once '../../class/servicio.php';
include_once '../../class/modalidad.php';
include_once '../../class/linea.php';
$modalidad=new modalidad;
$servicio=new servicio;
$sindicato=new sindicato;
$linea=new linea;
	
$mod=array_shift($modalidad->mostrar($t['codmodalidad']));
$sin=array_shift($sindicato->mostrar($t['codsindicato']));
$lin=$linea->mostrarTodo("codsindicato=".$t['codsindicato']." and codmodalidad=".$t['codmodalidad']);

//print_r($lin);

$pdf=new FPDF("L","mm",array(217,168));
$pdf->SetFont("arial","",10);
$pdf->AddPage();

$pdf->SetXY(20,48);
$pdf->Cell(50,4,utf8_encode(mb_strtoupper($t['placa'],"utf8")),0,0,"C");

$pdf->SetXY(35,63);
$pdf->Cell(130,4,utf8_encode(mb_strtoupper($sin['nombre'],"utf8")),0,0,"C");

$pdf->SetXY(160,84);
$pdf->Cell(45,4,utf8_encode(mb_strtoupper($mod['nombre'],"utf8")),0,0,"C");

foreach($lin as $l){
	$numeroslineas.=$l['numerolinea']." - ";	
}

$pdf->SetXY(30,84);
$pdf->Cell(105,4,utf8_encode(mb_strtoupper($t['propetario'],"utf8")),0,0,"C");


$pdf->SetXY(25,72);
$pdf->Cell(130,4,utf8_encode(mb_strtoupper($numeroslineas,"utf8")),0,0,"C");

$pdf->SetXY(50,90);
$pdf->Cell(55,4,utf8_encode(mb_strtoupper($t['cipropetario'],"utf8")),0,0,"C");

$pdf->SetXY(130,90);
$pdf->Cell(70,4,utf8_encode(mb_strtoupper($t['polizaseguro'],"utf8")),0,0,"C");

$pdf->SetXY(25,103);
$pdf->Cell(50,4,utf8_encode(mb_strtoupper($t['marca'],"utf8")),0,0,"C");

$pdf->SetXY(95,103);
$pdf->Cell(50,4,utf8_encode(mb_strtoupper($t['modelo'],"utf8")),0,0,"C");

$pdf->SetXY(155,103);
$pdf->Cell(50,4,utf8_encode(mb_strtoupper($t['color'],"utf8")),0,0,"C");

$pdf->SetXY(40,109);
$pdf->Cell(65,4,utf8_encode(mb_strtoupper($t['clasevehiculo'],"utf8")),0,0,"C");

$pdf->SetXY(130,109);
$pdf->Cell(65,4,utf8_encode(mb_strtoupper($t['nasientos'],"utf8")),0,0,"C");

$pdf->SetXY(40,116);
$pdf->Cell(65,4,utf8_encode(mb_strtoupper($t['nmotor'],"utf8")),0,0,"C");

$pdf->SetXY(130,116);
$pdf->Cell(65,4,utf8_encode(mb_strtoupper($t['nchasis'],"utf8")),0,0,"C");

$pdf->SetXY(122,123);
$pdf->Cell(10,4,utf8_encode(mb_strtoupper(date("d",strtotime($t['licenciavalida'])),"utf8")),0,0,"C");

$pdf->SetXY(143,123);
$pdf->Cell(35,4,utf8_encode(mb_strtoupper(strftime("%B",strtotime($t['licenciavalida'])),"utf8")),0,0,"C");

$pdf->SetXY(190,123);
$pdf->Cell(15,4,utf8_encode(mb_strtoupper(date("Y",strtotime($t['licenciavalida'])),"utf8")),0,0,"C");


$pdf->SetXY(24,133);
$pdf->Cell(10,4,utf8_encode(mb_strtoupper(date("d",strtotime($t['fechaderegistro'])),"utf8")),0,0,"C");

$pdf->SetXY(46,133);
$pdf->Cell(35,4,utf8_encode(mb_strtoupper(strftime("%B",strtotime($t['fechaderegistro'])),"utf8")),0,0,"C");

$pdf->SetXY(96,133);
$pdf->Cell(15,4,utf8_encode(mb_strtoupper(date("Y",strtotime($t['fechaderegistro'])),"utf8")),0,0,"C");


$pdf->SetXY(190,35);
$pdf->Cell(15,4,utf8_encode(mb_strtoupper(date("Y",strtotime($t['fechaderegistro'])),"utf8")),0,0,"C");

$foto="../../imagenes/fotografiapropetario/".$t['fotografiapropetario'];
if(!empty($t['fotografiapropetario']) && file_exists($foto)){
	$pdf->Image($foto,177,45,30,35);	
}

$pdf->Output("reporte","I");
?>