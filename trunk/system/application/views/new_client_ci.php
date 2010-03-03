<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cliente</title>
</head>

<body>
<table border="1" align="center" width="100%"> <tr>
    <td colspan="2" align="center"><strong>HOTELES.COM.VE</strong></td> </tr>
    <tr>
	<td align="center"> <a href="form_controller"><strong>Clientes</strong></a> </td>
    <td align="center"> <a href="management"><strong>Gestion</strong></a> </td> 
</tr> </table>

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
	
    <?php echo validation_errors(); ?>
	<?php echo form_open('new_client_ci'); ?>
     <div id="datos">
    <table>
    <tr> <td colspan="2" align="center"><strong>Cliente Nuevo</strong></td></tr>
    <tr>
     <td>Cedula:</td> <td><input type="text" name="ci_client" readonly="readonly" value="<?php echo($ci_customer); ?>"/></td>
    </tr>
    <tr> 
    <td>Nombre: </td> <td><input type="text" name="nombre" /></td> 
	</tr>
    <tr>
    <td>Apellido:</td> <td><input type="text" name="apellido" /></td> 
    </tr>
    <tr>
    <td>Teléfono:</td> <td><input type="text" name="tlf" /> </td>
    </tr>
    <tr>
    <td>e-mail:</td> <td><input type="text" name="email" /> </td>
    </tr>
    <tr>
    <td>Direccion:</td> <td><input type="text" name="direccion" /></td>
    </tr>
    <tr>
    <td>Fecha de Nacimiento:</td> <td><input type="text" name="fecha" /></td>
    </tr>
    <tr>
    <td>Sexo:  </td> <td>
        <input name="sexo" type="radio" value="m" />M 
        <input name="sexo" type="radio" value="f" />F
    </td>
    </tr>
    <td> <input name="enviar" type="submit" value="Agregar Cliente Nuevo" /> </td>
    </table>
     </div>
     </form>
</body>
</html>