<?php if ($all_categories) {?>
    
<script type="text/javascript">
	$(function() {
		var availableTags = new Array();
		<?php for($i=0; $i <  count($all_categories) ; $i++){?>
			availableTags[<?php echo($i); ?>] = {label: "<?php echo($all_categories[$i]['name_spanish']);?>",
												 value: "<?php echo($all_categories[$i]['categorie_id']);?>"};
		<?php } ?>	
		
		$('#tags_pack').autocomplete({
			minLength: 0,
			source: availableTags,
			focus: function(event, ui) {
				$('#tags_pack').val(ui.item.label);
				return false;
			},
			select: function(event, ui) {
				$('#tags_pack').val(ui.item.label);
				$('#categories').val(ui.item.value);				
				return false;
			}
		});
	});
</script>
<div class="separadorv"></div>
<div class="separadorv_gris"></div>
<div class="separadorv"></div>
    
<h1>Paquete</h1>
    <div id="asociar_c">
    <ul>
        <li class="li_tit_1"><img src="<?php echo IMG; ?>zoom.png" alt="Buscador de Cliente" class="valign" />Seleccione Categoria</li> 
		<li>
            <input id="tags_pack"/>
            <input type="hidden" id="categories" />
        </li>
        <li>
            <input type="image" src="<?php echo IMG; ?>bseleccionar.jpg" onclick="pq_select_categorie();"/>
        </li>
    </ul>
	</div>
        
<?php }?>
<div id="pq_select_package">
</div>

<?php if($all_packages){ ?>
	<br /><br />
	<table width="100%" class="resumen">
    <thead>
    <tr class="pthead">
	    <td align="center">Nombre</td> 
        <td align="center">Valido Desde</td> 
        <td align="center">Hasta</td> 
        <td align="center"><span class="naranja">Desde</span></td>
        <td align="center" width="17px"></td>
    </tr>
    </thead>
    <?php foreach($all_packages as $package){ ?>
    <tr>
    	<td align="center" width="50%"><?php echo($package['name']); ?></td>
        <td align="center"><?php echo($package['date_start']); ?></td>
        <td align="center"><?php echo($package['date_end']); ?></td>
       	<td align="center">BsF.<?php echo($package['since_price']); ?></td>
        <td align="center"> <a href="javascript:void(0);" onClick="pq_select_package(<?php echo($package['package_id']);?>);"><img src="<?php echo IMG; ?>bir.jpg"/></a></td>
    </tr>
    <?php } ?>
    </table>

<?php } ?>