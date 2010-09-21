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

var cont_f = 1;
var flights_quote = '';

function test(){
	if (confirm('amame!....')){
		return true;
	}
	else return false;
}

function client_quote(){
	customer_id = $F('ci_client');
	
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/new_quote/'+customer_id,{
      method: 'post',
      parameters: {},
	  asynchronous: true,
      onSuccess: function(consultadoA){
		 $('quotation').update(consultadoA.responseText);
      }
      }
   );
}

function quote(client_id, quote_type){
	 if (quote_type == 'flight_quote'){
	 	cont_f = 1;
		flights_quote = '';
	 }
		
	 customer_id = client_id;
     new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/'+quote_type,{
      method: 'post',
      parameters: {cont_f : cont_f},
	  asynchronous: true,
      onSuccess: function(consultadoA){
		 $(quote_type).update(consultadoA.responseText);
      }
      }
   );
}

function add_flight(){
	cont_f = cont_f + 1;
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/flight_quote',{
      method: 'post',
      parameters: {cont_f : cont_f},
	  asynchronous: true,
      onSuccess: function(consultadoA){
		 $('flight_quote'+cont_f).update(consultadoA.responseText);
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

function new_matrix_season(hotel_selected_id){
	hotel_id = hotel_selected_id;
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
	  		alert('Matriz agregada con exito!');
				new Ajax.Request('http://localhost/hotel-mario/index.php/price_matrix/index/1',{
				  method: 'post',
				  parameters: {hotels : hotel_id},
				  asynchronous: true,
				  onSuccess: function(consultadoA){	
						$('management_price_matrix').update(consultadoA.responseText);
				  }
				  }
			   );
      }
      }
   );
}

function flight_quote_data(cont_flight){
	 var cant_adults=$F('cant_adults'+cont_flight);
	 var cant_kids=$F('cant_kids'+cont_flight);
	 
	 if (((cant_adults == '') && (cant_kids == '')) || ((cant_adults == '0') && (cant_kids == '0'))|| ((cant_adults == '') && (cant_kids == '0'))|| ((cant_adults == '0') && (cant_kids == '')))
	 	alert ('Debe haber por lo menos un pasajero');
	 else{
	 
		 new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/travelers_info',{
		  method: 'post',
		  parameters: {cant_adults : cant_adults,
					   cant_kids : cant_kids,
					   cont_flight : cont_flight},
		  asynchronous: true,
		  onSuccess: function(consultadoA){	
				$('travelers_info'+cont_flight).update(consultadoA.responseText);
		  }
		  }
		);
	 }
}

function travelers(cont_flight){	
	flights_quote += $F('origin'+cont_flight) +'|'+ $F('destination'+cont_flight) +'|'+ $F('go_date'+cont_flight) +'|'+ $F('go_time'+cont_flight) +'|'+ $F('number'+cont_flight) +'|'+ $F('airline'+cont_flight) +'|'+ $F('class'+cont_flight) +'|'+ $F('price_per_adult'+cont_flight) +'|'+ $F('price_per_kid'+cont_flight) +'|'+ $F('cant_adults'+cont_flight) +'|'+ $F('cant_kids'+cont_flight) +'|';
	
	round_trip = $F('round_trip'+cont_flight);
	
	if (round_trip){
		flights_quote += 'Y|' +$F('back_date'+cont_flight) +'|'+ $F('back_time'+cont_flight) +'|';
	}
	else flights_quote += 'N|' ;

	var cant_adults=$F('cant_adults'+cont_flight);
	var cant_kids=$F('cant_kids'+cont_flight);
	
	var adults = '';
	var kids = '';
	
	flights_quote += '|';
	
	if ((cant_adults != '0') && (cant_adults != '')){
		for (i=1; i <= parseInt(cant_adults); i++){
			adults += $F(cont_flight+'_adult'+i+'_name') + '|' + $F(cont_flight+'_adult'+i+'_lastname') + '|' + $F(cont_flight+'_adult'+i+'_ci') + '|' + $F(cont_flight+'_adult'+i+'_passport') + '|' + $F(cont_flight+'_adult'+i+'_email') + '|adult||'; 
		}
		flights_quote += adults;
	}
	
	if ((cant_kids != '0') && (cant_kids != '')){
		for (i=1; i <= parseInt(cant_kids); i++){
			kids += $F(cont_flight+'_kid'+i+'_name') + '|' + $F(cont_flight+'_kid'+i+'_lastname') + '|' + $F(cont_flight+'_kid'+i+'_ci') + '|' + $F(cont_flight+'_kid'+i+'_passport') + '|' + $F(cont_flight+'_kid'+i+'_email') + '|kid||'; 
		}
		
		flights_quote += kids;
	}
	flights_quote += '|';
	
	$('flight_quote_summary').update('<input type="button" value="Procesar" onclick="flight_quote_process();" />');
	
	
	/*new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/flight_quote_insert',{
		  method: 'post',
		  parameters: {	flights_quote : flights_quote },
		  asynchronous: true,
		  onSuccess: function(consultadoA){	
		  		alert('Cotizacion de vuelo ingresada exitosamente!');
				$('travelers_info'+cont_flight).update(consultadoA.responseText);
		  }
		  }
		);*/
}

function flight_quote_process(){
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/flight_quote_insert',{
		  method: 'post',
		  parameters: {	flights_quote : flights_quote },
		  asynchronous: true,
		  onSuccess: function(consultadoA){	
		  		alert('Cotizacion de vuelo ingresada exitosamente!');
				$('travelers_info'+cont_flight).update(consultadoA.responseText);
		  }
		  }
		);
}

function back_data(cont_flight){
	var round_trip = $F('round_trip'+cont_flight);
	
	if (round_trip){
		$('back'+cont_flight).style.visibility = 'visible'; 
		$('back_data'+cont_flight).style.visibility = 'visible'; 
	}
	else {
		$('back'+cont_flight).style.visibility = 'hidden'; 
		$('back_data'+cont_flight).style.visibility = 'hidden'; 
	}
}






