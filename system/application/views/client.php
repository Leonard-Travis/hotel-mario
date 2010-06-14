<?php
$this->load->view('global/header');
?>

<script>

function validarNum(valor) {
re=/^([0-9])*$/

    if(!re.exec(valor))    {
        alert("La busqueda debe ser por cedula");
		return false;
    }else{
		return true;
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
		<li> <div class="cajat"> <input type="text" name="ci_client" id="ci_client" value="Ejem: 18888888" onclick="document.searchForm.ci_client.value ='';" maxlength="10"/></div>
             <input name="enviar" type="submit" value="Seleccionar" /> </li> 
        <li class="li_tit_1"> &nbsp;&nbsp;<a href="new_client"><img src="http://localhost/hotel-mario/designed_views/imagenes/add.png" alt="Agregar" class="valign" />Agregar Cliente Nuevo</a>    </li>
     </ul>  
</div>
</form>    
    
    <!-- $ci_aux is an auxiliary variable to keep the costumer ci after the foreach cycle is done -->
    <?php $ci_aux=11111; 
    if ($query != NULL){ ?>
    <div class="separador"></div>
    <div class="separadorv_gris"></div>
      
    <?php foreach ($query as $client) { ?>  
    
    <div id="asociar_c">
    <ul class="ul_tit_2">    
        <li class="li_tit_2">Cedula:</li>
        <li><div class="cajat"><input type="text" name="ci_client" readonly="readonly" value="<?php echo($client['customer_ci_id']); ?>"/></div></li>
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
    <form method="post" action="<?php echo base_url(); ?>customer/modify_client">
        <input type="hidden" name="ci_client" id="ci_client" value="<?php echo ($ci_aux) ?>"  />
        <input name="modify_button" id="modify_button" type="submit" value="Modificar Informacion" />
    </form>
    </td>
    <td>
    <form method="post" action="<?php echo base_url(); ?>customer/delete_client">
        <input type="hidden" name="ci_client" id="ci_client" value="<?php echo ($ci_aux) ?>"  />
        <input name="modify_button" id="modify_button" type="submit" value="Eliminar Cliente" /> 
    </form>
    </td>
    </tr>
    </table>

<?php 	}?> <!--End $query-->
</div> <!--End div id="datos"-->
<div id="test" ></div>
     
     
</body>
</html>