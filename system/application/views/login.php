<div id="login">

<?php if($this->session->userdata('type')) { ?>

<script type="text/javascript">
alert('Su sesion sera desconectada');
</script>

<?php $this->session->sess_destroy(); } ?>	


<!--<!DOCTYPE html>
<html lang="en">
<head>
	<link type="text/css" href="http://localhost/hotel-mario/js/jquery/themes/base/jquery.ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="http://localhost/hotel-mario/js/jquery/jquery-1.4.2.js"></script>
<script type="text/javascript" src="http://localhost/hotel-mario/js/jquery/jquery.ui.core.js"></script>
<script type="text/javascript" src="http://localhost/hotel-mario/js/jquery/jquery.ui.widget.js"></script>

<script type="text/javascript" src="http://localhost/hotel-mario/js/jquery/jquery.ui.position.js"></script>
<script type="text/javascript" src="http://localhost/hotel-mario/js/jquery/jquery.ui.autocomplete.js"></script>

<link type="text/css" href="http://localhost/hotel-mario/js/jquery/demos.css" rel="stylesheet" />
	<script type="text/javascript">
	$(function() {
		var availableTags = ["ActionScript", "AppleScript", "Asp", "BASIC", "C", "C++", "Clojure", "COBOL", "ColdFusion", "Erlang", "Fortran", "Groovy", "Haskell", "Java", "JavaScript", "Lisp", "Perl", "PHP", "Python", "Ruby", "Scala", "Scheme"];
		$("#tags").autocomplete({
			source: availableTags
		});
	});
	</script>
</head>
<body>
	
<div class="demo">

<div class="ui-widget">
	<label for="tags">Tags: </label>
	<input id="tags" />
</div>

</div><!-- End demo -->

</body>
</html>-->







	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Hoteles.com.ve</title>
	<link type="text/css" href="themes/redmond/ui.all.css" rel="stylesheet" />
    <script type="text/javascript" src="http://localhost/hotel-mario/js/hotel_js.js"></script>
	<link type="text/css" href="demos.css" rel="stylesheet" />
	<link href="http://localhost/hotel-mario/designed_views/estilos.css" rel="stylesheet" type="text/css" />
	</script>

	<link type="text/css" href="http://localhost/hotel-mario/js/jquery/themes/base/jquery.ui.all.css" rel="stylesheet" />
	<script type="text/javascript" src="http://localhost/hotel-mario/js/jquery/jquery-1.4.2.js"></script>
</head>

<body>
<div id="cintillo">
	<div class="cuerpo">
		<a href="#" class="logo">Hoteles.com.ve</a>
		<div class="palito"><img src="http://localhost/hotel-mario/designed_views/imagenes/palito.gif" alt="" /></div>
		<div class="floati">Gestion de servicios</div>
	</div>
</div>


<div class="separadorv"></div>

<div class="cuerpo">
	<div class="floati">
		<div id="tablappa1">
			<div id="asociar">
            <img src="http://localhost/hotel-mario/designed_views/imagenes/tabla1.jpg" alt="" class="floati valign" />
            <img src="http://localhost/hotel-mario/designed_views/imagenes/user_orange.png" alt="Agregar Hoteles" class="valign" /> LOGIN
            
            <img src="http://localhost/hotel-mario/designed_views/imagenes/tabla3.jpg" alt=""  class="floatd valign"/>
            </div>
            
            <div id="asociar2" >
            <br /><br /> 
            <table id="user_table" align="center">
            	<tr> 
                <td>Usuario:</td>
                <td><select id="user_type" name="user_type">
                	<option value="manager">Administrador&nbsp;&nbsp;&nbsp;</option>
                    <option value="seller" selected>Vendedor</option>
                    </select>	
                </td>
                </tr>
                <tr> 
                <td>Cedula:</td>
                <td><input type="text" id="user_id" name="user_id" maxlength="7"></td>
                </tr>
                <tr> 
                <td>Password:</td>
                <td><input type="password" id="user_password" name="user_password" maxlength="6"></td>
                </tr>
                <tr></tr><tr></tr><tr></tr>
                <tr>
                <td></td><td align="right">
                	<input type="image" src="http://localhost/hotel-mario/designed_views/imagenes/bprocesar.jpg" onClick="login();" id="login_img" name="login_img">
                </td>
                </tr>
            </table>
            </div>
            
            <div class="separador"></div>
			<div class="tpiec"><img src="http://localhost/hotel-mario/designed_views/imagenes/esq1.gif" alt="" /><img src="http://localhost/hotel-mario/designed_views/imagenes/esq3.gif" alt="" class="floatd" /></div>
			<div class="separadorv"></div>
        </div>
    </div>
</div>

</div>