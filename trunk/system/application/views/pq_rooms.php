
<br /><br />
<input type="hidden" value="<?php echo($package[0]['date_start']);?>" id="pq_date_start" />
<input type="hidden" value="<?php echo($package[0]['date_end']);?>" id="pq_date_end" />
<table  width="80%" align="center">
<tr>
	<td align="center"><span class="naranja">Paquete:<?php echo($package[0]['name']);?></span></td>
    </td>
</tr>
<tr>
	<td align="center" bgcolor="#FFFF66">Tarifas vigentes del <?php echo($package[0]['date_start']);?> al <?php echo($package[0]['date_end']);?>
    </td>
</tr>
<tr>
	<td align="center">
    <strong>
	<?php echo($package[0]['number_of_days']);?> D&iacute;as / <?php echo($package[0]['number_of_nights']);?> Noches</strong>
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
                <td colspan="4" align="center">
                    <span class="naranja"><?php echo($room['name']);?></span>
                </td>
                <td width="10%">
                    <input name="pq" id="pq" type="button" value="Cotizar" onclick="pq_details(<?php echo($package[0]['package_id']);?>, <?php echo($room['hotel_id']);?>);"/>
                </td>
            </tr>
            
            <tr>
            	<td align="center" width="40%"><strong>Habitaciones</strong></td> 
                <td align="center"><strong>Precio p/persona</strong></td>
                <td align="center"><strong>Precio p/ni&ntilde;o</strong></td>
                <td align="center"><strong>Noche Adicional</strong></td>
            </tr>
   <?php } ?>
   		<tr>
        	<td align="center" bgcolor="#00FF33"><?php echo($room['name_spanish']);?></td>
            <td align="center" bgcolor="#99FF33">BsF. <?php echo($room['price_per_person']);?></td>
            <td align="center">BsF. <?php echo($room['price_per_kid']);?></td>
            <td align="center">BsF. <?php echo($room['additional_night']);?></td>
        </tr>
    	
<?php } ?>
   
</table>

</div>

<div id="pq_process_button" align="center">
</div>