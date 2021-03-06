<?php
include_once("../../login/check.php");
include_once("../../impresion/pdf.php");
$titulo="Reporte General de Lineas de Sindicato por Trayecto";
extract($_GET);

$codsindicato=$codsindicato!=''?" and codsindicato='$codsindicato'":'';
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

$where="trayectoida LIKE '%$trayectoida%' and trayectovuelta LIKE '%$trayectovuelta%' $codsindicato $codmodalidad $codservicio";

//echo $where;
class PDF extends PPDF{
	function Cabecera(){
		global $trayectoida,$trayectovuelta;
		$this->CuadroCabecera(30,"Trayecto de Ida:",80,$trayectoida?'':'-----------');
		$this->CuadroCabecera(35,"Trayecto de Vuelta:",80,$trayectovuelta?'':'-----------');
		$this->Ln();
		$this->TituloCabecera(10,"N");
		$this->TituloCabecera(50,"Sindicato");
		$this->TituloCabecera(40,"Modalidad");
		$this->TituloCabecera(40,"Servicio");
		$this->TituloCabecera(40,"Número de Linea");
		$this->TituloCabecera(30,"Color");
		$this->TituloCabecera(50,"Parada Inicial");
		$this->TituloCabecera(50,"Parada Final");
		
	}	
}
$pdf=new PDF("L","mm","legal");
$pdf->AddPage();
$totales=array();
foreach($linea->mostrarTodos($where,"numerolinea") as $l){
	
	$mod=array_shift($modalidad->mostrar($l['codmodalidad']));
	$sin=array_shift($sindicato->mostrar($l['codsindicato']));
	$ser=array_shift($servicio->mostrar($l['codservicio']));
	
	//print_r($mod);
	
	if($mod['estadistica']==0){
		continue;
	}
	$i++;
	$pdf->CuadroCuerpo(10,$i,1,"R",1);
	$pdf->CuadroCuerpo(50,$sin['nombre'],1,"",1);
	$pdf->CuadroCuerpo(40,$mod['nombre'],1,"",1);
	$pdf->CuadroCuerpo(40,$ser['nombre'],1,"",1);
	$pdf->CuadroCuerpo(40,$l['numerolinea'],1,"",1);
	$pdf->CuadroCuerpo(30,$l['color'],1,"",1);
	$pdf->CuadroCuerpo(50,$l['paradainicial'],1,"",1);
	$pdf->CuadroCuerpo(50,$l['paradafinal'],1,"",1);
	
	$pdf->ln();
	$pdf->CuadroCuerpo(10,"",0,"R");
	$pdf->CuadroCuerpoPersonalizado(50,"Trayecto de Ida:",0,"",1,"B");
	$pdf->CuadroCuerpoMulti(250,$l['trayectoida'],0,"",1);
	
	$pdf->CuadroCuerpo(10,"",0,"R");
	$pdf->CuadroCuerpoPersonalizado(50,"Trayecto de Vuelta:",0,"",1,"B");
	$pdf->CuadroCuerpoMulti(250,$l['trayectovuelta'],0,"",1);
	$pdf->ln();
	$pdf->Linea();
}
$pdf->Linea();


$pdf->Output();
?>