<div id="quotation">
<?php
$this->load->view('global/header');
?>

<script>

function validarNum(valor) {
re=/^([0-9])*$/

    if(!re.exec(valor))    {
        alert("La busqueda debe ser por cedula");
		return false;
    }else{
		return true;
    }
}

function confirmar(){
	if (confirm('¿Seguro desea eliminar el Cliente?')){
		return true;
	}
	else return false;
}
</script>

<div id="menu">
	<div class="cuerpo">
		<ul>
        	<li class="mfocus">
				<img src="http://localhost/hotel-mario/designed_views/imagenes/f1.png" alt="" class="floati" />
				<div class="mf_texto">Clientes</div>
				<img src="http://localhost/hotel-mario/designed_views/imagenes/f3.png" alt="" class="floati" />
            </li>

			<li><a href="<?php echo base_url(); ?>home/management">Gestion</a></li>
			<li class="palito"><img src="http://localhost/hotel-mario/designed_views/imagenes/naranja3.gif" alt="" /></li>
			<li><a href="<?php echo base_url(); ?>price_matrix/index/0">Matriz de Precios</a></li>
            <li class="palito"><img src="http://localhost/hotel-mario/designed_views/imagenes/naranja3.gif" alt="" /></li>
            <li><a href="<?php echo base_url(); ?>quotation/new_quote/0">Cotizaciones</a></li>
		</ul>
	</div>
</div>
<div id="menu2">
</div>
<div class="separadorv"></div>
</body>
</html>

<?php echo validation_errors(); ?>
<div class="separadorv"></div><div class="separadorv"></div>
<form name="searchForm" onsubmit="return validarNum(this.ci_client.value);">
<div id="asociar_c">
    <ul>
        <li class="li_tit_1"><img src="http://localhost/hotel-mario/designed_views/imagenes/zoom.png" alt="Buscador de Cliente" class="valign" onclick="search_client();" />Buscador de Cliente</li> 
		<li> <div class="cajat"> <input type="text" name="ci_client" id="ci_client" value="Ejem: 18888888" onclick="document.searchForm.ci_client.value ='';" maxlength="10"/></div>
             <input name="enviar" type="button" value="Seleccionar" onclick="search_client(document.searchForm.ci_client.value);" /> </li> 
        <li class="li_tit_1"> &nbsp;&nbsp;<a href="#" onclick="new_client(0);"><img src="http://localhost/hotel-mario/designed_views/imagenes/add.png" alt="Agregar" class="valign" />Agregar Cliente Nuevo</a>    </li>
     </ul>  
</div>
</form>    
    
<div id="customer"></div>
    
<div id="existing_quotation">
</div>
    
<div id="cot" name="cot"></div>
     
</div>
</body>
</html>