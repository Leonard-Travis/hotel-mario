<script type="text/javascript" src="http://localhost/hotel-mario/js/prototype-1.6.0.3.js"></script>

<?php if ($hotels) {?>
<div class="separadorv"></div>
<div class="separadorv"></div>
    <div id="asociar_c">
    <ul>
        <li class="li_tit_1"><img src="http://localhost/hotel-mario/designed_views/imagenes/zoom.png" alt="Buscador de Cliente" class="valign" />Seleccione un Hotel</li> 
		<li><select name="hotels" id="hotels" onchange="hotel_info();">
        	<option value="-">------</option>
			<?php foreach ($hotels as $hotel) { ?>
				<option value="<?php echo ($hotel['hotel_id']);?>"><?php echo ($hotel['name']);?></option> 
			<?php }?>
			</select> 
        </li>
    </ul>
	</div>
        
<?php }?>

<?php if ($hotel_selected) {?>
<?php foreach ($hotel_selected as $hotel_selected) { ?>
    <div class="separador"></div>
    <div class="separadorv_gris"></div>
    <h1>Detalle de la reserva</h1>
    <div id="hoteles1">
        <table>
            <tr>
                <td><strong>Hotel:</strong></td>
                <td class="tdazul"><?php echo($hotel_selected['name']); ?></td>
                <td><img src="http://localhost/hotel-mario/designed_views/imagenes/cal1.jpg" alt="" /> 
                <a href="<?php echo base_url(); ?>price_matrix/index/0" class="link_naranja" target="_blank">Var mariz de precios</a></td>
            </tr>
            <tr>
                <td><strong>Fecha In:</strong></td>
                <td><input type="text" name="date_start" id="date_start"/></td>
            </tr>
            <tr>
                <td><strong>Fecha Out:</strong></td>
                <td><input type="text" name="date_end" id="date_end"/></td>
            </tr>
            <tr>
                <td><strong>Plan:</strong></td>
                
               	<?php if (count ($plans) == 0){?>
                  <td class="tdazul">No hay planes relacionados </td> </tr>
                    <input type="hidden" name="plan" id="plan" value="no_plan"  />
        		<?php }
              		else { ?>
                    <td>
                <select name="plan" id="plan" >
                <?php foreach ($plans as $plan) { ?>
					<option value="<?php echo ($plan['plan_id']); ?>"> <?php echo ($plan['name_spanish']); ?> </option>
                <?php }?> <!-- end of foreach $plans --> 
                </select>
        		<?php }?> <!-- end of else -->
        <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo($hotel_selected['hotel_id']); ?>" />
                </td>
            </tr>
            <tr> <td></td> <td></td> 
            <td><img src="http://localhost/hotel-mario/designed_views/imagenes/bseleccionar.jpg" alt="seleccionar"  onclick="start_quote();"/></td>
            </tr>
        </table>
    </div>
    <div class="separadorv"></div>
	<div id="hoteles">
    	<div id="quote_details_form" name="quote_details_form" ></div>
        
    </div>
<?php } 
}?>