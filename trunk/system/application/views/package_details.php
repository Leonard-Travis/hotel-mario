<div class="separadorv"></div>
<div class="separadorv"></div>

<table width="100%">
	<tr>
    	<td align="center">
        <strong><?php echo($days_nights);?></strong>
        </td>
    </tr>
    <tr>
        <td>
        <span class="naranja">Descripcion: </span><br /> <?php echo nl2br($description); ?><br />
        </td>
    </tr>
</table>

<table width="50%" align="center">
    <?php $hotel = ''; 
	foreach($rooms as $room){
    	if($hotel != $room['name']){
			$hotel = $room['name'];?>
        	<tr>
                <td colspan="4" align="center">
                    <span class="naranja"><?php echo($room['name']);?></span>
                </td>
            </tr>
            
            <tr>
            	<td align="center"><strong>Habitaciones</strong></td> 
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
<br  />
<br  />