<?php
$this->load->view('global/header');
?>

<div id="menu">
	<div class="cuerpo">
		<ul>
			<li><a href="<?php echo base_url(); ?>customer/search_form">Clientes</a></li>
			<li class="mfocus">
				<img src="<?php echo IMG; ?>f1.png" alt="" class="floati" />
				<div class="mf_texto">Gestion</div>
				<img src="<?php echo IMG; ?>f3.png" alt="" class="floati" />
            </li>
			<li><a href="<?php echo base_url(); ?>price_matrix/index/0">Matriz de Precios</a></li>
            <li class="palito"><img src="<?php echo IMG; ?>naranja3.gif" alt="" /></li>
            <li><a href="<?php echo base_url(); ?>quotation/new_quote/0">Cotizaciones</a></li>
		</ul>
	</div>
</div>
<div id="menu2">
</div>
<div class="separadorv"></div>

<?php
if($this->session->userdata('type') == 'manager'){
	$this->load->view('global/management_bar');
	$this->load->view('global/management_close');
}
else{ ?>

<div id="asociar2">
<div class="alertar">
    <img src="<?php echo IMG; ?>alerta.gif" alt="Alerta" class="valign" /><strong>ERROR: personal no autorizado</strong>
</div>
</div>
	
<?php } ?>

