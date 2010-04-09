<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gestion</title>
</head>

<body>
<table border="1" align="center" width="100%"> <tr>
    <td colspan="3" align="center"><strong>HOTELES.COM.VE</strong></td> </tr>
    <tr>
	<td width="33%" align="center"> <a href="<?php echo base_url(); ?>customer/search_form"><strong>Clientes</strong></a> </td>
    <td width="33%" align="center"> <a href="<?php echo base_url(); ?>home/management"><strong>Gestion</strong></a> </td>
    <td width="33%" align="center"> <a href="<?php echo base_url(); ?>price_matrix/index/0"><strong>Matriz de Precios</strong></a> </td> 
</tr> </table>
<table border="1" align="center" width="100%"> <tr>
    <td colspan="4" align="center"><strong>GESTION</strong></td> </tr>
    <tr>
	<td width="25%" align="center"> <a href="<?php echo base_url(); ?>hotels"><strong>Hoteles</strong></a> </td>
    <td width="25%" align="center"> <a href="<?php echo base_url(); ?>rooms"><strong>Habitaciones</strong></a> </td>
    <td width="25%" align="center"> <a href="<?php echo base_url(); ?>plans"><strong>Planes</strong></a> </td> 
    <td width="25%" align="center"> <a href="<?php echo base_url(); ?>price_matrix/index/1"><strong>Matriz de Precios</strong></a> </td> 
</tr> </table>

<br  />
<table align="center" width="40%">
<form method="post" action="<?php echo base_url(); ?>hotels/modify_hotel/0">
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
        <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo ($hotel_selected['hotel_id']);?>"  />
        <?php $hotel_id_aux = $hotel_selected['hotel_id'];?>
    <?php }?> <!-- end of foreach $query -->
    <tr> 
    <td><input type="submit" value="Aceptar"  /></td>
</form>
    <form method="post" action="<?php echo base_url(); ?>hotels/associate_room">
        <input type="hidden" name="hotel_id_aux" id="hotel_id_aux" value="<?php echo ($hotel_id_aux);?>"  />
        <td><input type="submit" value="Asociar nuevo tipo de Habitacion al Hotel" /></td> 
    </tr>
	</form>
    <tr>
    <form method="post" action="<?php echo base_url(); ?>hotels/associate_plan">
        <input type="hidden" name="hotel_id_aux" id="hotel_id_aux" value="<?php echo ($hotel_id_aux);?>"  />
        <td></td> <td><input type="submit" value="Asociar nuevo Plan al Hotel" /></td> </tr>
    </form> <!-- end of form associate_plan -->
</table>
</body>
</html>