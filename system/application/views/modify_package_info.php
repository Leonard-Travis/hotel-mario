<div class="separadorv"></div>
<script type="text/javascript">
	$(document).ready(function() {
		$("#date_start").datepicker({dateFormat: 'yy-mm-dd'});
		$("#date_end").datepicker({dateFormat: 'yy-mm-dd'});
	});
</script>
<div id="new_package">
<form name="new_package_form" id="new_package_form">

<table align="center" width="50%">
    <tr> <td colspan="3" align="center"><span class="naranja">Modificar Paquete</span></td></tr>
   
    <tr>
    <td>Categoria(s):</td>
      <td>
        <table width="100%">
          <tr>
            <td width="40%">¿cuantas?<select id="number_of_categories" name="number_of_categories" onchange="new_package_categories();">
						 <?php for($i=0; $i<5; $i++){
                                   if($i == count($categories_selected)){?>
                                        <option value="<?php echo($i); ?>" selected><?php echo($i); ?></option>
                               <?php } 
							   	   else{?>
                            			<option value="<?php echo($i); ?>"><?php echo($i); ?></option>
                               <?php } 
                          }?>
                         </select>
            </td>
            <td>
                <div id="new_package_categories">
                	<table>
					<?php for($i=0; $i < count($categories_selected); $i++){ ?>
                            <tr>
                            <td>
                            <div id="categorie<?php echo($i);?>">
                            <select id="categories<?php echo($i);?>" onChange="new_categorie(<?php echo($i);?>);">
                            <?php foreach($categories as $categorie){
								
									if($categorie['categorie_id'] == $categories_selected[$i]['categorie_id']){?>
                                		<option value="<?php echo($categorie['categorie_id']); ?>" selected><?php echo($categorie['name_spanish']); ?></option>
                                    <?php }
									
									else {?>
                                    	<option value="<?php echo($categorie['categorie_id']); ?>"><?php echo($categorie['name_spanish']); ?></option>
                                    <?php }
									
                             } ?>
                            <option value="new">--Nueva Categoria--</option> 
                            </select>
                            </div>
                            </td>
                            </tr>
                    <?php } ?>
                    </table>
                	
                </div>
            </td>
          </tr>
    	</table>
      </td>
    </tr>
    
    <tr> 
    <td>Nombre:</td><td><input type="text" name="name" id="name" value="<?php echo($package[0]['name']);?>"/></td>
    <td><img src="<?php echo IMG; ?>exclamation.png" /></td> 
    </tr>
    <tr> <td></td> <td></td>
    </tr>
    <tr> 
    <td>Fecha In: </td> <td><input type="text" name="date_start" id="date_start" readonly="readonly" value="<?php echo($package[0]['date_start']);?>"/></td>
    <td><img src="<?php echo IMG; ?>exclamation.png" /></td> 
    </tr>
    <tr> 
    <td>Fecha Out: </td> <td><input type="text" name="date_end" id="date_end" readonly="readonly" value="<?php echo($package[0]['date_end']);?>"/></td>
    <td><img src="<?php echo IMG; ?>exclamation.png" /></td> 
    </tr>
    <tr>
    <tr> 
    <td>Dias/Noches: </td> 
    <td>
    <input type="text" name="days" id="days" size="3" maxlength="2" onclick="document.new_package_form.days.value ='';" onblur="if(document.new_package_form.days.value == '') document.new_package_form.days.value = '00';" value="<?php echo($package[0]['number_of_days']);?>"/>
    <strong>/</strong>
    <input type="text" name="nights" id="nights" size="3" maxlength="2" onclick="document.new_package_form.nights.value ='';" onblur="if(document.new_package_form.nights.value == '') document.new_package_form.nights.value = '00';" value="<?php echo($package[0]['number_of_nights']);?>"/>
    </td>
    <td><img src="<?php echo IMG; ?>exclamation.png" /></td> 
    </tr>
    <tr>
    <td>Descripci&oacute;n:</td> <td><textarea name="description" id="description"><?php echo ($package[0]['description']);?></textarea></td>
    <td><img src="<?php echo IMG; ?>exclamation.png" /></td>
    </tr>
    <tr>
        <td colspan="3" align="right">
            	<input type="hidden" id="package_id" value="<?php echo($package[0]['package_id']);?>">
            	<a href="javascript:void(0);" onclick="package_hotels(2);">Modificar Precios</a>
			
        </td>
    </tr>
</table>

</form>

</div>