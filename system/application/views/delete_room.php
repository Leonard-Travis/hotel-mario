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
	<td width="33%" align="center"> <a href="form_controller"><strong>Clientes</strong></a> </td>
    <td width="33%" align="center"> <a href="management"><strong>Gestion</strong></a> </td>
    <td width="33%" align="center"> <a href="price_matrix"><strong>Matriz de Precios</strong></a> </td> 
</tr> </table>
<table border="1" align="center" width="100%"> <tr>
    <td colspan="3" align="center"><strong>GESTION</strong></td> </tr>
    <tr>
	<td align="center"> <a href="management_hotels"><strong>Hoteles</strong></a> </td>
    <td align="center"> <a href="management_rooms"><strong>Habitaciones</strong></a> </td>
    <td align="center"> <a href="management_plans"><strong>Planes</strong></a> </td> 
</tr> </table>
    <a href="modify_room">Modificar</a>
    <a href="delete_room">Eliminar</a>
    <a href="new_room">Agregar</a>
    
<table align="center" width="40%">
    <tr>
    <td> <strong>Elige el tipo de cuarto a Eliminar </strong> </td> 
    <td align="center">
    <?php echo form_open('delete_room'); ?>
        <select name="rooms" id="rooms">
        <?php foreach ($query as $room) { ?>
        
        <option value="<?php echo ($room['room_id']);?>"><?php echo ($room['name']);?></option> 
        
        <?php }?>
        </select>
        </td> <td> <input name="send" type="submit" value="Aceptar" /> </td> </tr>
    </form>
</table>
     
</body>
</html>