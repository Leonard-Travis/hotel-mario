<?php if($frame == '1'){ ?>
<script>
$(document).ready(function() {
		$("#check_in").datepicker({dateFormat: 'yy-mm-dd'});
		$("#check_out").datepicker({dateFormat: 'yy-mm-dd'});
	});
</script>
<form id="pq_details_form" name="pq_details_form">

    <table align="center" width="60%" class="resumen">
    <tr>
        <td align="center">
            <span class="naranja"><?php echo($hotel[0]['name']);?>
        </td>
    </tr>
    </table>


	<table align="center" width="80%" id="pq_table" border="1">
        <tr>
            <td>Check In:<div id="check_in_div"><input type="text" id="check_in" maxlength="10" size="11" readonly="readonly"/></div></td>
            <td>Check Out:<input type="text" id="check_out" maxlength="10" size="11" readonly="readonly"/></td>
        </tr>
        <tr>
        <td>
        <img src="http://localhost/hotel-mario/designed_views/imagenes/i_mas.gif" alt="Agregar" class="valign" />
        <a href="#" class="link_naranja" onclick="pq_add_room();">Agregar Habitaci&oacute;n</a>
        </tr>
        <tr>
            <td class="primera" align="center"><strong>Habitaci&oacute;n</strong></td>
            <td align="center" width="15%"><strong>Precio p/Adulto</strong></td>
            <td align="center" width="15%"><strong>Precio p/Infante</strong></td>
            <td align="center"><strong>Adultos</strong></td>
            <td align="center"><strong>Infantes</strong></td>
            <td align="center"><strong>Subtotal</strong></div></td>
            <td align="center" width="17px"></td>
        </tr>
    
</form>

<?php } ?>
<!------------------------------------------add room------------------------------------------------->

<tr>
    <td class="primera" align="center">
    <select id="room<?php echo($pq_count);?>" onchange="pq_set_price(<?php echo($pq_count);?>);">
    <option value="-">----------------</option>
    <?php foreach($rooms as $room) { ?>
            <option value="<?php echo($room['room_per_package_id'].'|'.$room['price_per_person'].'|'.$room['price_per_kid']);?>"><?php echo($room['name_spanish']); ?></option> 
    <?php }?>
    </select>
    </td>
    <td align="center">
    	<div id="pq_price_adult<?php echo($pq_count);?>">
        </div>
    </td>
     <td align="center">
    	<div id="pq_price_kid<?php echo($pq_count);?>">
        </div>
    </td>
    <td align="center">
    	<input type="text" id="cant_persons<?php echo($pq_count);?>" size="3" maxlength="2" onblur="pq_set_subtotal(<?php echo($pq_count);?>, <?php echo($this->session->userdata('id'));?>);" value="00"/>
    </td>
    <td align="center">
    	<input type="text" id="cant_kids<?php echo($pq_count);?>" size="3" maxlength="2" onblur="pq_set_subtotal(<?php echo($pq_count);?>, <?php echo($this->session->userdata('id'));?>);" value="00"/>
    </td>
    <td align="center">
    	<div id="pq_subtotal<?php echo($pq_count);?>"></div>
        <span class="rojo">
        	<div id="pq_total<?php echo($pq_count);?>"></div>
    	</span>
    </td>
    <td>
    </td>
</tr>
<script>
	$('#cant_persons<?php echo($pq_count);?>').click(function() {			   
	  $('#cant_persons<?php echo($pq_count);?>').val("");
	});
	$('#cant_kids<?php echo($pq_count);?>').click(function() {			   
	  $('#cant_kids<?php echo($pq_count);?>').val("");
	});
	$('#check_out').click(function() {			   
	  $('#cant_kids<?php echo($pq_count);?>').val("");
	});
</script>
    