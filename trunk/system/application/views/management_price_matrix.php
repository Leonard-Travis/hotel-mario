<?php
$this->load->view('global/header');
?>

<script>
function confirmar(){
	if (confirm('¿Seguro desea eliminar la Matriz de Precio?')){
		return true;
	}
	else return false;
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

<?php if ($query) {?>
<div class="separadorv"></div><div class="separadorv"></div>
		<form method="post" action="<?php echo base_url(); ?>price_matrix/index/1">
    <div id="asociar_c">
    <ul>
        <li class="li_tit_1"><img src="http://localhost/hotel-mario/designed_views/imagenes/zoom.png" alt="Buscador de Cliente" class="valign" />Seleccione un Hotel</li> 
		<li>	<select name="hotels" id="hotels">
			<?php foreach ($query as $hotel) { ?>
				<option value="<?php echo ($hotel['hotel_id']);?>"><?php echo ($hotel['name']);?></option> 
			<?php }?>
			</select> </div>
			<input name="send" type="submit" value="Aceptar" /> </td> </li>
		</form>
<?php }?>

<?php $hotel_id; 
	  if ($hotel_selected) {?>
      	<?php foreach ($hotel_selected as $hotel_selected) { 
        			$hotel_id = $hotel_selected['hotel_id'];?>
        <?php } ?>

	<div class="separador"></div>
	<div class="separadorv_gris"></div>
    
<div id="new_matrix" name="new_matrix">
    <table width="100%">
    <tr> <td align="center"><img src="http://localhost/hotel-mario/designed_views/imagenes/bagregar.jpg" onclick="new_matrix(<?php echo($hotel_id);?>)"/></td>
         <td align="center"><img src="http://localhost/hotel-mario/designed_views/imagenes/bbuscar.jpg"/></td>
    </tr>
    </table>
</div>

	<div class="separador"></div>
	<div class="separadorv_gris"></div>
       
	<?php if ($all_matrices != 'empty') { 
              foreach ($all_matrices as $value) { ?>
			  	<?php $prices_id = "";?>
              	<table width="40%">
                <br /><br />
                <tr> <td><strong>Plan:</strong></td> <td><?php echo($value['plan_name']); ?></td> </tr>
                <tr> <td><strong>Desde:</strong></td> <td> <?php echo($value['date_start']); ?></td> 
                     <td><strong>Hasta:</strong></td> <td> <?php echo($value['date_end']); ?></td> </tr>
                <?php $gray_row = TRUE; ?>
                <table border="1" width="100%">
                    <tr> 
                    <td width="14.7%" align="center"><strong>Habitacion</strong></td>
                    <td align="center"><strong>Precio</strong></td>
                    </tr>
                    <?php foreach ($value['prices'] as $price)  { ?>                    	
                        <?php if ($gray_row){?>
                             <tr bgcolor="#CCCCCC">
                             <?php $gray_row = false;
                          }
                          else{  ?>
                             <tr>
                             <?php $gray_row = true;
                          }?>
                        <td width="14.7%" align="center"><?php echo ($price['room_name']); ?></td>
                        <td align="center"><?php echo ($price['price_per_night']); ?></td> 
                        </tr>    
						<?php $prices_id = $prices_id.'|'.$price['price_id']?> 
                    <?php } ?>				
                </table> 
        <form method="post" action="<?php echo base_url(); ?>price_matrix/delete_matrix">
        <input type="hidden" name="prices_id" id="prices_id" value="<?php echo($prices_id); ?>"  />
        <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo($hotel_id);?>"/>
        <input type="submit" value="Eliminar"  onclick="return confirmar();"/>
        </form>               
        <?php } ?> <!-- end of foreach ($all_matrices as $value) -->
    <?php }  // end of if ($all_matrices != 'empty')
    else { ?>
        El hotel <strong><?php echo ($hotel_selected['name']);?></strong> no tiene precios de habitaciones disponibles.
    <?php } ?>
<?php } ?>
<?php
$this->load->view('global/management_close');
?>

</body>
</html>