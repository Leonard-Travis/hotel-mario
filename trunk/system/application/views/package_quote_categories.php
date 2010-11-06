<?php if ($all_categories) {?>
<script type="text/javascript">
	$(function() {
		var availableTags = new Array();
		<?php for($i=0; $i <  count($all_categories) ; $i++){?>
			availableTags[<?php echo($i); ?>] = {label: "<?php echo($all_categories[$i]['name_spanish']);?>",
												 value: "<?php echo($all_categories[$i]['categorie_id']);?>"};
		<?php } ?>	
		
		$('#tags').autocomplete({
			minLength: 0,
			source: availableTags,
			focus: function(event, ui) {
				$('#tags').val(ui.item.label);
				return false;
			},
			select: function(event, ui) {
				$('#tags').val(ui.item.label);
				$('#categories').val(ui.item.value);				
				return false;
			}
		});
	});
</script>
<div class="separadorv"></div>
<div class="separadorv"></div>
<h1>Paquete</h1>

    <div id="asociar_c">
    <table>
    	<tr>
        <td class="li_tit_1"><img src="http://localhost/hotel-mario/designed_views/imagenes/zoom.png" alt="Buscador de Cliente" class="valign" />Seleccione una Categoria</td> 
        <td>
            <input id="tags" />
            <input type="hidden" id="categories" />
        </td>
        <td>
            <input type="image" src="http://localhost/hotel-mario/designed_views/imagenes/bseleccionar.jpg" onclick="pq_select_categorie();"/>
        </td>
        </tr>
    </table>
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
        <td align="center"> <a href="#" onClick="pq_select_package(<?php echo($package['package_id']);?>);"><img src="http://localhost/hotel-mario/designed_views/imagenes/bir.jpg"/></a></td>
    </tr>
    <?php } ?>
    </table>

<?php } ?>