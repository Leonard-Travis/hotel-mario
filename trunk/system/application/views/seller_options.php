<link href="../../../designed_views/estilos2.css" rel="stylesheet" type="text/css" />

<div id="seller_options">

<?php
$this->load->view('global/header');
?>

<div id="menu">
	<div class="cuerpo">
		<ul>
        	<li><a href="<?php echo base_url(); ?>customer/search_form">Clientes</a></li>
			<li class="palito"><img src="<?php echo IMG; ?>naranja3.gif" alt="" /></li>
			<li><a href="<?php echo base_url(); ?>home/management">Gestion</a></li>
			<li class="palito"><img src="<?php echo IMG; ?>naranja3.gif" alt="" /></li>
			<li><a href="<?php echo base_url(); ?>price_matrix/index/0">Matriz de Precios</a></li>
            <li class="palito"><img src="<?php echo IMG; ?>naranja3.gif" alt="" /></li>
            <li><a href="<?php echo base_url(); ?>quotation/new_quote/0">Cotizaciones</a></li>
		</ul>
	</div>
</div>
<div id="menu2">
</div>
<div class="separadorv"></div>
<div class="separador"></div>
<div class="separadorv_gris"></div>

<div id="asociar_c">

	<h1>
    	Perfil de Usuario
    </h1>

	<div id="change_password"> <!--This div will update it's content when change password is required-->
    
		<?php 
        if($modify == 'not') $readonly = 'readonly="readonly"';
        else 				 $readonly = ''
        ?>
        <ul class="ul_tit_2">    
        
            <li class="li_tit_2">Cedula:</li>
            <li><div class="cajat">
                <input type="text" id="emp_ci" readonly="readonly" value="<?php echo($emp[0]['employees_id']);?>"/>
            </div></li>
            
            <li class="li_tit_2">Nombre:</li> 
            <li><div class="cajat">
                <input type="text" id="name" <?php echo $readonly;?> value="<?php echo ($emp[0]['name']); ?>" />
            </div>
                <?php if($modify == 'yes'){ ?>
                    <img src="<?php echo IMG;?>exclamation.png" />
                <?php } ?>
            </li>
            
            <li class="li_tit_2">Apellido:</li>
            <li><div class="cajat">
                <input type="text" id="lastname" <?php echo $readonly;?> 
                													value="<?php echo($emp[0]['lastname']); ?>" />
            </div>
                <?php if($modify == 'yes'){ ?>
                    <img src="<?php echo IMG;?>exclamation.png" />
                <?php } ?>
            </li>
            
            <li class="li_tit_2">Nombre de Usuario:</li>
            <li><div class="cajat">
                <input type="text" id="nick_name" <?php echo $readonly;?> 
                												value="<?php echo ($emp[0]['nick_name']); ?>" /> 
            </div>
                <?php if($modify == 'yes'){ ?>
                    <img src="<?php echo IMG;?>exclamation.png" />
                <?php } ?>
            </li>
            
            <li class="li_tit_2">Correo Electronico:</li>
            <li><div class="cajat">
                <input type="text" id="email" <?php echo $readonly;?> value="<?php echo ($emp[0]['email']); ?>" /> 
            </div>
                <?php if($modify == 'yes'){ ?>
                    <img src="<?php echo IMG;?>exclamation.png" />
                <?php } ?>
            </li>
            
            <li class="li_tit_2">Tipo:</li>
            <li><div class="cajat">
                <?php 	$type = ''; 
                        if($emp[0]['type'] == 'manager') $type='Gerente';
                        else $type='Vendedor';
                ?>
                <input type="text" id="type" readonly="readonly" value="<?php echo($type); ?>" /> 
            </div></li>
            
            <li class="li_tit_2">
                <a href="javascript:void(0);">
                
                <?php if($modify == 'not') {?>
                            <input type="image" src="<?php echo IMG; ?>bmodificar.jpg" 
                                            onclick="seller_modify(<?php echo($emp[0]['employees_id']); ?>);"/>
                <?php } 
                      else{?>
                            <input type="image" src="<?php echo IMG; ?>bprocesar.jpg" 
                                            onclick="seller_process(<?php echo($emp[0]['employees_id']); ?>);"/>
                 <?php } ?>
                
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" onclick="change_password(0);">Cambiar Clave</a>
            </li>
            
        </ul>
	</div> <!--end of change_password div-->
</div> <!--end of asociar_c div -->
</div> <!--end of seller options div, that starts at the top of the page-->