<div class="separadorv"></div>
<div id="boletos2">
    <span class="naranja">Resumen Genérico</span>
    <div class="separadorv_gris"></div>
    <table class="resumen" align="center">
        <thead>
            <tr>
                <td align="center">Descripción</td>
                <td align="center">Cantidad</td>
                <td align="center">Precio Unitario</td>
                <td align="center">Sub-Total</td>
                <td width="10px" align="center"></td>
                <td></td>
            </tr>
        </thead>
		<?php foreach($generic as $generic){ 
				if ($generic[0] != ''){?>        
        <tr>
            <td align="center"> <?php echo($generic[0]); ?> </td>
            <td align="center"> <?php echo($generic[1]); ?> </td>
            <td align="center"> <?php echo($generic[2]); ?> </td>
            <td align="center"> <?php echo($generic[3]); ?> </td>
            <td align="center"><a href="javascript:void(0);"><img src="<?php echo IMG; ?>x.jpg" alt="" onclick="drop_generic(<?php echo($generic[4]); ?>)"/></a></td>
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
   			<td class="sinborde">
            <div id="generic_process_button">
            <img src="<?php echo IMG; ?>bprocesar.jpg" onclick="generic_process(<?php echo($this->session->userdata('id'));?>);" />
            </div>
            </td>
        </tr>
    </table>
</div>
<div class="separadorv"></div>
<div class="separadorv"></div>