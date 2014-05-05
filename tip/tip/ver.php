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

$pdf=new FPDF("L","mm",array(217,141));
$pdf->SetFont("arial","",10);
$pdf->AddPage();

$pdf->SetXY(15,62);
$pdf->Cell(90,4,utf8_encode(mb_strtoupper($sin['nombre'],"utf8")),0,0,"C");

$pdf->SetXY(115,62);
$pdf->Cell(30,4,utf8_encode(mb_strtoupper($mod['nombre'],"utf8")),0,0,"C");

foreach($lin as $l){
	$numeroslineas.=$l['numerolinea']." - ";	
}

$pdf->SetXY(15,77);
$pdf->Cell(130,4,utf8_encode(mb_strtoupper($numeroslineas,"utf8")),0,0,"C");

$pdf->SetXY(15,92);
$pdf->Cell(130,4,utf8_encode(mb_strtoupper($t['nombreconductor'],"utf8")),0,0,"C");

$pdf->SetXY(15,109);
$pdf->Cell(45,4,utf8_encode(mb_strtoupper($t['ciconductor'],"utf8")),0,0,"C");

$pdf->SetXY(70,109);
$pdf->Cell(35,4,utf8_encode(mb_strtoupper($t['categoriaconductor'],"utf8")),0,0,"C");

$pdf->SetXY(110,109);
$pdf->Cell(70,4,utf8_encode(mb_strtoupper($t['numerogratuito'],"utf8")),0,0,"C");

$foto="../../imagenes/fotografiaconductor/".$t['fotografiaconductor'];
if(!empty($t['fotografiaconductor']) && file_exists($foto)){
	$pdf->Image($foto,153,55,32,40);	
}

$pdf->Output("reporte","I");
?>