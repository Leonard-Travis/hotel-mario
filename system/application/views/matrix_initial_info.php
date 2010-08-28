<?php if ($hotel_selected) {?>
        <table width="40%">
        <tr> <td colspan="4" align="center"><strong>Nueva Matriz con nueva Season</strong></td></tr>
        <?php foreach ($hotel_selected as $hotel_selected) { ?>
        <tr>
        <td>Hotel:</td> <td><input type="text" name="name" id="name" size="40" readonly="readonly" value="<?php echo ($hotel_selected['name']);?>" /></td>
        </tr>        
        <tr>
        <td>Plan:</td>
        <td>
        <?php if (count ($plans) == 0){?>
                <strong>No hay planes relacionados</strong> </td> </tr>
                <input type="hidden" name="plan" id="plan" value="no_plan"  />
        <?php }
              else { ?>
                <select name="plan" id="plan" >
                <?php foreach ($plans as $plan) { ?>
					<option value="<?php echo ($plan['plan_id']); ?>"> <?php echo ($plan['name_spanish']); ?> </option>
                <?php }?> <!-- end of foreach $plans --> 
                </select>
        <?php }?> <!-- end of else -->
        </td>
        </tr>
        <tr>
        <td>Nombre:</td> <td><input type="text" name="season_name" id="season_name"></td>
        </tr>
        <tr> 
        <td>Desde:</td> <td><input type="text" name="date_ini" id="date_ini"  /></td>
        <td>Hasta:</td> <td><input type="text" name="date_end" id="date_end"  /></td>
        <td><input type="button" value="Validar" onClick="validate_dates()"></td><td><div id="validate_check" name="validate_check"></div></td>
        </tr>
        <?php }?> <!-- end of foreach $hotel_selected -->
    </table>
    
    <div name="new_matrix_data" id="new_matrix_data">
    </div>
    <div name="process_new_matrix_button" id="process_new_matrix_button">
    </div>
<?php } ?>