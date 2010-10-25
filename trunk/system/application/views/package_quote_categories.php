<?php if ($all_categories) {?>
<link href="../../../designed_views/estilos.css" rel="stylesheet" type="text/css">

<div class="separadorv"></div>
<div class="separadorv"></div>
<h1>Paquete</h1>

    <div id="asociar_c">
    <table>
    	<tr>
        <td class="li_tit_1"><img src="http://localhost/hotel-mario/designed_views/imagenes/zoom.png" alt="Buscador de Cliente" class="valign" />Seleccione una Categoria</td> 
        <td><select name="categories" id="categories" onchange="pq_select_categorie();">
        	<option value="-">---------------------</option>
			<?php foreach ($all_categories as $categorie) { ?>
				<option value="<?php echo ($categorie['categorie_id']);?>"><?php echo ($categorie['name_spanish']);?></option> 
			<?php }?>
			</select> 
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
        <td align="center">Check In</td> 
        <td align="center">Check Out</td> 
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