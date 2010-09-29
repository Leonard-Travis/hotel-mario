<?php
$this->load->view('global/header');
?>

<script>
function confirmar(){
	if (confirm('¿Seguro desea eliminar la habitacion?')){
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
            <li class="palito"><img src="http://localhost/hotel-mario/designed_views/imagenes/naranja3.gif" alt="" /></li>
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

<table>
<tr>
<td> 
<form method="post" action="<?php echo base_url(); ?>plans/new_plan">  
<input name="enviar" type="submit" value="Nuevo Plan" />
</form>
</td>
<tr>
</table>

<table width="80%" align="center">
    <tr>
    <td align="center"><strong>Nombre Español</strong></td>
    <td align="center"><strong>English Name</strong></td>
    <td align="center" width="17px"></td>
    <td align="center" width="17px"></td> 
    </tr>
    <?php $gray_row = TRUE;?>
    <?php foreach ($query as $plan) { ?>
		<?php if ($gray_row){?>
        		 <tr bgcolor="#CCCCCC">
        		 <?php $gray_row = false;
        	  }
              else{  ?>
        		 <tr>
        		 <?php $gray_row = true;
        	  }?>
        
        <td align="center"><?php echo ($plan['name_spanish']);?></td>
        <td align="center"><?php echo ($plan['name_english']);?></td>
        <td align="center"> <a href="<?php echo base_url(); ?>plans/modify_plan/<?php echo ($plan['plan_id']);?>"><img src="http://localhost/hotel-mario/system/application/views/img/modificar.png" /></a></td>
        <td align="center"> <a href="<?php echo base_url(); ?>plans/delete_plan/<?php echo ($plan['plan_id']);?>"><img src="http://localhost/hotel-mario/system/application/views/img/eliminar.png" onclick="return confirmar();" /></a></td>
        </tr>
    <?php }?>
</table>

<?php
$this->load->view('global/management_close');
?>

</body>
</html>