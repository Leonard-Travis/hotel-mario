<div class="separadorv"></div>
<div id="boletos2">
    <span class="naranja">Resumen Genérico</span>
    <div class="separadorv_gris"></div>
    <table class="resumen" align="center">
        <thead>
            <tr>
                <td>Descripción</td>
                <td>Cantidad</td>
                <td>Precio Unitario</td>
                <td>Sub-Total</td>
                <td width="10px"></td>
                <td></td>
            </tr>
        </thead>
		<?php foreach($generic as $generic){ 
				if ($generic[0] != ''){?>        
        <tr>
            <td> <?php echo($generic[0]); ?> </td>
            <td> <?php echo($generic[1]); ?> </td>
            <td> <?php echo($generic[2]); ?> </td>
            <td> <?php echo($generic[3]); ?> </td>
            <td><a href="#"><img src="http://localhost/hotel-mario/designed_views/imagenes/x.jpg" alt="" onclick="drop_generic(<?php echo($generic[4]); ?>)"/></a></td>
        </tr>
		<?php 	}
			  }?>
        <tr><td class="sinborde">&nbsp;</td></tr>
        <tr>
            <td class="numerico sinborde" colspan="3"><strong>Subtotal General Genérico:</strong></td>
            <td class="numerico sinborde"><strong>BsF <?php echo($total); ?></strong></td>
        </tr>
        <tr>
            <td class="numerico sinborde" colspan="3"><span class="rojo">Total General Genérico:</span></td>
            <td class="numerico sinborde"><span class="rojo">BsF <?php echo($total); ?></span></td>
        </tr>
        <tr></tr> <tr></tr> <tr></tr> <tr></tr> <tr></tr> <tr></tr> <tr></tr>
        <tr>
        	<td class="numerico sinborde"></td> 
            <td class="numerico sinborde" colspan="3">
            <div id="generic_process_button">
            <img src="http://localhost/hotel-mario/designed_views/imagenes/bprocesar.jpg" onclick="generic_process();" />
            </div>
            </td>
        </tr>
    </table>
</div>