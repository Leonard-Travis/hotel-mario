<div id="management_hotels_div">
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

<?php if($cities){?>
	<br  />
    <h1>Agregar/Eliminar Hoteles</h1>
	<table align="center" width="50%">
    	<tr>
        	<td align="center">Escoger Ciudad</td>
            <td align="center">
            	<select id="cities" name="cities" onchange="city_chosen();">
                <option value="-" selected="selected">------------------------------------------</option>
                	<?php foreach($cities as $city){?>
                    	<option value="<?php echo $city['city_id'];?>"><?php echo $city['city_name'];?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
        	<td align="center"><div id="select_hotel_preferred"></div></td>
        	<td align="center"><div id="preferred_hotel"></div></td>
        </tr>
    </table>
	<div id="hotel_info"></div>

<?php }
else { ?><!--end of if cities-->
		<a href="<?php echo base_url(); ?>hotels/all_cities" >Agregar/Eliminar Hoteles</a>
<?php } ?>

          	
<?php if ($query) {?>
<script type="text/javascript">
	$(function() {
		var availableTags = new Array();
		<?php for($i=0; $i <  count($query) ; $i++){?>
			availableTags[<?php echo($i); ?>] = {label: "<?php echo($query[$i]['name']);?>",
												 value: "<?php echo($query[$i]['hotel_id']);?>"};
		<?php } ?>	
		
		$('#tags').autocomplete({
			minLength: 0,
			source: availableTags,
			focus: function(event, ui) {
				$('#tags').val(ui.item.label);
				return false;
			},
			select: function(event, ui) {
				$('#tags').val(ui.item.label);
				$('#hotels').val(ui.item.value);				
				return false;
			}
		});
	});
</script>

<table align="center" width="40%">
    <tr>
        <td align="center"> <img src="<?php echo IMG; ?>zoom.png" alt="Buscador de Cliente" class="valign" />Seleccione un Hotel</td>
        <td align="center">           
                <input id="tags" />
         </td> 
         <td> 
             <input type="hidden" id="hotels" name="hotels" />
             <input type="image" src="<?php echo IMG; ?>bbuscar.jpg" onclick="middle_pass();" /> 
                         
             
         </td> 
    </tr>
</table> 

<script type="text/javascript">
	function middle_pass(){
		var hotel = $("#hotels").val();
		management_hotel_chosen(hotel);
	}
</script>
 
<?php }?>
    
    
    
<?php if ($hotel_selected) {?>
	<?php $hotel_id_aux = 111;?>
        <br  /><br  /><br  />
        <h1>Datos del Hotel</h1>
        
        <table  align="center" width="60%">
        <?php foreach ($hotel_selected as $hotel_selected) { ?>
        <tr>
        <td>Nombre</td> <td><input width="100%" type="text" name="name" id="name" size="40" readonly="readonly" value="<?php echo ($hotel_selected['name']);?>" onclick="test2()"/></td>
        </tr> 
        <tr>
        <td>Ubicacion</td> <td><textarea name="location" cols="24" rows=""  maxlength="50" readonly="readonly"><?php echo ($hotel_selected['location']);?></textarea></td>
        <td>
        <a href="<?php echo base_url(); ?>hotels/modify_hotel/<?php echo ($hotel_selected['hotel_id']);?>" >
        <img src="<?php echo IMG; ?>bmodificar.jpg" />
        </a>
        </td>
        </tr>
        </table> 
        <br /><br />
        
        
        <table width="100%">
          <tr>
        <td><span class="naranja">Habitaciones</span></td> <td><span class="naranja">Planes</span></td>
    	</tr>
        <tr></tr><tr></tr><tr></tr>
        <tr>
        <td valign="top" width="50%">
        <?php if (count ($rooms) == 0){?>
                <strong>No hay habitaciones relacionadas</strong> </td>
        <?php }
              else { ?>
                <table class="resumen" width="100%">
                    <thead>
            		<tr class="pthead"> 
                    <td align="center"><strong>Nombre</strong></td>
                    <td align="center"><strong>Name</strong></td>
                    <td align="center"><strong>Descripcion</strong></td> 
                    <td align="center"><strong>Cap.</strong></td>
                    <td align="center"><strong>Esp.</strong></td>
                    <td align="center" width="17px"><strong></strong></td>
                    </tr>
                    </thead>
                    <?php foreach ($rooms as $room) { ?>
                         <tr>
                        <td align="center"> <?php echo ($room['name_spanish']);?> </td>
                        <td align="center"> <?php echo ($room['name_english']);?> </td>
                        <td align="center"> <?php echo ($room['description']);?> </td>
                        <td align="center"> <?php echo ($room['capacity']);?> </td>
                        <?php if ($room['commissionable'] == 0) {?>
                                <td align="center">SI</td>
                                <?php }
                              else {?>
                                <td align="center">NO</td>
                        <?php }?>
                        <td align="center"> <a href="<?php echo base_url(); ?>hotels/disassociate_room/<?php echo ($room['room_id']);?>/<?php echo ($hotel_selected['hotel_id']);?>"><img src="<?php echo IMG;?>x.jpg" onclick="return confirmar('room');" /></a></td>
                        </tr>
                    <?php }?> <!-- end of foreach $room -->
                </table> 
        <?php }?> <!-- end of else -->
        </td>
        <td valign="top" width="50%">
        <?php if (count ($plans) == 0){?>
                <strong>No hay planes relacionados</strong> </td>
        <?php }
              else { ?>
                <table class="resumen" width="100%">
                <?php $gray_row = true;?> 
                <thead>
            	<tr class="pthead">   
                <td align="center"><strong>Nombre</strong></td>
                <td align="center"><strong>Name</strong></td> 
                <td align="center"><strong>Descripcion</strong></td> 
                <td align="center" width="17px"><strong></strong></td>
                </tr>
                </thead>
                <?php foreach ($plans as $plan) { ?>
                   <tr>
                    <td align="center"> <?php echo ($plan['name_spanish']);?> </td>
                    <td align="center"> <?php echo ($plan['name_english']);?> </td>
                    <td align="center"> <?php echo ($plan['description']);?> </td>
                    <td align="center"> <a href="<?php echo base_url(); ?>hotels/disassociate_plan/<?php echo ($plan['plan_id']);?>/<?php echo ($hotel_selected['hotel_id']);?>"><img src="<?php echo IMG;?>x.jpg" onclick="return confirmar('plan');"/></a></td>
                   </tr>
                <?php }?> <!-- end of foreach $plans -->
                </table> 
        <?php }?> <!-- end of else -->
        </td>
        </tr>
        <?php $hotel_id_aux = $hotel_selected['hotel_id'];?>
        <?php }?>
    
    <form method="post" action="<?php echo base_url(); ?>hotels/associate_room">
        <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo ($hotel_id_aux);?>"  />
        <td align="center"><input type="submit" value="Asociar nuevo tipo de Habitacion al Hotel" /></td>
    </form> <!-- end of form associate_room -->
    <form method="post" action="<?php echo base_url(); ?>hotels/associate_plan">
        <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo ($hotel_id_aux);?>"  />
        <td align="center"><input type="submit" value="Asociar nuevo Plan al Hotel" /></td> </tr>
    </form> <!-- end of form associate_plan -->
    </table>
<?php }?>
<div id="libro" name="libro" >
</div>

<?php
$this->load->view('global/management_close');
?>

</body>
</html>
</div><!-- end of management hotels div-->