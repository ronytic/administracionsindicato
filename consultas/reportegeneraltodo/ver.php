<?php
include_once("../../login/check.php");
include_once("../../impresion/pdf.php");
$titulo="Reporte General de Sindicatos";
extract($_GET);

$codsindicato=$codsindicato!=''?" codsindicato='$codsindicato'":'';
$codmodalidad=$codmodalidad!=''?" and codmodalidad='$codmodalidad'":'';
$codservicio=$codservicio!=''?" and codservicio='$codservicio'":'';

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

$where="$codsindicato $codmodalidad $codservicio";
$where="";
/*if(!empty($fechacontrato)){
	$where="`fechacontrato`<='$fechacontrato'";
}
if(!empty($codobra)){
	$where=(empty($fechacontrato))?"`codobra`=$codobra":$where." and `codobra`=$codobra";
}
if(!empty($tipocontrato)){
	$where=(empty($where))?$where."`tipocontrato` LIKE '%$tipocontrato%'":$where." and `tipocontrato` LIKE '%$tipocontrato%'";
}*/

class PDF extends PPDF{
	function Cabecera(){
		global $fechasalida;
		/*if($fechasalida!="%"){
		$this->CuadroCabecera(30,"Fecha Salida:",20,fecha2Str($fechasalida));
		}*/
		$this->Ln();
		$this->TituloCabecera(10,"N");
		$this->TituloCabecera(70,"Nombre de Sindicato");
		$this->TituloCabecera(25,"Pers Juridica");
		$this->TituloCabecera(50,"Nombre Responsable");
		$this->TituloCabecera(20,"C.I.");
		$this->TituloCabecera(40,"Teléfono");
		$this->TituloCabecera(60,"Dirección");
		$this->TituloCabecera(40,"Observación");
		
	}	
}
$pdf=new PDF("L","mm","legal");
$pdf->AddPage();
$totales=array();
foreach($sindicato->mostrarTodos($where,"nombre") as $l){
	$mod=array_shift($modalidad->mostrar($l['codmodalidad']));
	$sin=array_shift($sindicato->mostrar($l['codsindicato']));
	$ser=array_shift($servicio->mostrar($l['codservicio']));
	//if($mod['estadistica']==0){
		//continue;
	//}
	$i++;

	$pdf->CuadroCuerpo(10,$i,0,"R",1);
	$pdf->CuadroCuerpo(70,$l['nombre'],0,"",1);
	$pdf->CuadroCuerpo(25,$l['personeriajuridica'],0,"",1);
	$pdf->CuadroCuerpo(50,$l['nombreresponsable'],0,"",1);
	$pdf->CuadroCuerpo(20,$l['ciresponsable'],0,"",1);
	$pdf->CuadroCuerpo(40,$l['telefono'],0,"",1);
	$pdf->CuadroCuerpo(60,$l['direccion'],0,"",1);
	$pdf->CuadroCuerpo(40,$l['observacion'],0,"",1);
	
	
	$pdf->ln();
}


$pdf->Output();
?>