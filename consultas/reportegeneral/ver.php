<?php
include_once("../../login/check.php");
include_once("../../impresion/pdf.php");
$titulo="Reporte General de Lineas de Sindicato";
extract($_GET);

$codsindicato=$codsindicato!=''?" codsindicato='$codsindicato'":" codsindicato LIKE '%'";

$codmodalidad=$codmodalidad!=''?" codmodalidad='$codmodalidad'":" codmodalidad LIKE '%'";

$codservicio=$codservicio!=''?" codservicio='$codservicio'":" codservicio LIKE '%'";

$consulta=array();
array_push($consulta,$codsindicato,$codmodalidad,$codservicio);
$unido=implode(" and ",$consulta);
//echo $unido;

//$codproductos=$codproductos!=""?$codproductos:"%";

/*$existente=$existente=="1"?'and cantidadstock>0':'';
if($fechainicio!="" && $fechafin!=""){
	$fechainicio=$fechainicio!=""?$fechainicio:"%";
	$fechafin=$fechafin!=""?$fechafin:"%";
	$fechas=" and  (fechacompra BETWEEN '$fechainicio' and '$fechafin')";
}*/
include_once '../../class/linea.php';
include_once '../../class/sindicato.php';
include_once '../../class/servicio.php';
include_once '../../class/modalidad.php';
$linea=new linea;
$modalidad=new modalidad;
$servicio=new servicio;
$sindicato=new sindicato;

$where="$unido";
/*if(!empty($fechacontrato)){
	$where="`fechacontrato`<='$fechacontrato'";
}
if(!empty($codobra)){
	$where=(empty($fechacontrato))?"`codobra`=$codobra":$where." and `codobra`=$codobra";
}
if(!empty($tipocontrato)){
	$where=(empty($where))?$where."`tipocontrato` LIKE '%$tipocontrato%'":$where." and `tipocontrato` LIKE '%$tipocontrato%'";
}*/

//echo "-".$where."-";
class PDF extends PPDF{
	function Cabecera(){
		global $fechasalida;
		/*if($fechasalida!="%"){
		$this->CuadroCabecera(30,"Fecha Salida:",20,fecha2Str($fechasalida));
		}*/
		$this->Ln();
		$this->TituloCabecera(10,"N");
		$this->TituloCabecera(20,"Núm Linea");
		$this->TituloCabecera(20,"Color");
		$this->TituloCabecera(50,"Sindicato");
		$this->TituloCabecera(40,"Modalidad");
		$this->TituloCabecera(20,"N Pasajero");
		$this->TituloCabecera(40,"Servicio");
		
		
		$this->TituloCabecera(50,"Parada Inicial");
		$this->TituloCabecera(50,"Parada Final");
		$this->TituloCabecera(15,"L. Tramo");
		
	}	
}
$pdf=new PDF("L","mm","legal");
$pdf->AddPage();
$totales=array();
foreach($linea->mostrarTodos($where,"numerolinea") as $l){
	$mod=array_shift($modalidad->mostrar($l['codmodalidad']));
	$sin=array_shift($sindicato->mostrar($l['codsindicato']));
	$ser=array_shift($servicio->mostrar($l['codservicio']));
	
	if($mod['estadistica']==0){
		continue;
	}
	$i++;
	
	$pi=str_split($l['paradainicial'],30);
	$pf=str_split($l['paradafinal'],30);
	
	$pdf->CuadroCuerpo(10,$i,0,"R");
	$pdf->CuadroCuerpo(20,$l['numerolinea'],0,"C");
	$pdf->CuadroCuerpo(20,$l['color']);
	$pdf->CuadroCuerpo(50,$sin['nombre']);
	$pdf->CuadroCuerpo(40,$mod['nombre']);
	$pdf->CuadroCuerpo(20,$l['numeropasajeros']);
	$pdf->CuadroCuerpo(40,$ser['nombre']);
	
	
	$pdf->CuadroCuerpo(50,$pi[0]);
	$pdf->CuadroCuerpo(50,$pf[0]);
	$pdf->CuadroCuerpo(15,$l['longitudtramo']);
	
	
	$pdf->ln();
}
$pdf->Linea();


$pdf->Output();
?>