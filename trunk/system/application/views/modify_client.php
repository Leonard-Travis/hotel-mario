<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cliente</title>
</head>
<body>
    <div id="nuevo">
    <a href="form_controller">Buscar Cliente</a>
    </div>
	
    
    
    <?php if ($query != NULL){ ?>
	
	<?php echo validation_errors(); ?>
	<?php echo form_open('modify_client'); ?>
    
	<?php foreach ($query as $client) { ?>

     <div id="datos">
    <table>
    <tr>
    <td>Cedula:</td> <td><input type="text" name="nombre" value="<?php echo($client['customer_ci_id']); ?>"/></td>
    </tr>
    <tr> 
    <td>Nombre: </td> <td><input type="text" name="nombre" value="<?php echo ($client['name']); ?>" /></td> 
	</tr>
    <tr>
    <td>Apellido:</td> <td><input type="text" name="apellido" value="<?php echo ($client['lastname']); ?>" /></td> 
    </tr>
    <tr>
    <td>Teléfono:</td> <td><input type="text" name="tlf" value="<?php echo ($client['phone']); ?>" /> </td>
    </tr>
    <tr>
    <td>e-mail:</td> <td><input type="text" name="email" value="<?php echo ($client['email']); ?>" /> </td>
    </tr>
    <tr>
    <td>Direccion:</td> <td><input type="text" name="direccion" value="<?php echo ($client['address']); ?>" /></td>
    </tr>
    <tr>
    <td>Fecha de Nacimiento:</td> <td><input type="text" name="fecha" value="<?php echo ($client['birth_date']); ?>" /></td>
    </tr>
    <tr>
    <td>Sexo:  </td> <td>
    <?php if ($client['sex'] == 'm') { ?>
        <input name="sexo" type="radio" value="m" checked="checked" />M 
        <input name="sexo" type="radio" value="f" />F 
    <?php } 
          else { ?>
        <input name="sexo" type="radio" value="f" checked="checked" />F 
        <input name="sexo" type="radio" value="m" />M
     <?php } ?></td></tr>
     
     <?php 	}	}?>
     <input name="send" type="submit" value="Aceptar" />
     </div>
    </form>
     
     
</body>
</html>