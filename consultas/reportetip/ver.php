<?php
include_once("../../login/check.php");
include_once("../../impresion/pdf.php");
$titulo="Reporte General T.I.P. - T.O.";
extract($_GET);

$codsindicato=$codsindicato!=''?" codsindicato='$codsindicato'":" codsindicato LIKE '%'";

$codmodalidad=$codmodalidad!=''?" codmodalidad='$codmodalidad'":" codmodalidad LIKE '%'";


$consulta=array();
array_push($consulta,$codsindicato,$codmodalidad);
$unido=implode(" and ",$consulta);
//echo $unido;



include_once '../../class/tip.php';
include_once '../../class/sindicato.php';
include_once '../../class/modalidad.php';
$tip=new tip;
$modalidad=new modalidad;
$sindicato=new sindicato;

$where="$unido";

//echo "-".$where."-";
class PDF extends PPDF{
	function Cabecera(){
		global $fechasalida;
		/*if($fechasalida!="%"){
		$this->CuadroCabecera(30,"Fecha Salida:",20,fecha2Str($fechasalida));
		}*/
		$this->Ln();
		$this->TituloCabecera(10,"N");
		$this->TituloCabecera(50,"Sindicato");
		$this->TituloCabecera(30,"Modalidad");
		$this->TituloCabecera(20,"Placa");
		$this->TituloCabecera(25,"Marca");
		$this->TituloCabecera(15,"Modelo");
		$this->TituloCabecera(60,"Propetario");
		
		
		$this->TituloCabecera(25,"C.I. Propetario");
		$this->TituloCabecera(55,"Conductor");
		$this->TituloCabecera(25,"C.I. Conductor");
		
	}	
}
$pdf=new PDF("L","mm","legal");
$pdf->AddPage();
$totales=array();
$modelo=$modelo!=""?$modelo."%":"%";
$marca=$marca!=""?$marca."%":"%";

$where="$unido and modelo LIKE '$modelo' and marca LIKE '$marca' and YEAR(fechaderegistro)='$anio'";

foreach($tip->mostrarTodos($where,"placa") as $l){
	$mod=array_shift($modalidad->mostrar($l['codmodalidad']));
	$sin=array_shift($sindicato->mostrar($l['codsindicato']));
	
	
	
	$i++;
	
	$pi=str_split($l['paradainicial'],30);
	$pf=str_split($l['paradafinal'],30);
	
	$pdf->CuadroCuerpo(10,$i,0,"R",0);
    $pdf->CuadroCuerpo(50,$sin['nombre'],0,"",0);
	$pdf->CuadroCuerpo(30,$mod['nombre'],0,"",0);
    $pdf->CuadroCuerpo(20,$l['placa'],0,"",0);
    $pdf->CuadroCuerpo(25,$l['marca'],0,"",0);
	$pdf->CuadroCuerpo(15,$l['modelo'],0,"",0);
	
	$pdf->CuadroCuerpo(60,ucwords(mb_strtolower($l['propetario'],"utf8")),0,"",0);
    $pdf->CuadroCuerpo(25,$l['cipropetario'],0,"",0);
	$pdf->CuadroCuerpo(60,ucwords(mb_strtolower($l['nombreconductor'],"utf8")),0,"",0);
    $pdf->CuadroCuerpo(20,$l['ciconductor'],0,"",0);
	
	$pdf->CuadroCuerpo(50,$pi[0]);
	$pdf->CuadroCuerpo(50,$pf[0]);
	$pdf->CuadroCuerpo(15,$l['longitudtramo']);
	
	
	$pdf->ln();
}
$pdf->Linea();


$pdf->Output();
?>