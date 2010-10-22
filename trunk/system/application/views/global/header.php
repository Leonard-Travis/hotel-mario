<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Hoteles.com.ve</title>
	<link type="text/css" href="themes/redmond/ui.all.css" rel="stylesheet" />
    <script language="javascript" src="http://localhost/hotel-mario/system/application/views/calendario/popcalendar6.js"> </script>
    <script type="text/javascript" src="http://localhost/hotel-mario/js/prototype-1.6.0.3.js"></script>
    <script type="text/javascript" src="http://localhost/hotel-mario/js/hotel_js.js"></script>
	<link type="text/css" href="demos.css" rel="stylesheet" />
	<script type="text/javascript">
	$(function() {
		$("#datepicker").datepicker();
	});
	</script>
	<link href="http://localhost/hotel-mario/designed_views/estilos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="cintillo">
	<div class="cuerpo">
		<a href="#" class="logo">Hoteles.com.ve</a>
		<div class="palito"><img src="http://localhost/hotel-mario/designed_views/imagenes/palito.gif" alt="" /></div>
		<div class="floati">Gestion de servicios</div>
        <?php if($this->session->userdata('type')){ ?>
        <div class="cintillod">
			<img src="http://localhost/hotel-mario/designed_views/imagenes/user_orange.png" alt="Usuario" class="valign" />            
            Bienvenido, <a href="#"><?php echo($this->session->userdata('name').' '.$this->session->userdata('lastname')); ?></a>
			<!--<img src="http://localhost/hotel-mario/designed_views/imagenes/cog_edit.png" alt="Opciones" class="valign" />
			<a href="#">Opciones</a>-->
			<img src="http://localhost/hotel-mario/designed_views/imagenes/lock.png" alt="Desconectar" class="valign" />
			<a href="<?php echo base_url(); ?>home">Desconectar</a>
		</div>
        <?php } ?>
	</div>
</div>