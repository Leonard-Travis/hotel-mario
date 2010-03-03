<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gestion</title>
</head>

<body>
<table border="1" align="center" width="100%"> <tr>
    <td colspan="2" align="center"><strong>HOTELES.COM.VE</strong></td> </tr>
    <tr>
	<td align="center"> <a href="form_controller"><strong>Clientes</strong></a> </td>
    <td align="center"> <a href="management"><strong>Gestion</strong></a> </td> 
</tr> </table>
<table border="1" align="center" width="100%"> <tr>
    <td colspan="3" align="center"><strong>GESTION</strong></td> </tr>
    <tr>
	<td align="center"> <a href="management_hotels"><strong>Hoteles</strong></a> </td>
    <td align="center"> <a href="management_rooms"><strong>Habitaciones</strong></a> </td>
    <td align="center"> <a href="management_plans"><strong>Planes</strong></a> </td> 
</tr> </table>
	
<?php if ($query) {?>
	<table align="center" width="40%">
		<tr>
			<td> <strong>Seleccione un Hotel</strong> </td> 
		<td align="center">
		
		<?php echo form_open('management_hotels'); ?>
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
<?php $hotel_id_aux = 111;?>
	<?php echo form_open('modify_hotel'); ?>
        <br  />
        <table align="center" width="40%">
			<?php foreach ($hotel_selected as $hotel_selected) { ?>
                <tr> <td colspan="2" align="center"><strong>Datos del Hotel</strong></td> </tr>
                <tr>
                <td>Nombre</td> <td><input type="text" name="name" id="name" readonly="readonly" value="<?php echo ($hotel_selected['name']);?>" /></td>
                </tr> 
                <tr>
                <td>Ubicacion</td> <td><input type="text" name="location" id="location" readonly="readonly" value="<?php echo ($hotel_selected['location']);?>" /></td>
                </tr> 
                
                <tr>
                <td>Habitaciones</td>
                <td>
                <table>
					<?php $filaGris = true;?>   
                    <tr> <td align="center"><strong>Nombre</strong></td> <td align="center"><strong>Descripcion</strong></td> 
                    <td align="center"><strong>Comisionabale</strong></td></tr>
                    <?php foreach ($rooms as $room) { ?>
						<?php if ($filaGris){?>
                        		<tr bgcolor="#CCCCCC">
                                <?php $filaGris = false;
                        	  }
                              else{  ?>
                              	<tr>
                        		<?php $filaGris = true;
                        	  }?>
                        <td align="center"> <?php echo ($room['name']);?> </td>
                        <td align="center"> <?php echo ($room['description']);?> </td>
                        <?php if ($room['commissionable'] == 1) {?>
                        		<td align="center">TRUE</td>
                        <?php }
                        else {?>
                        		<td align="center">FALSE</td>
                        <?php }?>
                        </tr>
                    <?php }?>
                  </td>
                  </table>
                 </tr>
                 
                <tr>
                <td>Planes</td>
                <td>
                <table>
					<?php $filaGris = true;?>   
                    <tr> <td align="center"><strong>Nombre</strong></td> <td align="center"><strong>Descripcion</strong></td> </tr>
                    <?php foreach ($plans as $plan) { ?>
						<?php if ($filaGris){?>
                        		<tr bgcolor="#CCCCCC">
                                <?php $filaGris = false;
                        	  }
                              else{  ?>
                              	<tr>
                        		<?php $filaGris = true;
                        	  }?>
                        <td align="center"> <?php echo ($plan['name']);?> </td>
                        <td align="center"> <?php echo ($plan['description']);?> </td>
                        </tr>
                    <?php }?>
                </td>
                </table>
                </tr>
                
                <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo ($hotel_selected['hotel_id']);?>"  />
                <?php $hotel_id_aux = $hotel_selected['hotel_id'];?>
            <?php }?>
            <tr> <td><input type="submit" value="Modificar Informacion"  /></td>
	</form>
            <?php echo form_open('associate_room'); ?>
            <input type="hidden" name="hotel_id_aux" id="hotel_id_aux" value="<?php echo ($hotel_id_aux);?>"  />
            <td align="center"><input type="submit" value="Asociar nuevo tipo de Habitacion al Hotel" /></td> </tr>
            </form>
            <?php echo form_open('associate_plan'); ?>
            <input type="hidden" name="hotel_id_aux" id="hotel_id_aux" value="<?php echo ($hotel_id_aux);?>"  />
            <tr> <td></td><td align="center"><input type="submit" value="Asociar nuevo Plan al Hotel" /></td> </tr>
            </form>
       </table>
<?php }?>
</body>
</html>