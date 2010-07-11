<?php if ($prices != 11) {?>

<form name="quote_data" id="quote_data">
<table id="quote_hotel_table">
    <tr>
    <td><img src="http://localhost/hotel-mario/designed_views/imagenes/i_mas.gif" alt="Agregar" class="valign" /><a href="#" class="link_naranja" onclick="add_room();">Agregar Habitación</a></td>
    </tr>
    <tr class="pthead">
        <td align="center">Tipo de Habitación</td>
        <td align="center">Cantidad</td>
        <td  align="center">Precio unitario</td>
        <td  align="center">Sub Total</td>
    </tr>
    <tr> 
    	<td align="center">
        
        <input type="hidden" id="date_start" name="date_start" value="<?php echo($date_start_quote);?>"  />
        <input type="hidden" id="date_end" name="date_end" value="<?php echo($date_end_quote);?>"  />
        <input type="hidden" id="plan" name="plan" value="<?php echo($plan_selected);?>"  />
        <input type="hidden" id="hotel_id" name="hotel_id" value="<?php echo($hotel_selected_id);?>"  />
        <input type="hidden" id="contador" name="contador" value= "<?php echo($contador);?>"  />

        <select name="rooms<?php echo($contador);?>" id="rooms<?php echo($contador);?>" onchange="setting_PU();">
        <option value="-">-----------</option>
        <?php $room_aux = ''; 
		foreach($prices as $price) { 
			if ($price['rooms_hotels_id'] != $room_aux) { ?>
        		<option value="<?php echo ($price['rooms_hotels_id']); ?>"> <?php echo ($price['name_spanish']); ?> </option> 
                <?php $room_aux = $price['rooms_hotels_id']; 
			}
		}?>
        </select>     
    	</td>
        <td align="center">
        <input type="text" name="quantity<?php echo($contador);?>" id="quantity<?php echo($contador);?>" maxlength="2" size="3" value="00" onblur="setting_subtotal()" onclick="document.quote_data.quantity<?php echo($contador);?>.value ='';"/>
        </td>
         <td align="center">
       		<div id="price_per_night<?php echo($contador);?>" name="price_per_night<?php echo($contador);?>"></div>
        </td>
        <td align="center">
        	<div id="subtotal<?php echo($contador);?>" name="subtotal<?php echo($contador);?>"></div>
        </td>        
    </tr>
</table>
</form>		
<div id="new_room" name="new_room"></div>


<?php } 
else echo('No hay precios referentes con las especificaciones dadas');?>			