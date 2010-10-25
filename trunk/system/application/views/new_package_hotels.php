<table>
<tr>
	<td>Hoteles relacionados al paquete: </td> <td>¿cuantos?<input type="text" name="number_of_hotels" id="number_of_hotels" onblur="np_print_hotels();" maxlength="2" size="3" /></td>
</tr>
</table>

<?php if($query){ ?>
<br />
<table align="center" width="60%">
    <?php for($i=1; $i <= (int)$number_of_hotels; $i++){?>
    	<tr>
        <td><select id="hotel<?php echo($i);?>" onchange="np_process_hotels(<?php echo($i);?>);">
        	<option value="-">------------------------</option>
			 <?php foreach($query as $hotel){?>
                <option value="<?php echo($hotel['hotel_id']); ?>"><?php echo($hotel['name']); ?></option>
             <?php }?>
             </select>			
            </td>
        </tr>
        <tr>
            <td>
                <div id="np_hotel<?php echo($i);?>">
                </div>
            </td>
        </tr>
        <tr><td><div class="separadorv_gris"></div></td></tr>
    <?php } ?>

    <tr><td align="center"><div id="new_package_process_button"> </div></td></tr>

</table>
<?php } ?>