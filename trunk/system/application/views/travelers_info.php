<div class="separadorv"></div>
<img src="http://localhost/hotel-mario/designed_views/imagenes/pasajeros.bmp" />
<div class="separadorv"></div><div class="separadorv"></div>
<form name="travelers_info" id="travelers_info">
<table width="100%">
	<?php $cant_adults = (int) $cant_adults;
		  $cant_kids = (int) $cant_kids;
		  
		  for($i=1; $i<=$cant_adults; $i++ ){ ?>
    	<tr> <td colspan="2" align="left"><strong>Adulto <?php echo($i); ?></strong> </tr>
        <tr> <td width="50%">
        <input type="text" name="<?php echo($cont_f); ?>_adult<?php echo($i); ?>_name" id="<?php echo($cont_f); ?>_adult<?php echo($i); ?>_name" value="nombre" onclick="document.<?php echo($cont_f); ?>_adult<?php echo($i); ?>_name.value ='';" size="50" />
        </td>
        	<td><input type="text" name="<?php echo($cont_f); ?>_adult<?php echo($i); ?>_lastname" id="<?php echo($cont_f); ?>_adult<?php echo($i); ?>_lastname" value="apellido" onclick="document.travelers_info.<?php echo($cont_f); ?>_adult<?php echo($i); ?>_lastname.value ='';" size="50" /></td>
        </tr>
        <tr> <td>CI &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" name="<?php echo($cont_f); ?>_adult<?php echo($i); ?>_ci" id="<?php echo($cont_f); ?>_adult<?php echo($i); ?>_ci"/> <img src="http://localhost/hotel-mario/designed_views/imagenes/zoom.png" onclick="find_traveler(<?php echo($cont_f); ?>, <?php echo($i); ?>, 'adult');"/></td>
        </tr>
        <tr> <td>Pasaporte &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" name="<?php echo($cont_f); ?>_adult<?php echo($i); ?>_passport" id="<?php echo($cont_f); ?>_adult<?php echo($i); ?>_passport"/></td>
        </tr>
        <tr> <td>Email &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" name="<?php echo($cont_f); ?>_adult<?php echo($i); ?>_email" id="<?php echo($cont_f); ?>_adult<?php echo($i); ?>_email"/></td>
        </tr>
        <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
        
    <?php } ?>
    
    <?php for($i=1; $i<=$cant_kids; $i++ ){ ?>
    	<tr> <td colspan="2" align="left"><strong>Ni&ntilde;o <?php echo($i); ?></strong> </tr>
        <tr> <td width="50%"><input type="text" name="<?php echo($cont_f); ?>_kid<?php echo($i); ?>_name" id="<?php echo($cont_f); ?>_kid<?php echo($i); ?>_name" value="nombre" onclick="document.travelers_info.<?php echo($cont_f); ?>_kid<?php echo($i); ?>_name.value ='';" size="50" /></td>
        	<td><input type="text" name="<?php echo($cont_f); ?>_kid<?php echo($i); ?>_lastname" id="<?php echo($cont_f); ?>_kid<?php echo($i); ?>_lastname" value="apellido" onclick="document.travelers_info.<?php echo($cont_f); ?>_kid<?php echo($i); ?>_lastname.value ='';" size="50" /></td>
        </tr>
        <tr> <td>CI &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" name="<?php echo($cont_f); ?>_kid<?php echo($i); ?>_ci" id="<?php echo($cont_f); ?>_kid<?php echo($i); ?>_ci"/></td>
        </tr>
        <tr> <td>Pasaporte &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" name="<?php echo($cont_f); ?>_kid<?php echo($i); ?>_passport" id="<?php echo($cont_f); ?>_kid<?php echo($i); ?>_passport"/></td>
        </tr>
        <tr> <td>Email &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" name="<?php echo($cont_f); ?>_kid<?php echo($i); ?>_email" id="<?php echo($cont_f); ?>_kid<?php echo($i); ?>_email"/></td>
        </tr>
        <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
        
    <?php } ?>
    <tr> <td></td> <td align="center"> <img src="http://localhost/hotel-mario/designed_views/imagenes/bagregar.jpg" onclick="travelers(<?php echo($cont_f); ?>);" />
    </td> </tr>
</table>
</form>