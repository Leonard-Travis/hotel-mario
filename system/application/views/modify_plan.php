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
    <td> <strong>Elige el Plan a Modificar</strong> </td> 
    <td align="center">
    <?php echo form_open('modify_plan'); ?>
	 <select name="plans" id="plans">
	 <?php foreach ($query as $plan) { ?>
       
       <option value="<?php echo ($plan['plan_id']);?>"><?php echo ($plan['name']);?></option> 
      
     <?php }?>
	 </select>
     </td> <td> <input name="send" type="submit" value="Aceptar" /> </td> </tr>
     </form>
     </table>
     <?php }?>
     
     <?php if ($plan_to_change) {?>
     <?php echo form_open('save_modified_plan'); ?>
     
     <table align="center" width="20%">
     <?php foreach ($plan_to_change as $plan_to_change) { ?>
     	<tr> <td colspan="2" align="center"><strong>Datos del Plan</strong></td> </tr>
        <tr>
        <td>Nombre</td> <td><input type="text" name="name" id="name" value="<?php echo ($plan_to_change['name']);?>" /></td>
        </tr> 
        <tr>
        <td>Descripcion</td> <td><input type="text" name="description" id="description" value="<?php echo($plan_to_change['description']);?>" /></td>
        </tr>          
          <input type="hidden" name="plan_id" id="plan_id" value="<?php echo ($plan_to_change['plan_id']);?>"  />
         <?php }?>
         <tr> <td><input type="submit" value="Procesar"  /></td> </tr>
         </table>
         </form>
         <?php }?>
</body>
</html>