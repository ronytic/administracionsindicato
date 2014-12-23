<?php
include_once("../../impresion/fpdf/fpdf.php");
$id=$_GET['id'];
$lineas=$_GET['lineas'];

include_once("../../class/tip.php");
$tip=new tip;
$t=array_shift($tip->mostrar($id));

include_once '../../class/sindicato.php';
include_once '../../class/servicio.php';
include_once '../../class/modalidad.php';
include_once '../../class/linea.php';
include_once '../../class/tipgenerado.php';
$modalidad=new modalidad;
$servicio=new servicio;
$sindicato=new sindicato;
$linea=new linea;
$tipgenerado=new tipgenerado;

	
$mod=array_shift($modalidad->mostrar($t['codmodalidad']));
$sin=array_shift($sindicato->mostrar($t['codsindicato']));
$lin=$linea->mostrarTodo("codsindicato=".$t['codsindicato']." and codmodalidad=".$t['codmodalidad']);

//print_r($lin);

$pdf=new FPDF("L","mm",array(217,141));
$pdf->SetFont("arial","B",11);
$pdf->AddPage();

$pdf->SetXY(15,61);

$pdf->Cell(90,4,utf8_decode(mb_strtoupper($sin['nombre'],"utf8")),0,0,"C");
$pdf->SetFont("arial","",10);

$pdf->SetXY(115,61);
$pdf->Cell(30,4,utf8_decode(mb_strtoupper($mod['nombre'],"utf8")),0,0,"C");
$numeroslineas='';
$numeroslineas2='';
$i=0;
//print_r($lineas);
$tipgenerado->eliminar2($id,"codtip");
if(count($lineas)){
	$numeroslineas=array();
	$numeroslineas2=array();
	foreach($lineas as $l){
		$tipgenerado->insertar(array("codtip"=>$id,"numerolinea"=>"'".$l."'"));
		$i++;
		if($i<=13){
		array_push($numeroslineas,$l);	
		}else{
		array_push($numeroslineas2,$l);
		}
	}
}
$numeroslineas=implode("-",$numeroslineas);
$numeroslineas2=implode("-",$numeroslineas2);
$pdf->SetFont("arial","",9);
$pdf->SetXY(15,77);
//$pdf->Cell(130,4,utf8_decode(mb_strtoupper($numeroslineas,"utf8")),0,0,"C");

$pdf->SetXY(15,75);
$pdf->Cell(130,4,utf8_decode(mb_strtoupper($numeroslineas,"utf8")),0,0,"C");
$pdf->SetXY(15,78);
$pdf->Cell(130,4,utf8_decode(mb_strtoupper($numeroslineas2,"utf8")),0,0,"C");


$pdf->SetFont("arial","B",11);

$pdf->SetXY(15,94);
$pdf->Cell(130,4,utf8_decode(mb_strtoupper($t['nombreconductor'],"utf8")),0,0,"C");

$pdf->SetXY(15,111);
$pdf->Cell(45,4,utf8_decode(mb_strtoupper($t['ciconductor'],"utf8")),0,0,"C");
$pdf->SetFont("arial","",10);
$pdf->SetXY(70,111);
$pdf->Cell(35,4,utf8_decode(mb_strtoupper($t['categoriaconductor'],"utf8")),0,0,"C");

$pdf->SetXY(110,111);
$pdf->Cell(70,4,utf8_decode(mb_strtoupper($t['numerogratuito'],"utf8")),0,0,"C");

$foto="../../imagenes/fotografiaconductor/".$t['fotografiaconductor'];
if(!empty($t['fotografiaconductor']) && file_exists($foto)){
	$pdf->Image($foto,157,55,32,40);	
}

$pdf->Output("reporte","I");
?>