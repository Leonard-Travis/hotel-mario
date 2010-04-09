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
    
<table width="40%" align="center">
    <tr>
    <td align="center"><strong>Nombre</strong></td>  
    <td align="center"><strong>Capacidad</strong></td> 
    <td align="center"><strong>Especial</strong></td>
    <td align="center" width="17px"></td>
    <td align="center" width="17px"></td>
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
        <td align="center"><?php echo ($room['capacity']);?></td>
        <?php if ($room['special'] == 1) {?>
        		<td align="center">TRUE</td>
        <?php }
        	  else {?>
        		<td align="center">FALSE</td>
        <?php }?>
        <td align="center"> <a href="<?php echo base_url(); ?>rooms/modify_room/<?php echo ($room['room_id']);?>">mod</a></td>
        <td align="center"> <a href="<?php echo base_url(); ?>rooms/delete_room/<?php echo ($room['room_id']);?>">del</a></td>
        </tr>
    <?php }?>
</table>
</body>
</html>