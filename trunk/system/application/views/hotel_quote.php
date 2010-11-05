<?php if ($hotels) {?>
<script type="text/javascript">
	$(function() {
		var availableTags = new Array();
		
		
		<?php for($i=0; $i <  count($hotels) ; $i++){?>
			availableTags[<?php echo($i); ?>] = "hola"+<?php echo($hotels[$i]['name']);?>;
		<?php } ?>	
		//var availableTags = ["ActionScript", "AppleScript", "Asp", "BASIC", "C", "C++", "Clojure", "COBOL", "ColdFusion", "Erlang", "Fortran", "Groovy", "Haskell", "Java", "JavaScript", "Lisp", "Perl", "PHP", "Python", "Ruby", "Scala", "Scheme"];
		$("#tags").autocomplete({
			source: availableTags
		});
	});
</script>
<div class="separadorv"></div>
<div class="separadorv"></div>
<h1>Hotel</h1>
    <div id="asociar_c">
    <ul>
        <li class="li_tit_1"><img src="http://localhost/hotel-mario/designed_views/imagenes/zoom.png" alt="Buscador de Cliente" class="valign" />Seleccione un Hotel</li> 
		<li><select name="hotels" id="hotels" onchange="hotel_info();">
        	<option value="-">----------------</option>
			<?php foreach ($hotels as $hotel) { ?>
				<option value="<?php echo ($hotel['hotel_id']);?>"><?php echo ($hotel['name']);?></option> 
			<?php }?>
			</select> 
            <input id="tags" />
        </li>
    </ul>
	</div>
        
<?php }?>

<?php if ($hotel_selected) {?>

<script type="text/javascript">
	$(document).ready(function() {
		$("#date_start").datepicker({dateFormat: 'yy-mm-dd'});
		$("#date_end").datepicker({dateFormat: 'yy-mm-dd'});
	});
</script>


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
                <td><input type="text" name="date_start" id="date_start" readonly="readonly"/></td>
            </tr>
            <tr>
                <td><strong>Fecha Out:</strong></td>
                <td><input type="text" name="date_end" id="date_end" readonly="readonly"/></td>
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
        <input type="hidden" name="rooms" id="rooms" value="0" />
                </td>
            </tr>
            <tr>
            	<td><strong>Adultos:</strong></td>
                <td><input type="text" name="persons" id="persons" maxlength="3" size="4"/></td>
            </tr>
            <tr> <td></td> <td></td> 
            <td><input type="image" name="procesar" id="procesar" src="http://localhost/hotel-mario/designed_views/imagenes/bseleccionar.jpg" onclick="start_hotel_quote();"/></td>
            </tr>
        </table>
    </div>
    <div class="separadorv"></div>
	<div id="hoteles">
    	<div id="quote_details_form" name="quote_details_form" ></div>
        <div id="add_quote_button"></div>
    </div>
    
<?php } ?>
<?php } ?>