<div id="flight_quote_aux">
<script type="text/javascript">
	$(function compl(tag) {
		var availableTags = new Array();
		<?php for($i=0; $i <  count($citys) ; $i++){?>
			availableTags[<?php echo($i); ?>] = {label: "<?php echo($citys[$i]['name']);?>",
												 value: "<?php echo($citys[$i]['flight_city_id']);?>"};
		<?php } ?>	
		
		$('#origin<?php echo($cont_f); ?>_tag').autocomplete({
			minLength: 0,
			source: availableTags,
			focus: function(event, ui) {
				$('#origin<?php echo($cont_f); ?>_tag').val(ui.item.label);
				return false;
			},
			select: function(event, ui) {
				$('#origin<?php echo($cont_f); ?>_tag').val(ui.item.label);
				$('#origin<?php echo($cont_f); ?>').val(ui.item.value);				
				return false;
			}
		});
		$('#destination<?php echo($cont_f); ?>_tag').autocomplete({
			minLength: 0,
			source: availableTags,
			focus: function(event, ui) {
				$('#destination<?php echo($cont_f); ?>_tag').val(ui.item.label);
				return false;
			},
			select: function(event, ui) {
				$('#destination<?php echo($cont_f); ?>_tag').val(ui.item.label);
				$('#destination<?php echo($cont_f); ?>').val(ui.item.value);				
				return false;
			}
		});
	});
	
	
	$(document).ready(function() {
		$("#go_date<?php echo($cont_f); ?>").datepicker({
												dateFormat: 'yy-mm-dd',
												minDate: '<?php echo date('Y-m-d');?>',
												onSelect: function(date) {
													$("#back_date<?php echo($cont_f); ?>").val( $(this).val() );
												}
											 });
		$("#back_date<?php echo($cont_f); ?>").datepicker({dateFormat: 'yy-mm-dd'});
	});
</script>

<table width="100%">
        	<tr>
            <td><strong>Origen:</strong></td>
            <td>
                <input id="origin<?php echo($cont_f); ?>_tag"/>
            	<input type="hidden" id="origin<?php echo($cont_f); ?>" />
            </td>
            <td><strong>Partida:</strong></td>
            <td>
            <input type="text" name="go_date<?php echo($cont_f); ?>" id="go_date<?php echo($cont_f); ?>" value="yyyy-mm-dd" width="11" maxlength="10" readonly="readonly"/>
            
            <input type="text" name="go_time<?php echo($cont_f); ?>" id="go_time<?php echo($cont_f); ?>" value="hh:mm" onclick="$('#go_time<?php echo($cont_f); ?>').val('');" width="6%" maxlength="5"/>
            </td>
            </tr> 
            
            <tr>
            <td><strong>Destino:</strong></td>
            <td>
                <input id="destination<?php echo($cont_f); ?>_tag"/>
            	<input type="hidden" id="destination<?php echo($cont_f); ?>" />
            </td>
            
            <td>
            <div id="back<?php echo($cont_f); ?>">
            <strong>Regreso:</strong>
            </div>
            </td>
            <td>
            <div id="back_data<?php echo($cont_f); ?>">
            <input type="text" name="back_date<?php echo($cont_f); ?>" id="back_date<?php echo($cont_f); ?>" value="yyyy-mm-dd" width="11" maxlength="10" readonly="readonly"/>
            <input type="text" name="back_time<?php echo($cont_f); ?>" id="back_time<?php echo($cont_f); ?>" value="hh:mm" width="6%" maxlength="5" onclick="$('#back_time<?php echo($cont_f); ?>').val('');"/>
            </div>
            </td>
            
            
            </tr>    
            
            <tr> <td><strong>Numero:</strong></td> <td><input type="text" name="number<?php echo($cont_f); ?>" id="number<?php echo($cont_f); ?>" maxlength="6" /></td> </tr>
            <tr> <td><strong>Aerolinea:</strong></td> 
            	 <td><select name="airline<?php echo($cont_f); ?>" id="airline<?php echo($cont_f); ?>">
            	<?php foreach($airlines as $airline){ ?>
                	<option value="<?php echo($airline['airline_id']); ?>"><?php echo($airline['name']); ?></option>
                <?php } ?>
                </select>
                 </td> 
            </tr>
            <tr> <td><strong>Clase:</strong></td> 
            	 <td><select name="class<?php echo($cont_f); ?>" id="class<?php echo($cont_f); ?>">
            	<?php foreach($classes as $class){ ?>
                	<option value="<?php echo($class); ?>"><?php echo($class); ?></option>
                <?php } ?>
                </select>
                 </td> 
            </tr>
            
            <tr>
            <td><strong>Adultos:</strong></td>
            <td><input type="text" name="cant_adults<?php echo($cont_f); ?>" id="cant_adults<?php echo($cont_f); ?>" size="5" maxlength="2" value="00" onclick="document.fboletos.cant_adults<?php echo($cont_f); ?>.value ='';" onblur="if( $('#cant_adults<?php echo($cont_f); ?>').val() =='') $('#cant_adults<?php echo($cont_f); ?>').val('00')"/>
            
            	<input type="text" name="price_per_adult<?php echo($cont_f); ?>" id="price_per_adult<?php echo($cont_f); ?>" size="12" maxlength="10" value="00" onclick="document.fboletos.price_per_adult<?php echo($cont_f); ?>.value ='';" onblur="if( $('#price_per_adult<?php echo($cont_f); ?>').val() =='') $('#price_per_adult<?php echo($cont_f); ?>').val('00')"/>BsF.c/u
            </td>
            
            <td><strong>Ni&ntilde;os:</strong></td>
            <td><input type="text" name="cant_kids<?php echo($cont_f); ?>" id="cant_kids<?php echo($cont_f); ?>"  size="5" maxlength="2" value="00" onclick="document.fboletos.cant_kids<?php echo($cont_f); ?>.value ='';" onblur="if( $('#cant_kids<?php echo($cont_f); ?>').val() =='') $('#cant_kids<?php echo($cont_f); ?>').val('00')"/>
            
            	<input type="text" name="price_per_kid<?php echo($cont_f); ?>" id="price_per_kid<?php echo($cont_f); ?>" size="12" maxlength="10" value="00" onclick="document.fboletos.price_per_kid<?php echo($cont_f); ?>.value ='';" onblur="if( $('#price_per_kid<?php echo($cont_f); ?>').val() =='') $('#price_per_kid<?php echo($cont_f); ?>').val('00')"/>BsF.c/u
            </td>
            </tr>
            <tr><td></td></tr><tr><td></td></tr>
            <tr>
            <td></td> <td><input type="checkbox" name="round_trip<?php echo($cont_f); ?>" id="round_trip<?php echo($cont_f); ?>" onclick="back_data(<?php echo($cont_f); ?>);" checked="checked" /> Ida y vuelta</td>
            </tr>
            
            <tr> <td></td> <td></td> <td></td> <td align="center"><input type="button" value="Agregar Viajeros"onclick="flight_quote_data(<?php echo($cont_f); ?>);" /></td></tr>
            
        <div id="flight_quote<?php echo(((int) $cont_f) + 1); ?>" name="flight_quote<?php echo(((int) $cont_f) + 1); ?>">
        </div>
        </table>
        
        <div id="travelers_info<?php echo($cont_f); ?>" name="travelers_info<?php echo($cont_f); ?>">
        </div>        
        
        
     
     <?php if ($cont_f != 0) { ?>
		<div class="separadorv"></div><div class="separadorv_gris"></div><div class="separadorv"></div>
	 <?php } ?>
    
        <div class="separadorv"></div>        
        <div class="separadorv"></div>
        <div class="separadorv"></div>
    </div>
</div>
</div>