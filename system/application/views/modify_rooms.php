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
    <td colspan="4" align="center"><strong>GESTION</strong></td> </tr>
    <tr>
	<td width="25%" align="center"> <a href="management_hotels"><strong>Hoteles</strong></a> </td>
    <td width="25%" align="center"> <a href="management_rooms"><strong>Habitaciones</strong></a> </td>
    <td width="25%" align="center"> <a href="management_plans"><strong>Planes</strong></a> </td> 
    <td width="25%" align="center"> <a href="management_price_matrix"><strong>Matriz de Precios</strong></a> </td> 
</tr> </table>

<a href="modify_room">Modificar</a>
<a href="delete_room">Eliminar</a>
<a href="new_room">Agregar</a>
    
<?php if ($query) {?>
    <table align="center" width="40%">
        <tr>
        <td> <strong>Elige el tipo de cuarto a Modificar </strong> </td> 
        <td align="center">
        <?php echo form_open('modify_room'); ?>
            <select name="rooms" id="rooms">
            <?php foreach ($query as $room) { ?>
            
                <option value="<?php echo ($room['room_id']);?>"><?php echo ($room['name']);?></option> 
            
            <?php }?>
            </select>
            </td> <td> <input name="send" type="submit" value="Aceptar" /> 
        </form>
        </td>
        </tr>
    </table>
<?php }?>
    
<?php if ($room_to_change) {?>
    <?php echo form_open('save_modified_room'); ?>
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
            <td>Descripcion</td> <td><input type="text" name="description" id="description" value="<?php echo ($room_to_change['description']);?>" /></td>
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