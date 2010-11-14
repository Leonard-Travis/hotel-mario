<div id="quotation">
<?php
$this->load->view('global/header');
?>


<div id="menu">
	<div class="cuerpo">
		<ul>
        	<li><a href="<?php echo base_url(); ?>customer/search_form">Clientes</a></li>
            <li class="palito"><img src="<?php echo IMG; ?>naranja3.gif" alt="" /></li>
			<li><a href="<?php echo base_url(); ?>home/management">Gestion</a></li>
			<li class="palito"><img src="<?php echo IMG; ?>naranja3.gif" alt="" /></li>
			<li><a href="<?php echo base_url(); ?>price_matrix/index/0">Matriz de Precios</a></li>
            <li class="mfocus">
				<img src="<?php echo IMG; ?>f1.png" alt="" class="floati" />
				<div class="mf_texto">Cotizaciones</div>
				<img src="<?php echo IMG; ?>f3.png" alt="" class="floati" />
            </li>
		</ul>
	</div>
</div>
<div id="menu2">
</div>
<div class="separadorv"></div>


<?php echo validation_errors(); ?>
<div class="separadorv"></div><div class="separadorv"></div>

<div id="asociar_c">
    <ul>
        <li class="li_tit_1"><img src="<?php echo IMG; ?>zoom.png" alt="Buscador de Cliente" class="valign" />Buscador de Cliente</li> 
		<li> <div class="cajat"> <input type="text" name="ci_client" id="ci_client" value="Ejem: 18888888" maxlength="10"/></div>
        	<input type="image" src="<?php echo IMG; ?>bseleccionar.jpg" onclick="client_quote($('#ci_client').val());"/></li> 
     </ul>  
</div>
<script>
	$('#ci_client').click(function() {			   
	  $('#ci_client').val("");
	});
</script>
<?php if ($customer != NULL){ ?>
    <div class="separador"></div>
    <div class="separadorv_gris"></div>
	<?php foreach ($customer as $client) { ?>  
    	<table><tr><td>Cliente: <strong><?php echo($client['name'].' '.$client['lastname']); ?></strong></td>
        <td>CI: <strong><?php echo($client['customer_ci_id']); ?></strong></td></tr></table>    

<div class="separadorv"></div>
<div class="cuerpo">
	<div class="floati">
		<div id="tablappa1"> <!-- usar id="tablappa2" cuandos e quiera que ocupe toda la ventana y eliminar el <div id="calendario">
									en todo caso el ancho completo es de 950 px-->
			<div id="asociar">
				<img src="<?php echo IMG; ?>tabla1.jpg" alt="" class="floati valign" />
				<img src="<?php echo IMG; ?>add.png" alt="Agregar Hoteles" class="valign" /><a href="javascript:void(0);" onclick="quote(<?php echo($client['customer_ci_id']); ?>, 'hotel_quote') ">Agregar Hoteles</a>
				<img src="<?php echo IMG; ?>nada.gif" alt="" width="20" />
				<img src="<?php echo IMG; ?>add.png" alt="Agregar Boletos" class="valign" /><a href="javascript:void(0);" onclick="quote(<?php echo($client['customer_ci_id']); ?>, 'flight_quote') ">Agregar Boletos</a>
				<img src="<?php echo IMG; ?>nada.gif" alt="" width="20" />
				<img src="<?php echo IMG; ?>add.png" alt="Agregar Genérica" class="valign" /><a href="javascript:void(0);" onclick="quote(<?php echo($client['customer_ci_id']); ?>, 'generic_quote') ">Agregar Genérica</a>
                <img src="<?php echo IMG; ?>nada.gif" alt="" width="20" />
				<img src="<?php echo IMG; ?>add.png" alt="Agregar Genérica" class="valign" /><a href="javascript:void(0);" onclick="quote(<?php echo($client['customer_ci_id']); ?>, 'package_quote') ">Agregar Paquete</a>
				<img src="<?php echo IMG; ?>tabla3.jpg" alt=""  class="floatd valign"/>
            </div> 
       <?php }
} ?>
<div id="asociar2" >
	
    <div id="hotel_quote">
    </div>
	<div id="package_quote">
    </div>
	
    <div id="flight_quote">
    </div>
    <div id="flight_quote_summary">
    </div>
    <div id="generic_quote">
    </div>
    <div id="generic_summary">
    </div>
    
    
    <div id="close_quotation">
    </div>

</div>
		<!--</div>-->
			<div class="separador"></div>
			<div class="tpiec"><img src="<?php echo IMG; ?>esq1.gif" alt="" /><img src="<?php echo IMG; ?>esq3.gif" alt="" class="floatd" /></div>
			<div class="separadorv"></div>
	<!--</div>
</div>-->

</body>
</html>
</div>
