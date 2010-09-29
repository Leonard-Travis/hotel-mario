<?php
$this->load->view('global/header');
?>
<div id="menu">
	<div class="cuerpo">
		<ul>
			<li><a href="<?php echo base_url(); ?>customer/search_form">Clientes</a></li>
			<li class="palito"><img src="http://localhost/hotel-mario/designed_views/imagenes/naranja3.gif" alt="" /></li>
			<li><a href="<?php echo base_url(); ?>home/management">Gestion</a></li>
            <li class="mfocus">
				<img src="http://localhost/hotel-mario/designed_views/imagenes/f1.png" alt="" class="floati" />
				<div class="mf_texto">Matriz de Precios</div>
				<img src="http://localhost/hotel-mario/designed_views/imagenes/f3.png" alt="" class="floati" />
            </li>
            <li><a href="<?php echo base_url(); ?>quotation/new_quote/0">Cotizaciones</a></li>
		</ul>
	</div>
</div>
<div id="menu2">
</div>
<div class="separadorv"></div>

<div class="cuerpo">
	<div class="floati">
		<div id="tablappa1"> <!-- usar id="tablappa2" cuandos e quiera que ocupe toda la ventana y eliminar el <div id="calendario">
									en todo caso el ancho completo es de 950 px-->
			<div id="matriz">
				<img src="http://localhost/hotel-mario/designed_views/imagenes/tabla1.jpg" alt="" class="floati valign" />
				Matriz de Precios
				<img src="http://localhost/hotel-mario/designed_views/imagenes/tabla3.jpg" alt=""  class="floatd valign"/>
			</div>
			<div class="separador"></div>
			<div id="matriz2">

<?php if ($query) {?>
<div class="separadorv"></div><div class="separadorv"></div>
		<form method="post" action="<?php echo base_url(); ?>price_matrix/index/0">
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
				
<?php if ($hotel_selected) {?>
	<div class="separador"></div>
	<div class="separadorv_gris"></div>

    <form name="form1" method="post" action="<?php echo base_url(); ?>price_matrix/price_matrix_data/0">
        <br  />
        <table width="40%">
        <?php foreach ($hotel_selected as $hotel_selected) { ?>
        <tr>
        <td>Hotel:</td> <td><input type="text" name="name" id="name" size="40" readonly="readonly" value="<?php echo ($hotel_selected['name']);?>" /></td>
        </tr>        
        <tr>
        <td>Plan:</td>
        <td>
        <?php if (count ($plans) == 0){?>
                <strong>No hay planes relacionados</strong> </td> </tr>
                <input type="hidden" name="plan" id="plan" value="no_plan"  />
        <?php }
              else { ?>
                <select name="plan" id="plan" >
                <?php foreach ($plans as $plan) { ?>
					<option value="<?php echo ($plan['plan_id']); ?>"> <?php echo ($plan['name_spanish']); ?> </option>
                <?php }?> <!-- end of foreach $plans --> 
                </select>
        <?php }?> <!-- end of else -->
        </td>
        </tr>
        <tr> 
        <td>Desde:</td> <td><input type="text" name="date_ini" id="date_ini" onclick="popUpCalendar(this, form1.date_ini, 'yyyy-mm-dd')" readonly="readonly" /></td>
        <td>Hasta:</td> <td><input type="text" name="date_end" id="date_end" onclick="popUpCalendar(this, form1.date_end, 'yyyy-mm-dd')" readonly="readonly" /></td>
        </tr>
        <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo ($hotel_selected['hotel_id']);?>"  />
        <?php }?> <!-- end of foreach $hotel_selected -->
        <tr> <td><input type="submit" value="Buscar"/></td>
    </form> <!-- end of form price_matrix_data -->
    </table>
<?php }?>

</div>
			<div class="separador"></div>
			<div class="tpiec"><img src="http://localhost/hotel-mario/designed_views/imagenes/esq1.gif" alt="" /><img src="http://localhost/hotel-mario/designed_views/imagenes/esq3.gif" alt="" class="floatd" /></div>
			<div class="separadorv"></div>
		</div>
	</div>


</body>
</html>