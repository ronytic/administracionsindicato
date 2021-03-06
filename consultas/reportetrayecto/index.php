<?php
include_once("../../login/check.php");
$titulo="Reporte General de Lineas de Sindicato";
$folder="../../";
include_once("../../funciones/funciones.php");

include_once("../../class/sindicato.php");
$sindicato=new sindicato;
$sin=todolista($sindicato->mostrarTodo("","nombre"),"codsindicato","nombre","");

include_once("../../class/modalidad.php");
$modalidad=new modalidad;
$mod=todolista($modalidad->mostrarTodo("estadistica=1","nombre"),"codmodalidad","nombre","");

include_once("../../class/servicio.php");
$servicio=new servicio;
$ser=todolista($servicio->mostrarTodo("","nombre"),"codservicio","nombre","");

include_once "../../cabecerahtml.php";
?>
<?php include_once "../../cabecera.php";?>
<div class="grid_12">
	<div class="contenido">
    	<div class="grid_8 prefix_2 alpha">
        	<fieldset>
        	<div class="titulo"><?php echo $titulo;?></div>
            <form id="busqueda" action="busqueda.php" method="post">
                <table class="tablabus">
                	<tr>
                    	<td><?php campos("Trayecto de Ida","trayectoida","text");?></td>
                        <td><?php campos("Trayecto de Vuelta","trayectovuelta","text");?></td>
                    </tr>
                    <tr>
                        <td><?php campos("Sindicato","codsindicato","select",$sin);?></td>
                        <td><?php campos("Modalidad","codmodalidad","select",$mod);?></td>
                        <td><?php campos("Servicio","codservicio","select",$ser);?></td>
                        
                    </tr>
                    <tr>
                        <td><?php campos("Ver Reporte","enviar","submit","",0,array("size"=>15));?></td>
                    </tr>
                </table>
            </form>
            </fieldset>
        </div>
        <div class="clear"></div>
        <strong>Nota:</strong> Reporte Tamaño Oficio
        <div id="respuesta" class="imprimir"></div>
    </div>
</div>
<?php include_once "../../piepagina.php";?>