<div class="separador"></div>
<div class="separadorv_gris"></div>
<?php echo validation_errors(); ?>
<form>
<?php foreach ($query as $client) { ?>  
<div id="asociar2">
    <div class="alertar">
        <img src="http://localhost/hotel-mario/designed_views/imagenes/alerta.gif" alt="Alerta" class="valign" /><strong>Todos los campos son OBLIGATORIOS</strong>
    </div>
    <!-- fin alerta de arriba -->
    <div class="separadorv"></div><div class="separadorv"></div>
    
    <div id="asociar_c">
    <ul class="ul_tit_2">   
        <li class="li_tit_2">Cedula:</li>
        <li><div class="cajat"><input type="text" name="client_id" id="client_id" maxlength="9"  readonly="readonly" value="<?php echo($client['customer_ci_id']); ?>"/></div></li>
        <li class="li_tit_2">Nombre:</li> 
        <li><div class="cajat"><input type="text" name="name" id="name" maxlength="15" value="<?php echo ($client['name']); ?>" /></div></li>
        <li class="li_tit_2">Apellido:</li>
        <li><div class="cajat"><input type="text" name="lastname" id="lastname" maxlength="15" value="<?php echo ($client['lastname']); ?>" /></div></li>
        <li class="li_tit_2">Telefono:</li>
        <li><div class="cajat"><input type="text" name="phone" id="phone" maxlength="20" value="<?php echo ($client['phone']); ?>" /> </div></li>
        <li class="li_tit_2">e-mail:</li>
        <li><div class="cajat"><input type="text" name="email" id="email" maxlength="40" value="<?php echo ($client['email']); ?>" /> </div></li>
        <li class="li_tit_2">Direccion:</li>
        <li><textarea name="address" id="address" cols="18" rows=""  maxlength="50"><?php echo ($client['address']); ?></textarea></li>
        <li class="li_tit_2">Fecha de Nacimiento:</li>
        <li><div class="cajat"><input type="text" name="birthdate" id="birthdate" value="<?php echo ($client['birth_date']); ?>" /></div></li>
        
        <li class="li_tit_2">Sexo:</li>
        <li>
        <?php if ($client['sex'] == 'm') { ?>
            <input name="sex" id="sex" type="radio" value="m" checked="checked" />M 
            <input name="sex" id="sex" type="radio" value="f"  />F 
        <?php } 
        else { ?>
            <input name="sex" id="sex" type="radio" value="f" checked="checked" />F 
            <input name="sex" id="sex" type="radio" value="m"/>M
        <?php } ?></li>
    <?php 	}?> <!--End for each-->
    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;
    <li class="li_tit_2"></li>
    <img src="http://localhost/hotel-mario/designed_views/imagenes/bprocesar.jpg" onclick="modify_client();" /> 
    </ul>
    </div>
</div>
</form>
 