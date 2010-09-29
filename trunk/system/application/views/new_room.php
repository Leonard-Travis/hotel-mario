<?php
$this->load->view('global/header');
?>

<script>
function vacio(q) {  
        for ( i = 0; i < q.length; i++ ) {  
                if ( q.charAt(i) != " " ) {  
                        return true  
                }  
        }  
        return false  
}  
   
function valida(F) {	
    	if ((vacio(F.name.value) == false) || (vacio(F.name_english.value) == false)){  
                alert("Ha dejado uno o mas de los campos OBLIGATORIOS vacios.")  
                return false  
        } else {
				if (validarNum(F.capacity.value) == true)
                	return true
				else return false;
        }  
          
}
</script>

<div id="menu">
	<div class="cuerpo">
		<ul>
			<li><a href="<?php echo base_url(); ?>customer/search_form">Clientes</a></li>
			<li class="mfocus">
				<img src="http://localhost/hotel-mario/designed_views/imagenes/f1.png" alt="" class="floati" />
				<div class="mf_texto">Gestion</div>
				<img src="http://localhost/hotel-mario/designed_views/imagenes/f3.png" alt="" class="floati" />
            </li>
			<li><a href="<?php echo base_url(); ?>price_matrix/index/0">Matriz de Precios</a></li>
            <li class="palito"><img src="http://localhost/hotel-mario/designed_views/imagenes/naranja3.gif" alt="" /></li>
            <li><a href="<?php echo base_url(); ?>quotation/new_quote/0">Cotizaciones</a></li>
		</ul>
	</div>
</div>
<div id="menu2">
</div>
<div class="separadorv"></div>

<?php
$this->load->view('global/management_bar');
?>

<table>
<tr>
<td> 
<form method="post" action="<?php echo base_url(); ?>rooms/new_room">  
<input name="enviar" type="submit" value="Nueva Habitacion" />
</form>
</td>
<tr>
</table>
    
    <?php echo validation_errors(); ?>
	<form method="post" action="<?php echo base_url(); ?>rooms/new_room" onsubmit="return valida(this);">
     <div id="datos">
    <table align="center" width="50%">
    <tr> <td colspan="3" align="center"><strong>Habitacion Nueva</strong></td></tr>
    <tr> 
    <td>Nombre Español: </td> <td><input type="text" name="name" maxlength="30" size="40"  /></td>
    <td><img src="http://localhost/hotel-mario/designed_views/imagenes/exclamation.png" /></td> 
	</tr>
    <tr> 
    <td>English Name: </td> <td><input type="text" name="name_english" maxlength="30" size="40"  /></td>
    <td><img src="http://localhost/hotel-mario/designed_views/imagenes/exclamation.png" /></td> 
	</tr>
    <tr>
    <td>Especial:  </td> <td>
        <input name="special" type="radio" value="1" />TRUE 
        <input name="special" type="radio" value="0" checked="checked"/>FALSE
    </td>
    <td><img src="http://localhost/hotel-mario/designed_views/imagenes/exclamation.png" /></td>
    </tr>
    <td> <input name="enviar" type="submit" value="Agregar Habitacion" /> </td>
    </table>
     </div>
     </form>
<?php
$this->load->view('global/management_close');
?>
</body>
</html>