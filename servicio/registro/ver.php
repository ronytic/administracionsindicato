<?php
include_once("../../impresion/pdf.php");
$titulo="Reporte de Servicio";
$id=$_GET['id'];
class PDF extends PPDF{
	
}

include_once("../../class/servicio.php");
$servicio=new servicio;
$ser=array_shift($servicio->mostrar($id));

include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$prov=array_shift($proveedor->mostrar($pro['codproveedor']));

$pdf=new PDF("P","mm","letter");

$pdf->AddPage();
mostrarI(array("Nombre"=>$ser['nombre'],
				"Descripcion"=>$ser['descripcion'],
				"Observación"=>$ser['observacion'],
			));

/*$foto="../foto/".$emp['foto'];
if(!empty($emp['foto']) && file_exists($foto)){
	$pdf->Image($foto,140,50,40,40);	
}
*/
$pdf->Output();
?>