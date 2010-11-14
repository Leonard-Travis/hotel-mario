<table>
    <tr>
        <td><span class="naranja">Resumen Hotel</span></td>
    </tr>
    <tr><td class="tdseparadorgris" colspan="6"></td></tr>
</table>
<table class="h_tabla2" width="100%">
    <tr class="pthead">
        <td class="centrado">Tipo de Habitación</td>
        <td class="centrado">Cantidad</td>
        <td class="centrado" width="100%">Precio unitario</td>
        <td class="centrado">SubTotal</td>
        <td width="10px"></td>
    </tr>
    
    <?php foreach($quote_rooms as $quote_rooms){ ?>
    
    <tr>
        <td class="centrado"><?php echo($quote_rooms["name_spanish"]); ?></td>
        <td class="centrado"><?php echo($quote_rooms["quantity"]); ?></td>
        <td class="centrado">BsF<?php echo($quote_rooms["PU"]); ?></td>
        <td class="centrado">BsF<?php echo($quote_rooms["subtotal"]); ?></td>
        <td><a href="javascript:void(0);"><img src="<?php echo IMG; ?>x.jpg" alt="" onclick="drop_element_from_quote(<?php echo($quote_rooms["rooms_hotels_id"]); ?>)"/></a></td>
    </tr>
    
    <?php } ?>
    
    <tr><td class="sinborde">&nbsp;</td></tr>
    <tr>
        <td class="numerico sinborde" colspan="2"><strong>Subtotal General Hotel:</strong></td>
        <td class="numerico sinborde"><strong>BsF<?php echo($subtotal); ?></strong></td>
    </tr>
    <tr>
        <td class="numerico sinborde" colspan="2"><span class="rojo">Total General Hotel:</span></td>
        <td class="numerico sinborde"><span class="rojo">BsF<?php echo($subtotal); ?></span></td>
    </tr>
</table>