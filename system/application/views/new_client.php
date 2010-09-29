<div class="separador"></div>
<div class="separadorv_gris"></div>
<?php echo validation_errors(); ?>
<form name="form1">

<div id="asociar2">
<div class="alertar">
    <img src="http://localhost/hotel-mario/designed_views/imagenes/alerta.gif" alt="Alerta" class="valign" /><strong>Todos los campos son OBLIGATORIOS</strong>
</div>
<!-- fin alerta de arriba -->
<div class="separadorv"></div><div class="separadorv"></div>
<div id="asociar_c">
<ul class="ul_tit_2"> 
    <li class="li_tit_2"></li><li></li>
    <li class="li_tit_2">Cedula:</li>
    <?php if($ci_client == '0') {?>
    		<li><div class="cajat"><input type="text" name="client_id" id="client_id" maxlength="9" /></div></li>
    <?php }
		  else{?>
            <li><div class="cajat"><input type="text" name="client_id" id="client_id" readonly="readonly" value="<?php echo($ci_client); ?>"/></div></li>
    <?php }?>
    <li class="li_tit_2">Nombre:</li> 
    <li><div class="cajat"><input type="text" name="name" id="name" maxlength="15"/></div></li>
    <li class="li_tit_2">Apellido:</li>
    <li><div class="cajat"><input type="text" name="lastname" id="lastname" maxlength="15"/></div></li>
    <li class="li_tit_2">Telefono:</li>
    <li><div class="cajat"><input type="text" name="phone" id="phone" maxlength="20"/> </div></li>
    <li class="li_tit_2">e-mail:</li>
    <li><div class="cajat"><input type="text" name="email" id="email" maxlength="40"/> </div></li> 
    <li class="li_tit_2">Direccion:</li>
    <li><textarea name="address" id="address" cols="18" rows=""  maxlength="50"></textarea></li>
    <li class="li_tit_2">Fecha de Nacimiento:</li>
    <li><div class="cajat"><input type="text" name="birthdate" id="birthdate" onclick="popUpCalendar(this, form1.fecha, 'yyyy-mm-dd')" /></div></li>
    <li class="li_tit_2">Sexo:</li>
    <li>
    <input name="sex" id="sex" type="radio" value="m" checked="checked" />M 
    <input name="sex" id="sex" type="radio" value="f" />F
    </li> 
    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <li class="li_tit_2"></li>
    <img align="right" src="http://localhost/hotel-mario/designed_views/imagenes/bagregar.jpg" onclick="new_client_data();" /> 
</ul>
</div>
</div>
</form>

</body>
</html>