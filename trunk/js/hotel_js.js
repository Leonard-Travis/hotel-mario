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

var cont_f = 0;
var flights_quote = '';
var flights_array = new Array();

var generic_quote = '';
var generic_quote_array = new Array();
var generic_total = 0;
var generic_number = 0;

var hotel_quote_id = null;
var flight_quote_id = null;
var generic_quote_id = null;

var package_hotel = '';
var package_name = '';
var package_number_of_categories = '';
var package_date_start = '';
var package_date_end = '';
var package_description = '';
var package_categories = '';
var package_rooms = '';
var np_number_of_hotels = '';
var package_hotels_array = new Array();

var pq_count = 1;
var pq_hotel = '';
var pq_package = '';
var pq_rooms = new Array();
var pq_total = 0;

function test(){
	if (confirm('amame!....')){
		return true;
	}
	else return false;
}

function client_quote(customer){
	customer_id = customer;
	hotel_quote_id = null;
	flight_quote_id = null;
	generic_quote_id = null;
	
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
	 	cont_f = 0;
		flights_quote = '';
		$('flight_quote_summary').update('');
		var clean_array = new Array();
		flights_array = clean_array;
	 }
	 else if(quote_type == 'generic_quote'){
	 	generic_quote = '';
		generic_total = 0;
		$('generic_summary').update('');
		generic_number = 0;
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
	//alert(cont_f);
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

function start_hotel_quote(){
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
	
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/save_hotel_quote',{
      method: 'post',
      parameters: {plan_id : plan_id,
				   date_start : date_start,
				   date_end : date_end,
		    	   rooms_selected : imploded,
	  			   subtotal : subtotal,
				   persons : persons},
	  asynchronous: true,
      onSuccess: function(consultadoA){		  		
			$('add_quote_button').update('');
			hotel_quote_id = consultadoA.responseText;
			alert('Cotizacion de hotel agregada con exito: '+hotel_quote_id);
			
			$('close_quotation').update('<div class="separador"></div> <div class="separadorv_gris"></div> <table align="center"> <tr><td align="center"> <img src="http://localhost/hotel-mario/designed_views/imagenes/finalizar.jpg" onclick="process_quotation();" align="middle" /></td></tr> </table>');
      }
      }
   );
}

function drop_element_from_quote(rooms_hotels_id){
	if (confirm('¿Desea eliminar el elemento de la cotizacion?')){
		for (i=0; i<rooms_selected.length; i++) {
				if(rooms_selected[i]['room'] == rooms_hotels_id){
					rooms_selected.splice(i,1);
				}
			}
		calculate_sub();
		if ((capacity_total < persons) || (rooms_selected.length == 0)){
			alert('La capacidad total de las habitaciones ('+capacity_total+') debe ser igual o mayor a las cantidad de adultos ('+persons+') a ospedarse, debera escoger las habitaciones nuevamente');
			start_hotel_quote();
		}
		else if (rooms_selected.length > 0)	process_quote_hotel();
	}
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
	var pos = flights_array.length;
	flights_array[pos] = new Array();
	
	var cant_adults=$F('cant_adults'+cont_flight);
	var cant_kids=$F('cant_kids'+cont_flight);
	
	flights_array[pos][0] = $F('origin'+cont_flight);
	flights_array[pos][1] = $F('destination'+cont_flight);
	flights_array[pos][2] = $F('go_date'+cont_flight);
	flights_array[pos][3] = $F('go_time'+cont_flight);	
	flights_array[pos][4] = $F('number'+cont_flight);
	flights_array[pos][5] = $F('airline'+cont_flight);
	flights_array[pos][6] = $F('class'+cont_flight);
	flights_array[pos][7] = $F('price_per_adult'+cont_flight);
	flights_array[pos][8] = $F('price_per_kid'+cont_flight);
	flights_array[pos][9] = $F('cant_adults'+cont_flight);
	flights_array[pos][10] = $F('cant_kids'+cont_flight);
	flights_array[pos][11] = cont_flight;
	flights_array[pos][12] = $F('round_trip'+cont_flight);
	flights_array[pos][13] = new Array();
	
	flights_array[pos][14] =  $F('back_date'+cont_flight);
	flights_array[pos][15] =  $F('back_time'+cont_flight);
	
	if ((cant_adults != '0') && (cant_adults != '')){
		for (i=1; i <= parseInt(cant_adults); i++){
			var traveler_pos = flights_array[pos][13].length;
			flights_array[pos][13][traveler_pos] = new Array();
			flights_array[pos][13][traveler_pos][0] = $F(cont_flight+'_adult'+i+'_name');
			flights_array[pos][13][traveler_pos][1] = $F(cont_flight+'_adult'+i+'_lastname');
			flights_array[pos][13][traveler_pos][2] = $F(cont_flight+'_adult'+i+'_ci');
			flights_array[pos][13][traveler_pos][3] = $F(cont_flight+'_adult'+i+'_passport');
			flights_array[pos][13][traveler_pos][4] = $F(cont_flight+'_adult'+i+'_email');
			flights_array[pos][13][traveler_pos][5] = 'adult';
		}
	}
	
	if ((cant_kids != '0') && (cant_kids != '')){
		for (i= 1; i <= parseInt(cant_kids); i++){
			var traveler_pos = flights_array[pos][13].length;
			flights_array[pos][13][traveler_pos] = new Array();
			flights_array[pos][13][traveler_pos][0] = $F(cont_flight+'_kid'+i+'_name');
			flights_array[pos][13][traveler_pos][1] = $F(cont_flight+'_kid'+i+'_lastname');
			flights_array[pos][13][traveler_pos][2] = $F(cont_flight+'_kid'+i+'_ci');
			flights_array[pos][13][traveler_pos][3] = $F(cont_flight+'_kid'+i+'_passport');
			flights_array[pos][13][traveler_pos][4] = $F(cont_flight+'_kid'+i+'_email');
			flights_array[pos][13][traveler_pos][5] = 'kid';
		}
	}
	
	$('travelers_info'+cont_flight).update('');
	if (cont_flight == '0')
		$('flight_quote_aux').update('<div id="flight_quote'+(cont_f+1)+'"> </div>');
	else
		$('flight_quote'+cont_flight).update('<div id="flight_quote'+(cont_f+1)+'"> </div>');
		
	flight_summary();
}

function flight_summary(){
	flights_quote = '';
	var travelers = '';
	
	for(i=0; i < flights_array.length; i++){
		travelers = '';
		for(j=0; j < flights_array[i][13].length; j++){
			travelers += flights_array[i][13][j].join("|")+'||';
		}
		
		flights_quote += flights_array[i][0] +'|'+ flights_array[i][1] +'|'+ flights_array[i][2] +'|'+ flights_array[i][3] +'|'+ flights_array[i][4] +'|'+ flights_array[i][5] +'|'+ flights_array[i][6] +'|'+ flights_array[i][7] +'|'+ flights_array[i][8] +'|'+ flights_array[i][9] +'|'+ flights_array[i][10] +'|'+ i +'|';
		
		if (flights_array[i][12]){
			flights_quote += 'Y|' + flights_array[i][14] +'|'+ flights_array[i][15] +'|';
		}
		else flights_quote += 'N|' ;
		
		flights_quote += '|'+travelers+'|';
	}
	
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/flight_quote_insert/1',{
		  method: 'post',
		  parameters: {	flights_quote : flights_quote },
		  asynchronous: true,
		  onSuccess: function(consultadoA){	
				$('flight_quote_summary').update(consultadoA.responseText);
		  }
		  }
		);
}

function drop_flight(flight_id){
	if ( confirm('¿Desea eliminar este elemento de la cotizacion?. En caso de ser vuelo ida y vuelta, ambos seran eliminados') ){
		for(i=0; i < flights_array.length; i++){
			if(flights_array[i][11] == flight_id)	flights_array.splice(i,1);
		}

		if(flights_array.length > 0)
			flight_summary();
		else{
			alert('Cotizacion eliminada por completo');
			quote(customer_id, 'flight_quote');
		}
	}
}


function flight_quote_process(){
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/flight_quote_insert/0',{
		  method: 'post',
		  parameters: {	flights_quote : flights_quote },
		  asynchronous: true,
		  onSuccess: function(consultadoA){	
				$('flight_process_button').update('');
				flight_quote_id = consultadoA.responseText;
				alert('Cotizacion de vuelo agregada con exito: '+flight_quote_id);
				
			$('close_quotation').update('<div class="separador"></div> <div class="separadorv_gris"></div> <table align="center"> <tr><td align="center"> <img src="http://localhost/hotel-mario/designed_views/imagenes/finalizar.jpg" onclick="process_quotation();" align="middle" /></td></tr> </table>');
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

function generic_set_total(number){
	var description = $F('description'+number);
	var cant = $F('cant'+number);
	var price = $F('price'+number);
	
	var total = parseInt(cant) * parseFloat(price);
	$('generic_total'+number).update('BsF '+total);
}

function generic_q(){
	var clean_array = new Array();
	generic_quote_array = clean_array;
	generic_total = 0;
	
	for(i=0; i <= generic_number; i++){	
		if(($F('description'+i) != '') || ($F('cant'+i) != '') || ($F('price'+i) != '')){
			var length = generic_quote_array.length;
			generic_quote_array[length] = new Array();
			generic_quote_array[length][0] = $F('description'+i);
			generic_quote_array[length][1] = $F('cant'+i);
			generic_quote_array[length][2] = $F('price'+i);
			generic_quote_array[length][3] = parseInt( $F('cant'+i) ) * parseFloat( $F('price'+i) );
			generic_quote_array[length][4] = i;
			
			generic_total += generic_quote_array[length][3];
		}
	}
	generic_summary(generic_quote_array);
}

function generic_summary(generic_array){
	generic_quote = '';
	for(i=0; i < generic_array.length; i++)
			generic_quote += generic_array[i].join("|")+'||';
			
		new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/generic_summary',{
			  method: 'post',
			  parameters: {	generic_quote : generic_quote ,
							generic_total : generic_total},
			  asynchronous: true,
			  onSuccess: function(consultadoA){	
					$('generic_summary').update(consultadoA.responseText);
			  }
			  }
			);
}

function drop_generic(generic_element){
	if( confirm('¿Desea eliminar este elemento de la cotizacion?') ){
		for(i=0; i < generic_quote_array.length; i++){
			if(generic_quote_array[i][4] == generic_element) generic_quote_array.splice(i,1);
		}
		if(generic_quote_array.length > 0)
			generic_summary(generic_quote_array);
		else{
			alert('Cotizacion eliminada por completo');
			quote(customer_id, 'generic_quote');
		}
	}
}

function add_generic(){
	$('generic_info').style.visibility = 'visible';
	generic_number = generic_number + 1;
	var tr = document.createElement("tr"); //create object <TR> 
	tr.innerHTML = '<td align="center"><input type="text" id="description'+generic_number+'" name="description'+generic_number+'" size="60"></td>     <td align="center"><input type="text" id="cant'+generic_number+'" name="cant'+generic_number+'" size="3" maxlength="2" ></td> <td align="center">BsF.<input type="text" id="price'+generic_number+'" name="price'+generic_number+'" onBlur="generic_set_total('+generic_number+');" ></td> <td class="rojo totall"><div id="generic_total'+generic_number+'"></div></td> <td></td><td></td>'; 
	obj1 = document.getElementById("generic_table"); 
	obj1.lastChild.appendChild(tr);
}

function generic_process(){
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/generic_process',{
		  method: 'post',
		  parameters: {	generic_quote : generic_quote ,
		  				generic_total : generic_total},
		  asynchronous: true,
		  onSuccess: function(consultadoA){	
				$('generic_info').style.visibility = 'hidden';
				$('generic_process_button').update('');
				generic_quote_id = consultadoA.responseText;
				alert('Cotizacion generica agregada con exito: '+generic_quote_id);
				
				$('close_quotation').update('<div class="separador"></div> <div class="separadorv_gris"></div> <table align="center"> <tr><td align="center"> <img src="http://localhost/hotel-mario/designed_views/imagenes/finalizar.jpg" onclick="process_quotation();" align="middle" /></td></tr> </table>');
				
		  }
		  }
		);
}

function find_traveler(cont_flight, cont_traveler, type){	
	var traveler_ci = $F(cont_flight+'_'+type+cont_traveler+'_ci');
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/find_traveler/'+traveler_ci,{
		  method: 'post',
		  parameters: {},
		  asynchronous: true,
		  onSuccess: function(consultadoA){	
				var info = consultadoA.responseText;
				if (info != ''){
					info = info.split('|');
					document.getElementById(cont_flight+'_'+type+cont_traveler+'_name').value = info[0];
					document.getElementById(cont_flight+'_'+type+cont_traveler+'_lastname').value = info[1];
					document.getElementById(cont_flight+'_'+type+cont_traveler+'_passport').value = info[2];
					document.getElementById(cont_flight+'_'+type+cont_traveler+'_email').value = info[3];
				}
				else alert(traveler_ci+' Viajero nuevo');
		  }
		  }
		);
}

function process_quotation(){
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/process_quotation',{
			  method: 'post',
			  parameters: {hotel_quote_id : hotel_quote_id,
			  			   flight_quote_id : flight_quote_id,
			  			   generic_quote_id : generic_quote_id,
						   customer_id: customer_id},
			  asynchronous: true,
			  onSuccess: function(consultadoA){	
			  		alert('Cotizacion finalizada');
					
			new Ajax.Request('http://localhost/hotel-mario/index.php/customer/customer_after_quote/'+customer_id,{
			  method: 'post',
			  parameters: {},
			  asynchronous: true,
			  onSuccess: function(consultadoA){	
					$('quotation').update(consultadoA.responseText);
			  }
			  }
			);
			
			  }
			  }
			);
}

function existing_quotation(customer){
	new Ajax.Request('http://localhost/hotel-mario/index.php/customer/existing_quotation/'+customer,{
			  method: 'post',
			  parameters: {},
			  asynchronous: true,
			  onSuccess: function(consultadoA){	
			  		var aux = consultadoA.responseText;
					if(aux != 'no-quote')	$('existing_quotation').update(consultadoA.responseText);
					else					alert('El cliente no posee cotizaciones hasta el momento');
			  }
			  }
			);
}

function existing_quote_details(quote_id, close_div){
	if(close_div == '1'){
		$('existing_quote_details'+quote_id).update('');
		$('existing_quote_details_button'+quote_id).update('<a href="#"><img src="http://localhost/hotel-mario/designed_views/imagenes/fazul.jpg" alt="" onclick="existing_quote_details('+quote_id+',0);" /></a>');
	}
	else{
		new Ajax.Request('http://localhost/hotel-mario/index.php/customer/existing_quote_details',{
				  method: 'post',
				  parameters: {quote_id : quote_id},
				  asynchronous: true,
				  onSuccess: function(consultadoA){	
						$('existing_quote_details'+quote_id).update(consultadoA.responseText);
						$('existing_quote_details_button'+quote_id).update('<a href="#"><img src="http://localhost/hotel-mario/designed_views/imagenes/fazul_abajo.jpg" alt="" onclick="existing_quote_details('+quote_id+',1);" /></a>');
				  }
				  }
				);
	}
}

function search_client(customer){
	
	new Ajax.Request('http://localhost/hotel-mario/index.php/customer/search_form',{
		  method: 'post',
		  parameters: {ci_client : customer},
		  asynchronous: true,
		  onSuccess: function(consultadoA){	
				var aux = consultadoA.responseText;
				if (aux == 'non_existent'){
					
					if ( confirm('No se encuentra registrado, ¿Desea agregarlo?') ){
						new_client(customer);
					}
				}
				else $('customer').update(consultadoA.responseText);
				
		  }
		  }
		);
}

function new_client(customer){
	new Ajax.Request('http://localhost/hotel-mario/index.php/customer/new_client/'+customer,{
			  method: 'post',
			  parameters: {},
			  asynchronous: true,
			  onSuccess: function(consultadoA){	
					$('customer').update(consultadoA.responseText);
			  }
			  }
			);
}

function new_client_data(){
	var ci_client = $F('client_id');
	var name = $F('name');
	var lastname = $F('lastname');
	var phone = $F('phone');
	var email = $F('email');
	var address = $F('address');
	var birthdate = $F('birthdate');
	var sex = $F('sex');
	
	if((ci_client != '') && (name != '') && (lastname != '') && (phone != '') && (email != '') && (address != '') && (birthdate != '')){
	
	new Ajax.Request('http://localhost/hotel-mario/index.php/customer/new_client/'+ci_client,{
			  method: 'post',
			  parameters: {ci_client :ci_client,
			  			   name : name,
						   lastname : lastname,
						   phone : phone,
						   email : email,
						   address : address,
						   birthdate : birthdate,
						   sex : sex},
			  asynchronous: true,
			  onSuccess: function(consultadoA){	
					var aux = consultadoA.responseText;
					if(aux == 'exist') {
						alert('Ya existe un cliente en el sistema con ese numero de cedula');
					}
					else {
						alert('Cliente agregado con exito');
						search_client(ci_client);
					}
			  }
			  }
			);
	}
	else alert('Hay campo(s) obligatorios vacios');
}

function modify_client_button(customer){
	new Ajax.Request('http://localhost/hotel-mario/index.php/customer/modify_client',{
			  method: 'post',
			  parameters: {ci_client : customer},
			  asynchronous: true,
			  onSuccess: function(consultadoA){	
					$('customer').update(consultadoA.responseText);
			  }
			  }
			);
}

function modify_client(){
	var ci_client = $F('client_id');
	var name = $F('name');
	var lastname = $F('lastname');
	var phone = $F('phone');
	var email = $F('email');
	var address = $F('address');
	var birthdate = $F('birthdate');
	var sex = $F('sex');
	
	if((ci_client != '') && (name != '') && (lastname != '') && (phone != '') && (email != '') && (address != '') && (birthdate != '')){
	
		new Ajax.Request('http://localhost/hotel-mario/index.php/customer/modify_client',{
				  method: 'post',
				  parameters: {ci_client :ci_client,
							   name : name,
							   lastname : lastname,
							   phone : phone,
							   email : email,
							   address : address,
							   birthdate : birthdate,
							   sex : sex},
				  asynchronous: true,
				  onSuccess: function(consultadoA){	
						alert('Informacion actualizada!');
						search_client(ci_client);
				  }
				  }
				);
	}
	else alert('Hay campo(s) obligatorios vacios');
}

function delete_client(customer){
	if( confirm('¿Realmente desea eliminar este cliente?') ){
		new Ajax.Request('http://localhost/hotel-mario/index.php/customer/delete_client/'+customer,{
				  method: 'post',
				  parameters: {},
				  asynchronous: true,
				  onSuccess: function(consultadoA){	
						alert('Cliente eliminado');
						
						new Ajax.Request('http://localhost/hotel-mario/index.php/customer/search_form',{
						  method: 'post',
						  parameters: {},
						  asynchronous: true,
						  onSuccess: function(consultadoA){	
								$('quotation').update(consultadoA.responseText);
								
				  }
				  }
				);
				  }
				  }
				);
	}
}

function delete_matrix(season_id, hotel_id, prices){
	alert('delete');
	alert('season '+season_id+', hotel: '+hotel_id);
}

function login(){
	var user_type = $F('user_type');
	var user_id = $F('user_id');
	var user_password = $F('user_password');
	
	new Ajax.Request('http://localhost/hotel-mario/index.php/seller/login',{
			  method: 'post',
			  parameters: {user_type : user_type,
			  			   user_id : user_id,
			  			   user_password : user_password},
			  asynchronous: true,
			  onSuccess: function(consultadoA){	
			  		var resp = consultadoA.responseText;
					if (resp == ('error1')) alert('Combinacion erronea de Usuario y Password');
					else		$('login').update(consultadoA.responseText);
					
	  }
	  }
	);
}

function add_seller(){
	var name = $F('seller_name');
	var lastname = $F('seller_lastname');
	var id = $F('seller_id');
	var type = $F('seller_type');
	var password = $F('password');
	
	new Ajax.Request('http://localhost/hotel-mario/index.php/seller/add_seller',{
			  method: 'post',
			  parameters: {name : name,
			  			   lastname : lastname,
						   id : id,
						   type : type,
						   password : password},
			  asynchronous: true,
			  onSuccess: function(consultadoA){	
			  		alert('Agregado con exito');
			  		$('seller').update(consultadoA.responseText);
					
	  }
	  }
	);
}

function categorie_packages(){
	var categorie_id = $F('categories');
	
	new Ajax.Request('http://localhost/hotel-mario/index.php/packages/categorie_packages/0',{
			  method: 'post',
			  parameters: {categorie_id : categorie_id},
			  asynchronous: true,
			  onSuccess: function(consultadoA){	
			  		$('packages').update(consultadoA.responseText);
					
	  }
	  }
	);
}

function package_details(pack_id, close_div){
	if(close_div == '1'){
		$('package'+pack_id).update('');
		$('package_arrow'+pack_id).update('<a href="#"><img src="http://localhost/hotel-mario/designed_views/imagenes/fazul.jpg" alt="" onclick="package_details('+pack_id+',0);" /></a>');
	}
	else{
		new Ajax.Request('http://localhost/hotel-mario/index.php/packages/package_details',{
				  method: 'post',
				  parameters: {pack_id : pack_id},
				  asynchronous: true,
				  onSuccess: function(consultadoA){	
						$('package'+pack_id).update(consultadoA.responseText);
						$('package_arrow'+pack_id).update('<a href="#"><img src="http://localhost/hotel-mario/designed_views/imagenes/fazul_abajo.jpg" alt="" onclick="package_details('+pack_id+',1);" /></a>');
				  }
				  }
				);
	}
}

//'np' stands for New Package
function new_package(){
	package_count = 1;
	new Ajax.Request('http://localhost/hotel-mario/index.php/packages/new_package/1/0',{
			  method: 'post',
			  parameters: {count : package_count},
			  asynchronous: true,
			  onSuccess: function(consultadoA){	
			  		$('new_package').update(consultadoA.responseText);					
	  }
	  }
	);
}

function new_package_categories(){
	var number_of_categories = $F('number_of_categories');
	new Ajax.Request('http://localhost/hotel-mario/index.php/packages/package_categories',{
		  method: 'post',
		  parameters: {number_of_categories : number_of_categories},
		  asynchronous: true,
		  onSuccess: function(consultadoA){	
				$('new_package_categories').update(consultadoA.responseText);
		  }
		  }
	   );
}

function new_categorie(cont){
	var categorie = $F('categories'+cont);
	if(categorie == 'new'){
	$('categorie'+cont).update('Nueva: <input type="text" id="categories'+cont+'" name="categories'+cont+'">');
	}
}

function new_package_hotels(){
	if ( ($F('name') != '') && ($F('number_of_categories') != 0) && ($F('date_start') != '')&& ($F('date_end') != '') && ($F('description') != '') ){
	
		package_name = $F('name');
		package_number_of_categories = $F('number_of_categories');
		package_date_start = $F('date_start');
		package_date_end = $F('date_end');
		package_description = $F('description');
		
		for(i=0; i < parseInt(package_number_of_categories); i++){
			package_categories += $F('categories'+i)+'|';
		}
		alert(package_categories);
		
		new Ajax.Request('http://localhost/hotel-mario/index.php/packages/new_package_hotels/1',{
					  method: 'post',
					  parameters: {},
					  asynchronous: true,
					  onSuccess: function(consultadoA){	
							$('new_package').update(consultadoA.responseText);
			  }
			  }
			);
	}	
	else alert('Debe llenar todos los campos obligatorios antes de Agregar Hoteles-Precios');
}

function np_print_hotels(){
	var clean_array = new Array();
	package_hotels_array = clean_array;
	
	np_number_of_hotels = $F('number_of_hotels');
	new Ajax.Request('http://localhost/hotel-mario/index.php/packages/new_package_hotels/0',{
					  method: 'post',
					  parameters: {number_of_hotels : np_number_of_hotels},
					  asynchronous: true,
					  onSuccess: function(consultadoA){	
							$('new_package').update(consultadoA.responseText);
							$('new_package_process_button').update('<div class="separadorv"></div> <table><tr><td><img src="http://localhost/hotel-mario/designed_views/imagenes/bprocesar.jpg" onclick="process_package();" /></td></tr></table>');
			  }
			  }
			);
}

function np_process_hotels(number_of_hotel){
	var hotel_id = $F('hotel'+number_of_hotel);
	
	if(hotel_id != ''){
//in package_hotels_array is stored the id of the current chosen hotel, at the position wich is printed on the screen, so it's easier to know wich hotel was chosen and when. And also initialize the rooms counter that shows how many rooms were picked to belongs to the new package.   		
		
		package_hotels_array[number_of_hotel] = new Array();
		package_hotels_array[number_of_hotel][0] = hotel_id;
		package_hotels_array[number_of_hotel][1] = 1;
	
		new Ajax.Request('http://localhost/hotel-mario/index.php/packages/new_package/0/1',{
						  method: 'post',
						  parameters: {hotel_id : hotel_id,
									   count : 1,
									   number_of_hotel : number_of_hotel},
						  asynchronous: true,
						  onSuccess: function(consultadoA){	
								$('np_hotel'+number_of_hotel).update(consultadoA.responseText);
				  }
				  }
				);
	}
	else $('np_hotel'+number_of_hotel).update('');
}

function new_package_room(hotel_id, number_of_hotel){
	package_hotels_array[number_of_hotel][1] += 1;
	new Ajax.Request('http://localhost/hotel-mario/index.php/packages/new_package/0/0',{
		  method: 'post',
		  parameters: {hotel_id : hotel_id,
			  		   count : package_hotels_array[number_of_hotel][1],
					   number_of_hotel : number_of_hotel},
		  asynchronous: true,
		  onSuccess: function(consultadoA){	
				var tr = document.createElement("tr"); //create object <TR> 
				tr.innerHTML = consultadoA.responseText; 
				obj1 = document.getElementById("np_table_hotel"+number_of_hotel); 
				obj1.lastChild.appendChild(tr);
		  }
		  }
	   );
}



function process_package(){
	package_rooms = '';

	for(f=1; f < package_hotels_array.length; f++){
		package_rooms += '|||'+package_hotels_array[f][0];
		
		for(j=1; j <= package_hotels_array[f][1]; j++){
			package_rooms += '||'+$F('rooms'+j+'_'+f)+'|'+$F('price'+j+'_'+f);
		}
	}
	
	new Ajax.Request('http://localhost/hotel-mario/index.php/packages/add_package',{
		  method: 'post',
		  parameters: {name : package_name,
		  			   date_start : package_date_start,
					   date_end : package_date_end,
					   description : package_description,
					   categories : package_categories,
					   rooms : package_rooms},
		  asynchronous: true,
		  onSuccess: function(consultadoA){	
		  		$('management_packages').update(consultadoA.responseText);
				alert('Paquete agregado con exito');
		  }
		  }
	   );
}





//pq stands for Package Quotation
function pq_select_categorie(){
	var categorie = $F('categories');
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/pq_selected_categorie',{
		  method: 'post',
		  parameters: {categorie : categorie},
		  asynchronous: true,
		  onSuccess: function(consultadoA){	
		  		$('pq_select_package').update(consultadoA.responseText);
		  }
		  }
	   );
}

function pq_select_package(package_id){
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/pq_selected_package',{
		  method: 'post',
		  parameters: {package : package_id},
		  asynchronous: true,
		  onSuccess: function(consultadoA){	
		  		$('pq_select_package').update(consultadoA.responseText);
		  }
		  }
	   );
}

function pq_details(pack_id, hotel_id){
	pq_count = 1;
	pq_total = 0;
	pq_hotel = hotel_id;
	pq_package = pack_id;
	var clean_array = new Array();
	pq_rooms = clean_array;
	
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/pq_selected_hotel/1',{
		  method: 'post',
		  parameters: {package : pack_id,
		  			   hotel : hotel_id,
					   pq_count : 1},
		  asynchronous: true,
		  onSuccess: function(consultadoA){	
		  		$('pq_details').update(consultadoA.responseText);
		  }
		  }
	   );
}

function pq_add_room(){
	pq_count += 1;
	
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/pq_selected_hotel/0',{
		  method: 'post',
		  parameters: {package : pq_package,
		  			   hotel : pq_hotel,
					   pq_count : pq_count},
		  asynchronous: true,
		  onSuccess: function(consultadoA){	
				var tr = document.createElement("tr"); //create object <TR> 
				tr.innerHTML = consultadoA.responseText; 
				obj1 = document.getElementById("pq_table"); 
				obj1.lastChild.appendChild(tr);
		  }
		  }
	   );
}

function pq_set_price(count){
	var pack_room = $F('room'+count);
	
	pq_rooms[count] = new Array(); //[0]: rooms_per_package_id, [1]:price per person, [2]:cant of persons
	pq_rooms[count] = pack_room.split("|");
	$('pq_price'+count).update('BsF. '+pq_rooms[count][1]);
}

function pq_set_subtotal(count){
	var cant_persons = $F('cant_persons'+count);
	
	pq_rooms[count][2] = cant_persons;
	var subtotal = parseFloat(pq_rooms[count][1])* parseInt(pq_rooms[count][2]);
	pq_total = pq_total + subtotal;
	
	$('pq_subtotal'+count).update('BsF. '+subtotal);
	for(i=1; i<=count; i++){
		$('pq_total'+i).update('');
	}
	$('pq_total'+pq_count).update('----------------- <br />BsF. '+pq_total);
	if(pq_total > 0){
		$('pq_process_button').update('<a href="#"><img src="http://localhost/hotel-mario/designed_views/imagenes/bprocesar.jpg" onclick="pq_process();" /></a>');
	}
}

function pq_process(){
	var rooms = '';
	for(i=1; i < pq_rooms.length; i++){
		rooms += pq_rooms[i][0]+'|'+pq_rooms[i][1]+'|'+pq_rooms[i][2]+'||';
	}
	
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/pq_process',{
		  method: 'post',
		  parameters: {rooms : rooms,
		  			   pq_total : pq_total},
		  asynchronous: true,
		  onSuccess: function(consultadoA){	
		  		alert('Paquete agregado con exito');
				$('pq_process_button').update('');
				$('pq_details').update(consultadoA.responseText);
		  }
		  }
	   );
	
}


