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
</tr> 
</table>

<br  />
<table align="center" width="40%">
<?php echo form_open('modify_hotel'); ?>
	<?php $hotel_id_aux = 111;?> <!--$hotel_id_aux is an auxiliary variable to keep the hotel id after the foreach cycle is done-->
    <?php foreach ($query as $hotel_selected) { ?>
        <tr> <td colspan="2" align="center"><strong>Datos del Hotel</strong></td> </tr>
        <tr>
        <td>Nombre</td> <td><input type="text" name="name" id="name" value="<?php echo ($hotel_selected['name']);?>" /></td>
        </tr> 
        <tr>
        <td>Ubicacion</td> <td><input type="text" name="location" id="location" value="<?php echo ($hotel_selected['location']);?>" /></td>
        </tr> 
        <tr>
        <td>Habitaciones (escoge la que desees <strong>desasociar</strong> del hotel)</td>
        <td>
        <select name="rooms" id="rooms">
        <option value="-">----------------------------</option>
        <?php foreach ($rooms as $room) { ?>
            <option value="<?php echo ($room['room_id']);?>"><?php echo ($room['name']);?></option>
        <?php }?>
        </select>
        </td>
        </tr>
    
        <tr>
        <td>Planes (escoge el desees <strong>desasociar</strong> del hotel)</td>
        <td>
        <select name="plans" id="plans">
        <option value="-">----------------------------</option>
        <?php foreach ($plans as $plan) { ?>
            <option value="<?php echo ($plan['plan_id']);?>"><?php echo ($plan['name']);?></option>
        <?php }?>
        </select>
        </td>
        </tr>
        
        <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo ($hotel_selected['hotel_id']);?>"  />
        <?php $hotel_id_aux = $hotel_selected['hotel_id'];?>
    <?php }?> <!-- end of foreach $query -->
    <tr> 
    <td><input type="submit" value="Aceptar"  /></td>
</form>
    <?php echo form_open('associate_room'); ?>
        <input type="hidden" name="hotel_id_aux" id="hotel_id_aux" value="<?php echo ($hotel_id_aux);?>"  />
        <td><input type="submit" value="Asociar nuevo tipo de Habitacion al Hotel" /></td> 
    </tr>
	</form>
</table>
</body>
</html>