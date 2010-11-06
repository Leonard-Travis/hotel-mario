<table>
<tr>
	<td>Hoteles relacionados al paquete: </td> <td>¿cuantos?<input type="text" name="number_of_hotels" id="number_of_hotels" onblur="np_print_hotels();" maxlength="2" size="3" /></td>
</tr>
</table>

<?php if($query){ ?>
<br />
<table align="center" width="60%">

<?php for($i=1; $i <= (int)$number_of_hotels; $i++){ ?>

    
<script type="text/javascript">
	$(function() {
		var availableTags = new Array();
		<?php for($j=0; $j <  count($query) ; $j++){?>
			availableTags[<?php echo($j); ?>] = {label: "<?php echo($query[$j]['name']);?>",
												 value: "<?php echo($query[$j]['hotel_id']);?>"};
		<?php } ?>	
		
		$('#tags'+<?php echo($i); ?>).autocomplete({
			minLength: 0,
			source: availableTags,
			focus: function(event, ui) {
				$('#tags'+<?php echo($i); ?>).val(ui.item.label);
				return false;
			},
			select: function(event, ui) {
				$('#tags'+<?php echo($i); ?>).val(ui.item.label);
				$('#hotel'+<?php echo($i); ?>).val(ui.item.value);
				 np_process_hotels(<?php echo($i);?>);
				return false;
			}
		});
	});
</script>
    	<tr>
        <td>	
        <input id="tags<?php echo($i);?>" />
        <input type="hidden" id="hotel<?php echo($i);?>" />		
        </td>
        </tr>
        <tr>
            <td>
                <div id="np_hotel<?php echo($i);?>">
                </div>
            </td>
        </tr>
        <tr><td><div class="separadorv_gris"></div></td></tr>
    <?php } ?>

    <tr><td align="center"><div id="new_package_process_button"> </div></td></tr>

</table>
<?php } ?>