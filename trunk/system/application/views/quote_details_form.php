<?php if ($prices != 11) {?>

<td align="center">

    <input type="hidden" id="date_start" name="date_start" value="<?php echo($date_start_quote);?>"  />
    <input type="hidden" id="date_end" name="date_end" value="<?php echo($date_end_quote);?>"  />
    <input type="hidden" id="plan" name="plan" value="<?php echo($plan_selected);?>"  />
    <input type="hidden" id="hotel_id" name="hotel_id" value="<?php echo($hotel_selected_id);?>"  />
    <input type="hidden" id="counter" name="counter" value="<?php echo($counter);?>"  />
    
    <select name="rooms<?php echo($counter);?>" id="rooms<?php echo($counter);?>" onchange="setting_PU(<?php echo($counter);?>);" >
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
	<input type="text" name="quantity<?php echo($counter);?>" id="quantity<?php echo($counter);?>" maxlength="2" size="3" value="00" onblur="setting_subtotal(<?php echo($counter);?>)" onclick="document.quote_data.quantity<?php echo($counter);?>.value ='';"/>
</td>
 <td align="center">
    <div id="price_per_night<?php echo($counter);?>" name="price_per_night<?php echo($counter);?>"></div>
</td>
<td align="center">
    <div id="subtotal<?php echo($counter);?>" name="subtotal<?php echo($counter);?>"></div>
    <span class="rojo">
        <div id="total<?php echo($counter);?>" name="total<?php echo($counter);?>"></div>
    </span>
    <br /><br  />
    <div id="process_button<?php echo($counter);?>"></div>
</td>
</tr>

<?php } 
else {
	echo('<strong>No rooms left</strong>');?>

<td></td> <td></td> 
<td align="center">
	<span class="rojo">
        <div id="total<?php echo($counter);?>" name="total<?php echo($counter);?>"></div>
    </span>
</td>
<?php } ?>

</table>