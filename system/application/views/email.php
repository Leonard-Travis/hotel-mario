<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Hoteles.com.ve</title>
	<link href="http://www.hoteles.com.ve/codeigniter/designed_views/estilos_mail.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="cuerpo">
	<div id="cabecera">
		<div id="logo">
			<h1>Hoteles.com.ve</h1>
			<img src="http://www.hoteles.com.ve/codeigniter/designed_views/imagenes/palito.gif" alt="" class="palito" />
			Reservaciones
		</div>
		<div class="floatd">
			<img src="http://www.hoteles.com.ve/codeigniter/designed_views/imagenes/telefono.gif" alt="" class="floati" />
			<div class="telefonos">
				0-800-HOTELES
				<div class="separa_azul"></div>
				0-800-BOLETOS
			</div>
		</div>
	</div>
	<div id="cuerpo2">
		<div id="barra">
			<h2>
				<div class="floati">
                	Estimado(a) Sr.(a) <?php echo($customer[0]["name"]." ".$customer[0]["lastname"]);?>
                </div>
				<div class="floatd">Caracas, <?php echo($current_date);?></div>
			</h2>
		</div>
		<div id="tit1">
			A continuaci&oacute;n presentamos detalles de la reservaci&oacute;n  
            									<span class="naranja">#<?php echo($quotation_id);?></span> 
		</div>
        
        
<!----------------------------------HOTEL--------------------------------------------->
<?php if($hotel){?>
		<div class="separagris"></div>
		<div class="tit2">
			HOTEL:
		</div>
		<div class="separagris"></div>
     <table>
     <tr>
     <td>
		<ul class="ul2">
			<li>
				<div>
					<div class="ultit">Hotel:</div><span class="colorn">
										  <?php echo($hotel["hotel_name"].", ".$hotel["hotel_location"]);?></span>
				</div>
			</li>
			<li>
				<div>
					<div class="ultit">Fecha checkin:</div><span class="colorn">
																		  <?php echo($hotel["check_in"]);?></span>
				</div>
			</li>
			<li>
				<div>
					<div class="ultit">Fecha checkout:</div><span class="colorn">
																		  <?php echo($hotel["check_out"]);?></span>
				</div>
			</li>
			<li>
				<div>
					<div class="ultit">Nro Personas:</div><span class="colorn">
																		    <?php echo($hotel["persons"]);?></span>
				</div>
			</li>
			<li>
				<div>
					<div class="ultit">Plan:</div><span class="colorn"><?php echo($hotel["plan"]);?></span>
				</div>
			</li>
		</ul>
      </td>
      	<td>
        	<ul class="ul2">
                <li>
                    <div>
                    	<div class="ultit">Descripcion de Plan:</div>
                    </div>
                </li>
			</ul>
      	</td>
        <td>
        	<?php echo nl2br($hotel["plan_description"]);?>
        </td>
      </tr>
      </table>
      	
        <br />
        <div class="separagris"></div>
		<div class="tit2">
			Detalle:
		</div>
		
		<div class="margen">
			<table>
				<thead>
					<tr>
						<td align="center">Tipo de Habitaci&oacute;n</td>
						<td align="center">Cantidad</td>
						<td align="center">Precio unitario</td>
						<td align="center">Sub Total</td>
					</tr>
				</thead>
        
        <?php foreach($hotel["rooms"] as $room){ ?>
				<tr>
					<td align="center"><?php echo($room["name"]);?></td>
					<td align="center"><?php echo($room["quantity"]);?></td>
					<td align="center"><?php echo($room["unit_price"]);?></td>
					<td align="center">BsF. <?php echo($room["subtotal"]);?></td>
				</tr>
                <tr><td colspan="5" class="puntitos"></td></tr>
        <?php } ?>
                <tr><td colspan="5" class="puntitos"></td></tr>
				<tr>
					<td colspan="3" class="ader total"><span class="rojo">Total General Hotel:</span></td>
					<td class="ader total"><span class="rojo">BsF. <?php echo($hotel["total"]);?></span></td>
				</tr>
			</table>
		</div>
<?php } ?>
<!--------------------------------------END OF HOTEL----------------------------------------------->


<!-----------------------------------------FLIGHT-------------------------------------------------->
<?php if($flight){?>
		<div class="separagris"></div>
		<div class="tit2">
			BOLETOS:
		</div>
		<div class="separagris"></div>
		
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo IMG?>icon_roundtrip.gif" /> = Ida Y Vuelta.
        
		<div class="margen">
			<table>
				<thead>
					<tr>
						<td align="center">Orig-Dest</td>
						<td align="center">Vuelo</td>
						<td align="center">Salida</td>
						<td align="center">Adultos</td>
                        <td align="center">Infantes</td>
                        <td align="center">P.U. Adulto</td>
                        <td align="center">P.U. Infante</td>
                        <td align="center">Sub Total</td>
					</tr>
				</thead>
        
           <?php $flight_total = 0;
		foreach($flight as $flight){ 
				$flight_subtotal = 0; $cant_adults = 0; $cant_kids = 0;
				foreach ($flight["traveler"] as $traveler){
					if($traveler["type"] == "adult") $cant_adults++;
					elseif($traveler["type"] == "kid") $cant_kids++;
				}
				$flight_subtotal = ($cant_adults * (floatval($flight["price_per_adult"]))) + ($cant_kids * (floatval($flight["price_per_kid"])));
				$flight_total += $flight_subtotal;
				?>
		<tr>
			<td align="center">
				<?php echo($flight["origin"]."-".$flight["destination"]); 
							if($flight["round_trip"] == "1"){ ?>
									<img src="<?php echo IMG?>icon_roundtrip.gif" />
							<?php } ?>
                
            </td>
			<td align="center"><?php echo($flight["number"].", ".$flight["airline"]); ?></td>
			<td align="center">
				<?php echo($flight["date"].", ".$flight["time"]); 
							if($flight["round_trip"] == "1"){ 
								echo("<br />".$flight["back_date"].", ".$flight["back_time"]);
							 } ?>
            </td>
            
			<td align="center"><?php echo($cant_adults); ?></td>
			<td align="center"><?php echo($cant_kids); ?></td>
			<td align="center">BsF. <?php echo($flight["price_per_adult"]); ?></td>
			<td align="center">BsF. <?php echo($flight["price_per_kid"]); ?></td>
			<td align="center">BsF. <?php echo($flight_subtotal); ?></td>
			
		</tr>
        <tr><td colspan="8" class="puntitos"></td></tr>
		
		<?php } ?>
        		<tr><td colspan="8" class="puntitos"></td></tr>
				<tr>
					<td colspan="7" class="ader total"><span class="rojo">Total General Boleto:</span></td>
					<td class="ader total"><span class="rojo">BsF. <?php echo($flight_total);?></span></td>
				</tr>
			</table>
		</div>
<?php } ?>
<!--------------------------------------END OF FLIGHTS----------------------------------------------->





<!-----------------------------------------PACKAGES--------------------------------------------->
<?php if($package){?>
		<div class="separagris"></div>
		<div class="tit2">
			PAQUETE:
		</div>
		<div class="separagris"></div>
     <table>
     <tr>
     <td>
		<ul class="ul2">
        	<li>
				<div>
					<div class="ultit">Hotel:</div><span class="colorn">
															   <?php echo($package["pack_data"]["hotel"]);?></span>
				</div>
			</li>
			<li>
				<div>
					<div class="ultit">Paquete:</div><span class="colorn">
										  						<?php echo($package["pack_data"]["name"]);?></span>
				</div>
			</li>
            <li>
				<div>
					<div class="ultit">Tarifas validas desde </div>
                    <span class="colorn">
							<?php echo($package["pack_data"]["date_start"]." hasta ".
																			$package["pack_data"]["date_end"]);?>
                     </span>
				</div>
			</li>
			<li>
				<div>
					<div class="ultit">Fecha checkin:</div><span class="colorn">
																		  <?php echo($package["check_in"]);?></span>
				</div>
			</li>
			<li>
				<div>
					<div class="ultit">Fecha checkout:</div><span class="colorn">
																		<?php echo($package["check_out"]);?></span>
				</div>
			</li>
			<li>
				<div>
					<div class="ultit">Noches Adicionales:</div><span class="colorn">
													<?php echo($package["number_of_additional_nights"]);?></span>
				</div>
			</li>
		</ul>
      </td>
      	<td>
        	<ul class="ul2">
                <li>
                    <div>
                    	<div class="ultit">Descripcion de Paquete:</div>
                    </div>
                </li>
			</ul>
      	</td>
        <td>
        	<?php echo nl2br($package["pack_data"]["description"]);?>
        </td>
      </tr>
      </table>
      	
        <br />
        <div class="separagris"></div>
		<div class="tit2">
			Detalle:
		</div>
		
		<div class="margen">
        <?php $additional_night_colspan = "5" //if there are additional days the colspan is 5 instead of 4 ?>
			<table>
				<thead>
					<tr>
                        <td align="center">Tipo de Habitaci&oacute;n</td>
                        <td align="center">Adultos</td>
                        <td align="center">P.U. Adulto</td>
                        <td align="center">Infantes</td>
                        <td align="center">P.U. Infante</td>
                        
                        <?php if($package["number_of_additional_nights"] != "0") {?>
                                <td class="centrado">C/Noche Adicional</td>
                                <?php $additional_night_colspan = "6";
                        }?>
                        
                        <td class="centrado">SubTotal</td>
					</tr>
				</thead>
        
       <?php foreach($package["rooms"] as $rooms){ 
				if(count($rooms) > 0){ ?>
				<tr>
					<td align="center"><?php echo($rooms["name_spanish"]); ?></td>
					<td align="center"><?php echo($rooms["number_of_adults"]); ?></td>
					<td align="center">BsF. <?php echo($rooms["price_per_person"]); ?></td>
					<td align="center"><?php echo($rooms["number_of_kids"]); ?></td>
					<td align="center">BsF. <?php echo($rooms["price_per_kid"]); ?></td>
					
					<?php if($package["number_of_additional_nights"] != "0") {?>
							<td class="centrado">BsF. <?php echo($rooms["additional_night"]); ?></td>
					<?php }?>
					
					<td class="centrado">
					BsF. <?php echo(   ((int)$rooms["number_of_adults"]*(float)$rooms["price_per_person"])+((int)$rooms["number_of_kids"]*(float)$rooms["price_per_kid"])    );?>
					
					</td>
				</tr>
                <tr><td colspan="7" class="puntitos"></td></tr>
                
		<?php } }?><!--end of foreach and validation if there is any room-->
        
                <tr><td colspan="7" class="puntitos"></td></tr>
				<tr>
					<td colspan="<?php echo($additional_night_colspan);?>" class="ader total">
                    	<span class="rojo">Total General Paquete:</span>
                    </td>
					<td class="ader total"><span class="rojo">BsF. <?php echo($package["total"]);?></span></td>
				</tr>
			</table>
		</div>
<?php } ?>
<!--------------------------------------END OF PACKAGES----------------------------------------------->




<!-----------------------------------------GENERIC--------------------------------------------->
<?php if($generic){?>
		<div class="separagris"></div>
		<div class="tit2">
			GENERICO:
		</div>
		<div class="separagris"></div>
		<div class="margen">
			<table>
				<thead>
					<tr>
                        <td align="center">Descripci&oacute;n</td>
                        <td align="center">Cant.</td>
                        <td align="center">Precio Unitario</td>
                        <td align="center">Subtotal</td>
					</tr>
				</thead>
        
          <?php $generic_total = 0;
				foreach($generic as $generic){
					$generic_subtotal = ($generic["quantity"] * (floatval($generic["unit_price"])));
					$generic_total += $generic_subtotal;
					?>
			<tr>
				<td align="center"><?php echo($generic["description"]); ?></td>
				<td align="center"><?php echo($generic["quantity"]); ?></td>
				<td align="center"><?php echo($generic["unit_price"]); ?></td>
				<td align="center"><?php echo($generic_subtotal); ?></td>        
			</tr>
			<tr><td colspan="4" class="puntitos"></td></tr>
		  <?php } ?>
        
                <tr><td colspan="4" class="puntitos"></td></tr>
				<tr>
					<td colspan="3" class="ader total"> <span class="rojo">Total Gen&eacute;rico:</span> </td>
					<td class="ader total"><span class="rojo">BsF. <?php echo($generic_total);?></span></td>
				</tr>
			</table>
		</div>
<?php } ?>
<!--------------------------------------END OF GENERIC----------------------------------------------->



		<div id="tit3">
			<div class="margen">
				<img src="http://www.hoteles.com.ve/codeigniter/designed_views/imagenes/tick.png" alt="" class="valign" />&nbsp;&nbsp;Sirvase a cancelar  <span class="naranja">BsF. <?php echo($total);?></span>  en cualquiera de las siguientes cuentas:			</div>
		</div>
		<div class="margen">
			<div class="floati">
				<img src="http://www.hoteles.com.ve/codeigniter/designed_views/imagenes/banesco.gif" alt="Banesco" /><br />
				Cuenta Corriente<br />
				N&omicron; de Cuenta<br />
				0134-0359-74-3591026355
			</div>
			<img src="http://www.hoteles.com.ve/codeigniter/designed_views/imagenes/barra.gif" alt="" class="floati" />
			<div class="floati">
				<img src="http://www.hoteles.com.ve/codeigniter/designed_views/imagenes/mercantil.gif" alt="Mercantil" /><br />
				Cuenta Corriente<br />
				Nº de Cuenta<br />
				0105-0034-62-1034287621
			</div>
			<img src="http://www.hoteles.com.ve/codeigniter/designed_views/imagenes/barra.gif" alt="" class="floati" />
			A nombre de:
			<h3>LOCACIONES.COM.VE C.A<br />RIF J-31022812-4 </h3> 
		</div>
		
		<div class="tit2">
			OBSERVACIONESS:
		</div>
		<div class="separagris"></div><br />
		<div class="margen">
			<img src="http://www.hoteles.com.ve/codeigniter/designed_views/imagenes/m_o1.gif" alt=" " />
			<div id="observaciones">
				<div class="margen">
					En caso de No Show, cambio de fechas en estadías o cancelación de reservación una vez que su pago hay sido confirmado,  se aplicará la penalidad establecida por el Hotel, Operador Turístico o Línea Aérea, y, adicionalmente el 15% por gastos administrativos de Hoteles.com.ve.
				</div>
			</div>
			<img src="http://www.hoteles.com.ve/codeigniter/designed_views/imagenes/m_o2.gif" alt=" " /><br /><br />
			Atte.<br />
			<br />
			Miner Alejandra Gamboa<br />
			Coordinadora del Departamento Internacional<br />
			<br />
			Tlfs: 0800-HOTELES 0800-4683537 | 0800-BOLETOS 0800-2653867<br />
			Master: ++58212 5783922 (Ext. 103)<br />
			Fax: 0212- 942-11-27  (Ext. 7104)<br />
			Caracas - Venezuela<br />
			<br />
		</div>
	</div>
	<div class="tpiec"><img src="http://www.hoteles.com.ve/codeigniter/designed_views/imagenes/esq1.gif" alt="" /><img src="http://www.hoteles.com.ve/codeigniter/designed_views/imagenes/esq3.gif" alt="" class="floatd" /></div>
</div>
</body>
</html>  
