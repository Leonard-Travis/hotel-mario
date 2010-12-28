<?php if($new_package_room_frame == '1'){ ?>
	<table align="center" width="100%" id="np_table_hotel<?php echo($number_of_hotel);?>">
    <tr>
    <td width="30%">
    <img src="<?php echo IMG; ?>i_mas.gif" alt="Agregar" class="valign" />
    <a href="javascript:void(0);" class="link_naranja" onclick="new_package_room(<?php echo($hotel_id); ?>, <?php echo($number_of_hotel);?>);">Agregar Habitaci&oacute;n</a>
    </td>
    </tr>
    
    <tr>
        <td class="primera" align="center"><strong>Habitaci&oacute;n</strong></td>
        <td align="center"><strong>Precio p/persona</strong></td>
        <td align="center"><strong>Precio p/ni&ntilde;o</strong></td>
        <td align="center"><strong>Noche Adicional</strong></td>
    </tr>
<?php } ?>

	<tr>
        <td class="primera" align="center">
        	<input type="hidden" id="rooms<?php echo($counter.'_'.$number_of_hotel);?>" />
            <input id="tags<?php echo($counter.'_'.$number_of_hotel);?>"/>
        </td>
        <td align="center">
            <div class="cantidades">BsF. <input type="text" id="price_adult<?php echo($counter.'_'.$number_of_hotel);?>" size="12" maxlength="10" />
            </div>
        </td>
        <td align="center">
            <div class="cantidades">BsF. <input type="text" id="price_kid<?php echo($counter.'_'.$number_of_hotel);?>" size="12" maxlength="10" />
            </div>
        </td>
        <td align="center">
            <div class="cantidades">BsF. <input type="text" id="price_additional<?php echo($counter.'_'.$number_of_hotel);?>" size="12" maxlength="10" />
            </div>
        </td>
    </tr>
    
    
 
<script type="text/javascript">
	$(function() {
		var availableTags = new Array();
		<?php for($i=0; $i <  count($rooms) ; $i++){?>
			availableTags[<?php echo($i); ?>] = {label: "<?php echo($rooms[$i]['name_spanish']);?>",
												 value: "<?php echo($rooms[$i]['rooms_hotels_id']);?>"};
		<?php } ?>	
		
		$('#tags<?php echo($counter.'_'.$number_of_hotel);?>').autocomplete({
			minLength: 0,
			source: availableTags,
			focus: function(event, ui) {
				$('#tags<?php echo($counter.'_'.$number_of_hotel);?>').val(ui.item.label);
				return false;
			},
			select: function(event, ui) {
				$('#tags<?php echo($counter.'_'.$number_of_hotel);?>').val(ui.item.label);
				$('#rooms<?php echo($counter.'_'.$number_of_hotel);?>').val(ui.item.value);				
				return false;
			}
		});
	});
</script>
    