<div id="flight_quote_aux">
<table width="100%">
        	<tr>
            <td><strong>Origen:</strong></td>
            <td><select name="origin<?php echo($cont_f); ?>" id="origin<?php echo($cont_f); ?>">
            	<?php foreach($citys as $city){ ?>
                	<option value="<?php echo($city['flight_city_id']); ?>"><?php echo($city['name']); ?></option>
                <?php } ?>
                </select>
            </td>
            <td><strong>Partida:</strong></td>
            <td>
            <input type="text" name="go_date<?php echo($cont_f); ?>" id="go_date<?php echo($cont_f); ?>" value="yyyy-mm-dd" onclick="document.fboletos.go_date<?php echo($cont_f); ?>.value ='';" width="11" maxlength="10"/>
            
            <input type="text" name="go_time<?php echo($cont_f); ?>" id="go_time<?php echo($cont_f); ?>" value="hh:mm" onclick="document.fboletos.go_time<?php echo($cont_f); ?>.value ='';" width="6%" maxlength="5"/>
            </td>
            </tr> 
            
            <tr>
            <td><strong>Destino:</strong></td>
            <td><select name="destination<?php echo($cont_f); ?>" id="destination<?php echo($cont_f); ?>">
            	<?php foreach($citys as $city){ ?>
                	<option value="<?php echo($city['flight_city_id']); ?>"><?php echo($city['name']); ?></option>
                <?php } ?>
                </select>
            </td>
            
            <td>
            <div id="back<?php echo($cont_f); ?>">
            <strong>Regreso:</strong>
            </div>
            </td>
            <td>
            <div id="back_data<?php echo($cont_f); ?>">
            <input type="text" name="back_date<?php echo($cont_f); ?>" id="back_date<?php echo($cont_f); ?>" value="yyyy-mm-dd" width="11" maxlength="10" onclick="document.fboletos.back_date<?php echo($cont_f); ?>.value ='';"/>
            <input type="text" name="back_time<?php echo($cont_f); ?>" id="back_time<?php echo($cont_f); ?>" value="hh:mm" width="6%" maxlength="5" onclick="document.fboletos.back_time<?php echo($cont_f); ?>.value ='';"/>
            </div>
            </td>
            
            
            </tr>    
            
            <tr> <td><strong>Numero:</strong></td> <td><input type="text" name="number<?php echo($cont_f); ?>" id="number<?php echo($cont_f); ?>" /></td> </tr>
            <tr> <td><strong>Aerolinea:</strong></td> 
            	 <td><select name="airline<?php echo($cont_f); ?>" id="airline<?php echo($cont_f); ?>">
            	<?php foreach($airlines as $airline){ ?>
                	<option value="<?php echo($airline['airline_id']); ?>"><?php echo($airline['name']); ?></option>
                <?php } ?>
                </select>
                 </td> 
            </tr>
            <tr> <td><strong>Clase:</strong></td> 
            	 <td><select name="class<?php echo($cont_f); ?>" id="class<?php echo($cont_f); ?>">
            	<?php foreach($classes as $class){ ?>
                	<option value="<?php echo($class); ?>"><?php echo($class); ?></option>
                <?php } ?>
                </select>
                 </td> 
            </tr>
            
            <tr>
            <td><strong>Adultos:</strong></td>
            <td><input type="text" name="cant_adults<?php echo($cont_f); ?>" id="cant_adults<?php echo($cont_f); ?>" size="5" maxlength="2"/>
            	<input type="text" name="price_per_adult<?php echo($cont_f); ?>" id="price_per_adult<?php echo($cont_f); ?>" size="12" maxlength="10"/>BsF.c/u
            </td>
            
            <td><strong>Ni&ntilde;os:</strong></td>
            <td><input type="text" name="cant_kids<?php echo($cont_f); ?>" id="cant_kids<?php echo($cont_f); ?>"  size="5" maxlength="2"/>
            	<input type="text" name="price_per_kid<?php echo($cont_f); ?>" id="price_per_kid<?php echo($cont_f); ?>" size="12" maxlength="10"/>BsF.c/u
            </td>
            </tr>
            <tr><td></td></tr><tr><td></td></tr>
            <tr>
            <td></td> <td><input type="checkbox" name="round_trip<?php echo($cont_f); ?>" id="round_trip<?php echo($cont_f); ?>" onclick="back_data(<?php echo($cont_f); ?>);" checked="checked" /> Ida y vuelta</td>
            </tr>
            
            <tr> <td></td> <td></td> <td></td> <td align="center"><input type="button" value="Agregar Viajeros"onclick="flight_quote_data(<?php echo($cont_f); ?>);" /></td></tr>
            
        <div id="flight_quote<?php echo(((int) $cont_f) + 1); ?>" name="flight_quote<?php echo(((int) $cont_f) + 1); ?>">
        </div>
        </table>
        
        <div id="travelers_info<?php echo($cont_f); ?>" name="travelers_info<?php echo($cont_f); ?>">
        </div>        
        
        
     
     <?php if ($cont_f != 0) { ?>
		<div class="separadorv"></div><div class="separadorv_gris"></div><div class="separadorv"></div>
	 <?php } ?>
    
        <div class="separadorv"></div>        
        <div class="separadorv"></div>
        <div class="separadorv"></div>
    </div>
</div>
</div>