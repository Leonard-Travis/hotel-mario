<?php if($new_package_room_frame == '1'){ ?>
	<table align="center" width="100%" id="np_table_hotel<?php echo($number_of_hotel);?>">
    <tr>
    <td>
    <img src="http://localhost/hotel-mario/designed_views/imagenes/i_mas.gif" alt="Agregar" class="valign" />
    <a href="#" class="link_naranja" onclick="new_package_room(<?php echo($hotel_id); ?>, <?php echo($number_of_hotel);?>);">Agregar Habitaci&oacute;n</a>
    </td>
    </tr>
    
    <tr>
        <td class="primera" align="center"><strong>Habitaci&oacute;n</strong></td>
        <td align="center"><strong>Precio p/persona</strong></td>
    </tr>
<?php } ?>

    <td class="primera" align="center">
    <select id="rooms<?php echo($counter.'_'.$number_of_hotel);?>">
    <?php foreach($rooms as $room) { ?>
            <option value="<?php echo($room['rooms_hotels_id']);?>"><?php echo($room['name_spanish']); ?></option> 
    <?php }?>
    </select>
    </td>
    <td align="center">
    	<div class="cantidades">BsF. <input type="text" id="price<?php echo($counter.'_'.$number_of_hotel);?>" />
        </div>
    </td>
    
    </table>