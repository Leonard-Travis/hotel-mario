<div id="asociar2">
    <div class="separadorv"></div><div class="separadorv_gris"></div><div class="separadorv"></div>
    <h1>Boletos</h1>
    <div id="boletos">
        <form id="fboletos" name="fboletos" method="post" action="">
        <img src="http://localhost/hotel-mario/designed_views/imagenes/i_mas.gif" alt="Agregar" class="valign" /><a href="#" class="link_naranja">Agregar boletos</a>
        <div class="separadorv"></div>
        <table width="100%">
        	<tr>
            <td><strong>Origen:</strong></td>
            <td><input type="text" name="origin" id="origin" size="50"/></td>
            <td><strong>Partida:</strong></td>
            <td><input type="text" name="go_date" id="go_date" value="yyyy-mm-dd" onclick="document.fboletos.go_date.value ='';" width="11" maxlength="10"/><input type="text" name="go_time" id="go_time" value="hh:mm" onclick="document.fboletos.go_time.value ='';" width="6%" maxlength="5"/>
            </td>
            </tr> 
            
            <tr>
            <td><strong>Destino:</strong></td>
            <td><input type="text" name="destination" id="destination" size="50"/></td>
            <td><strong>Regreso:</strong></td>
            <td><input type="text" name="back_date" id="back_date" value="yyyy-mm-dd" onclick="document.fboletos.back_date.value ='';" width="11" maxlength="10"/><input type="text" name="back_time" id="back_time" value="hh:mm" onclick="document.fboletos.back_time.value ='';" width="6%" maxlength="5"/>
            </td>
            </tr>    
            
            <tr> <td><strong>Numero:</strong></td> <td><input type="text" name="number" id="number" /></td> </tr>
            <tr> <td><strong>Aerolinea:</strong></td> 
            	 <td><select name="airline" id="airline">
                 	<option value="santa_barbara">Santa Barbara</option>
                    </select>
                 </td> 
            </tr>
            <tr> <td><strong>Clase:</strong></td> 
            	 <td><select name="class" id="class">
                 	<option value="turist">Turista</option>
                    </select>
                 </td> 
            </tr>
            
            <tr>
            <td><strong>Adultos:</strong></td>
            <td><input type="text" name="cant_adults" id="cant_adults" size="5" maxlength="2"/>
            	<input type="text" name="price_per_adult" id="price_per_adult" size="12" maxlength="10"/>BsF.c/u
            </td>
            
            <td><strong>Ni&ntilde;os:</strong></td>
            <td><input type="text" name="cant_kids" id="cant_kids"  size="5" maxlength="2"/>
            	<input type="text" name="price_per_kid" id="price_per_kid" size="12" maxlength="10"/>BsF.c/u
            </td>
            </tr>
            <tr><td></td></tr><tr><td></td></tr>
            <tr>
            <td></td> <td><input type="checkbox" name="idayvuelta" id="idayvuelta" /> Ida y vuelta</td>
            </tr>
            
            <tr> <td></td> <td></td> <td></td> <td align="center"><img src="http://localhost/hotel-mario/designed_views/imagenes/bprocesar.jpg" onclick="flight_quote_data();" /></td></tr>
            
        </table> 
        <div id="travelers_info" name="travelers_info">
        </div>
        
        <div class="separadorv"></div>        
        <div class="separadorv"></div>
        <div class="separadorv"></div>
    </div>
</div>