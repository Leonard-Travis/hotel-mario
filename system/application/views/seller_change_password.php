<ul class="ul_tit_2">    
    <li class="li_tit_2">Contrase&ntilde;a Actual</li>
    <li>
        <div class="cajat">
           <input type="password" id="current_password" name="current_password" 
                           onchange="check_seller_password(<?php echo $this->session->userdata('password'); ?>);"/>
        </div> 
    </li>
    <li>
    	<div id="check_password_div"></div>
    </li>
    
    <li class="li_tit_2">Contrase&ntilde;a Nueva</li>
    <li>
        <div class="cajat">
           <input type="password" id="new_password" name="new_password"/>
        </div>
    </li>
    
    <li class="li_tit_2">Repetir Contrase&ntilde;a Nueva</li>
    <li>
        <div class="cajat">
           <input type="password" id="new_password2" name="new_password2" onchange="check_password_idem();"/>
        </div>
    </li>
    <li>
        <div id="check_new_password2_div"></div>
    </li>
    
    <li class="li_tit_2"></li>
    <li>
        <input type="image" src="<?php echo IMG; ?>bprocesar.jpg" onclick="change_password(1);" />
    </li>
</ul>
           