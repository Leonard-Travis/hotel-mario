<link href="../../../designed_views/estilos.css" rel="stylesheet" type="text/css">
<br /><br />
<table  width="80%" align="center">
<tr>
	<td align="center"><span class="naranja">Paquete:<?php echo($package[0]['name']);?></span></td>
    </td>
</tr>
<tr>
	<td align="center">Vigente del <?php echo($package[0]['date_start']);?> al <?php echo($package[0]['date_end']);?>
    </td>
</tr>
<tr></tr> <tr></tr> <tr></tr> <tr></tr> <tr></tr> <tr></tr>

<tr>
	<td><strong>Descripcion: <br /></strong><?php echo nl2br($package[0]['description']);?>
    </td>
</tr>
</table>

<div id="pq_details">

<table class="resumen" width="50%" align="center">
    <?php $hotel = ''; 
	foreach($rooms as $room){
    	if($hotel != $room['name']){
			$hotel = $room['name'];?>
        	<tr>
                <td colspan="2" align="center">
                    <span class="naranja"><?php echo($room['name']);?></span>
                </td>
                <td width="10%">
                    <input name="pq" id="pq" type="button" value="Cotizar" onclick="pq_details(<?php echo($package[0]['package_id']);?>, <?php echo($room['hotel_id']);?>);"/>
                </td>
            </tr>
            
            <tr>
            	<td align="center"><strong>Habitaciones</strong></td> 
                <td align="center" colspan="2" width="50%"><strong>Precio p/persona</strong></td>
            </tr>
   <?php } ?>
   		<tr>
        	<td align="center"><?php echo($room['name_spanish']);?></td>
            <td align="center" colspan="2">BsF. <?php echo($room['price_per_person']);?></td>
        </tr>
    	
<?php } ?>
   
</table>

</div>

<div id="pq_process_button" align="center">
</div>