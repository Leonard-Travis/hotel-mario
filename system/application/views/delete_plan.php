<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gestion</title>
</head>

<body>
<table border="1" align="center" width="100%"> 
<tr>
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
    <a href="modify_plan">Modificar</a>
    <a href="delete_plan">Eliminar</a>
    <a href="new_plan">Agregar</a> 
    
    <table align="center" width="40%">
    <tr>
    <td> <strong>Elige el Plan a Eliminar </strong> </td> 
    <td align="center">
    
    <?php echo form_open('delete_plan'); ?>
	 <select name="plans" id="plans">
	 <?php foreach ($query as $plan) { ?>
       
       <option value="<?php echo ($plan['plan_id']);?>"><?php echo ($plan['name']);?></option> 
      
     <?php }?>
	 </select>
     </td> <td> <input name="send" type="submit" value="Aceptar" /> </td> </tr>
     </form>
     </table>
     
</body>
</html>