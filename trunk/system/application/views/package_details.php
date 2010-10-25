<div class="separadorv"></div>
<div class="separadorv"></div>

<table width="100%">
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
                <td colspan="2" align="center">
                    <span class="naranja"><?php echo($room['name']);?></span>
                </td>
            </tr>
            
            <tr>
            	<td align="center"><strong>Habitaciones</strong></td> 
                <td align="center"><strong>Precio p/persona</strong></td>
            </tr>
   <?php } ?>
   		<tr>
        	<td align="center"><?php echo($room['name_spanish']);?></td>
            <td align="center">BsF. <?php echo($room['price_per_person']);?></td>
        </tr>
    	
<?php } ?>
   
</table>
<br  />
<br  />