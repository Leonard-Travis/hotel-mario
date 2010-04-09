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
<form method="post" action="<?php echo base_url(); ?>plans/new_plan">  
<input name="enviar" type="submit" value="Nuevo Plan" />
</form>
</td>
<tr>
</table>

<table width="40%" align="center">
    <tr>
    <td align="center"><strong>Nombre</strong></td>
    <td align="center" width="17px"></td>
    <td align="center" width="17px"></td> 
    </tr>
    <?php $gray_row = TRUE;?>
    <?php foreach ($query as $plan) { ?>
		<?php if ($gray_row){?>
        		 <tr bgcolor="#CCCCCC">
        		 <?php $gray_row = false;
        	  }
              else{  ?>
        		 <tr>
        		 <?php $gray_row = true;
        	  }?>
        
        <td align="center"><?php echo ($plan['name']);?></td>
        <td align="center"> <a href="<?php echo base_url(); ?>plans/modify_plan/<?php echo ($plan['plan_id']);?>">mod</a></td>
        <td align="center"> <a href="<?php echo base_url(); ?>plans/delete_plan/<?php echo ($plan['plan_id']);?>">del</a></td>
        </tr>
    <?php }?>
</table>

</body>
</html>