<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Modificar Modalidad";
$id=$_GET['id'];
include_once '../../class/modalidad.php';
$modalidad=new modalidad;
$mod=array_shift($modalidad->mostrar($id));
/*include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$prov=todolista($proveedor->mostrarTodo(),"codproveedor","nombre","");*/
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
                <form action="actualizar.php" method="post" enctype="multipart/form-data">
                <?php campos("","id","hidden",$id);?>
				<table class="tablareg">
					<tr>
						<td><?php campos("Nombre","nombre","text",$mod['nombre'],1,array("required"=>"required"));?></td>
					</tr>
					<tr>
						<td><?php campos("Descripción","descripcion","text",$mod['descripcion']);?></td>
					</tr>
                    <tr>
						<td><?php campos("Observación","observacion","textarea",$mod['observacion']);?></td>
					</tr>
                    <tr>
						<td><?php campos("Tipo de Reporte","tiporeporte","select",$tiporeporte,0,"",$mod['tiporeporte']);?></td>
					</tr>
                    <tr>
						<td><?php campos("Activar Mostrar en Reporte/ Estadísticas","estadistica","select",$sino,0,"",$mod['estadistica']);?></td>
					</tr>
					<tr><td><?php campos("Modificar","guardar","submit");?></td></tr>
				</table>
                </form>
			</fieldset>
		</div>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once '../../piepagina.php';?>