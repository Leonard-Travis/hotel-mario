<?php
$this->load->view('global/header');
?>

<script>

function validarEmail(valor) {
re=/^[^@\s]+@[^@\.\s]+(\.[^@\.\s]+)+$/

    if(!re.exec(valor))    {
        alert("La dirección de email es incorrecta.");
		return false;
    }else{
		return true;
    }
}

function validarNum(valor) {
re=/^([0-9])*$/

    if(!re.exec(valor))    {
        alert("Debe introducir la cedula completamente numerica");
		return false;
    }else{
		return true;
    }
}

function vacio(q) {  
        for ( i = 0; i < q.length; i++ ) {  
                if ( q.charAt(i) != " " ) {  
                        return true  
                }  
        }  
        return false  
}  
   
function valida(F) {	
    	if( (vacio(F.nombre.value) == false) || (vacio(F.ci_client.value) == false) || (vacio(F.apellido.value) == false) || (vacio(F.tlf.value) == false) || (vacio(F.email.value) == false) || (vacio(F.direccion.value) == false) || (vacio(F.fecha.value) == false) ){  
                alert("Ha dejado uno o mas de los campos OBLIGATORIOS vacios.")  
                return false  
        } else {
				if ((validarEmail(F.email.value) == true) && (validarNum(F.ci_client.value) == true))
                	return true
				else return false;
        }  
          
}
</script>

<div id="menu">
	<div class="cuerpo">
		<ul>
        	<li class="mfocus">
				<img src="http://localhost/hotel-mario/designed_views/imagenes/f1.png" alt="" class="floati" />
				<div class="mf_texto">Clientes</div>
				<img src="http://localhost/hotel-mario/designed_views/imagenes/f3.png" alt="" class="floati" />
            </li>

			<li><a href="<?php echo base_url(); ?>home/management">Gestion</a></li>
			<li class="palito"><img src="http://localhost/hotel-mario/designed_views/imagenes/naranja3.gif" alt="" /></li>
			<li><a href="<?php echo base_url(); ?>price_matrix/index/0">Matriz de Precios</a></li>
		</ul>
	</div>
</div>
<div id="menu2">
</div>
<div class="separadorv"></div>
</body>
</html>


<?php echo validation_errors(); ?>
<div class="separadorv"></div><div class="separadorv"></div>
<form name="searchForm" method="post" action="<?php echo base_url(); ?>customer/search_form" onsubmit="return validarNum(this.ci_client.value);">
<div id="asociar_c">
    <ul>
        <li class="li_tit_1"><img src="http://localhost/hotel-mario/designed_views/imagenes/zoom.png" alt="Buscador de Cliente" class="valign" />Buscador de Cliente</li> 
        <li><div class="cajat">  <input type="text" name="ci_client" id="ci_client" size="50" value="Ejem: 18888888" onclick="document.searchForm.ci_client.value ='';" maxlength="10"/></div>
             <input name="enviar" type="submit" value="Seleccionar" /> </li> 
        <li class="li_tit_1"> &nbsp;&nbsp;<a href="new_client"><img src="http://localhost/hotel-mario/designed_views/imagenes/add.png" alt="Agregar" class="valign" />Agregar Cliente Nuevo</a>    </li>
     </ul>  
</div>
</form>

   <?php if ($query != NULL){ ?>
    <div class="separador"></div>
    <div class="separadorv_gris"></div>
	<?php echo validation_errors(); ?>
<form method="post" action="<?php echo base_url(); ?>customer/modify_client" onSubmit="return valida(this);">
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
            <li><div class="cajat"><input type="text" name="ci_client" maxlength="9"  readonly="readonly" value="<?php echo($client['customer_ci_id']); ?>"/></div></li>
            <li class="li_tit_2">Nombre:</li> 
            <li><div class="cajat"><input type="text" name="nombre" maxlength="15" value="<?php echo ($client['name']); ?>" /></div></li>
            <li class="li_tit_2">Apellido:</li>
            <li><div class="cajat"><input type="text" name="apellido" maxlength="15" value="<?php echo ($client['lastname']); ?>" /></div></li>
            <li class="li_tit_2">Telefono:</li>
            <li><div class="cajat"><input type="text" name="tlf" maxlength="20" value="<?php echo ($client['phone']); ?>" /> </div></li>
            <li class="li_tit_2">e-mail:</li>
            <li><div class="cajat"><input type="text" name="email" maxlength="40" value="<?php echo ($client['email']); ?>" /> </div></li>
            <li class="li_tit_2">Direccion:</li>
            <li><textarea name="direccion" cols="18" rows=""  maxlength="50"><?php echo ($client['address']); ?></textarea></li>
            <li class="li_tit_2">Fecha de Nacimiento:</li>
            <li><div class="cajat"><input type="text" name="fecha" value="<?php echo ($client['birth_date']); ?>" /></div></li>
            
            <li class="li_tit_2">Sexo:</li>
            <li>
            <?php if ($client['sex'] == 'm') { ?>
                <input name="sexo" type="radio" value="m" checked="checked" />M 
                <input name="sexo" type="radio" value="f"  />F 
            <?php } 
            else { ?>
                <input name="sexo" type="radio" value="f" checked="checked" />F 
                <input name="sexo" type="radio" value="m"/>M
            <?php } ?></li>
        <?php 	}?> <!--End for each-->
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;
            <li class="li_tit_2"><input name="enviar" type="submit" value="Aceptar" /></li><li></li> 
        </ul>
        </div>
    </div>
    </form>
<?php 	}  ?> <!--end of if($query) -->
  
</body>
</html>