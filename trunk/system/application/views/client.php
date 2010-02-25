<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cliente</title>
</head>
<body>
	<?php echo validation_errors(); ?>
	<?php echo form_open('form_controller'); ?>
    <div id="buscador">
    <table>
    <tr>
    <td><strong>Buscador de Cliente</strong></td> 
    <td> <input type="text" name="ci_client" id="ci_client" value="" size="50" /></td>
    <td> <input name="enviar" type="submit" value="Selecccionar" /> </td>   
    </tr>
    </table>
    </div>
	</form>
    
    <div id="nuevo">
    <a href="new_client">Agregar Nuevo Cliente</a>
    </div>
    
    <?php $ci_aux=0;
		if ($query != NULL){ ?>

	 <?php foreach ($query as $client) { ?>
     <div id="datos">
    <table>
    <tr>
    <td>Cedula:</td> <td><input type="text" name="nombre" readonly="readonly" value="<?php echo($client['customer_ci_id']); ?>"/></td>
    </tr>
    <tr> 
    <td>Nombre: </td> <td><input type="text" name="nombre" readonly="readonly" value="<?php echo ($client['name']); ?>" /></td> 
	</tr>
    <tr>
    <td>Apellido:</td> <td><input type="text" name="apellido" readonly="readonly" value="<?php echo ($client['lastname']); ?>" /></td> 
    </tr>
    <tr>
    <td>Teléfono:</td> <td><input type="text" name="tlf" readonly="readonly" value="<?php echo ($client['phone']); ?>" /> </td>
    </tr>
    <tr>
    <td>e-mail:</td> <td><input type="text" name="email" readonly="readonly" value="<?php echo ($client['email']); ?>" /> </td>
    </tr>
    <tr>
    <td>Direccion:</td> <td><input type="text" name="direccion" readonly="readonly" value="<?php echo ($client['address']); ?>" /></td>
    </tr>
    <tr>
    <td>Fecha de Nacimiento:</td> <td><input type="text" name="fecha" readonly="readonly" value="<?php echo ($client['birth_date']); ?>" /></td>
    </tr>
    <tr>
    <td>Sexo:  </td> <td>
    <?php if ($client['sex'] == 'm') { ?>
        <input name="sexo" type="radio" value="m" checked="checked" disabled="disabled" />M 
        <input name="sexo" type="radio" value="f" disabled="disabled" />F 
    <?php } 
          else { ?>
        <input name="sexo" type="radio" value="f" checked="checked" disabled="disabled" />F 
        <input name="sexo" type="radio" value="m" disabled="disabled"  />M
     <?php } ?></td></tr>
     </table>
	 <?php $ci_aux = $client['customer_ci_id']; ?> 
     <?php 	}?> <!--End for each-->
     
     <?php echo validation_errors(); ?>
     <?php echo form_open('modify_client'); ?>
     <input type="hidden" name="ci_customer" id="ci_customer" value="<?php $ci_aux ?>"  />
     <input name="send" type="submit" value="Modificar Informacion" />
    </form>
     <?php 	}?> <!--End $query-->
     </div> <!--End div id="datos"-->

     
     
</body>
</html>