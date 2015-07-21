<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Registro de Tarjeta de Identificación Personal";
include_once("../../class/sindicato.php");
$sindicato=new sindicato;
$sin=todolista($sindicato->mostrarTodo("","nombre"),"codsindicato","nombre","");

include_once("../../class/modalidad.php");
$modalidad=new modalidad;
$mod=todolista($modalidad->mostrarTodo("","nombre"),"codmodalidad","nombre","");

include_once("../../class/servicio.php");
$servicio=new servicio;
$ser=todolista($servicio->mostrarTodo("","nombre"),"codservicio","nombre","");

$categoria=array("A"=>"A","B"=>"B","C"=>"C","P"=>"P");

include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<?php include_once '../../cabecera.php';?>
<div class="grid_12">
	<div class="contenido">
    	<div class="prefix_1 grid_8 alpha">
			<fieldset>
            	<form action="guardar.php" method="post" enctype="multipart/form-data">
				<div class="titulo"><?php echo "Registro de Tarjeta de Operación"?></div>
                
				<table class="tablareg">
                	<tr>
                    	<td><?php campos("Sindicato","codsindicato","select",$sin);?></td>
						<td colspan="2"><label>Modalidad</label>
                        	<select name="codmodalidad">
                        	<?php foreach($modalidad->mostrarTodo("","nombre")as $m):?>
                            <option value="<?php echo $m['codmodalidad']?>" rel="<?php echo $m['tiporeporte']?>"><?php echo $m['nombre']?></option>
                            <?php endforeach;?>
                        </select></td>
                        
					</tr>
					<tr>
						<td><?php campos("Placa","placa","text","",1,array(""=>"","size"=>20,"required"=>"required"));?></td>
                        <td><?php campos("Nombre del Propietario","propetario","text","",0,array("size"=>30,"required"=>"required"));?></td>
                        <td><?php campos("C.I. Propietario","cipropetario","text","",0,array("size"=>20,"required"=>"required"));?></td>
					</tr>
                    <tr>
                        <td colspan="3">
                        <?php campos("Dirección del Propetario","direccion","text","",0,array("size"=>80));?>
                        </td>
                    </tr>
                    <tr>
						<td><?php campos("Poliza de Seguro","polizaseguro","text","",1,array(""=>"","size"=>20));?></td>
                        <td><?php campos("Marca","marca","text","",0,array("size"=>30));?></td>
                        <td><?php campos("Modelo","modelo","text","",0,array("size"=>30));?></td>
					</tr>
                    <tr>
						<td><?php campos("Color","color","text","",1,array(""=>"","size"=>20,"required"=>"required"));?></td>
                        <td><?php campos("Clase de Vehículo","clasevehiculo","text","",0,array("size"=>30,"required"=>"required"));?></td>
                        <td><?php campos("Nº de Asientos","nasientos","text","",0,array("size"=>30,"required"=>"required"));?></td>
					</tr>
                    <tr>
						<td><?php campos("Nº de Motor","nmotor","text","",1,array(""=>"","size"=>20));?></td>
                        <td><?php campos("Nº de Chasis","nchasis","text","",0,array("size"=>30));?></td>
                        <td><?php campos("Licencia Valida Hasta","licenciavalida","date","",0,array("size"=>30));?></td>
					</tr>
                    <tr>
                    	<td colspan="2">
                        <?php campos("Fecha de Registro","fechaderegistro","date",$t['fechaderegistro'],0);?>
                        </td>
                        <td><?php campos("Código de Barra del Propetario","codbarrapropetario","password",$t['codbarrapropetario'],0,array("size"=>30,"required"=>"required"));?></td>
                    </tr>
				</table>
                <div class="titulo"><?php echo "Registro de Tarjeta de Identificación Personal"?></div>
                <table class="tablareg">
					<tr>
                        <td><?php campos("Nombre del Conductor","nombreconductor","text","",0,array("size"=>50));?></td>
                        <td><?php campos("C.I. Conductor","ciconductor","text","",0,array("size"=>20));?></td>
					</tr>
                    <tr>
                        <td colspan="3">
                        <?php campos("Dirección del Conductor","direccionconductor","text","",0,array("size"=>80));?>
                        </td>
                    </tr>
                    <tr>
						<td><?php campos("Categoria de la Licencia","categoriaconductor","select",$categoria,1,array(""=>"","size"=>20));?></td>
                        <td><?php campos("Número Gratuito","numerogratuito","text","",0,array("size"=>40));?></td>
                        
					</tr>
                    <tr>
						<td><?php campos("Fotografía del Propetario","fotografiapropetario","file","",1,array(""=>"","size"=>20));?></td>
                        <td><?php campos("Fotografía del Conductor","fotografiaconductor","file","",0,array("size"=>50));?></td>
					</tr>
                    <tr>
                    	<td><?php campos("Código de Barra del Vehículo","codbarravehiculo","password",$t['codbarravehiculo'],0,array("size"=>30,"required"=>"required"));?></td>
                    </tr>
					<tr><td colspan="2"><?php campos("Guardar","guardar","submit");?></td></tr>
				</table>
                </form>
			</fieldset>
		</div>
    	<div class="clear"></div>
    </div>
</div>
<?php include_once '../../piepagina.php';?>