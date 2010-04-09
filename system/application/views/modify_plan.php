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
<input name="enviar" type="submit" value="Nueva Plan" />
</form>
</td>
<tr>
</table>      
     <?php if ($plan_to_change) {?>
     <form method="post" action="<?php echo base_url(); ?>plans/save_modified_plan">
     
     <table align="center" width="20%">
     <?php foreach ($plan_to_change as $plan_to_change) { ?>
     	<tr> <td colspan="2" align="center"><strong>Datos del Plan</strong></td> </tr>
        <tr>
        <td>Nombre</td> <td><input type="text" name="name" id="name" value="<?php echo ($plan_to_change['name']);?>" /></td>
        </tr>          
      <input type="hidden" name="plan_id" id="plan_id" value="<?php echo ($plan_to_change['plan_id']);?>"  />
     <?php }?>
     <tr> <td><input type="submit" value="Procesar"  /></td> </tr>
     </table>
     </form>
     <?php }?>
</body>
</html>