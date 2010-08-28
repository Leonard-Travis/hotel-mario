<div id="asociar2">
    <div class="separadorv"></div><div class="separadorv_gris"></div><div class="separadorv"></div>
    <h1>Boletos</h1>
    <div id="boletos">
        <form id="fboletos" name="fboletos" method="post" action="">
        <img src="http://localhost/hotel-mario/designed_views/imagenes/i_mas.gif" alt="Agregar" class="valign" /><a href="#" class="link_naranja">Agregar boletos</a>
        <div class="separadorv"></div>
        <table>
            <tr>
            	<td align="center"><strong>Tipo</strong></td>
                <td align="center"><strong>Numero</strong></td>
                <td align="center"><strong>Clase</strong></td>
                <td align="center"><strong>Precio</strong></td>
            </tr>
               
            <tr>
            	<td align="center"><select name="flight_type" id="flight_type" onChange="#">
                	<option value="-">-------------</option>
                    <option value="nac">Nacional</option>
                    <option value="inter">Internacional</option>
                    </select>
                </td>
                <td align="center"><input type="text" name="flight_number" id="flight_number"></td>
                <td align="center"><select name="flight_class" id="flight_class" onChange="#">
                	<option value="-">-------------</option>
                    <option value="nac">Primera Clase</option>
                    <option value="inter">Turista</option>
                    </select>
                </td>
                <td align="center"><input type="text" name="flight_price" id="flight_price"></td> 
            </tr>
            <tr>
                <td align="center"><strong>Origen</strong></td>
                <td align="center"><strong>Destino</strong></td>
                <td align="center"><strong>Fecha</strong></td>
                <td align="center"><strong>Hora</strong></td>
            </tr>
            <tr>
                <td align="center"><input type="text" name="origin" id="origin"></td>
                <td align="center"><input type="text" name="destination" id="destination"></td>
                <td align="center"><input type="text" name="flight_date" id="flight_date"></td>
                <td align="center"><input type="text" name="flight_time" id="flight_time"></td>                
            </tr>
            
            </table>
          
        <div class="separadorv"></div>
        <input type="checkbox" name="idayvuelta" id="idayvuelta" /> Ida y vuelta
    </div>
</div>