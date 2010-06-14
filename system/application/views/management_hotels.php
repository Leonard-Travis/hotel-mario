<?php
$this->load->view('global/header');
?>

<script>
function confirmar(plan_or_room){
	var msg = "";
	if (plan_or_room == 'plan')
		msg = '¿Seguro desea desasociar el plan del hotel?'; 
	else if (plan_or_room == 'room')
		msg = '¿Seguro desea desasociar la habitacion del hotel?';
	if (confirm(msg)){
		return true;
	}
	else return false;
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
		</ul>
	</div>
</div>
<div id="menu2">
</div>
<div class="separadorv"></div>

<?php
$this->load->view('global/management_bar');
?>
          	
<?php if ($query) {?>
	<table align="center" width="40%">
		<tr>
			<td> <strong>Seleccione un Hotel</strong> </td> 
		<td align="center">
		<form method="post" action="<?php echo base_url(); ?>hotels">
			<select name="hotels" id="hotels">
			<?php foreach ($query as $hotel) { ?>
				<option value="<?php echo ($hotel['hotel_id']);?>"><?php echo ($hotel['name']);?></option> 
			<?php }?>
			</select>
			</td> <td> <input name="send" type="submit" value="Aceptar" /> </td> </tr>
		</form>
	</table>
 
<?php }?>
    
    
    
<?php if ($hotel_selected) {?>
	<?php $hotel_id_aux = 111;?>
        <br  />
        <table  align="center" width="60%">
        <?php foreach ($hotel_selected as $hotel_selected) { ?>
        <tr> <td colspan="2" align="center"><strong>Datos del Hotel</strong></td> </tr>
        <tr>
        <td>Nombre</td> <td><input width="100%" type="text" name="name" id="name" size="40" readonly="readonly" value="<?php echo ($hotel_selected['name']);?>" /></td>
        </tr> 
        <tr>
        <td>Ubicacion</td> <td><textarea name="location" cols="24" rows=""  maxlength="50" readonly="readonly"><?php echo ($hotel_selected['location']);?></textarea></td>
        </tr> 
        <tr>
        <td>Habitaciones</td>
        <td>
        <?php if (count ($rooms) == 0){?>
                <strong>No hay habitaciones relacionadas</strong> </td> </tr>
        <?php }
              else { ?>
                <table width="100%">
                    <?php $gray_row = true;?>   
                    <tr> 
                    <td align="center"><strong>Nombre</strong></td> 
                    <td align="center"><strong>Descripcion</strong></td> 
                    <td align="center"><strong>Comisionabale</strong></td>
                    <td align="center" width="17px"><strong></strong></td>
                    </tr>
                    <?php foreach ($rooms as $room) { ?>
                        <?php if ($gray_row){?>
                                <tr bgcolor="#CCCCCC">
                                <?php $gray_row = false;
                              }
                              else{  ?>
                                <tr>
                                <?php $gray_row = true;
                              }?>
                        <td align="center"> <?php echo ($room['name']);?> </td>
                        <td align="center"> <?php echo ($room['description']);?> </td>
                        <?php if ($room['commissionable'] == 1) {?>
                                <td align="center">TRUE</td>
                                <?php }
                              else {?>
                                <td align="center">FALSE</td>
                        <?php }?>
                        <td align="center"> <a href="<?php echo base_url(); ?>hotels/disassociate_room/<?php echo ($room['room_id']);?>/<?php echo ($hotel_selected['hotel_id']);?>"><img src="http://localhost/hotel-mario/system/application/views/img/eliminar.png" onclick="return confirmar('room');" /></a></td>
                        </tr>
                    <?php }?> <!-- end of foreach $room -->
                </table> 
        <?php }?> <!-- end of else -->
        </td>
        </tr>
        
        <tr>
        <td>Planes</td>
        <td>
        <?php if (count ($plans) == 0){?>
                <strong>No hay planes relacionados</strong> </td> </tr>
        <?php }
              else { ?>
                <table width="100%">
                <?php $gray_row = true;?>   
                <tr> 
                <td align="center"><strong>Nombre</strong></td> 
                <td align="center"><strong>Descripcion</strong></td> 
                <td align="center" width="17px"><strong></strong></td>
                </tr>
                <?php foreach ($plans as $plan) { ?>
                    <?php if ($gray_row){?>
                            <tr bgcolor="#CCCCCC">
                            <?php $gray_row = false;
                          }
                          else{  ?>
                            <tr>
                            <?php $gray_row = true;
                          }?>
                    <td align="center"> <?php echo ($plan['name']);?> </td>
                    <td align="center"> <?php echo ($plan['description']);?> </td>
                    <td align="center"> <a href="<?php echo base_url(); ?>hotels/disassociate_plan/<?php echo ($plan['plan_id']);?>/<?php echo ($hotel_selected['hotel_id']);?>"><img src="http://localhost/hotel-mario/system/application/views/img/eliminar.png" onclick="return confirmar('plan');"/></a></td>
                    </tr>
                <?php }?> <!-- end of foreach $plans -->
                </table> 
        <?php }?> <!-- end of else -->
        </td>
        </tr>
        <?php $hotel_id_aux = $hotel_selected['hotel_id'];?>
        <?php }?>
        <tr> <td><a href="<?php echo base_url(); ?>hotels/modify_hotel/<?php echo ($hotel_selected['hotel_id']);?>" ><strong>Modificar Hotel</strong></a></td>
    
    <form method="post" action="<?php echo base_url(); ?>hotels/associate_room">
        <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo ($hotel_id_aux);?>"  />
        <td align="center"><input type="submit" value="Asociar nuevo tipo de Habitacion al Hotel" /></td> </tr>
    </form> <!-- end of form associate_room -->
    <form method="post" action="<?php echo base_url(); ?>hotels/associate_plan">
        <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo ($hotel_id_aux);?>"  />
        <tr> <td></td><td align="center"><input type="submit" value="Asociar nuevo Plan al Hotel" /></td> </tr>
    </form> <!-- end of form associate_plan -->
    </table>
<?php }?>

<?php
$this->load->view('global/management_close');
?>

</body>
</html>