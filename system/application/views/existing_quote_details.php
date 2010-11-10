<div class="separadorv"></div>
<div class="separadorv"></div>
<?php if($hotel){ ?>
<table>
    <tr>
        <td><span class="naranja">Hotel</span></td>
    </tr>
    <tr>
    	<td><strong>Hotel</strong>:</td> <td bgcolor="#00FF33"><?php echo($hotel['hotel_name'].' '.$hotel['hotel_location']); ?></td>
    </tr>
    <tr>
    	<td><strong>Fecha checkin</strong>:</td> <td> <?php echo($hotel['check_in'])?></td>
    </tr>
    <tr>
    	<td><strong>Fecha checkin</strong>:</td> <td> <?php echo($hotel['check_out']); ?></td>
    </tr>
    <tr>
    	<td><strong>Plan</strong>:</td> <td> <?php echo($hotel['plan']); ?></td>
    </tr>
    <tr>
    	<td><strong>Personas</strong>:</td> <td> <?php echo($hotel['persons']); ?></td>
    </tr>
</table>

<br />

<table width="100%">
    <tr class="pthead">
        <td class="centrado">Tipo de Habitación</td>
        <td class="centrado">Cantidad</td>
        <td class="centrado">Precio unitario</td>
        <td class="centrado">SubTotal</td>
    </tr>
    
    <?php foreach($hotel['rooms'] as $rooms){ ?>
    
    <tr>
        <td class="centrado"><?php echo($rooms["name"]); ?></td>
        <td class="centrado"><?php echo($rooms["quantity"]); ?></td>
        <td class="centrado">BsF. <?php echo($rooms["unit_price"]); ?></td>
        <td class="centrado">BsF. <?php echo($rooms["subtotal"]); ?></td>
    </tr>
    
    <?php } ?>
    <tr>
        <td class="numerico sinborde" colspan="3"><span class="rojo">Total:</span></td>
        <td class="numerico sinborde"><span class="rojo">BsF. <?php echo($hotel['total']);?></span></td>
    </tr>
</table>

<?php } ?>


<div class="separadorv"></div>
<div class="separadorv"></div>
<?php if($flight){ ?>
<table>
    <tr>
        <td><span class="naranja">Boletos</span></td>
    </tr>
</table>

<br />

<table width="100%">
    <tr class="pthead">
        <td class="centrado">Orig-Dest</td>
        <td class="centrado">Vuelo</td>
        <td class="centrado">Salida</td>
        <td class="centrado">Adultos</td>
        <td class="centrado">Ni&ntilde;os</td>
        <td class="centrado">P.U. Adulto</td>
        <td class="centrado">P.U. Ni&ntilde;o</td>
        <td class="centrado">Subtotal</td>
    </tr>
    
    <?php $total = 0;
		foreach($flight as $flight){ 
			$subtotal = 0; $cant_adults = 0; $cant_kids = 0;
			foreach ($flight['traveler'] as $traveler){
				if($traveler['type'] == 'adult') $cant_adults++;
				elseif($traveler['type'] == 'kid') $cant_kids++;
			}
			$subtotal = ($cant_adults * (floatval($flight['price_per_adult']))) + ($cant_kids * (floatval($flight['price_per_kid'])));
			$total += $subtotal;
			?>
    <tr>
        <td class="centrado"><?php echo($flight['origin'].'-'.$flight['destination']); ?></td>
        <td class="centrado"><?php echo($flight['number'].', '.$flight['airline']); ?></td>
        <td class="centrado"><?php echo($flight['date'].', '.$flight['time']); ?></td>
        <td class="centrado"><?php echo($cant_adults); ?></td>
        <td class="centrado"><?php echo($cant_kids); ?></td>
        <td class="centrado">BsF. <?php echo($flight['price_per_adult']); ?></td>
        <td class="centrado">BsF. <?php echo($flight['price_per_kid']); ?></td>
        <td class="centrado">BsF. <?php echo($subtotal); ?></td>
        
    </tr>
    
    <?php } ?>
    <tr>
        <td class="numerico sinborde" colspan="7"><span class="rojo">Total:</span></td>
        <td class="numerico sinborde"><span class="rojo">BsF. <?php echo($total); ?></span></td>
    </tr>
</table>

<?php } ?>


<div class="separadorv"></div>
<div class="separadorv"></div>
<?php if($generic){ ?>
<table>
    <tr>
        <td><span class="naranja">Gen&eacute;rico</span></td>
    </tr>
</table>

<br />

<table width="100%">
    <tr class="pthead">
        <td class="centrado">Descripci&oacute;n</td>
        <td class="centrado">Cant.</td>
        <td class="centrado">Precio Unitario</td>
        <td class="centrado">Subtotal</td>
    </tr>
    
    <?php $total = 0;
		foreach($generic as $generic){
			$subtotal = ($generic['quantity'] * (floatval($generic['unit_price'])));
			$total += $subtotal;
			?>
    <tr>
        <td class="centrado"><?php echo($generic['description']); ?></td>
        <td class="centrado"><?php echo($generic['quantity']); ?></td>
        <td class="centrado"><?php echo($generic['unit_price']); ?></td>
        <td class="centrado"><?php echo($subtotal); ?></td>        
    </tr>
    
    <?php } ?>
    <tr>
        <td class="numerico sinborde" colspan="2"><span class="rojo"></span></td>
        <td class="numerico sinborde"><span class="rojo">Total: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BsF. <?php echo($total); ?></span></td>
    </tr>
</table>

<?php } ?>




<div class="separadorv"></div>
<div class="separadorv"></div>
<?php if($package){ ?>
<table>
    <tr>
        <td><span class="naranja">Paquete : <?php echo($package['pack_data']['name']); ?></span></td>
    </tr>
    <tr>
    	<td><strong>Hotel</strong>:</td> <td bgcolor="#00FF33" align="center"><?php echo($package['pack_data']['hotel']); ?></td>
    </tr>
    <tr>
    	<td><strong>Descripcion</strong>:</td> <td><?php echo nl2br($package['pack_data']['description']); ?></td>
    </tr>
    <tr>
    	<td><strong>Tarifas validas desde <?php echo($package['pack_data']['date_start']);?> hasta <?php echo($package['pack_data']['date_end']);?></strong></td><td></td>
    </tr>
    <tr>
    	<td><strong>Fecha checkin</strong>:</td> <td> <?php echo($package['check_in'])?></td>
    </tr>
    <tr>
    	<td><strong>Fecha checkin</strong>:</td> <td> <?php echo($package['check_out']); ?></td>
    </tr>
</table>

<br />

<table width="100%">
    <tr class="pthead">
        <td class="centrado">Tipo de Habitación</td>
        <td class="centrado">Adultos</td>
        <td class="centrado">Precio p/Adulto</td>
        <td class="centrado">Infantes</td>
        <td class="centrado">Precio p/Infante</td>
        <td class="centrado">SubTotal</td>
    </tr>
    
    <?php foreach($package['rooms'] as $rooms){ 
			if(count($rooms) > 0){ ?>
    
    <tr>
        <td class="centrado"><?php echo($rooms["name_spanish"]); ?></td>
        <td class="centrado"><?php echo($rooms["number_of_adults"]); ?></td>
        <td class="centrado">BsF. <?php echo($rooms["price_per_person"]); ?></td>
        <td class="centrado"><?php echo($rooms["number_of_kids"]); ?></td>
        <td class="centrado">BsF. <?php echo($rooms["price_per_kid"]); ?></td>
        <td class="centrado">
        BsF. <?php echo(   ((int)$rooms["number_of_adults"]*(float)$rooms["price_per_person"])+((int)$rooms["number_of_kids"]*(float)$rooms["price_per_kid"])    );?>
        
        </td>
    </tr>
    <?php } }?>
    <tr>
        <td class="numerico sinborde" colspan="4"><span class="rojo"></span></td>
        <td class="numerico sinborde"><span class="rojo">Total: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BsF. <?php echo($package['total']); ?></span></td>
    </tr>
</table>

<?php } ?>



<br /><br /><br />
<div class="separadorv"></div>
<div class="separadorv"></div>
