<?php
$this->load->view('global/header');
?>

<script>
function vacio(q) {  
        for ( i = 0; i < q.length; i++ ) {  
                if ( q.charAt(i) != " " ) {  
                        return true  
                }  
        }  
        return false  
}  
   
function valida(F) {	
    	if ((vacio(F.name.value) == false) || (vacio(F.name_english.value) == false)){  
                alert("Ha dejado uno o mas de los campos OBLIGATORIOS vacios.")  
                return false  
        } else {
			return true;
        }  
          
}
</script>

<div id="menu">
	<div class="cuerpo">
		<ul>
			<li><a href="<?php echo base_url(); ?>customer/search_form">Clientes</a></li>
			<li class="mfocus">
				<img src="http://localhost/hotel-mario/designed_views/imagenes/f1.png" alt="" class="floati" />
				<div class="mf_texto">Gestion</div>
				<img src="http://localhost/hotel-mario/designed_views/imagenes/f3.png" alt="" class="floati" />
            </li>
			<li><a href="<?php echo base_url(); ?>price_matrix/index/0">Matriz de Precios</a></li>
		</ul>
	</div>
</div>
<div id="menu2">
</div>
<div class="separadorv"></div>

<?php
$this->load->view('global/management_bar');
?>

<table>
<tr>
<td> 
<form method="post" action="<?php echo base_url(); ?>plans/new_plan" >  
<input name="enviar" type="submit" value="Nueva Plan" />
</form>
</td>
<tr>
</table>      
<?php if ($plan_to_change) {?>
     <form method="post" action="<?php echo base_url(); ?>plans/save_modified_plan" onsubmit="return valida (this);">
     
     <table align="center" width="50%">
     <?php foreach ($plan_to_change as $plan_to_change) { ?>
     	<tr> <td colspan="3" align="center"><strong>Datos del Plan</strong></td> </tr>
        <tr>
        <td>Nombre Español</td> <td><input type="text" name="name" id="name" value="<?php echo ($plan_to_change['name_spanish']);?>" maxlength="30" size="40" /></td>
    <td><img src="http://localhost/hotel-mario/designed_views/imagenes/exclamation.png" /></td> 
        </tr> 
        <tr>
        <td>English Name</td> <td><input type="text" name="name_english" id="name_english" value="<?php echo ($plan_to_change['name_english']);?>" maxlength="30" size="40" /></td>
    <td><img src="http://localhost/hotel-mario/designed_views/imagenes/exclamation.png" /></td> 
        </tr>         
      <input type="hidden" name="plan_id" id="plan_id" value="<?php echo ($plan_to_change['plan_id']);?>"  />
     <?php }?>
     <tr> <td><input type="submit" value="Procesar"  /></td> </tr>
     </table>
     </form
><?php }?>
     
<?php
$this->load->view('global/management_close');
?>
</body>
</html>