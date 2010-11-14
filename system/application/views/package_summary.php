<div class="separadorv"></div>
<div id="boletos2">
    <span class="naranja">Resumen Paquete</span>
    <div class="separadorv_gris"></div>
    <table align="center">
    <tr>
    	<td><strong>Check In: </strong> <?php echo($check_in);?></td>
        <td><strong>Check Out: </strong> <?php echo($check_out);?></td>
        <td width="50%" bgcolor="#CCFF99" align="center"><strong>Noche(s) Adicional(es): </strong> <?php echo($additional_nights);?></td>
    </tr>
    </table>
    <table class="resumen" align="center">
        <thead>
            <tr>
                <td align="center">Habitacion</td>
                <td align="center">Adultos</td>
                <td align="center">Precio p/Adulto</td>
                <td align="center">Infantes</td>
                <td align="center">Precio p/Infante</td>
                <td align="center">Sub-Total</td>
                <td></td>
            </tr>
        </thead>
		<?php foreach($package_rooms as $room){ ?>       
        <tr>
            <td align="center"> <?php echo($room['name'][0]['name_spanish']); ?> </td>
            <td align="center"> <?php echo($room[4]); ?> </td>
            <td align="center">BsF. <?php echo($room[1]); ?> </td>
            <td align="center"> <?php echo($room[5]); ?> </td>
            <td align="center">BsF. <?php echo($room[2]); ?> </td>
            <td align="center">
            BsF <?php 
			echo(  ((int)$room[4] * (float)$room[1]) + ((int)$room[5] * (float)$room[2]) + ( ((int)$room[4]+(int)$room[5])*(float)$room[3]*(float)$additional_nights )    ); 
			?> 
            </td>
        </tr>
		<?php }?>
        <tr><td class="sinborde">&nbsp;</td></tr>
        <tr>
            <td class="numerico sinborde" colspan="5"><strong>Subtotal Paquete:</strong></td>
            <td class="numerico sinborde"><strong>BsF <?php echo($total); ?></strong></td>
        </tr>
        <tr>
            <td class="numerico sinborde" colspan="5"><span class="rojo">Total Paquete:</span></td>
            <td class="numerico sinborde"><span class="rojo">BsF <?php echo($total); ?></span></td>
        </tr>    
        <tr>
        <td colspan="6" align="right">
        <div id="pq_process_button_summary">
        <a href="javascript:void(0);">
        <img src="<?php echo IMG; ?>bprocesar.jpg" onclick="pq_process(1, <?php echo($this->session->userdata('id'));?>);" />
        </a>
        </td>
        </div>
        </tr>
        </table>
</div>
<div class="separadorv"></div>
<div class="separadorv"></div>