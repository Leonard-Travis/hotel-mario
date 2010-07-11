<html> 
<head> 
<script> 
function agregarcont_fila(idTabla,arrayContenido){ 
	var tr = document.createElement("tr"); //crear objeto <TR> 
	for (i=0; i < 4; i++){ 
		var td = document.createElement("td"); //crear objeto <TD> 
		td.innerHTML = "["+(cont_fila+2)+"]["+(i+1)+"]" +arrayContenido;	//agregamos HTML al interior de <TD>
		tr.appendChild(td); 
	} 
	obj1 = document.getElementById(idTabla); 
	obj1.lastChild.appendChild(tr); 
} 

cont_fila=0; 

function agregarFila(){ 
	idtabla="tabla"; 
	contenido = new Array(); 
	contenido[contenido.length] = ""; 
	contenido[contenido.length] = "<input type='text' name='nombre_input["+cont_fila+"]["+contenido.length+"]'>";	
	contenido[contenido.length] = "<input type='text' name='nombre_input["+cont_fila+"]["+contenido.length+"]'>";
	contenido[contenido.length] = " <?php $p = 'xculo' ?><select> <option value='1'> <?php echo($p); ?> </option> <option value='2'>chao</option> </select>";
	contenido[contenido.length] = "";	
	agregarcont_fila(idtabla,contenido); 
	cont_fila++; 
} 

</script> 
</head> 
<body> 
<input type="button" name="botonx1" value="crear fila" onClick="agregarFila();"> 
<br> 
<table width="100%" border="1" id="tabla"> 
<tr> 
<td>[1][1] </td> 
<td>[1][2] </td> 
<td>[1][3] </td> 
<td>[1]-[4] </td> 
</tr> 
<tr> 
<td>[2][1]</td> 
<td>[2][2] </td> 
<td> [2]-[3] </td> 
<td>[2]-[4] </td> 
</tr> 
</table> 
<p>  </p> 
<br> 
</body> 
</html> 

<!--<html> 
<head> 
<script type="text/javascript"> 
num=0; 
function ver(fil) { 
  obj=fil.form; 
  tab = document.createElement('div');
  tab.id = 'calendario';
  tab.style.padding = "10px";
  //tab.textContent('holaaaaq');
  obj.appendChild(tab); 
  tab.style.border = "10px solid red";
} 
</script> 
</head> 
<body> 
<form id="form1" name="form1"> 
<input type="button" onClick="ver(this)" value="botooon" /> 
</form> 
</body> 
</html>-->