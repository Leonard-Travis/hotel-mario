<div id="login">

<?php if($this->session->userdata('type')) { ?>

<script type="text/javascript">
alert('Su sesion sera desconectada');
</script>

<?php $this->session->sess_destroy(); } ?>	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Hoteles.com.ve</title>
    <script type="text/javascript" src="<?php echo JSQ; ?>hotel_js.js"></script>
	<link href="<?php echo STYLE; ?>estilos.css" rel="stylesheet" type="text/css" />
	</script>

	<link type="text/css" href="<?php echo JSQ; ?>themes/base/jquery.ui.all.css" rel="stylesheet" />
	<script type="text/javascript" src="<?php echo JSQ; ?>jquery-1.4.2.js"></script>
</head>

<body>
<div id="cintillo">
	<div class="cuerpo">
		<a href="#" class="logo">Hoteles.com.ve</a>
		<div class="palito"><img src="<?php echo IMG; ?>palito.gif" alt="" /></div>
		<div class="floati">Gestion de servicios</div>
	</div>
</div>


<div class="separadorv"></div>

<div class="cuerpo">
	<div class="floati">
		<div id="tablappa1">
			<div id="asociar">
            <img src="<?php echo IMG; ?>tabla1.jpg" alt="" class="floati valign" />
            <img src="<?php echo IMG; ?>user_orange.png" alt="Agregar Hoteles" class="valign" /> LOGIN
            
            <img src="<?php echo IMG; ?>tabla3.jpg" alt=""  class="floatd valign"/>
            </div>
            
            <div id="asociar2" >
            <br /><br /> 
            <table id="user_table" align="center">
                <tr> 
                <td>Usuario:</td>
                <td><input type="text" id="user_id" name="user_id" maxlength="20"></td>
                </tr>
                <tr> 
                <td>Password:</td>
                <td><input type="password" id="user_password" name="user_password" maxlength="6"></td>
                </tr>
                <tr></tr><tr></tr><tr></tr>
                <tr>
                <td></td><td align="right">
                	<input type="image" src="<?php echo IMG; ?>bprocesar.jpg" onClick="login();" id="login_img" name="login_img">
                </td>
                </tr>
            </table>
            </div>
            
            <div class="separador"></div>
			<div class="tpiec"><img src="<?php echo IMG; ?>esq1.gif" alt="" /><img src="<?php echo IMG; ?>esq3.gif" alt="" class="floatd" /></div>
			<div class="separadorv"></div>
        </div>
    </div>
</div>

</div>