<div id="management_seller">
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
$this->load->view('global/management_bar');
?>

<table>
<tr>
<td> 
<form method="post" action="<?php echo base_url(); ?>seller/new_seller">  
<input name="enviar" type="submit" value="Agregar Vendedor" />
</form>
</td>
<tr>
</table>

<table class="resumen" width="80%" align="center">
    <thead>
    <tr class="pthead">
    <td align="center"><strong>Nombre</strong></td>
    <td align="center"><strong>Apellido</strong></td>
    <td align="center"><strong>C&eacute;dula</strong></td>
    <td align="center"><strong>Nombre de Usuario</strong></td>
    <td align="center"><strong>Tipo</strong></td>
    <td align="center" width="17px"></td>
    </tr>
    </thead>
    <?php $gray_row = TRUE;?>
    <?php foreach ($query as $seller) { ?>
        <tr>
        <td align="center"><?php echo ($seller['name']);?></td>
        <td align="center"><?php echo ($seller['lastname']);?></td>
        <td align="center"><?php echo ($seller['employees_id']);?></td>
        <td align="center"><?php echo ($seller['nick_name']);?></td>
        <td align="center"><?php echo ($seller['type']);?></td>
        <td align="center"> <a href="#"><img src="<?php echo IMG; ?>x.jpg" onclick="delete_seller(<?php echo ($seller['employees_id']);?>);"/></a></td>
        </tr>
    <?php }?>
</table>


<?php
$this->load->view('global/management_close');
?>

</body>
</html>
</div>