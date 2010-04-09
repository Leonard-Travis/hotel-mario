<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mensaje</title>
</head>

<body>
<table>
<?php if ($message_index == 'success'){ ?>
<tr> <td> <strong> Agregado exitosamente! <strong> </td> </tr>
<?php } 

	  else if ($message_index == 'unknown') {?>
	<?php echo validation_errors(); ?>
    <form method="post" action="<?php echo base_url(); ?>new_client_ci">
    <tr> <td> <strong>El cliente no existe en la base de datos! <strong> </td> </tr>
     <input type="hidden" name="ci_customer" id="ci_customer" value="<?php echo ($new_ci) ?>"  />
     <tr> <td> <input type="submit" value="Agregar Cliente" /> </td> </tr>
     </form>
<?php }

	  else if ($message_index == 'update') {?>
<tr> <td> <strong>Los Datos han sido actuaizados exitosamente! <strong> </td> </tr>
<?php } 

	  else if ($message_index == 'exist') {?>
<tr> <td> <strong>Ya existe un cliente con ese numero de cedula en la base de datos! <strong> </td> </tr>
<?php }

	  else if ($message_index == 'deleted') {?>
<tr> <td> <strong>El cliente fue borrado exitosamente <strong> </td> </tr>
<?php }

	  else if ($message_index == 'no_rooms_left') {?>
<tr> <td> <strong>El Hotel tiene todos los tipos de Habitaciones existentes asociados a el<strong> </td> </tr>
<?php }

	  else if ($message_index == 'no_plans_left') {?>
<tr> <td> <strong>El Hotel tiene todos los Planes existentes asociados a el<strong> </td> </tr>
<?php }

	  else if ($message_index == 'cant_delet_room') {?>
<tr> <td> <strong>No se puede eliminar la habitacion porque pertenece a la(s) cotizaciones siguiente(s): <strong> </td> 
	 <td> <?php foreach ($quote_id as $value){
     				echo ($value['QUOTATIONS_HOTELS_id']."<br>");
        	}?>
      </td></tr>
      <tr> <td> <a href="<?php echo base_url(); ?>rooms">Volver a Gestion de Habitaciones</a> </td> </tr>
<?php }

	  else if ($message_index == 'cant_delet_plan') {?>
<tr> <td> <strong>No se puede eliminar el plan porque pertenece a la(s) cotizaciones siguiente(s): <strong> </td> 
	 <td> <?php foreach ($quote_id as $value){
     				echo ($value['quote_hotel_id']."<br>");
        	}?>
      </td></tr>
      <tr> <td> <a href="<?php echo base_url(); ?>plans">Volver a Gestion de Planes</a> </td> </tr>
<?php }
     
 	  else if ($message_index == 'cant_desassociate_room') { ?>
<tr> <td> <strong>No se puede desasociar la habitacion del hotel porque pertenece a la(s) cotizaciones siguientes(s): </strong> </td>
	 <td> <?php foreach ($quote_id as $value){
		 			echo ($value['QUOTATIONS_HOTELS_id']."<br>");
	 		} ?>
     </td>
     </tr>
     <tr> <td> <a href="<?php echo base_url(); ?>hotels">Volver a Gestion de Hoteles</a> </td> </tr>
<?php }

	else if ($message_index == 'cant_desassociate_plan') { ?>
<tr> <td> <strong>No se puede desasociar el plan del hotel porque pertenece a la(s) cotizaciones siguientes(s): </strong> </td>
	 <td> <?php foreach ($quote_id as $value){
		 			echo ($value['quote_hotel_id']."<br>");
	 		} ?>
     </td>
     </tr>
     <tr> <td> <a href="<?php echo base_url(); ?>hotels">Volver a Gestion de Hoteles</a> </td> </tr>
<?php }?>
<tr> <td> <a href="<?php echo base_url(); ?>home">Volver a Pagina Principal</a> </td> </tr>
</table>
</body>
</html>