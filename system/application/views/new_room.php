<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
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
    <a href="add_room">Agregar</a>
    
    <?php echo validation_errors(); ?>
	<?php echo form_open('new_room'); ?>
     <div id="datos">
    <table align="center" width="30%">
    <tr> <td colspan="2" align="center"><strong>Habitacion Nueva</strong></td></tr> 
    <td>Nombre: </td> <td><input type="text" name="name" /></td> 
	</tr>
    <tr>
    <td>Capacidad:</td> <td><input type="text" name="capacity" /></td> 
    </tr>
    <tr>
    <td>Descripcion:</td> <td><input type="text" name="description" /> </td>
    </tr>
    <td>Especial:  </td> <td>
        <input name="special" type="radio" value="1" />TRUE 
        <input name="special" type="radio" value="0" />FALSE
    </td>
    </tr>
    <td> <input name="enviar" type="submit" value="Agregar Habitacion" /> </td>
    </table>
     </div>
     </form>
</body>
</html>