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

<a href="modify_plan">Modificar</a>
<a href="delete_plan">Eliminar</a>
<a href="new_plan">Agregar</a> 

<table width="40%" align="center">
    <tr>
    <td align="center"><strong>Nombre</strong></td> 
    <td align="center"><strong>Descripcion</strong></td> 
    </tr>
    <?php $gray_row = TRUE;?>
    <?php foreach ($query as $room) { ?>
		<?php if ($gray_row){?>
        		 <tr bgcolor="#CCCCCC">
        		 <?php $gray_row = false;
        	  }
              else{  ?>
        		 <tr>
        		 <?php $gray_row = true;
        	  }?>
        
        <td align="center"><?php echo ($room['name']);?></td>
        <td align="center"><?php echo ($room['description']);?></td>
        </tr>
    <?php }?>
</table>

</body>
</html>