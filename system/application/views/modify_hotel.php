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
    	if ((vacio(F.name.value) == false) || (vacio(F.location.value) == false)){  
                alert("Ha dejado uno o mas de los campos OBLIGATORIOS vacios.")  
                return false  
        } else {
			return true;
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

<table align="center" width="40%">
<form method="post" action="<?php echo base_url(); ?>hotels/modify_hotel/0" onsubmit="return valida(this);">
	<?php $hotel_id_aux = 111;?> <!--$hotel_id_aux is an auxiliary variable to keep the hotel id after the foreach cycle is done-->
    <?php foreach ($query as $hotel_selected) { ?>
        <tr> <td colspan="2" align="center"><strong>Datos del Hotel</strong></td> </tr>
        <tr>
        <td>Nombre</td> <td><input type="text" name="name" maxlength="30" size="40" value="<?php echo ($hotel_selected['name']);?>" /></td>
    <td><img src="<?php echo IMG; ?>exclamation.png" /></td>
        </tr> 
        <tr>
        <td>Ubicacion</td> 
        
        <td>
        <select id="location" name="location">
        	<?php foreach($locations as $location){
            		if($location['city_id'] == $hotel_selected['city_id']){?>
                    	<option value="<?php echo($location['city_id']);?>" selected="selected"><?php echo($location['city_name']);?></option>
                    <?php } 
					else{?>
            		<option value="<?php echo($location['city_id']);?>"><?php echo($location['city_name']);?></option>
			  		<?php }
			}?>
        </select>
        </td>
        
    	<td><img src="<?php echo IMG; ?>exclamation.png" /></td>
        </tr> 
        
        <tr>        
        <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo ($hotel_selected['hotel_id']);?>"  />
        <?php $hotel_id_aux = $hotel_selected['hotel_id'];?>
    <?php }?> <!-- end of foreach $query -->
    <tr> 
    <td><input type="submit" value="Aceptar"  /></td>
</form>
    <form method="post" action="<?php echo base_url(); ?>hotels/associate_room">
        <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo ($hotel_id_aux);?>"  />
        <td align="center"><input type="submit" value="Asociar nuevo tipo de Habitacion al Hotel" /></td> 
    </tr>
	</form>
    <tr>
    <form method="post" action="<?php echo base_url(); ?>hotels/associate_plan">
        <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo ($hotel_id_aux);?>"  />
        <td></td> <td align="center"><input type="submit" value="Asociar nuevo Plan al Hotel" /></td> </tr>
    </form> <!-- end of form associate_plan -->
</table>

<?php
$this->load->view('global/management_close');
?>
</body>
</html>