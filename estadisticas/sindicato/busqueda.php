<?php
include_once("../../login/check.php");
extract($_POST);
if($anio=="%"){
    $tituloanio="Todos los años";
}else{
    $tituloanio=$anio;
}
$titulo="Estadísticas por Sindicato de $tituloanio";


$codsindicato=$codsindicato!=''?" codsindicato='$codsindicato'":'';
$codmodalidad=$codmodalidad!=''?" and codmodalidad='$codmodalidad'":'';
//$codservicio=$codservicio!=''?" and codservicio='$codservicio'":'';
$where="$codsindicato$codmodalidad$codservicio";

include_once '../../class/linea.php';
include_once '../../class/sindicato.php';
include_once '../../class/servicio.php';
include_once '../../class/modalidad.php';
$linea=new linea;
$modalidad=new modalidad;
$servicio=new servicio;
$sindicato=new sindicato;

$lin=$linea->mostrarTodo($where);
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
    
	$porcentajes[$ser['nombre']]=number_format(porcentaje($totallineas,count($cantlineas)),2,".",",");
}
/*echo "<pre>";
print_r($porcentajes);
echo "</spre>";*/

/*	$mod=array_shift($modalidad->mostrar($l['codmodalidad']));
	$sin=array_shift($sindicato->mostrar($l['codsindicato']));
	$ser=array_shift($servicio->mostrar($l['codservicio']));
*/


?>


<script type="text/javascript" language="javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'grafica',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: '<?php echo $titulo?>'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage}%</b>',
            	percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(2) +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Porcentaje de Modalidades',
                data: [
				<?php foreach($porcentajes as $k=>$v){?>
                    ['<?php echo $k?>',   <?php echo $v?>],
                 <?php }?>
                ]
            }]
        });
    });
    
});
</script>
<div id="grafica"></div>