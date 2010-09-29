<!-- $ci_aux is an auxiliary variable to keep the costumer ci after the foreach cycle is done -->
<div id="client_data">
<?php $ci_aux=11111; ?>
<div class="separador"></div>
<div class="separadorv_gris"></div>
  
<?php foreach ($query as $client) { ?>  

<div id="asociar_c">
<ul class="ul_tit_2">    
    <li class="li_tit_2">Cedula:</li>
    <li><div class="cajat"><input type="text" name="ci_client2" id="ci_client2" readonly="readonly" value="<?php echo($client['customer_ci_id']); ?>"/></div></li>
    <li class="li_tit_2">Nombre:</li> 
    <li><div class="cajat"><input type="text" name="nombre" readonly="readonly" value="<?php echo ($client['name']); ?>" /></div></li>
    <li class="li_tit_2">Apellido:</li>
    <li><div class="cajat"><input type="text" name="apellido" readonly="readonly" value="<?php echo ($client['lastname']); ?>" /></div></li>
    <li class="li_tit_2">Telefono:</li>
    <li><div class="cajat"><input type="text" name="tlf" readonly="readonly" value="<?php echo ($client['phone']); ?>" /> </div></li>
    <li class="li_tit_2">e-mail:</li>
    <li><div class="cajat"><input type="text" name="email" readonly="readonly" value="<?php echo ($client['email']); ?>" /> </div></li>
    <li class="li_tit_2">Direccion:</li>
    <li><div class="cajat"><input type="text" name="direccion" readonly="readonly" value="<?php echo ($client['address']); ?>" /></div></li>
    <li class="li_tit_2">Fecha de Nacimiento:</li>
    <li><div class="cajat"><input type="text" name="fecha" readonly="readonly" value="<?php echo ($client['birth_date']); ?>" /></div></li>
    
    <li class="li_tit_2">Sexo:</li>
    <li>
    <?php if ($client['sex'] == 'm') { ?>
        <input name="sexo" type="radio" value="m" checked="checked" disabled="disabled" />M 
        <input name="sexo" type="radio" value="f" disabled="disabled" />F 
    <?php } 
    else { ?>
        <input name="sexo" type="radio" value="f" checked="checked" disabled="disabled" />F 
        <input name="sexo" type="radio" value="m" disabled="disabled"  />M
    <?php } ?></li>
    
    <?php $ci_aux = $client['customer_ci_id'];?>
<?php 	}?> <!--End for each-->
</ul>
</div>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<table>
<tr>
<td>
    <input name="modify_button" id="modify_button" type="button" onClick="modify_client_button(<?php echo ($ci_aux) ?>);" value="Modificar Informacion" />
</td>
<td>
    <input name="modify_button" id="modify_button" type="button" onClick="delete_client(<?php echo ($ci_aux) ?>);" value="Eliminar Cliente" /> 
</td>
</tr>

<tr>    
<td> <img src="http://localhost/hotel-mario/designed_views/imagenes/add.png" alt="Agregar" class="valign" /><a href="#" onclick="client_quote(<?php echo ($ci_aux) ?>);"><strong>Agregar Cotizacion</strong></a> 
</td>

<td><img src="http://localhost/hotel-mario/designed_views/imagenes/add.png" alt="" class="valign" onclick="existing_quotation(<?php echo ($ci_aux) ?>);" /><a href="#" onclick="existing_quotation(<?php echo ($ci_aux) ?>);"><strong>Cotizacion Existente</strong></a></td>
</tr>
</table>

</div>