<div id="management_packages">
<?php
$this->load->view('global/header');
?>

<div id="menu">
	<div class="cuerpo">
		<ul>
			<li><a href="<?php echo base_url(); ?>customer/search_form">Clientes</a></li>
			<li class="mfocus">
				<img src="http://localhost/hotel-mario/designed_views/imagenes/f1.png" alt="" class="floati" />
				<div class="mf_texto">Gestion</div>
				<img src="http://localhost/hotel-mario/designed_views/imagenes/f3.png" alt="" class="floati" />
            </li>
			<li><a href="<?php echo base_url(); ?>price_matrix/index/0">Matriz de Precios</a></li>
            <li class="palito"><img src="http://localhost/hotel-mario/designed_views/imagenes/naranja3.gif" alt="" /></li>
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

<?php if ($query) {?>
	<table align="center" width="40%">
		<tr>
			<td align="center"> <strong>Seleccione una Categoria</strong> </td>
             
			<td align="center">
			<select name="categories" id="categories">
			<?php foreach ($query as $categorie) { ?>
				<option value="<?php echo ($categorie['categorie_id']);?>"><?php echo ($categorie['name_spanish']);?></option> 
			<?php }?>
			</select>
			</td> 
            
            <td> <img src="http://localhost/hotel-mario/designed_views/imagenes/bbuscar.jpg" onclick="categorie_packages();" /></td> 
        
        </tr>
	</table>
 
<?php }?>


<div id="packages">
</div>


<?php
$this->load->view('global/management_close');
?>

</body>
</html>
</div>