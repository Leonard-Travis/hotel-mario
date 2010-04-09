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

<table>
<tr>
<td> 
<form method="post" action="<?php echo base_url(); ?>rooms/new_room">  
<input name="enviar" type="submit" value="Nueva Habitacion" />
</form>
</td>
<tr>
</table>

<?php if ($room_to_change) {?>
    <form method="post" action="<?php echo base_url(); ?>rooms/save_modified_room">
        <table align="center" width="20%">
        <?php foreach ($room_to_change as $room_to_change) { ?>
            <tr> <td colspan="2" align="center"><strong>Datos del tipo de Habitacion</strong></td> </tr>
            <tr>
            <td>Nombre</td> <td><input type="text" name="name" id="name" value="<?php echo ($room_to_change['name']);?>" /></td>
            </tr> 
            <tr>
            <td>Capacidad</td> <td><input type="text" name="capacity" id="capacity" value="<?php echo ($room_to_change['capacity']);?>" /></td>
            </tr>
            <tr>
            <td>Especial</td>
            <td>
            <?php if ($room_to_change['special'] == 0) { ?>
                    <input name="special" type="radio" value="0" checked="checked" />FALSE 
                    <input name="special" type="radio" value="1" />TRUE
            <?php } 
            	  else { ?>
                    <input name="special" type="radio" value="1" />FALSE
                    <input name="special" type="radio" value="0" checked="checked" />TRUE
            <?php } ?>
            </td>
            </tr>
            <input type="hidden" name="room_id" id="room_id" value="<?php echo ($room_to_change['room_id']);?>"  />
        <?php }?> <!-- end foreach -->
        <tr> <td><input type="submit" value="Procesar"  /></td> </tr>
        </table>
    </form>
<?php }?>
</body>
</html>