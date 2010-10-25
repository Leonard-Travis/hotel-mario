<div class="separadorv"></div>

<div id="new_package">

<table align="center" width="50%">
    <tr> <td colspan="3" align="center"><span class="naranja">Paquete Nuevo</span></td></tr>
   
    <tr>
    <td>Categoria(s):</td>
      <td>
        <table width="100%">
          <tr>
            <td width="40%">¿cuantas?<select id="number_of_categories" name="number_of_categories" onchange="new_package_categories();">
									 <?php for($i=0; $i<5; $i++){?>
                                     	<option value="<?php echo($i); ?>"><?php echo($i); ?></option>
                                     <?php }?>
                                     </select>
            </td>
            <td>
                <div id="new_package_categories">
                </div>
            </td>
          </tr>
    	</table>
      </td>
    </tr>
    
    <tr> 
    <td>Nombre: </td> <td><input type="text" name="name" id="name" /></td>
    <td><img src="http://localhost/hotel-mario/designed_views/imagenes/exclamation.png" /></td> 
    </tr>
    <tr> 
    <td>Fecha In: </td> <td><input type="text" name="date_start" id="date_start" /></td>
    <td><img src="http://localhost/hotel-mario/designed_views/imagenes/exclamation.png" /></td> 
    </tr>
    <tr> 
    <td>Fecha Out: </td> <td><input type="text" name="date_end" id="date_end"/></td>
    <td><img src="http://localhost/hotel-mario/designed_views/imagenes/exclamation.png" /></td> 
    </tr>
    <tr>
    <td>Descripci&oacute;n:</td> <td><textarea name="description" id="description"></textarea></td>
    <td><img src="http://localhost/hotel-mario/designed_views/imagenes/exclamation.png" /></td>
    </tr>
    <tr>
        <td colspan="3" align="right">
            
            	<a href="#" onclick="new_package_hotels();">Agregar Hotel(es)</a>
			
        </td>
    </tr>
</table>

</div>