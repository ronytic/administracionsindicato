<?php
include_once("../../login/check.php");
$titulo="Listado de Lineas a Imprimir";
$folder="../../";
include_once '../../class/sindicato.php';
include_once '../../class/servicio.php';
include_once '../../class/modalidad.php';
include_once '../../class/linea.php';

$id=$_GET['id'];

include_once("../../class/tip.php");
$tip=new tip;
$t=array_shift($tip->mostrar($id));


$modalidad=new modalidad;
$servicio=new servicio;
$sindicato=new sindicato;
$linea=new linea;

$dest=array("Procesado"=>"Procesado","Directo"=>"Directo");

$mod=array_shift($modalidad->mostrar($t['codmodalidad']));
$sin=array_shift($sindicato->mostrar($t['codsindicato']));
$lin=$linea->mostrarTodo("codsindicato=".$t['codsindicato']." and codmodalidad=".$t['codmodalidad']);

include_once("../../funciones/funciones.php");
include_once "../../cabecerahtml.php";
?>
<?php include_once "../../cabecera.php";?>
<div class="grid_12">
	<div class="contenido">
    	<div class="grid_9 prefix_1 alpha">
        	<fieldset>
        	<div class="titulo"><?php echo $titulo?> - Criterio de Busqueda</div>
            <form action="verreporte.php" method="get" >
            	<input type="hidden" name="id" value="<?php echo $id?>">
                <table class="tablareg">
                	<tr class="titulo"><td>Nº</td><td>Linea</td><td></td></tr>
                    <?php 
					$i=0;
					foreach($lin as $l){ $i++;?>
                    <tr>
                    	<td><?php echo $i?></td>
                    	<td>
                        	<label for="l<?php echo $i;?>"><?php echo $l['numerolinea'];?></label>
                        </td>
                    	<td>
                        	
							<input type="checkbox" name="lineas[]" value="<?php echo $l['numerolinea'];?>" id="l<?php echo $i?>" ></td>
                    </tr>
                    <?php }?>
                    <tr>
                    	<td><?php campos("Generar","enviar","submit","",0,array("size"=>15));?></td>
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
