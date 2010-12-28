<div id="seller">

<?php
$this->load->view('global/header');
?>

<div id="menu">
	<div class="cuerpo">
		<ul>
			<li><a href="<?php echo base_url(); ?>customer/search_form">Clientes</a></li>
			<li class="mfocus">
				<img src="<?php echo IMG; ?>f1.png" alt="" class="floati" />
				<div class="mf_texto">Gestion</div>
				<img src="<?php echo IMG; ?>f3.png" alt="" class="floati" />
            </li>
			<li><a href="<?php echo base_url(); ?>price_matrix/index/0">Matriz de Precios</a></li>
            <li class="palito"><img src="<?php echo IMG; ?>naranja3.gif" alt="" /></li>
            <li><a href="<?php echo base_url(); ?>quotation/new_quote/0">Cotizaciones</a></li>
		</ul>
	</div>
</div>
<div id="menu2">
</div>
<div class="separadorv"></div>

<?php
$this->load->view('global/management_bar');
?>

<div class="separadorv"></div>
<div class="separadorv_gris"></div>
<div class="separadorv"></div>

<div id="datos">
<div id="asociar_c">
	<h1>
    	Nuevo Vendedor
    </h1>
    <table width="50%" align="center">
    
        <tr>
            <td><strong>Nombre:</strong></td> 
            <td><input type="text" id="seller_name" name="seller_name" maxlength="25"></td>
        </tr>
            
        <tr>
            <td><strong>Apellido:</strong></td> 
            <td><input type="text" id="seller_lastname" name="seller_lastname" maxlength="25"></td>
        </tr>
        
        <tr>
            <td><div id="user_id_div"><strong>Cedula:</strong></div></td>
            <td><input type="text" id="seller_id" name="seller_id" maxlength="25"></td>
        </tr>
        
        <tr>
            <td><strong>Correo Electr&oacute;nico: </strong></td> 
            <td><input type="text" id="email" maxlength="100"></td>
        </tr>
        
        <tr>
            <td><div id="user_name_div"><strong>Nombre de Usuario:</strong></div></td>
            <td><input type="text" id="nick_name" maxlength="100"></td>
        <tr>
        
        <tr>
            <td><strong>Tipo:</strong></td> 
            <td>	<select id="seller_type">
                        <option value="seller">Vendedor</option>
                        <option value="manager">Administrador&nbsp;&nbsp;&nbsp;</option>
                    </select>
            </td>
        </tr>
        
        <tr>
            <td><div id="pass_div"><strong>Password:</strong></div></td>
            <td><input type="password" id="password" name="password" maxlength="16"></td>
        </tr>
        
        <tr>
        	<td></td>
            <td>
                <a href="javascript:void(0);">
                    <img src="<?php echo IMG; ?>bprocesar.jpg" onClick="add_seller();">
                </a>
            </td>
        </tr>
    </table>
    
</div><!--asociar_c-->
</div><!--datos-->


<?php
$this->load->view('global/management_close');
?>

</body>
</html>
</div>