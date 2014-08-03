<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Registro de Sindicato";

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
						<td><?php campos("Personería Jurídica","personeriajuridica","text");?></td>
					</tr>
                    <tr>
						<td><?php campos("Nombre del Responsable","nombreresponsable","text");?></td>
					</tr>
                    <tr>
						<td><?php campos("C.I.: del Responsable","ciresponsable","text");?></td>
					</tr>
                    <tr>
						<td><?php campos("Teléfono","telefono","text");?></td>
					</tr>
                    <tr>
						<td><?php campos("Dirección","direccion","text");?></td>
					</tr>
                    <tr>
						<td><?php campos("Observación","observacion","textarea");?></td>
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