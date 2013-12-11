<?php
include_once("login/check.php");
$titulo="Inicio";
$_SESSION['idmenu']=0;
$_SESSION['subm']=0;
include_once("class/mensajes.php");
$mensa=new mensa;
?>
<?php include_once("cabecerahtml.php"); ?>
<link href="css/default/default.css" type="text/css" rel="stylesheet" />
<link href="css/light/light.css" type="text/css" rel="stylesheet" />
<link href="css/nivo-slider.css" type="text/css" rel="stylesheet" />
<script language="javascript" src="js/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
</script>
<?php include_once("cabecera.php");?>
<div class="grid_6">
    <div class="contenido">
    	<div class="theme-light">
    	<div id="slider" class="nivoSlider">
                <img src="imagenes/inicio/minibus.jpg"/>
                <img src="imagenes/inicio/minibus1.jpg" />
                <img src="imagenes/inicio/radio taxi.jpg" />
                <img src="imagenes/inicio/taxi.jpg"/>
                <img src="imagenes/inicio/Taxi1.jpg"/>
                <img src="imagenes/inicio/trufi.jpg"/>
		</div>
        </div>
    </div>
</div>
<div class="grid_6">
	<div class="contenido">
    	<div class="titulo">Panel Informativo</div>
       	<div class="mensajes">
        	<ul>
            	<?php foreach($mensa->mostrarTodo() as $m){
					?><li><?php echo $m['mensaje']?></li><?php
				}?>
            </ul>
        </div>
    </div>
</div>
<?php include_once("piepagina.php");?>