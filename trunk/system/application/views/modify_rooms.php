<?php
$this->load->view('global/header');
?>

<script>
function validarNum(valor) {
re=/^([0-9])*$/

    if(!re.exec(valor))    {
        alert("Debe introducir la capacidad completamente numerica");
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
				<img src="<?php echo IMG; ?>f1.png" alt="" class="floati" />
				<div class="mf_texto">Gestion</div>
				<img src="<?php echo IMG; ?>f3.png" alt="" class="floati" />
            </li>
			<li><a href="<?php echo base_url(); ?>price_matrix/index/0">Matriz de Precios</a></li>
            <li class="palito"><img src="<?php echo IMG; ?>naranja3.gif" alt="" /></li>
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

<?php if ($room_to_change) {?>
    <form method="post" action="<?php echo base_url(); ?>rooms/save_modified_room" onsubmit="return valida(this)">
        <table align="center" width="50%">
        <?php foreach ($room_to_change as $room_to_change) { ?>
            <tr> <td colspan="3" align="center"><strong>Datos del tipo de Habitacion</strong></td> </tr>
            <tr>
            <td>Nombre Espa�ol</td> <td><input type="text" name="name" id="name" value="<?php echo ($room_to_change['name_spanish']);?>" maxlength="30" size="40" /></td>
    <td><img src="<?php echo IMG; ?>exclamation.png" /></td>
            </tr> 
            <tr>
            <td>English Name</td> <td><input type="text" name="name_english" id="name_english" value="<?php echo ($room_to_change['name_english']);?>" maxlength="30" size="40" /></td>
    <td><img src="<?php echo IMG; ?>exclamation.png" /></td>
            </tr>
            <tr>
            <td>Especial</td>
            <td>
            <?php if ($room_to_change['special'] == 0) { ?>
                    <input name="special" type="radio" value="0" checked="checked" />FALSE 
                    <input name="special" type="radio" value="1" />TRUE
            <?php } 
            	  else { ?>
                    <input name="special" type="radio" value="1" />FALSE
                    <input name="special" type="radio" value="0" checked="checked" />TRUE
            <?php } ?>
            </td>
    <td><img src="<?php echo IMG; ?>exclamation.png" /></td>
            </tr>
            <input type="hidden" name="room_id" id="room_id" value="<?php echo ($room_to_change['room_id']);?>"  />
        <?php }?> <!-- end foreach -->
        <tr> <td><input type="submit" value="Procesar"  /></td> </tr>
        </table>
    </form>
<?php }?>
<?php
$this->load->view('global/management_close');
?>
</body>
</html>