<?php if ($prices != 11) {?>

<form name="quote_data" id="quote_data">
<table id="quote_hotel_table">
    <tr>
    <td><img src="<?php echo IMG; ?>i_mas.gif" alt="Agregar" class="valign" /><a href="javascript:void(0);" class="link_naranja" onclick="add_room();">Agregar Habitación</a></td>
    </tr>
    <tr class="pthead">
        <td align="center">Tipo de Habitación</td>
        <td align="center">Cantidad</td>
        <td  align="center">Precio unitario</td>
        <td  align="center">Sub Total</td>
        <td align="center"></td>
    </tr>

</form>	

<?php } 
else echo('No hay precios referentes con las especificaciones dadas');?>			