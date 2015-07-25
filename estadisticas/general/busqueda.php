<?php
include_once("../../login/check.php");
extract($_POST);
if($anio=="%"){
    $tituloanio="Todos los años";
}else{
    $tituloanio=$anio;
}
$titulo="Estadísticas por Sindicato de $tituloanio";

include_once '../../class/linea.php';
include_once '../../class/sindicato.php';
include_once '../../class/servicio.php';
include_once '../../class/modalidad.php';
$linea=new linea;
$modalidad=new modalidad;
$servicio=new servicio;
$sindicato=new sindicato;

/*$lin=$linea->mostrarTodo($where);
$totallineas=count($lin);

$porcentajes=array();

foreach($sindicato->mostrarTodo("estadistica=1 ") as $ser){
	
	//$condicion=$where!=''?$where.' and codsindicato='.$ser['codsindicato']:'codservicio='.$ser['codservicio'];
	$condicion="codsindicato=".$ser['codsindicato']." and YEAR(fecha) LIKE '$anio'";
	$cantlineas=$linea->mostrarTodo($condicion);
	if($ser['codsindicato']==58){
        //echo count($cantlineas);
    }
    //echo $totallineas;
    //echo "-".porcentaje($totallineas,count($cantlineas))."-";
	/*$mod=array_shift($modalidad->mostrar($l['codmodalidad']));
	if($mod['estadistica']==0){
		continue;
	}
	$i++;*/
    
	//$porcentajes[$ser['nombre']]=number_format(porcentaje($totallineas,count($cantlineas)),2,".",",");
/*  }*/
/*echo "<pre>";
print_r($porcentajes);
echo "</spre>";*/
if($codmodalidad!=""){
	$mod=array_shift($modalidad->mostrar($codmodalidad));
    $TextoModalidad=" Modalidad: ".$mod['nombre'];
}
if($codsindicato!=""){
	$sin=array_shift($sindicato->mostrar($codsindicato));
    $TextoSindicato=" Sindicato: ".$sin['nombre'];
}
if($codservicio!=""){
	$ser=array_shift($servicio->mostrar($codservicio));
    $TextoServicio=" Servicio: ".$ser['nombre'];
}
//echo $codsindicato;
//echo "<br>";
$codsindicato=$codsindicato!=""?$codsindicato:'%';
$codmodalidad=$codmodalidad!=""?$codmodalidad:'%';
$codservicio=$codservicio!=""?$codservicio:'%';

for($i=$anioinicio;$i<=$aniofin;$i++){
    
    $condicion="YEAR(fecha) LIKE '$i' and codservicio LIKE '$codservicio' and codsindicato LIKE '$codsindicato' and codmodalidad LIKE '$codmodalidad'";
	$cantlineas=$linea->mostrarTodo($condicion);
    
    $datos[$i]=count($cantlineas);  
}
//Genración de Grafico de Barras
?>
<script type="text/javascript" language="javascript">
$(function () {
    $('#grafica').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Estadística General del <?php echo $anioinicio?> al <?php echo $aniofin?>'
        },
        subtitle: {
            text: '<?php echo $TextoSindicato?> <?php echo $TextoModalidad?> <?php echo $TextoServicio?>'
        },
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total de Lineas Registradas'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Total de Lineas: <b>{point.y} </b>'
        },
        series: [{
            name: 'Population',
            data: [
                <?php foreach($datos as $k=>$v){
                ?>
                ['<?php echo $k?>', <?php echo $v?>],
                <?php    
                }?>
                
                
            ],
            dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{point.y}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        }]
    });
});
</script>
<div id="grafica"></div>