<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Cliente</title>
</head>
<body>
<table border="1" align="center" width="100%"> <tr>
    <td colspan="3" align="center"><strong>HOTELES.COM.VE</strong></td> </tr>
    <tr>
	<td width="33%" align="center"> <a href="<?php echo base_url(); ?>customer/search_form"><strong>Clientes</strong></a> </td>
    <td width="33%" align="center"> <a href="<?php echo base_url(); ?>home/management"><strong>Gestion</strong></a> </td>
    <td width="33%" align="center"> <a href="<?php echo base_url(); ?>price_matrix/index/0"><strong>Matriz de Precios</strong></a> </td> 
</tr> </table>

<?php echo validation_errors(); ?>
<form method="post" action="<?php echo base_url(); ?>customer/search_form">
    <div id="buscador">
    <table>
        <tr>
            <td><strong>Buscador de Cliente</strong></td> 
            <td> <input type="text" name="ci_client" id="ci_client" value="" size="50" /></td>
            <td> <input name="enviar" type="submit" value="Selecccionar" /> </td>   
    </div>
</form>
    
    <div id="nuevo">
    <td> <a href="new_client">Agregar Nuevo Cliente</a> </td>
    </div>
    </tr>
    
    <!-- $ci_aux is an auxiliary variable to keep the costumer ci after the foreach cycle is done -->
    <?php $ci_aux=11111; 
    if ($query != NULL){ ?>
    
<div id="datos">    
    <?php foreach ($query as $client) { ?>       
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
        
        <?php $ci_aux = $client['customer_ci_id'];?>
    <?php 	}?> <!--End for each-->
    
    
    <form method="post" action="<?php echo base_url(); ?>customer/modify_client">
        <input type="hidden" name="ci_customer" id="ci_customer" value="<?php echo ($ci_aux) ?>"  />
        <tr> <td> <input name="modify_button" id="modify_button" type="submit" value="Modificar Informacion" /> </td>
    </form>
    
    <form method="post" action="<?php echo base_url(); ?>customer/delete_client">
        <input type="hidden" name="ci_customer" id="ci_customer" value="<?php echo ($ci_aux) ?>"  />
        <td> <input name="modify_button" id="modify_button" type="submit" value="Eliminar Cliente" /> </td> </tr>
    </table>
    </form>

<?php 	}?> <!--End $query-->
</div> <!--End div id="datos"-->
<div id="test" ></div>
     
     
</body>
</html>