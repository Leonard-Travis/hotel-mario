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
  
//valida que el campo no este vacio y no tenga solo espacios en blanco  
function valida(F) {
	
    	if (vacio(F.description.value) == false) {  
                alert("Debe introducir la descripcion del Plan")  
                return false  
        } else {
				if (validarEmail(F.email.value) == true)
                	return true
				else return false;
        }  
          
}
</script>

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
	
<?php if ($query) {?>
<div id="asociar2">
	<div class="separadorv"></div><div class="separadorv"></div>
	<h1><strong>Asociacion Hotel con Plan</strong></h1>
    

	<ul>
	<?php foreach ($query as $hotel) { ?>
        
        <table align="center" width="60%">
        <tr>
        <td>Nombre</td>
        <td><span class="rojo"><?php echo($hotel['name']); ?></span></td>
        <tr>
                <td>Plan a <strong>asociar</strong></td> 
                <td>		
            <form method="post" action="<?php echo base_url(); ?>hotels/associate_plan" onSubmit="return valida(this);">
                <select name="plans" id="plans">
                <?php foreach ($plans as $plan) { ?>
                    <option value="<?php echo ($plan['plan_id']);?>"><?php echo ($plan['name_spanish']);?></option> 
                <?php }?>
                </select>
                </td> 
                </tr>
                <tr>
                <td>Descripcion del Plan</td> 
                <td><textarea name="description" cols="24" rows=""  maxlength="50" ></textarea>
                	<img src="<?php echo IMG; ?>exclamation.png" /></td>
                </tr>
                <tr>
                <td> <input name="send" type="submit" value="Aceptar" /> </td> </tr>
                <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo($hotel['hotel_id']); ?>"  />
            </form>
        </table>
    <?php }?>
</ul>
</div>
<?php }?>

<?php
$this->load->view('global/management_close');
?>

</body>
</html>