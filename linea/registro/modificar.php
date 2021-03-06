<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Modificar Linea";
$id=$_GET['id'];
include_once '../../class/linea.php';
$linea=new linea;
$lin=array_shift($linea->mostrar($id));

include_once("../../class/sindicato.php");
$sindicato=new sindicato;
$sin=todolista($sindicato->mostrarTodo("","nombre"),"codsindicato","nombre","");

include_once("../../class/modalidad.php");
$modalidad=new modalidad;
$mod=todolista($modalidad->mostrarTodo("","nombre"),"codmodalidad","nombre","");

include_once("../../class/servicio.php");
$servicio=new servicio;
$ser=todolista($servicio->mostrarTodo("","nombre"),"codservicio","nombre","");
/*include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$prov=todolista($proveedor->mostrarTodo(),"codproveedor","nombre","");*/

include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<script language="javascript">
$(document).on("ready",function(){
	$("select[name=codmodalidad]").change(cambiar);	
	cambiar();
});
function cambiar(e) {
	var tiporeporte=$("select[name=codmodalidad]>option:selected").attr("rel");
	//alert(tiporeporte);
	$(".ocultar").removeClass("mostrar");
	//alert($("."+tiporeporte).length);
	$("."+tiporeporte).addClass("mostrar");
	
	
}
</script>
<style type="text/css">
.ocultar{
	display:none !important;	
}
.mostrar{
	display:inline-block !important;
}
</style>
<?php include_once '../../cabecera.php';?>
<div class="grid_12">
	<div class="contenido">
    	<div class="prefix_1 grid_8 alpha">
			<fieldset>
				<div class="titulo"><?php echo $titulo?></div>
                <form action="actualizar.php" method="post" enctype="multipart/form-data">
                <?php campos("","id","hidden",$id);?>
				<table class="tablareg">
                	<tr>
						<td><label>Modalidad</label><select name="codmodalidad">
                        	<?php foreach($modalidad->mostrarTodo("","nombre")as $m):?>
                            <option value="<?php echo $m['codmodalidad']?>"  <?php echo $m['codmodalidad']==$lin['codmodalidad']?'selected="selected"':'';?> rel="<?php echo $m['tiporeporte']?>"><?php echo $m['nombre']?></option>
                            <?php endforeach;?>
                        </select></td>
                        <td><?php campos("Servicio","codservicio","select",$ser,0,"",$lin['codservicio']);?></td>
					</tr>
					<tr>
						<td><?php campos("Número de Linea","numerolinea","text",$lin['numerolinea'],1,array("required"=>"required","size"=>50));?></td>
                        <td><?php campos("Color","color","text",$lin['color'],0,array("size"=>50));?></td>
					</tr>
                    <tr>
						<td colspan="2"><?php campos("Sindicato","codsindicato","select",$sin,0,"",$lin['codsindicato']);?></td>
					</tr>
                    <tr>
						<td><?php campos("Parada Inicial","paradainicial","text",$lin['paradainicial'],0,array("size"=>50,"class"=>"ocultar reporte1 reporte4"));?>
                        	<?php //campos("Parada Autorizada","paradaautorizada","text",$lin['paradaautorizada'],0,array("size"=>50,"class"=>"ocultar reporte2 reporte3"));?></td>
                        <td><?php campos("Parada Final","paradafinal","text",$lin['paradafinal'],0,array("size"=>50,"class"=>"ocultar reporte1 reporte4"));?></td>
					</tr>
                    <tr>
						<td style="vertical-align: top;"><?php campos("Trayecto de Ida","trayectoida","textarea",$lin['trayectoida'],0,array("rows"=>20,"cols"=>40,"class"=>"ocultar reporte1 reporte4"));?>
                        	<?php campos("Parada Autorizada Detallada","paradaautorizadadetallada","textarea",$lin['paradaautorizadadetallada'],0,array("rows"=>20,"cols"=>40,"class"=>"ocultar reporte2 reporte3"));?>
                        </td>
                        <td>
                        <?php campos("Vehículos Autorizados","vehiculosautorizados","textarea",$lin['vehiculosautorizados'],0,array("rows"=>20,"cols"=>40,"class"=>"ocultar reporte2"));?>
						<?php campos("Trayecto de Vuelta","trayectovuelta","textarea",$lin['trayectovuelta'],0,array("rows"=>20,"cols"=>40,"class"=>"ocultar reporte1 reporte4"));?>
                        <?php campos("Caracteristicas del Vehiculo","caracteristicasvehiculo","textarea",$lin['caracteristicasvehiculo'],0,array("rows"=>20,"cols"=>40,"class"=>"ocultar reporte3 reporte4 reporte2"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Longitud de Tramo","longitudtramo","text",$lin['longitudtramo'],0,array("size"=>50,"class"=>"ocultar reporte1 reporte4"));?></td>
                        <td><?php campos("Número de Pasajeros","numeropasajeros","number",$lin['numeropasajeros'],0,array("size"=>50,"min"=>0,"step"=>1,"class"=>"der ocultar reporte1 reporte3 reporte4"));?></td>
					</tr>
                    
                    <tr>
						<td colspan="2"><?php campos("Observación","observacion","textarea",$lin['observacion'],0,array("cols"=>80,"rows"=>5));?></td>
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