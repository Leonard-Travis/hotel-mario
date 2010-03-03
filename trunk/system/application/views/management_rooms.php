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
	
    
    <a href="modify_room">Modificar</a>
    <a href="delete_room">Eliminar</a>
    <a href="new_room">Agregar</a> 
    
    <table width="40%" align="center">
        <tr>
        	<td align="center"><strong>Nombre</strong></td> 
            <td align="center"><strong>Descripcion</strong></td> 
            <td align="center"><strong>Capacidad</strong></td> 
            <td align="center"><strong>Especial</strong></td>
        </tr>
        <?php $filaGris = TRUE;?>
		<?php foreach ($query as $room) { ?>
			<?php if ($filaGris){?>
                    <tr bgcolor="#CCCCCC">
                    <?php $filaGris = false;
                  }
                  else{  ?>
                    <tr>
                    <?php $filaGris = true;
                  }?>
                  
                  <td align="center"><?php echo ($room['name']);?></td>
                  <td align="center"><?php echo ($room['description']);?></td>
                  <td align="center"><?php echo ($room['capacity']);?></td>
                  <?php if ($room['special'] == 1) {?>
                        		<td align="center">TRUE</td>
                        <?php }
                        else {?>
                        		<td align="center">FALSE</td>
                        <?php }?>
                   </tr>
		<?php }?>
	 </table>
</body>
</html>