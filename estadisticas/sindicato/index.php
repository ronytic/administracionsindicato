<?php
include_once("../../login/check.php");
$titulo="Estadísticas por Sindicatos";
$folder="../../";
include_once("../../funciones/funciones.php");

include_once("../../class/sindicato.php");
$sindicato=new sindicato;
$sin=todolista($sindicato->mostrarTodo("","nombre"),"codsindicato","nombre","");

include_once("../../class/modalidad.php");
$modalidad=new modalidad;
$mod=todolista($modalidad->mostrarTodo("","nombre"),"codmodalidad","nombre","");

include_once("../../class/servicio.php");
$servicio=new servicio;
$ser=todolista($servicio->mostrarTodo("","nombre"),"codservicio","nombre","");

include_once "../../cabecerahtml.php";
?>

<script language="javascript" src="../../js/highcharts.js" type="text/javascript"></script>
<?php include_once "../../cabecera.php";?>
<div class="grid_12">
	<div class="contenido">
    	<div class="grid_8 prefix_2 alpha noimprimir">
        	<fieldset>
        	<div class="titulo"><?php echo $titulo;?></div>
            <form id="busqueda" action="busqueda.php" method="post">
                <table class="tablabus">
                    <tr>
                        <td>Seleccionar un Año
                            <select name="anio">
                                <option value="%">Todos</option>
                                <?php for($i=2013;$i<=date("Y");$i++){?>
                                <option value="<?php echo $i?>"><?php echo $i?></option>
                                <?php }?>
                            </select>
                        
                        </td>
                        <!--<td><?php campos("Modalidad","codmodalidad","select",$mod);?></td>
                       <td><?php campos("Servicio","codservicio","select",$ser);?></td>-->
                        
                    </tr>
                    <tr>
                        <td><?php campos("Ver Reporte","enviar","submit","",0,array("size"=>15));?></td>
                    </tr>
                </table>
            </form>
            </fieldset>
        </div>
        <div class="clear"></div>
        <div id="respuesta"></div>
    </div>
</div>
<?php include_once "../../piepagina.php";?>