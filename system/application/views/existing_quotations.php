<div class="separador"></div>
<div class="separadorv_gris"></div>

<div id="asociar2" >
<div id="boletos2">
<h1>Cotizacion(es)</h1>

    <table class="resumen" align="center" width="10%">    
    	<thead>
            <tr class="pthead">
                <td align="center">ID</td>
                <td align="center">Fecha</td>
                <td align="center">Empleado</td>
                <td align="center">Total</td>
                <td width="10px"></td>
            </tr>
        </thead>
        
		<?php foreach($quotations as $quote){ ?>
        <tr>
        <td align="center"><?php echo($quote['quote_id']); ?></td>
        <td align="center"><?php echo($quote['quote_date']); ?></td>
        <td align="center"><?php echo($quote['EMPLOYEES_id']); ?></td>
        <td align="center">BsF <?php echo($quote['total']); ?></td>
        <td align="center">
        <div id="existing_quote_details_button<?php echo($quote['quote_id']); ?>">
        <a href="javascript:void(0);"><img src="<?php echo IMG; ?>fazul.jpg" alt="" onclick="existing_quote_details(<?php echo($quote['quote_id']); ?>,0);"/></a>
        </div>
        </td>
        </tr>
        <tr>
        <td colspan="5"><div id="existing_quote_details<?php echo($quote['quote_id']); ?>">
        </div></td>
        </tr>
        <?php } ?>


</table>
</div>
</div>
 <div class="separadorv"></div>