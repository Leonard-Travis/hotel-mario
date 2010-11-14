<div id="management_packages">
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

<?php if ($query) {?>
<script type="text/javascript">
	$(function() {
		var availableTags = new Array();
		<?php for($i=0; $i <  count($query) ; $i++){?>
			availableTags[<?php echo($i); ?>] = {label: "<?php echo($query[$i]['name_spanish']);?>",
												 value: "<?php echo($query[$i]['categorie_id']);?>"};
		<?php } ?>	
		
		$('#tags').autocomplete({
			minLength: 0,
			source: availableTags,
			focus: function(event, ui) {
				$('#tags').val(ui.item.label);
				return false;
			},
			select: function(event, ui) {
				$('#tags').val(ui.item.label);
				$('#categories').val(ui.item.value);				
				return false;
			}
		});
	});
</script>
	<table align="center" width="40%">
		<tr>
			<td align="center"><img src="<?php echo IMG; ?>zoom.png" alt="Buscador de Cliente" class="valign" />Seleccione una Categoria</td>
             
			<td align="center">
			<input id="tags" />
            <input type="hidden" id="categories" />
			</td> 
            
            <td> <input type="image" src="<?php echo IMG; ?>bbuscar.jpg" onclick="categorie_packages();" /></td> 
        
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