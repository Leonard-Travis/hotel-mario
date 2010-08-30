// JavaScript Document
var counter = 0;
var subtotal = 0;
var capacity_total = 0;
var customer_id;
var rooms_selected = new Array();
var hotel_id = '';
var date_start = '';
var date_end = '';
var plan_id = '';
var persons = '';
var season_name = '';

function test(){
	if (confirm('amame!')){
		return true;
	}
	else return false;
}

function quote(client_id, quote_type){
	 customer_id = client_id;
     new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/'+quote_type,{
      method: 'post',
      parameters: {},
	  asynchronous: true,
      onSuccess: function(consultadoA){
		 $(quote_type).update(consultadoA.responseText);
      }
      }
   );
}

function hotel_info(){
	var hotel_id = $F('hotels');
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/hotel_selected_quote',{
      method: 'post',
      parameters: {hotel_id : hotel_id,
	  			   customer_id : customer_id
		  			},
	  asynchronous: true,
      onSuccess: function(consultadoA){
		 $('hotel_quote').update(consultadoA.responseText);
      }
      }
   );
}

function start_quote(){
	var clean_array = new Array();
	rooms_selected = clean_array;
	subtotal = 0;
	capacity_total = 0;
	counter = 0;
	plan_id = $F('plan');
	date_start = $F('date_start');
	date_end = $F('date_end');
	hotel_id = $F('hotel_id');
	persons = $F('persons');
	
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/start_quote/0',{
      method: 'post',
      parameters: {hotel_id : hotel_id,
	  			   plan_id : plan_id,
				   date_ini : date_start,
				   date_end : date_end,
				   counter : 0
		  			},
	  asynchronous: true,
      onSuccess: function(consultadoA){
		 $('quote_details_form').update(consultadoA.responseText);
		 $('add_quote_button').update('<input type="image"  src="http://localhost/hotel-mario/designed_views/imagenes/bagregar.jpg" onclick="process_quote_hotel();"/>');
      }
      }
   );	
}

function setting_PU(countaux){
	rooms_selected[countaux] = new Array();
	var room = $F('rooms'+countaux);
	var flag_room = true;
	rooms_selected[countaux]['room'] = '';
	rooms_selected[countaux]['capacity'] = '';
	
	for (i=0; i < room.length; i++){
		if ((flag_room == true) && (room[i] != '|'))
			rooms_selected[countaux]['room'] += room[i];
		else if ((flag_room == false) && (room[i] != '|'))
			rooms_selected[countaux]['capacity'] += room[i];
		else if (room[i] == '|')
			flag_room = false;
	}
	rooms_selected[countaux]['capacity'] = parseInt(rooms_selected[countaux]['capacity']);
	
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/setting_PU',{
      method: 'post',
      parameters: {room : rooms_selected[countaux]['room'],
	  			   date_start : date_start,
				   date_end : date_end,
				   plan : plan_id
		  			},
	  asynchronous: true,
      onSuccess: function(consultadoA){
		  $('price_per_night'+countaux).update(consultadoA.responseText);
		  rooms_selected[countaux]['PU'] = consultadoA.responseText;
		  $('subtotal'+countaux).update('');
      }
      }
   );
}

function calculate_sub(){
	subtotal = 0;
	capacity_total = 0;
	for (i=0; i < rooms_selected.length; i++){
		if (rooms_selected[i]){
			subtotal += rooms_selected[i]['subtotal'];
			capacity_total += ((rooms_selected[i]['capacity']*rooms_selected[i]['quantity']));
		}
	}
}

function setting_subtotal(countaux){
	rooms_selected[countaux]['quantity'] = parseInt($F('quantity'+countaux));
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/setting_subtotal',{
      method: 'post',
      parameters: {room : rooms_selected[countaux]['room'],
	  			   date_start : date_start,
				   date_end : date_end,
				   plan : plan_id,
				   quantity : rooms_selected[countaux]['quantity']
		  			},
	  asynchronous: true,
      onSuccess: function(consultadoA){
		  rooms_selected[countaux]['subtotal'] = parseFloat(consultadoA.responseText);
		  calculate_sub();
		  $('subtotal'+countaux).update('BsF. '+consultadoA.responseText);
		  $('total'+counter).update('---------------- <br />BsF.'+subtotal);
	  }
      }
   );
}

function add_room(){ 	
	$('total'+counter).update('');
	counter = counter + 1;
	
	var imploded = 0;
	if (rooms_selected[0]){
		for (i=0; i<rooms_selected.length; i++) {
			imploded += '|' + rooms_selected[i]['room'];
		}
	}
		
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/start_quote/1',{
      method: 'post',
      parameters: {hotel_id : hotel_id,
	  			   plan_id : plan_id,
				   date_ini : date_start,
				   date_end : date_end,
				   counter : counter,
				   rooms_selected : imploded
		  			},
	  asynchronous: true,
      onSuccess: function(consultadoA){		  
		var tr = document.createElement("tr"); //create object <TR> 
		tr.innerHTML = consultadoA.responseText; 
		obj1 = document.getElementById("quote_hotel_table"); 
		obj1.lastChild.appendChild(tr);	
		$('total'+counter).update('---------------- <br />BsF. '+subtotal);
      }
      }
   );

}

function process_quote_hotel(){	
	calculate_sub();
	
	if (capacity_total >= persons){
		var imploded = '';
		if (rooms_selected[0]){
			for (i=0; i<rooms_selected.length; i++) {
				imploded += rooms_selected[i]['room'] + '|' + rooms_selected[i]['quantity']+ '|' + rooms_selected[i]['PU']+ '|' + rooms_selected[i]['subtotal'] + '||';
			}
		}
		
		new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/hotel_summary',{
		  method: 'post',
		  parameters: {rooms_selected : imploded,
					   subtotal : subtotal
						},
		  asynchronous: true,
		  onSuccess: function(consultadoA){	
				$('quote_details_form').update(consultadoA.responseText);
				$('add_quote_button').update('<td class="ntd"> <input type="image" name="procesar" id="procesar" src="http://localhost/hotel-mario/designed_views/imagenes/bprocesar.jpg" onclick="save_quote()"/>	</td>');
		  }
		  }
	   );
	
	}
	else {
		alert('La capacidad total de las habitaciones ('+capacity_total+') debe ser igual o mayor a las cantidad de adultos ('+persons+') a ospedarse');
	}

}

function save_quote(){
	var imploded = '';
	if (rooms_selected[0]){
		for (i=0; i<rooms_selected.length; i++) {
			imploded += rooms_selected[i]['room'] + '|' + rooms_selected[i]['quantity']+ '|' + rooms_selected[i]['PU']+ '|' + rooms_selected[i]['subtotal'] + '||';
		}
	}
	
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/save_quote',{
      method: 'post',
      parameters: {plan_id : plan_id,
				   date_start : date_start,
				   date_end : date_end,
		    	   rooms_selected : imploded,
	  			   subtotal : subtotal
		  			},
	  asynchronous: true,
      onSuccess: function(consultadoA){	
	  		alert('La cotizacion de Hotel ha sido procesado exitosamente');
			$('add_quote_button').update('');
      }
      }
   );
}

function drop_element_from_quote(rooms_hotels_id){
	if (confirm('¿Desea eliminar el elemento de la cotizacion?')){
		for (i=0; i<rooms_selected.length; i++) {
				if(rooms_selected[i]['room'] == rooms_hotels_id){
					rooms_selected.splice(rooms_selected[i],1);
				}
				
			}
			
		if (rooms_selected.length > 0)	process_quote_hotel();
		else start_quote();
	}
	else return false;
}

function new_matrix(hotel_selected_id){
	hotel_id = hotel_selected_id;
	$('new_matrix').update('<table width="100%"> <tr> <td align="center"><input type="button" value="Agregar nueva Season" onclick="new_matrix_season();"></td> <td align="center"><input type="button" value="Agregar a Season existente" onclick="add_matrix_to_season();"></td> </table>');
}

function new_matrix_season(){
	new Ajax.Request('http://localhost/hotel-mario/index.php/price_matrix/new_matrix_season',{
      method: 'post',
      parameters: {hotel_selected_id : hotel_id },
	  asynchronous: true,
      onSuccess: function(consultadoA){	
	  		$('new_matrix').update(consultadoA.responseText);
      }
      }
   );
}

function validate_dates(){
	date_start = $F('date_ini');
	date_end = $F('date_end');
	plan_id = $F('plan');
	season_name = $F('season_name');
	counter = 0;
	
	new Ajax.Request('http://localhost/hotel-mario/index.php/price_matrix/validate_dates',{
      method: 'post',
      parameters: {hotel_id : hotel_id,
				   date_ini : date_start,
				   date_end : date_end},
	  asynchronous: true,
      onSuccess: function(consultadoA){	
	  		if (consultadoA.responseText == '')	alert('Las fechas dadas se solapan con seasons existentes');
			else{
				$('validate_check').update('<img src="http://localhost/hotel-mario/designed_views/imagenes/tick.png"/>');
	  			$('new_matrix_data').update(consultadoA.responseText);
				
				new_matrix_add_room();
				
				$('process_new_matrix_button').update('<div class="separadorv"></div> <div class="tit2"> <input type="image" name="Agregar" id="Agregar" src="http://localhost/hotel-mario/designed_views/imagenes/bprocesar.jpg"  onclick="process_new_matrix();"/> </div> <div class="separador"></div>');
			}
      }
      }
   );
}

function new_matrix_add_room(){
	counter = counter + 1;
	new Ajax.Request('http://localhost/hotel-mario/index.php/price_matrix/new_matrix_add_room',{
      method: 'post',
      parameters: {hotel_id : hotel_id,
	  			   counter : counter},
	  asynchronous: true,
      onSuccess: function(consultadoA){	
	  		var tr = document.createElement("tr"); //create object <TR> 
			tr.innerHTML = consultadoA.responseText; 
			obj1 = document.getElementById("new_matrix_table"); 
			obj1.lastChild.appendChild(tr);
      }
      }
   );
	
}

function process_new_matrix(){
	var new_matrix = '';	
	for (i=1; i <= counter; i++){
		if ($F('price'+i) != ''){
			new_matrix += $F('rooms'+i)+'|'+$F('price'+i)+'|';
			if ($F('monday_price'+i) != ''){
				new_matrix += '1|'+$F('monday_price'+i)+'|'+$F('tuesday_price'+i)+'|'+$F('wednesday_price'+i)+'|'+$F('thrusday_price'+i)+'|'+$F('friday_price'+i)+'|'+$F('saturday_price'+i)+'|'+$F('sunday_price'+i)+'||';
			}
			else new_matrix += '0||';
		}
	}
	
	alert(new_matrix);
	
	new Ajax.Request('http://localhost/hotel-mario/index.php/price_matrix/process_new_matrix',{
      method: 'post',
      parameters: {hotel_id : hotel_id,
	  			   plan_id : plan_id,
				   date_start : date_start,
				   date_end : date_end,
				   season_name : season_name,
				   new_matrix : new_matrix},
	  asynchronous: true,
      onSuccess: function(consultadoA){	
	  		$('new_matrix_data').update(consultadoA.responseText);
	  		alert('Matriz agregada con exito!');
      }
      }
   );
}

function add_matrix_to_season(){
	alert('add_matrix_to_season');
}






