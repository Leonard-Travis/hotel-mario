<div id="management_price_matrix_div">
<?php
$this->load->view('global/header');
?>

<script>
function confirmar(){
	if (confirm('¿Seguro desea eliminar la Matriz de Precio?')){
		return true;
	}
	else return false;
}
</script>

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
			availableTags[<?php echo($i); ?>] = {label: "<?php echo($query[$i]['name']);?>",
												 value: "<?php echo($query[$i]['hotel_id']);?>"};
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
				$('#hotels').val(ui.item.value);				
				return false;
			}
		});
	});
</script>
<table align="center" width="40%">
    <tr>
        <td align="center"> <img src="<?php echo IMG; ?>zoom.png" alt="Buscador de Cliente" class="valign" />Seleccione un Hotel</td>
        <td align="center">           
                <input id="tags" />
         </td> 
         <td> 
             <a href="javascript:void(0);" onclick="management_price_matrx();">
             	<img src="<?php echo IMG; ?>bbuscar.jpg" onclick="management_price_matrix();" />             
             </a>
             <input type="hidden" id="hotels" name="hotels" />
         </td> 
    </tr>
</table>
<?php }?>

<?php $hotel_id; $hotel_name;
	  if ($hotel_selected) {?>
      	<?php foreach ($hotel_selected as $hotel_selected) { 
        			$hotel_id = $hotel_selected['hotel_id'];
                    $hotel_name = $hotel_selected['name']; ?>
        <?php } ?>

	<div class="separador"></div>
	<div class="separadorv_gris"></div>
    
    <table width="100%">
	<tr>
    <td colspan="2" align="center"><h1><?php echo($hotel_name); ?></h1></td>
    </tr>
    </table>
    
<div id="new_matrix" name="new_matrix">
    <table width="100%">
    <tr> <td align="center"><input type="image" src="<?php echo IMG; ?>bagregar.jpg" onclick="new_matrix_season(<?php echo($hotel_id);?>)"/></td>
         <td align="center"><input type="image" src="<?php echo IMG; ?>bbuscar.jpg" onclick="price_matrix_management_search(<?php echo($hotel_id);?>)"/></td>
    </tr>
    </table>
</div>

	<div class="separador"></div>
	<div class="separadorv_gris"></div>
       
	<?php if ($all_matrices != 'empty') { 
			  $plan = '';
              foreach ($all_matrices as $value) { ?>
			  	<?php $prices_id = "";?>
              	<table width="40%">
                <br /><br />
                <?php if($value['plan_name'] != $plan) {?>
                <div class="separadorv_gris"></div>
                <tr> <td><span class="naranja">Plan:</span></td> <td bgcolor="#00FF33"><?php echo($value['plan_name']); ?></td> </tr>
                <?php $plan = $value['plan_name'];
				      } ?>
                <tr> <td><strong>Desde:</strong></td> <td bgcolor="#CCFF66"> <?php echo($value['date_start']); ?></td> 
                     <td><strong>Hasta:</strong></td> <td bgcolor="#CCFF66"> <?php echo($value['date_end']); ?></td> 
                </tr>
                <?php $gray_row = TRUE; ?>
                <table class="resumen" width="100%">
                    <thead>
                        <tr class="pthead"> 
                            <td width="14.7%" align="center"><strong>Habitacion</strong></td>
                            <td align="center"><strong>Precio</strong></td>
                        </tr>
                    </thead>
                    <?php foreach ($value['prices'] as $price)  { ?>                    	
                        <?php if ($gray_row){?>
                             <tr>
                             <?php $gray_row = false;
                          }
                          else{  ?>
                             <tr>
                             <?php $gray_row = true;
                          }?>
                        <td width="14.7%" align="center"><?php echo ($price['room_name']); ?></td>
                        <td align="center"><?php echo ($price['price_per_night']); ?></td> 
                        </tr>    
						<?php $prices_id = $prices_id.$price['price_id'].'|'?> 
                    <?php } ?>				
                </table> 
        <form method="post" action="<?php echo base_url(); ?>price_matrix/delete_matrix">
        <input type="hidden" name="prices_id" id="prices_id" value="<?php echo($prices_id); ?>"  />
        <input type="hidden" name="season_id" id="season_id" value="<?php echo($value['season_id']); ?>"  />
        <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo($hotel_id);?>"/>
        <input type="submit" value="Eliminar"  onclick="return confirmar();"/>
        </form>              
        <?php } ?> <!-- end of foreach ($all_matrices as $value) -->
    <?php }  // end of if ($all_matrices != 'empty')
    else { ?>
        El hotel <strong><?php echo ($hotel_selected['name']);?></strong> no tiene precios de habitaciones disponibles.
    <?php } ?>
<?php } ?>
<?php
$this->load->view('global/management_close');
?>

</body>
</html>
</div>