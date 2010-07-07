<form name="quote_data" id="quote_data">
<table>
    <tr>
    <td><img src="http://localhost/hotel-mario/designed_views/imagenes/i_mas.gif" alt="Agregar" class="valign" /><a href="#" class="link_naranja">Agregar Habitación</a></td>
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
        
        <select name="rooms" id="rooms" onchange="setting_PU();">
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
        <input type="text" name="quantity" id="quantity" maxlength="2" size="3" value="1" onblur="setting_subtotal()"/>
        </td>
         <td align="center">
       		<div id="price_per_night" name="price_per_night"></div>
        </td>
        <td align="center">
        	<div id="subtotal" name="subtotal"></div>
        </td>        
    </tr>
</table>
</form>					