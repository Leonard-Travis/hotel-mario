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

<?php if ($query != NULL){ ?>
	<?php echo validation_errors(); ?>
    <?php echo form_open('modify_client'); ?>
    <div id="datos">
    <table>       
		<?php foreach ($query as $client) { ?> 
            <tr>
            <td colspan="2" align="center"><strong>Modificar Datos de Cliente</strong></td>
            </tr>
            <tr>
            <td>Cedula:</td> <td><input type="text" name="ci_client" readonly="readonly" value="<?php echo($client['customer_ci_id']); ?>"/></td>
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
            <?php } ?>
            </td>
            </tr>
        <?php 	}  ?> <!--end of foreach -->
    </table>
    </div>
    <input name="send" type="submit" value="Aceptar" />
    </form>
<?php 	}  ?> <!--end of if($query) -->
  
</body>
</html>