<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Registro de Modalidad";

$tiporeporte=array("reporte1"=>"Reporte 1","reporte2"=>"Reporte 2","reporte3"=>"Reporte 3","reporte4"=>"Reporte 4");
$sino=array(0=>"No",1=>"Si");
include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<?php include_once '../../cabecera.php';?>
<div class="grid_12">
	<div class="contenido">
    	<div class="prefix_3 grid_4 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                <form action="guardar.php" method="post" enctype="multipart/form-data">
				<table class="tablareg">
					<tr>
						<td><?php campos("Nombre","nombre","text","",1,array("required"=>"required"));?></td>
					</tr>
					<tr>
						<td><?php campos("Descripción","descripcion","text");?></td>
					</tr>
                    <tr>
						<td><?php campos("Observación","observacion","textarea");?></td>
					</tr>
                    <tr>
						<td><?php campos("Tipo de Reporte","tiporeporte","select",$tiporeporte,0,"","reporte3");?></td>
					</tr>
                    <tr>
						<td><?php campos("Activar Mostrar en Reporte/ Estadísticas","estadistica","select",$sino,0,"",$mod['estadistica']);?></td>
					</tr>
					<tr><td><?php campos("Guardar","guardar","submit");?></td></tr>
				</table>
                </form>
			</fieldset>
		</div>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once '../../piepagina.php';?>