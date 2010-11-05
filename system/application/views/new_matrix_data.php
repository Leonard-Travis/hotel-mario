<tr>
    <td class="primera">
    <select name="rooms<?php echo($counter);?>" id="rooms<?php echo($counter);?>">
    <?php foreach($rooms as $room) { ?>
            <option value="<?php echo($room['rooms_hotels_id']);?>"><?php echo($room['name_spanish']); ?></option> 
    <?php }?>
    </select>
    </td>
    <td><div class="cantidades"><input type="text" id="price<?php echo($counter); ?>" /></div></td>
    <td><div class="cantidades"><input type="text" id="monday_price<?php echo($counter); ?>" /></div></td>
    <td><div class="cantidades"><input type="text" id="tuesday_price<?php echo($counter); ?>" /></div></td>
    <td><div class="cantidades"><input type="text" id="wednesday_price<?php echo($counter); ?>" /></div></td>
    <td><div class="cantidades"><input type="text" id="thrusday_price<?php echo($counter); ?>" /></div></td>
    <td><div class="cantidades"><input type="text" id="friday_price<?php echo($counter); ?>" /></div></td>
    <td><div class="cantidades"><input type="text" id="saturday_price<?php echo($counter); ?>" /></div></td>
    <td><div class="cantidades"><input type="text" id="sunday_price<?php echo($counter); ?>" /></div></td>
</tr>