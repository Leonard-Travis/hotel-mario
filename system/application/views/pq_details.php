<?php if($frame == '1'){ ?>

    <table align="center" width="60%" class="resumen">
    <tr>
        <td align="center">
            <span class="naranja"><?php echo($hotel[0]['name']);?>
        </td>
    </tr>
    </table>


	<table align="center" width="80%" id="pq_table">
    <tr>
    <td>
    <img src="http://localhost/hotel-mario/designed_views/imagenes/i_mas.gif" alt="Agregar" class="valign" />
    <a href="#" class="link_naranja" onclick="pq_add_room();">Agregar Habitaci&oacute;n</a>
    </td>
    </tr>
    
    <tr>
        <td class="primera" align="center"><strong>Habitaci&oacute;n</strong></td>
        <td align="center"><strong>Precio p/persona</strong></td>
        <td align="center"><strong>Cant. de Personas</strong></td>
        <td align="center"><strong>Subtotal</strong></div></td>
    </tr>
<?php } ?>

    <td class="primera" align="center">
    <select id="room<?php echo($pq_count);?>" onchange="pq_set_price(<?php echo($pq_count);?>);">
    <option value="-">----------------</option>
    <?php foreach($rooms as $room) { ?>
            <option value="<?php echo($room['room_per_package_id']);?>|<?php echo($room['price_per_person']);?>"><?php echo($room['name_spanish']); ?></option> 
    <?php }?>
    </select>
    </td>
    <td align="center">
    	<div id="pq_price<?php echo($pq_count);?>">
        </div>
    </td>
    <td align="center">
    	<input type="text" id="cant_persons<?php echo($pq_count);?>" size="3" maxlength="2" onblur="pq_set_subtotal(<?php echo($pq_count);?>);"/>
    </td>
    <td align="center">
    	<div id="pq_subtotal<?php echo($pq_count);?>">
        </div>
        <span class="rojo">
        	<div id="pq_total<?php echo($pq_count);?>""></div>
    	</span>
    </td>
    