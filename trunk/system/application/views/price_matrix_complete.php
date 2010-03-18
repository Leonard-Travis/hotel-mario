<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Matriz de Precios</title>
</head>

<body>
<table border="1" align="center" width="100%"> <tr>
    <td colspan="3" align="center"><strong>HOTELES.COM.VE</strong></td> </tr>
    <tr>
	<td width="33%" align="center"> <a href="form_controller"><strong>Clientes</strong></a> </td>
    <td width="33%" align="center"> <a href="management"><strong>Gestion</strong></a> </td>
    <td width="33%" align="center"> <a href="price_matrix"><strong>Matriz de Precios</strong></a> </td> 
</tr> </table>



<?php if ($query) {?>
	<table width="40%">
		<tr>
			<td> <strong>Seleccione un Hotel</strong> </td> 
		<td align="center">
		<?php echo form_open('price_matrix'); ?>
			<select name="hotels" id="hotels">
			<?php foreach ($query as $hotel) { ?>
				<option value="<?php echo ($hotel['hotel_id']);?>"><?php echo ($hotel['name']);?></option> 
			<?php }?>
			</select>
			</td> <td> <input name="send" type="submit" value="Aceptar" /> </td> </tr>
		</form>
	</table>
<?php }?>


<?php if ($hotel_selected) {?>
    <?php echo form_open('price_matrix_data'); ?>
        <br  />
        <table width="40%">
        <?php foreach ($hotel_selected as $hotel_selected) { ?>
            <tr>
            <td>Hotel:</td> <td><input type="text" name="name" id="name" readonly="readonly" value="<?php echo ($hotel_selected['name']);?>" /></td>
            </tr>        
            <tr>
            <td>Plan:</td>
            <td>
		<?php if (count ($plans) == 0){?>
                <strong>No hay planes relacionados</strong> </td> </tr>
                <input type="hidden" name="plan" id="plan" value="no_plan"  />
        <?php }
              else { ?>
                <select name="plan" id="plan" >
                <?php foreach ($plan_selected as $plan_selected) { ?>
                        <option value="<?php echo ($plan_selected['plan_id']); ?>"> <?php echo ($plan_selected['name']); ?> </option>
                <?php } ?>
                <?php foreach ($plans as $plan) { ?>
                   <?php if ($plan_selected['plan_id'] != $plan['plan_id']){?>
                    <option value="<?php echo ($plan['plan_id']); ?>"> <?php echo ($plan['name']); ?> </option>
                   <?php }?>
                <?php }?> <!-- end of foreach $plans --> 
                </select>
        <?php }?> <!-- end of else -->
            </td>
            </tr>
            <tr> 
            <td>Desde:</td> <td><input type="text" name="date_ini" id="date_ini" value="<?php echo($date_ini);?>" /></td>
            <td>Hasta:</td> <td><input type="text" name="date_end" id="date_end" value="<?php echo($date_end);?>" /></td>
            </tr>
            <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo ($hotel_selected['hotel_id']);?>"  />
        <?php }?> <!-- end of foreach $hotel_selected -->
        <tr> <td><input type="submit" value="Buscar"  /></td>
    </form> <!-- end of form price_matrix_data -->
    </table>
<?php }?>

<?php 
if ($prices == 11) {?>
		<strong>No existen referencias de precios con dichas condiciones en sistema</strong>
	<?php }
else {
	if ($weekdays == 0){
		 $gray_row = TRUE; ?>
			<table width="100%">
				<tr> 
				<td width="14.7%" align="center"><strong>Habitacion</strong></td>
				<td align="center"><strong>Precio</strong></td>
				</tr>
				<?php foreach ($prices as $prices) { ?>
				<?php foreach ($prices as $price)  { ?>
					<?php if ($gray_row){?>
						 <tr bgcolor="#CCCCCC">
						 <?php $gray_row = false;
					  }
					  else{  ?>
						 <tr>
						 <?php $gray_row = true;
					  }?>
					<td width="14.7%" align="center"><?php echo ($price['name']); ?></td>
					<td align="center"><?php echo ($price['price_per_night']); ?></td> 
					</tr>             
				<?php } ?>
				<?php } ?>
			</table>
	  <?php }      
	  else if ($weekdays == 1){ 
		$gray_row = TRUE; ?>
		<table width="100%">
			<tr> 
			<td align="center"><strong>Habitacion</strong></td>
			<td align="center"><strong>Precio</strong></td>
			<td align="center"><strong>Lunes</strong></td>
			<td align="center"><strong>Martes</strong></td>
			<td align="center"><strong>Miercoles</strong></td>
			<td align="center"><strong>Jueves</strong></td>
			<td align="center"><strong>Viernes</strong></td>
			<td align="center"><strong>Sabado</strong></td>
			<td align="center"><strong>Domingo</strong></td>
			</tr>
			<?php foreach ($prices as $price)  { ?>
				<?php if ($gray_row){?>
					 <tr bgcolor="#CCCCCC">
					 <?php $gray_row = false;
				  }
				  else{  ?>
					 <tr>
					 <?php $gray_row = true;
				  }?>
				<td align="center"><?php echo ($price['name']); ?></td>
				<td align="center"><?php echo ($price['price_per_night']); ?></td> 
                <?php
				if ($price['weekdays'] == 0){ ?>
					<td align="center">0</td> <td align="center">0</td> <td align="center">0</td> 
                    <td align="center">0</td> <td align="center">0</td> <td align="center">0</td> <td align="center">0</td> 
				<?php }
				else {
					foreach ($price['weekdays'] as $day){?>
						<td align="center"><?php echo ($day['monday_price']); ?></td> 
						<td align="center"><?php echo ($day['tuesday_price']); ?></td> 
						<td align="center"><?php echo ($day['wednesday_price']); ?></td> 
						<td align="center"><?php echo ($day['thursday_price']); ?></td> 
						<td align="center"><?php echo ($day['friday_price']); ?></td> 
						<td align="center"><?php echo ($day['saturday_price']); ?></td> 
						<td align="center"><?php echo ($day['sunday_price']); ?></td> 
					<?php } 
				}?>
				</tr>             
			<?php } ?>
		</table>
	  <?php } ?>
	  <?php echo form_open('price_matrix_data'); ?>
		<input type="hidden" name="weekdays" id="weekdays" value="<?php echo($weekdays); ?>"  />
		<input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo ($hotel_selected['hotel_id']);?>"  />
		<input type="hidden" name="date_ini" id="date_ini" value="<?php echo($date_ini);?>"  />
		<input type="hidden" name="date_end" id="date_end" value="<?php echo($date_end);?>"  />
		<input type="hidden" name="plan" id="plan" value="<?php echo ($plan_selected['plan_id']);?>"  />
		<input type="submit" value="Detalles por dias de semana"  />
	</form>
<?php } ?> <!-- end of else $prices != 11 -->

</body>
</html>