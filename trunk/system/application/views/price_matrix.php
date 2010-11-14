<div id="price_matrix_div">
<?php
$this->load->view('global/header');
?>
<div id="menu">
	<div class="cuerpo">
		<ul>
			<li><a href="<?php echo base_url(); ?>customer/search_form">Clientes</a></li>
			<li class="palito"><img src="<?php echo IMG; ?>naranja3.gif" alt="" /></li>
			<li><a href="<?php echo base_url(); ?>home/management">Gestion</a></li>
            <li class="mfocus">
				<img src="<?php echo IMG; ?>f1.png" alt="" class="floati" />
				<div class="mf_texto">Matriz de Precios</div>
				<img src="<?php echo IMG; ?>f3.png" alt="" class="floati" />
            </li>
            <li><a href="<?php echo base_url(); ?>quotation/new_quote/0">Cotizaciones</a></li>
		</ul>
	</div>
</div>
<div id="menu2">
</div>
<div class="separadorv"></div>

<div class="cuerpo">
	<div class="floati">
		<div id="tablappa1"> <!-- usar id="tablappa2" cuandos e quiera que ocupe toda la ventana y eliminar el <div id="calendario">
									en todo caso el ancho completo es de 950 px-->
			<div id="matriz">
				<img src="<?php echo IMG; ?>tabla1.jpg" alt="" class="floati valign" />
				Matriz de Precios
				<img src="<?php echo IMG; ?>tabla3.jpg" alt=""  class="floatd valign"/>
			</div>
			<div class="separador"></div>
			<div id="matriz2">

<?php if ($query) {?>
<script type="text/javascript">
	$(function() {
		var availableTags = new Array();
		<?php for($i=0; $i <  count($query) ; $i++){?>
			availableTags[<?php echo($i); ?>] = {label: "<?php echo($query[$i]['name']);?>",
												 value: "<?php echo($query[$i]['hotel_id']);?>"};
		<?php } ?>	
		
		$('#tags').autocomplete({
			minLength: 0,
			source: availableTags,
			focus: function(event, ui) {
				$('#tags').val(ui.item.label);
				return false;
			},
			select: function(event, ui) {
				$('#tags').val(ui.item.label);
				$('#hotels').val(ui.item.value);				
				return false;
			}
		});
	});
</script>


<div class="separadorv"></div><div class="separadorv"></div>
    <div id="asociar_c">
    <ul>
        <li class="li_tit_1"><img src="<?php echo IMG; ?>zoom.png" alt="Buscador de Cliente" class="valign" />Seleccione un Hotel</li> 
		<li>
         <input id="tags" />
         <input type="hidden" id="hotels" />	
        </li>
        <li>
    <a href="javascript:void(0);"><img src="<?php echo IMG; ?>bbuscar.jpg" onclick="price_matrix_hotel();" /></a>
        </li>
     </ul>
     </div>
<?php }?>
			
            
                 
<table>
<tr>
<td width="50%">
<?php if ($hotel_selected) {?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#date_ini").datepicker({dateFormat: 'yy-mm-dd'});
		$("#date_end").datepicker({dateFormat: 'yy-mm-dd'});
	});
</script>

	<div class="separador"></div>

    <form name="form1" method="post" action="<?php echo base_url(); ?>price_matrix/price_matrix_data/0">
        <br  />
        <table width="40%" class="resumen">
        <?php foreach ($hotel_selected as $hotel_selected) { ?>
        <tr>
        <td><strong>Hotel:</strong></td> <td bgcolor="#99FF00" align="center"><strong><?php echo ($hotel_selected['name']);?></strong></td>
        </tr>        
        <tr>
        <td><strong>Plan:</strong></td>
        <td>
        <?php if (count ($plans) == 0){?>
                <strong>No hay planes relacionados</strong> </td> </tr>
                <input type="hidden" name="plan" id="plan" value="no_plan"  />
        <?php }
              else { ?>
                <select name="plan" id="plan" >
                <?php foreach ($plans as $plan) { ?>
					<option value="<?php echo ($plan['plan_id']); ?>"> <?php echo ($plan['name_spanish']); ?> </option>
                <?php }?> <!-- end of foreach $plans --> 
                </select>
        <?php }?> <!-- end of else -->
        </td>
        </tr>
        <tr> 
        <td><strong>Desde:</strong></td> <td><input type="text" name="date_ini" id="date_ini" readonly="readonly" /></td>
        <td><strong>Hasta:</strong></td> <td><input type="text" name="date_end" id="date_end" readonly="readonly" /></td>
        </tr>
        <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo ($hotel_selected['hotel_id']);?>"  />
        <?php }?> <!-- end of foreach $hotel_selected -->
        <tr> <td><input type="submit" value="Buscar"/></td>
    </form> <!-- end of form price_matrix_data -->
    </table>
<?php }?>
</td>



<td width="50%">
<?php if ($prices){ 
						if(count($no_price) > 0){ ?>
                            <script>
								
                            	alert('Hay rangos de fechas correspondientes a las introducidas sin precios asignados como: '+'<?php echo($no_price[0][0]['date_start'].' al '.$no_price[0][0]['date_end']);?>');
                            </script>
                  <?php }?>


<table class="resumen">
        <tr>
        <td><strong>Plan:</strong></td><td bgcolor="#33CCFF" align="center"><?php echo($plan_selected[0]['name_spanish']);?></td>
        </tr>
       	<tr>
        <td><strong>Descripci&oacute;n:</strong></td><td><?php echo nl2br($plan_description[0]['description']);?></td>
        </tr>
  
</table>
</td>
</tr>
</table>

<?php if ($prices == 11) {?>
		<strong>No existen referencias de precios con dichas condiciones en sistema</strong>
	<?php }
	
else { ?>
	<div class="separador"></div>
	<div class="separadorv_gris"></div>
    
    <table width="100%" class="resumen">
    <thead>
    <tr> 
    <td width="14.7%" align="center" class="primera"><strong>Habitacion</strong></td>
    <td align="center"><strong>Precio</strong></td>  
    <td align="center"><strong>Validez de Tarifas</strong></td>  
  
	<?php if ($weekdays == 0){?>
				</tr>
                </thead>
				<?php foreach ($prices as $prices) { ?>
				<?php foreach ($prices as $price)  { ?>
					<tr>
					<td align="center" bgcolor="#FFCC99"><?php echo ($price['name_spanish']); ?></td>
					<td align="center" bgcolor="#FFFFCC">BsF. <?php echo ($price['price_per_night']); ?></td>
                    <td align="center" bgcolor="#FF99CC"><?php echo ($price['date_start'].' al '.$price['date_end']); ?></td> 
					</tr>             
				<?php } ?>
				<?php } ?>
			</table>
	  <?php }      
	  else if ($weekdays == 1){?>
			<td align="center"><strong>Lunes</strong></td>
			<td align="center"><strong>Martes</strong></td>
			<td align="center"><strong>Miercoles</strong></td>
			<td align="center"><strong>Jueves</strong></td>
			<td align="center"><strong>Viernes</strong></td>
			<td align="center"><strong>Sabado</strong></td>
			<td align="center"><strong>Domingo</strong></td>
			</tr>
            </thead>
			<?php foreach ($prices as $prices)  { 
				  foreach ($prices as $price) {?>
            	<tr>
				<td align="center" bgcolor="#FFCC99"><?php echo ($price['name_spanish']); ?></td>
                <td align="center" bgcolor="#FFFFCC">BsF. <?php echo ($price['price_per_night']); ?></td>
                <td align="center" bgcolor="#FF99CC"><?php echo ($price['date_start'].' al '.$price['date_end']); ?></td> 
                <?php
				if ($price['has_weekdays'] == 0){ ?>
					<td align="center">-</td> <td align="center">-</td> <td align="center">-</td> 
                    <td align="center">-</td> <td align="center">-</td> <td align="center">-</td> <td align="center">-</td> 
				<?php } 
				else {?>
					<td align="center"><?php echo ($price['monday_price']); ?></td> 
					<td align="center"><?php echo ($price['tuesday_price']); ?></td> 
					<td align="center"><?php echo ($price['wednesday_price']); ?></td> 
					<td align="center"><?php echo ($price['thursday_price']); ?></td> 
					<td align="center"><?php echo ($price['friday_price']); ?></td> 
					<td align="center"><?php echo ($price['saturday_price']); ?></td> 
					<td align="center"><?php echo ($price['sunday_price']); ?></td> 
                    
				<?php } ?>
				</tr>             
			<?php } } //end of foreach prices ?>
		</table>
	  <?php } ?>
	  <form method="post" action="<?php echo base_url(); ?>price_matrix/price_matrix_data/0">
		<input type="hidden" name="weekdays" id="weekdays" value="<?php echo($weekdays); ?>"  />
		<input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo ($hotel_selected['hotel_id']);?>"  />
		<input type="hidden" name="date_ini" id="date_ini" value="<?php echo($date_ini);?>"  />
		<input type="hidden" name="date_end" id="date_end" value="<?php echo($date_end);?>"  />
		<input type="hidden" name="plan" id="plan" value="<?php echo($plan_selected[0]['plan_id']);?>"  />
		<input type="submit" value="Detalles por dias de semana"  />
	</form>
<?php } 
}
else {?> <!-- end of else $prices != 11 -->
</tr>
</table>
<?php } ?>




</div>
			<div class="separador"></div>
			<div class="tpiec"><img src="<?php echo IMG; ?>esq1.gif" alt="" /><img src="<?php echo IMG; ?>esq3.gif" alt="" class="floatd" /></div>
			<div class="separadorv"></div>
		</div>
	</div>


</body>
</html>
</div><!-- end of price_matrix_div div-->