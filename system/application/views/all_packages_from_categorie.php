<link href="../../../designed_views/estilos.css" rel="stylesheet" type="text/css" />
<div class="separador"></div>
<div class="separadorv_gris"></div>



<h1><input type="button" value="Agregar Paquete" onclick="new_package();" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Paquetes Tur&iacute;sticos - <?php echo($categorie_name); ?></h1>

<div id="new_package">
<?php if(count($package) > 0){ ?>
<table class="resumen" align="center" width="10%">    
    <thead>
        <tr class="pthead">
            <td align="center">Nombre</td>
            <td align="center">Check In</td>
            <td align="center">Check Out</td>
            <td align="center"><span class="naranja">Desde</span></td>
            <td width="10px"></td>
        </tr>
    </thead>
    
    <?php foreach($package as $package){ ?>
    <tr>
    <td align="center"><?php echo($package['name']); ?></td>
    <td align="center"><?php echo($package['date_start']); ?></td>
    <td align="center"><?php echo($package['date_end']); ?></td>
    <td align="center">BsF. <?php echo($package['since_price']); ?></td>
    <td align="center">
    <div id="package_arrow<?php echo($package['package_id']); ?>">
    <a href="#"><img src="http://localhost/hotel-mario/designed_views/imagenes/fazul.jpg" alt="" onclick="package_details(<?php echo($package['package_id']); ?>,0);"/></a>
    </div>
    </td>
    </tr>
    <tr>
    <td colspan="4"><div id="package<?php echo($package['package_id']); ?>"></div></td>
    </tr>
    <?php } ?>
</table>
<?php } 
else echo('<strong>No hay paquetes disponibles para esta categoria</strong>');?>
</div>
</div>
 <div class="separadorv"></div>
</div>