<?php
include_once("login/check.php");
$titulo="Inicio";
$_SESSION['idmenu']=0;
$_SESSION['subm']=0;
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
<div class="grid_12">
    <div class="contenido">
    	<div class="theme-light">
    	<div id="slider" class="nivoSlider">
                <img src="imagenes/inicio/Hydrangeas.jpg" />
                <img src="imagenes/inicio/Jellyfish.jpg" />
                <img src="imagenes/inicio/Koala.jpg" data-transition="slideInLeft" />
                <img src="imagenes/inicio/Lighthouse.jpg"/>
		</div>
        </div>
    </div>
</div>
<?php include_once("piepagina.php");?>