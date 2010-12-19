<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Hoteles.com.ve</title>
    
    <script type="text/javascript" src="<?php echo JSQ; ?>hotel_js.js"></script>
<!-----------------------------------------JQUERY----------------------------------------------------------
note: components should be included in this specific order, so that everything works properly -->

<link type="text/css" href="<?php echo JSQ; ?>themes/base/jquery.ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo JSQ; ?>jquery-1.4.2.js"></script>
<script type="text/javascript" src="<?php echo JSQ; ?>jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo JSQ; ?>jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo JSQ; ?>jquery.ui.datepicker.js"></script>

<script type="text/javascript" src="<?php echo JSQ; ?>jquery.ui.position.js"></script>
<script type="text/javascript" src="<?php echo JSQ; ?>jquery.ui.autocomplete.js"></script>

<link type="text/css" href="<?php echo JSQ; ?>demos.css" rel="stylesheet" />

<!--------------------------------------------------------------------------------------------------------->    

    
    <link href="<?php echo STYLE; ?>estilos3.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="cintillo">
	<div class="cuerpo">
		<a href="#" class="logo">Hoteles.com.ve</a>
		<div class="palito"><img src="<?php echo IMG; ?>palito.gif" alt="" /></div>
		<div class="floati">Gestion de servicios</div>
        
        <?php if($this->session->userdata('type')){ ?>
        <div class="cintillod">
			<img src="<?php echo IMG; ?>user_orange.png" alt="Usuario" class="valign" />            
            Bienvenido, <a href="#"><?php echo($this->session->userdata('name').' '.$this->session->userdata('lastname')); ?></a>
            
            <img src="<?php echo IMG; ?>cog_edit.png" alt="Opciones" class="valign" />
			<a href="<?php echo base_url(); ?>seller/options"> Opciones </a>
            
			<img src="<?php echo IMG; ?>lock.png" alt="Desconectar" class="valign" />
			<a href="<?php echo base_url(); ?>home">Desconectar</a>
		</div>
        <?php } ?>
        
	</div>
</div>