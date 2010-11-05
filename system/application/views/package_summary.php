<div class="separadorv"></div>
<div id="boletos2">
    <span class="naranja">Resumen Paquete</span>
    <div class="separadorv_gris"></div>
    <table>
    <tr>
    	<td><strong>Check In: </strong> <?php echo($check_in);?></td>
        <td><strong>Check Out: </strong> <?php echo($check_out);?></td>
    </tr>
    </table>
    <table class="resumen" align="center">
        <thead>
            <tr>
                <td align="center">Habitacion</td>
                <td align="center">Cantidad</td>
                <td align="center">Precio Unitario</td>
                <td align="center">Sub-Total</td>
                <td></td>
            </tr>
        </thead>
		<?php foreach($package_rooms as $room){ ?>       
        <tr>
            <td align="center"> <?php echo($room['name'][0]['name_spanish']); ?> </td>
            <td align="center"> <?php echo($room[2]); ?> </td>
            <td align="center">BsF. <?php echo($room[1]); ?> </td>
            <td align="center">BsF <?php echo((int)$room[2] * (float)$room[1]); ?> </td>
        </tr>
		<?php }?>
        <tr><td class="sinborde">&nbsp;</td></tr>
        <tr>
            <td class="numerico sinborde" colspan="3"><strong>Subtotal Paquete Genérico:</strong></td>
            <td class="numerico sinborde"><strong>BsF <?php echo($total); ?></strong></td>
        </tr>
        <tr>
            <td class="numerico sinborde" colspan="3"><span class="rojo">Total Paquete Genérico:</span></td>
            <td class="numerico sinborde"><span class="rojo">BsF <?php echo($total); ?></span></td>
        </tr>    
        <tr>
        <td colspan="4" align="right">
        <div id="pq_process_button_summary">
        <a href="#">
        <img src="http://localhost/hotel-mario/designed_views/imagenes/bprocesar.jpg" onclick="pq_process(1);" />
        </a>
        </td>
        </div>
        </tr>
        </table>
</div>
<div class="separadorv"></div>
<div class="separadorv"></div>