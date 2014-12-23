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
include_once '../../class/togenerado.php';
$modalidad=new modalidad;
$servicio=new servicio;
$sindicato=new sindicato;
$linea=new linea;
$togenerado=new togenerado;

	
$mod=array_shift($modalidad->mostrar($t['codmodalidad']));
$sin=array_shift($sindicato->mostrar($t['codsindicato']));
$lin=$linea->mostrarTodo("codsindicato=".$t['codsindicato']." and codmodalidad=".$t['codmodalidad']);

//print_r($lin);

$pdf=new FPDF("L","mm",array(217,168));
$pdf->SetFont("arial","",10);
$pdf->AddPage();
$pdf->SetFont("arial","B",18);
$pdf->SetXY(9,47);
$pdf->Cell(50,4,utf8_decode(mb_strtoupper($t['placa'],"utf8")),0,0,"C");

$pdf->SetFont("arial","B",17);
$pdf->SetXY(35,61);
$pdf->Cell(130,4,utf8_decode(mb_strtoupper($sin['nombre'],"utf8")),0,0,"C");
$pdf->SetFont("arial","",10);
$pdf->SetXY(160,84);
$pdf->Cell(45,4,utf8_decode(mb_strtoupper($mod['nombre'],"utf8")),0,0,"C");
$pdf->SetFont("arial","",10);
$numeroslineas='';
$numeroslineas2='';
$i=0;

$togenerado->eliminar2($id,"codtip");
if(count($lineas)){
	$numeroslineas=array();
	$numeroslineas2=array();
	foreach($lineas as $l){$i++;
	$togenerado->insertar(array("codtip"=>$id,"numerolinea"=>"'".$l."'"));
		if($i<=13){
		array_push($numeroslineas,$l);	
		}else{
		array_push($numeroslineas2,$l);
		}
	}
}
$numeroslineas=implode("-",$numeroslineas);
$numeroslineas2=implode("-",$numeroslineas2);
$pdf->SetFont("arial","",12);

$pdf->SetXY(25,72);
//$pdf->Cell(130,4,utf8_decode(mb_strtoupper($numeroslineas,"utf8")),0,0,"C");

$pdf->SetXY(25,70);
$pdf->Cell(130,4,utf8_decode(mb_strtoupper($numeroslineas,"utf8")),0,0,"C");
$pdf->SetXY(25,74);
$pdf->Cell(130,4,utf8_decode(mb_strtoupper($numeroslineas2,"utf8")),0,0,"C");

$pdf->SetFont("arial","B",11);
$pdf->SetXY(30,84);
$pdf->Cell(105,4,utf8_decode(mb_strtoupper($t['propetario'],"utf8")),0,0,"C");

$pdf->SetXY(50,92);
$pdf->Cell(55,4,utf8_decode(mb_strtoupper($t['cipropetario'],"utf8")),0,0,"C");
$pdf->SetFont("arial","",10);
$pdf->SetXY(130,92);
$pdf->Cell(70,4,utf8_decode(mb_strtoupper($t['polizaseguro'],"utf8")),0,0,"C");

$pdf->SetXY(25,104);
$pdf->Cell(50,4,utf8_decode(mb_strtoupper($t['marca'],"utf8")),0,0,"C");

$pdf->SetXY(95,104);
$pdf->Cell(50,4,utf8_decode(mb_strtoupper($t['modelo'],"utf8")),0,0,"C");

$pdf->SetXY(155,104);
$pdf->Cell(50,4,utf8_decode(mb_strtoupper($t['color'],"utf8")),0,0,"C");

$pdf->SetXY(40,112);
$pdf->Cell(65,4,utf8_decode(mb_strtoupper($t['clasevehiculo'],"utf8")),0,0,"C");

$pdf->SetXY(130,112);
$pdf->Cell(65,4,utf8_decode(mb_strtoupper($t['nasientos'],"utf8")),0,0,"C");

$pdf->SetXY(40,119);
$pdf->Cell(65,4,utf8_decode(mb_strtoupper($t['nmotor'],"utf8")),0,0,"C");

$pdf->SetXY(130,119);
$pdf->Cell(65,4,utf8_decode(mb_strtoupper($t['nchasis'],"utf8")),0,0,"C");

$pdf->SetXY(122,127);
$pdf->Cell(10,4,utf8_decode(mb_strtoupper(date("d",strtotime($t['licenciavalida'])),"utf8")),0,0,"C");

$pdf->SetXY(143,127);
$pdf->Cell(35,4,utf8_decode(mb_strtoupper(strftime("%B",strtotime($t['licenciavalida'])),"utf8")),0,0,"C");

$pdf->SetXY(190,127);
$pdf->Cell(15,4,utf8_decode(mb_strtoupper(date("Y",strtotime($t['licenciavalida'])),"utf8")),0,0,"C");


$pdf->SetXY(24,137);
$pdf->Cell(10,4,utf8_decode(mb_strtoupper(date("d",strtotime($t['fechaderegistro'])),"utf8")),0,0,"C");

$pdf->SetXY(46,137);
$pdf->Cell(35,4,utf8_decode(mb_strtoupper(strftime("%B",strtotime($t['fechaderegistro'])),"utf8")),0,0,"C");

$pdf->SetXY(96,137);
$pdf->Cell(15,4,utf8_decode(mb_strtoupper(date("Y",strtotime($t['fechaderegistro'])),"utf8")),0,0,"C");

$pdf->SetFont("arial","B",12);
$pdf->SetXY(190,33);
$pdf->Cell(15,4,utf8_decode(mb_strtoupper(date("Y",strtotime($t['fechaderegistro'])),"utf8")),0,0,"C");

$foto="../../imagenes/fotografiapropetario/".$t['fotografiapropetario'];
if(!empty($t['fotografiapropetario']) && file_exists($foto)){
	$pdf->Image($foto,178,43,32,37);	
}

$pdf->Output("reporte","I");
?>