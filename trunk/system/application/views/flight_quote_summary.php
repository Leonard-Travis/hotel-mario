<div class="separadorv"></div>
<div id="boletos2">
    <span class="naranja">Resumen Boletos</span>
    <div class="separadorv_gris"></div>
    <table class="resumen" align="center">    
        <thead>
            <tr class="pthead">
                <td align="center">Orig-Dest</td>
                <td align="center">Vuelo</td>
                <td align="center">Adultos</td>
                <td align="center">Ni&ntilde;os</td>
                <td align="center">P.U. Adulto</td>
                <td align="center">P.U. Ni&ntilde;o</td>
                <td align="center">Sub-Total</td>
                <td width="10px"></td>
                <td></td>
            </tr>
        </thead>
        
	<?php foreach($all_flights as $flight) {?>
        <tr>
            <td align="center"><?php echo($flight[0]['origin'].'-'.$flight[0]['destination']); ?></td>
            <td align="center"><?php echo($flight[0]['number'].', '.$flight[0]['AIRLINES_id']); ?></td>
            
		<?php $cant_adults = 0;    $cant_kids = 0;      $sub_total = 0;
			for($i=1; $i < count($flight); $i++){
				if ($flight[$i]['type'] == 'adult') {
					$cant_adults ++;
				}
				elseif ($flight[$i]['type'] == 'kid') $cant_kids ++;
			}
			$sub_total += ($cant_adults * ((floatval($flight[0]['price_per_adult']))) + ($cant_kids * (floatval($flight[0]['price_per_kid']))));  
		?>
                        
            <td align="center"><?php echo($cant_adults); ?></td>
            <td align="center"><?php echo($cant_kids); ?></td>
            <td align="center">BsF.<?php echo($flight[0]['price_per_adult']); ?></td>
            <td align="center">BsF.<?php echo($flight[0]['price_per_kid']); ?></td>
            <td align="center">BsF.<?php echo($sub_total); ?></td>
            <td><a href="#"><img src="http://localhost/hotel-mario/designed_views/imagenes/x.jpg" alt="" onclick="drop_flight(<?php echo($flight[0]['flight_id']); ?>)"/></a></td>
        </tr>
    <?php } ?>

        <tr><td class="sinborde">&nbsp;</td></tr>
        <tr>
            <td class="numerico sinborde" colspan="6"><strong>Subtotal General Boletos:</strong></td>
            <td class="numerico sinborde"><strong>BsF.<?php echo($total); ?></strong></td>
        </tr>
        <tr>
            <td class="numerico sinborde" colspan="6"><span class="rojo">Total General Boletos:</span></td>
            <td class="numerico sinborde"><span class="rojo">BsF.<?php echo($total); ?></span></td>
        </tr>
        <tr>
         	<td>
            <div id="flight_process_button"> 
            	<img src="http://localhost/hotel-mario/designed_views/imagenes/bprocesar.jpg" onclick="flight_quote_process();" />
            </div> 
            </td>
        </tr>

    </table>
    <div class="separadorv"></div>
</div>
