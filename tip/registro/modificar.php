<?php
include_once '../../login/check.php';
$folder="../../";
$titulo="Modificar Registro de Tarjeta de Identificación Personal";
$id=$_GET['id'];
include_once '../../class/tip.php';
$tip=new tip;
$t=array_shift($tip->mostrar($id));

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
/*include_once("../../class/proveedor.php");
$proveedor=new proveedor;
$prov=todolista($proveedor->mostrarTodo(),"codproveedor","nombre","");*/

include_once '../../funciones/funciones.php';
include_once '../../cabecerahtml.php';
?>
<script language="javascript">
</script>
<?php include_once '../../cabecera.php';?>
<div class="grid_12">
	<div class="contenido">
    	<div class="prefix_1 grid_8 alpha">
			<fieldset>
             	<form action="actualizar.php" method="post" enctype="multipart/form-data">
				<div class="titulo"><?php echo $titulo?></div>
                <?php campos("","id","hidden",$id);?>
				<table class="tablareg">
                	<tr>
                    	<td><?php campos("Sindicato","codsindicato","select",$sin,0,"",$t['codsindicato']);?></td>
						<td colspan="2"><label>Modalidad</label>
                        	<select name="codmodalidad">
                        	<?php foreach($modalidad->mostrarTodo("","nombre")as $m):?>
                            <option value="<?php echo $m['codmodalidad']?>" rel="<?php echo $m['tiporeporte']?>" <?php echo $m['codmodalidad']==$t['codmodalidad']?'selected="selected"':'';?>><?php echo $m['nombre']?></option>
                            <?php endforeach;?>
                        </select></td>
                        
					</tr>
					<tr>
						<td><?php campos("Placa","placa","text",$t['placa'],1,array(""=>"","size"=>20));?></td>
                        <td><?php campos("Nombre del Propietario","propetario","text",$t['propetario'],0,array("size"=>50));?></td>
                        <td><?php campos("C.I. Propietario","cipropetario","text",$t['cipropetario'],0,array("size"=>20));?></td>
					</tr>
                    <tr>
						<td><?php campos("Poliza de Seguro","polizaseguro","text",$t['polizaseguro'],1,array(""=>"","size"=>20));?></td>
                        <td><?php campos("Marca","marca","text",$t['marca'],0,array("size"=>40));?></td>
                        <td><?php campos("Modelo","modelo","text",$t['modelo'],0,array("size"=>30));?></td>
					</tr>
                    <tr>
						<td><?php campos("Color","color","text",$t['color'],1,array(""=>"","size"=>20));?></td>
                        <td><?php campos("Clase de Vehículo","clasevehiculo","text",$t['clasevehiculo'],0,array("size"=>50));?></td>
                        <td><?php campos("Nº de Asientos","nasientos","text",$t['nasientos'],0,array("size"=>30));?></td>
					</tr>
                    <tr>
						<td><?php campos("Nº de Motor","nmotor","text",$t['nmotor'],1,array(""=>"","size"=>20));?></td>
                        <td><?php campos("Nº de Chasis","nchasis","text",$t['nchasis'],0,array("size"=>50));?></td>
                        <td><?php campos("Licencia Valida Hasta","licenciavalida","date",$t['licenciavalida'],0,array("size"=>30));?></td>
					</tr>
                    <tr>
                    	<td colspan="2">
                        <?php campos("Fecha de Registro","fechaderegistro","date",$t['fechaderegistro'],0);?>
                        </td>
                    </tr>
				</table>
                <div class="titulo"><?php echo "Registro de Tarjeta de Identificación Personal"?></div>
                <table class="tablareg">
					<tr>
                        <td><?php campos("Nombre del Conductor","nombreconductor","text",$t['nombreconductor'],0,array("size"=>50));?></td>
                        <td><?php campos("C.I. Conductor","ciconductor","text",$t['ciconductor'],0,array("size"=>20));?></td>
					</tr>
                    <tr>
						<td><?php campos("Categoria de la Licencia","categoriaconductor","select",$categoria,1,array(""=>"","size"=>20),$t['categoriaconductor']);?></td>
                        <td><?php campos("Número Gratuito","numerogratuito","text",$t['numerogratuito'],0,array("size"=>40));?></td>
                        
					</tr>
                    <tr>
						<td><?php campos("Fotografía del Propetario","fotografiapropetario","file","",1,array(""=>"","size"=>20));?>
                        
                        </td>
                        <td><?php campos("Fotografía del Conductor","fotografiaconductor","file","",0,array("size"=>50));?></td>
					</tr>
                    <tr>
                    	<td><?php if($t['fotografiapropetario']!=""){?>
                        <img width="250" src="../../imagenes/fotografiapropetario/<?php echo $t['fotografiapropetario']?>">
                        <?php }else{echo "No se cuenta con una fotografía del propetario";}?></td>
                        <td><?php if($t['fotografiaconductor']!=""){?>
                        <img width="250" src="../../imagenes/fotografiaconductor/<?php echo $t['fotografiaconductor']?>">
                        <?php }else{echo "No se cuenta con una fotografía del conductor";}?></td>
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