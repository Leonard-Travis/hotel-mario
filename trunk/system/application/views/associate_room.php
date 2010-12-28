<?php
$this->load->view('global/header');
?>

<script>
function validarNum(valor) {
re=/^([0-9])*$/

    if(!re.exec(valor))    {
        alert("Debe introducir la capacidad completamente numerica");
		return false;
    }else{
		return true;
    }
}

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
	
    	if ((vacio(F.description.value) == false) || (vacio(F.capacity.value) == false)) {  
                alert("Ha dejado uno o mas campos obligatorios vacios")  
                return false  
        } else {
				if (validarNum(F.capacity.value) == true)
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

<script type="text/javascript">
	$(function() {
		var availableTags = new Array();
		<?php for($i=0; $i <  count($rooms) ; $i++){?>
			availableTags[<?php echo($i); ?>] = {label: "<?php echo($rooms[$i]['name_spanish']);?>",
												 value: "<?php echo($rooms[$i]['room_id']);?>"};
		<?php } ?>	
		
		$('#tags').autocomplete({
			minLength: 0,
			source: availableTags,
			focus: function(event, ui) {
				$('#tags').val(ui.item.label);
				return false;
			},
			select: function(event, ui) {
				$('#tags').val(ui.item.label);
				$('#rooms').val(ui.item.value);				
				return false;
			}
		});
	});
</script>

<div id="asociar2">
	<div class="separadorv"></div><div class="separadorv"></div>
	<h1><strong>Asociacion Hotel con Habitacion</strong></h1>
    

<?php foreach ($query as $hotel) { ?>
    <table align="center" width="70%">
        <tr>
            <td>Nombre</td>
            <td><span class="rojo"><?php echo($hotel['name']); ?></span></td>
        </tr>
        <tr>  
            <td>Habitacion a <strong>asociar</strong></td>
            
     <form method="post" action="<?php echo base_url(); ?>hotels/associate_room" onSubmit="return valida(this);">
            <td>
            	<input id="tags" />
                <input type="hidden" id="rooms" name="rooms" />
            </td>
        </tr>
        <tr>
            <td>Descripcion de la Habitacion</td> 
            <td><textarea name="description" cols="24" rows=""  maxlength="50" ></textarea>
            <img src="<?php echo IMG; ?>exclamation.png" /></td>
        </tr>
        <tr>
            <td>Capacidad de la Habitacion</td> 
            <td><input type="text" name="capacity" maxlength="2" size="3"/>
            <img src="<?php echo IMG; ?>exclamation.png" /></td>
        </tr>
        <tr>
        <td>Es comisionable para el hotel?</td>        
        <td> <input type="radio" name="commissionable" id="commissionable" value="1" checked="checked" />SI 
        	 <input type="radio" name="commissionable" id="commissionable" value="0" />NO</td>
        </tr>
        <tr> 
        <td><input name="send" type="submit" value="Aceptar" /></td>
        </tr> 
        <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo($hotel['hotel_id']); ?>"  />
    </table>
    </form>
    <?php }?>
</div>
<?php }?>

<?php
$this->load->view('global/management_close');
?>
   

</body>
</html>