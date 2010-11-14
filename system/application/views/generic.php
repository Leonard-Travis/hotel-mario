
<div class="separadorv"></div>
<div class="separadorv_gris"></div>
<div class="separadorv"></div>

<h1>Gen&eacute;rico</h1>
<div id="boletos">
    <img src="<?php echo IMG; ?>i_mas.gif" alt="Agregar" class="valign" /><a href="javascript:void(0);" class="link_naranja" onclick="add_generic();">Agregar generico</a>
    
<div id="generic_info">    
<form id="generic" name="generic">
        <div class="separadorv"></div>
    <table width="100%" align="center" id="generic_table">
    	<tr>
        	<td align="center"><strong>Descripcion</strong></td>
            <td align="center"><strong>Cantidad</strong></td>
            <td align="center"><strong>Precio Unitario</strong></td>
            <td align="center" class="rojo totall">SubTotal</td>
            <td></td> <td></td>
        </tr>
        <tr>
        	<td align="center"><input type="text" id="description0" name="description0" size="60"></td>
            <td align="center"><input type="text" id="cant0" name="cant0" size="3" maxlength="2" ></td>
            <td align="center">BsF.<input type="text" id="price0" name="price0" onBlur="generic_set_total(0);" ></td>
            <td class="rojo totall"><div id="generic_total0"></div></td>
            <td></td> <td></td>
        </tr>
    </table>
    <br /><br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <img src="<?php echo IMG; ?>bagregar.jpg" onClick="generic_q();">
    </form>
</div>
</div>
				