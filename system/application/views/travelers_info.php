<div class="separadorv"></div>
<img src="http://localhost/hotel-mario/designed_views/imagenes/pasajeros.bmp" />
<div class="separadorv"></div><div class="separadorv"></div>
<form name="travelers_info">
<table width="100%">
	<?php $cant_adults = (int) $cant_adults;
		  $cant_kids = (int) $cant_kids;
		  for($i=1; $i<=$cant_adults; $i++ ){ ?>
    	<tr> <td colspan="2" align="left"><strong>Adulto <?php echo($i); ?></strong> </tr>
        <tr> <td width="50%"><input type="text" name="adult<?php echo($i); ?>_name" id="adult<?php echo($i); ?>_name" value="nombre" onclick="document.travelers_info.adult<?php echo($i); ?>_name.value ='';" size="50" /></td>
        	<td><input type="text" name="adult<?php echo($i); ?>_lastname" id="adult<?php echo($i); ?>_lastname" value="apellido" onclick="document.travelers_info.adult<?php echo($i); ?>_lastname.value ='';" size="50" /></td>
        </tr>
        <tr> <td>CI &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" name="adult<?php echo($i); ?>_ci" id="adult<?php echo($i); ?>_ci"/></td>
        </tr>
        <tr> <td>Pasaporte &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" name="adult<?php echo($i); ?>_passport" id="adult<?php echo($i); ?>_passport"/></td>
        </tr>
        <tr> <td>Email &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" name="adult<?php echo($i); ?>_email" id="adult<?php echo($i); ?>_email"/></td>
        </tr>
        <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
        
    <?php } ?>
    
    <?php for($i=1; $i<=$cant_kids; $i++ ){ ?>
    	<tr> <td colspan="2" align="left"><strong>Ni&ntilde;o <?php echo($i); ?></strong> </tr>
        <tr> <td width="50%"><input type="text" name="kid<?php echo($i); ?>_name" id="kid<?php echo($i); ?>_name" value="nombre" onclick="document.travelers_info.kid<?php echo($i); ?>_name.value ='';" size="50" /></td>
        	<td><input type="text" name="kid<?php echo($i); ?>_lastname" id="kid<?php echo($i); ?>_lastname" value="apellido" onclick="document.travelers_info.kid<?php echo($i); ?>_lastname.value ='';" size="50" /></td>
        </tr>
        <tr> <td>CI &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" name="kid<?php echo($i); ?>_ci" id="kid<?php echo($i); ?>_ci"/></td>
        </tr>
        <tr> <td>Pasaporte &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" name="kid<?php echo($i); ?>_passport" id="kid<?php echo($i); ?>_passport"/></td>
        </tr>
        <tr> <td>Email &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" name="kid<?php echo($i); ?>_email" id="kid<?php echo($i); ?>_email"/></td>
        </tr>
        <tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
        
    <?php } ?>
    <tr> <td></td> <td align="center"><img src="http://localhost/hotel-mario/designed_views/imagenes/bejecutar.jpg" onclick="travelers_info();" /></td> </tr>
</table>
</form>