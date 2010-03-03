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
    <?php echo form_open('new_client_ci'); ?>
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
<?php } ?>

<tr> <td> <a href="home">Volver a Pagina Principal</a> </td> </tr>
</table>
</body>
</html>