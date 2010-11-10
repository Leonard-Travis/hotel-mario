// JavaScript Document
var counter = 0;
var matrix_counter = 0;
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
var package_quote_id = null;

var package_hotel = '';
var package_name = '';
var package_number_of_categories = '';
var package_date_start = '';
var package_date_end = '';
var package_description = '';
var package_categories = '';
var package_days = '';
var package_nights = '';
var package_rooms = '';
var package_kids = 0;
var package_additional = 0;
var np_number_of_hotels = '';
var package_hotels_array = new Array();

var pq_count = 1;
var pq_hotel = '';
var pq_package = '';
var pq_rooms = new Array();
var pq_total = new Array();
var pq_total_numeric = 0;
var pq_check_in = '';
var pq_check_out = '';


function test(){
	if (confirm('TEST!!!!!!')){
		return true;
	}
	else return false;
}

function client_quote(customer){
	customer_id = customer;
	hotel_quote_id = null;
	flight_quote_id = null;
	generic_quote_id = null;	
	
	$.ajax({
      url: 'http://localhost/hotel-mario/index.php/quotation/new_quote/'+customer_id,
      global: false,
      type: "POST",
      data: ({}),
      async:false,
	  dataType:"html",
      success: function(msg){
		$("#quotation").html(msg);
      }
	})
}

function quote(client_id, quote_type){
	 if (quote_type == 'flight_quote'){
	 	cont_f = 0;
		flights_quote = '';
		$('#flight_quote_summary').html('');
		var clean_array = new Array();
		flights_array = clean_array;
	 }
	 else if(quote_type == 'generic_quote'){
	 	generic_quote = '';
		generic_total = 0;
		$('#generic_summary').html('');
		generic_number = 0;
	 }
		
	 customer_id = client_id; 
	 
	$.ajax({
      url: 'http://localhost/hotel-mario/index.php/quotation/'+quote_type,
      global: false,
      type: "POST",
      data: ({cont_f : cont_f}),
      async:false,
	  dataType:"html",
      success: function(msg){
		$("#"+quote_type).html(msg);
      }
	})
	 
}

function add_flight(){
	cont_f = cont_f + 1;	
	
	$.ajax({
      url: 'http://localhost/hotel-mario/index.php/quotation/flight_quote',
      global: false,
      type: "POST",
      data: ({cont_f : cont_f}),
      async:false,
	  dataType:"html",
      success: function(msg){
		$("#flight_quote"+cont_f).html(msg);
      }
	})
}

function hotel_info(){
	var hotel_id = $("#hotels").val();	
	
	$.ajax({
      url: 'http://localhost/hotel-mario/index.php/quotation/hotel_selected_quote',
      global: false,
      type: "POST",
      data: ({hotel_id : hotel_id,
	  		  customer_id : customer_id}),
      async:false,
	  dataType:"html",
      success: function(msg){
		$("#hotel_quote").html(msg);
      }
	})
}

function start_hotel_quote(emp_id){
	var clean_array = new Array();
	rooms_selected = clean_array;
	subtotal = 0;
	capacity_total = 0;
	counter = 0;
	plan_id = $('#plan').val();
	date_start = $('#date_start').val();
	date_end = $('#date_end').val();
	hotel_id = $('#hotel_id').val();
	persons = $('#persons').val();
	
	$.ajax({
      url: 'http://localhost/hotel-mario/index.php/quotation/start_quote/0',
      global: false,
      type: "POST",
	  data:  ({hotel_id : hotel_id,
			   plan_id : plan_id,
			   date_ini : date_start,
			   date_end : date_end,
			   counter : 0}),
      async:false,
	  dataType:"html",
      success: function(msg){
		$("#quote_details_form").html(msg);
		$("#add_quote_button").html('<input type="image"  src="http://localhost/hotel-mario/designed_views/imagenes/bagregar.jpg" onclick="process_quote_hotel('+emp_id+');"/>');
      }
	})
}

function setting_PU(countaux){
	rooms_selected[countaux] = new Array();
	var room = $('#rooms'+countaux).val();
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
	
	$.ajax({
      url: 'http://localhost/hotel-mario/index.php/quotation/setting_PU',
      global: false,
      type: "POST",
      data: ({room : rooms_selected[countaux]['room'],
			   date_start : date_start,
			   date_end : date_end,
			   plan : plan_id}),
      async:false,
	  dataType:"html",
      success: function(msg){
		$('#price_per_night'+countaux).html(msg);
		rooms_selected[countaux]['PU'] = msg;
		$('#subtotal'+countaux).html('');
      }
	})
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
	rooms_selected[countaux]['quantity'] = parseInt($('#quantity'+countaux).val());
	
	$.ajax({
      url: "http://localhost/hotel-mario/index.php/quotation/setting_subtotal",
      global: false,
      type: "POST",
      data: ({room : rooms_selected[countaux]['room'],
			   date_start : date_start,
			   date_end : date_end,
			   plan : plan_id,
			   quantity : rooms_selected[countaux]['quantity']}),
      async:false,
	  dataType:"html",
      success: function(msg){
		  rooms_selected[countaux]['subtotal'] = parseFloat(msg);
		  calculate_sub();
		  $('#subtotal'+countaux).html('BsF. '+msg);
		  $('#total'+counter).html('---------------- <br />BsF.'+subtotal);
      }
	})
}

function add_room(){ 	
	$('#total'+counter).html('');
	counter = counter + 1;
	
	var imploded = 0;
	if (rooms_selected[0]){
		for (i=0; i<rooms_selected.length; i++) {
			imploded += '|' + rooms_selected[i]['room'];
		}
	}
		
	$.ajax({
      url: "http://localhost/hotel-mario/index.php/quotation/start_quote/1",
      global: false,
      type: "POST",
      data: ({hotel_id : hotel_id,
			   plan_id : plan_id,
			   date_ini : date_start,
			   date_end : date_end,
			   counter : counter,
			   rooms_selected : imploded}),
      async:false,
	  dataType:"html",
      success: function(msg){
		$("#quote_hotel_table").append(msg);	
		$('#total'+counter).html('---------------- <br />BsF. '+subtotal);
      }
	})

}

function process_quote_hotel(emp_id){	
	calculate_sub();
	
	if (capacity_total >= persons){
		var imploded = '';
		if (rooms_selected[0]){
			for (i=0; i<rooms_selected.length; i++) {
				imploded += rooms_selected[i]['room'] + '|' + rooms_selected[i]['quantity']+ '|' + rooms_selected[i]['PU']+ '|' + rooms_selected[i]['subtotal'] + '||';
			}
		}
				
			$.ajax({
			  url: 'http://localhost/hotel-mario/index.php/quotation/hotel_summary',
			  global: false,
			  type: "POST",
			  data: ({rooms_selected : imploded,
					  subtotal : subtotal}),
			  async:false,
			  dataType:"html",
			  success: function(msg){
				  $('#quote_details_form').html(msg);
				  $('#add_quote_button').html('<td class="ntd"> <input type="image" name="procesar" id="procesar" src="http://localhost/hotel-mario/designed_views/imagenes/bprocesar.jpg" onclick="save_hotel_quote('+emp_id+')"/>	</td>');
			  }
			})
	
	}
	else {
		alert('La capacidad total de las habitaciones ('+capacity_total+') debe ser igual o mayor a las cantidad de adultos ('+persons+') a ospedarse');
	}

}

function save_hotel_quote(emp_id){
	var imploded = '';
	if (rooms_selected[0]){
		for (i=0; i<rooms_selected.length; i++) {
			imploded += rooms_selected[i]['room'] + '|' + rooms_selected[i]['quantity']+ '|' + rooms_selected[i]['PU']+ '|' + rooms_selected[i]['subtotal'] + '||';
		}
	}

	$.ajax({
      url: "http://localhost/hotel-mario/index.php/quotation/save_hotel_quote",
      global: false,
      type: "POST",
      data: ({plan_id : plan_id,
			   date_start : date_start,
			   date_end : date_end,
			   rooms_selected : imploded,
			   subtotal : subtotal,
			   persons : persons}),
      async:false,
	  dataType:"html",
      success: function(msg){
		 $('#add_quote_button').html('');
			hotel_quote_id = msg;
			alert('Cotizacion de hotel agregada con exito: '+hotel_quote_id);
			$('#close_quotation').html('<div class="separador"></div> <div class="separadorv_gris"></div> <table align="center"> <tr><td align="center"> <img src="http://localhost/hotel-mario/designed_views/imagenes/finalizar.jpg" onclick="process_quotation('+emp_id+');" align="middle" /></td></tr> </table>'); 
      }
	})
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

	$.ajax({
      url: "http://localhost/hotel-mario/index.php/price_matrix/new_matrix_season",
      global: false,
      type: "POST",
      data: ({hotel_selected_id : hotel_id}),
      async:false,
	  dataType:"html",
      success: function(msg){
		  $('#new_matrix').html(msg);
      }
	})
}

function validate_dates(){
	date_start = $('#date_ini').val();
	date_end = $('#date_end').val();
	plan_id = $('#plan').val();
	season_name = $('#season_name').val();
	matrix_counter = 0;
	
	$.ajax({
      url: "http://localhost/hotel-mario/index.php/price_matrix/validate_dates",
      global: false,
      type: "POST",
      data: ({hotel_id : hotel_id,
			   date_ini : date_start,
			   date_end : date_end}),
      async:false,
	  dataType:"html",
      success: function(msg){
		if (msg == '')	alert('Las fechas dadas se solapan con seasons existentes');
		else{
				$('#validate_check').html('<img src="http://localhost/hotel-mario/designed_views/imagenes/tick.png"/>');
	  			$('#new_matrix_data').html(msg);
				
				new_matrix_add_room();
				
				$('#process_new_matrix_button').html('<div class="separadorv"></div> <div class="tit2"> <input type="image" name="Agregar" id="Agregar" src="http://localhost/hotel-mario/designed_views/imagenes/bprocesar.jpg"  onclick="process_new_matrix();"/> </div> <div class="separador"></div>');
		}
      }
	})
}

function new_matrix_add_room(){
	matrix_counter = matrix_counter + 1;
	
	$.ajax({
      url: "http://localhost/hotel-mario/index.php/price_matrix/new_matrix_add_room",
      global: false,
      type: "POST",
      data: ({hotel_id : hotel_id,
	  		  counter : matrix_counter}),
      async:false,
	  dataType:"html",
      success: function(msg){
			$("#new_matrix_table").append(msg);
      }
	})
	
}

function process_new_matrix(){
	var new_matrix = '';	
	for (i=1; i <= matrix_counter; i++){
		if ($('#price'+i).val() != ''){
			new_matrix += $('#rooms'+i).val()+'|'+$('#price'+i).val()+'|';
			if ($('#monday_price'+i).val() != ''){
				new_matrix += '1|'+$('#monday_price'+i).val()+'|'+$('#tuesday_price'+i).val()+'|'+$('#wednesday_price'+i).val()+'|'+$('#thrusday_price'+i).val()+'|'+$('#friday_price'+i).val()+'|'+$('#saturday_price'+i).val()+'|'+$('#sunday_price'+i).val()+'||';
			}
			else new_matrix += '0||';
		}
	}

	$.ajax({
      url: "http://localhost/hotel-mario/index.php/price_matrix/process_new_matrix",
      global: false,
      type: "POST",
      data: ({hotel_id : hotel_id,
			   plan_id : plan_id,
			   date_start : date_start,
			   date_end : date_end,
			   season_name : season_name,
			   new_matrix : new_matrix}),
      async:false,
	  dataType:"html",
      success: function(msg){
		alert('Matriz agregada con exito!');
				$.ajax({
				  url: "http://localhost/hotel-mario/index.php/price_matrix/index/1",
				  global: false,
				  type: "POST",
				  data: ({hotels : hotel_id}),
				  async:false,
				  dataType:"html",
				  success: function(msg){
					$('#management_price_matrix').html(msg);
				  }
				})
      }
	})
}

function flight_quote_data(cont_flight){
	 var cant_adults=$('#cant_adults'+cont_flight).val();
	 var cant_kids=$('#cant_kids'+cont_flight).val();
	 
	 if (((cant_adults == '') && (cant_kids == '')) || ((cant_adults == '00') && (cant_kids == '00'))|| ((cant_adults == '') && (cant_kids == '0'))|| ((cant_adults == '0') && (cant_kids == '')))
	 	alert ('Debe haber por lo menos un pasajero');
	 else{		 
			$.ajax({
			  url: "http://localhost/hotel-mario/index.php/quotation/travelers_info",
			  global: false,
			  type: "POST",
			  data: ({cant_adults : cant_adults,
					   cant_kids : cant_kids,
					   cont_flight : cont_flight}),
			  async:false,
			  dataType:"html",
			  success: function(msg){
				$('#travelers_info'+cont_flight).html(msg);
			  }
			})
	 }
}

function travelers(cont_flight){	
	var pos = flights_array.length;
	flights_array[pos] = new Array();
	
	var cant_adults=$('#cant_adults'+cont_flight).val();
	var cant_kids=$('#cant_kids'+cont_flight).val();
	
	flights_array[pos][0] = $('#origin'+cont_flight).val();
	flights_array[pos][1] = $('#destination'+cont_flight).val();
	flights_array[pos][2] = $('#go_date'+cont_flight).val();
	flights_array[pos][3] = $('#go_time'+cont_flight).val();	
	flights_array[pos][4] = $('#number'+cont_flight).val();
	flights_array[pos][5] = $('#airline'+cont_flight).val();
	flights_array[pos][6] = $('#class'+cont_flight).val();
	flights_array[pos][7] = $('#price_per_adult'+cont_flight).val();
	flights_array[pos][8] = $('#price_per_kid'+cont_flight).val();
	flights_array[pos][9] = $('#cant_adults'+cont_flight).val();
	flights_array[pos][10] = $('#cant_kids'+cont_flight).val();
	flights_array[pos][11] = cont_flight;
	flights_array[pos][12] = $("input:checked").length;

	flights_array[pos][13] = new Array();
	
	flights_array[pos][14] =  $('#back_date'+cont_flight).val();
	flights_array[pos][15] =  $('#back_time'+cont_flight).val();
	
	if ((cant_adults != '0') && (cant_adults != '')){
		for (i=1; i <= parseInt(cant_adults); i++){
			var traveler_pos = flights_array[pos][13].length;
			flights_array[pos][13][traveler_pos] = new Array();
			flights_array[pos][13][traveler_pos][0] = $('#'+cont_flight+'_adult'+i+'_name').val();
			flights_array[pos][13][traveler_pos][1] = $('#'+cont_flight+'_adult'+i+'_lastname').val();
			flights_array[pos][13][traveler_pos][2] = $('#'+cont_flight+'_adult'+i+'_ci').val();
			flights_array[pos][13][traveler_pos][3] = $('#'+cont_flight+'_adult'+i+'_passport').val();
			flights_array[pos][13][traveler_pos][4] = $('#'+cont_flight+'_adult'+i+'_email').val();
			flights_array[pos][13][traveler_pos][5] = 'adult';
		}
	}
	
	if ((cant_kids != '0') && (cant_kids != '')){
		for (i= 1; i <= parseInt(cant_kids); i++){
			var traveler_pos = flights_array[pos][13].length;
			flights_array[pos][13][traveler_pos] = new Array();
			flights_array[pos][13][traveler_pos][0] = $('#'+cont_flight+'_kid'+i+'_name').val();
			flights_array[pos][13][traveler_pos][1] = $('#'+cont_flight+'_kid'+i+'_lastname').val();
			flights_array[pos][13][traveler_pos][2] = $('#'+cont_flight+'_kid'+i+'_ci').val();
			flights_array[pos][13][traveler_pos][3] = $('#'+cont_flight+'_kid'+i+'_passport').val();
			flights_array[pos][13][traveler_pos][4] = $('#'+cont_flight+'_kid'+i+'_email').val();
			flights_array[pos][13][traveler_pos][5] = 'kid';
		}
	}
	
	$('#travelers_info'+cont_flight).html('');
	if (cont_flight == '0')
		$('#flight_quote_aux').html('<div id="flight_quote'+(cont_f+1)+'"> </div>');
	else
		$('#flight_quote'+cont_flight).html('<div id="flight_quote'+(cont_f+1)+'"> </div>');
		
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
		
		if (flights_array[i][12] == '1') flights_quote += '1|' + flights_array[i][14] +'|'+ flights_array[i][15] +'|';
		else 					  flights_quote += '0|NULL|NULL|' ;
		
		flights_quote += '|'+travelers+'|';
	}
	
	$.ajax({
      url: "http://localhost/hotel-mario/index.php/quotation/flight_quote_insert/1",
      global: false,
      type: "POST",
      data: ({	flights_quote : flights_quote }),
      async:false,
	  dataType:"html",
      success: function(msg){
		$('#flight_quote_summary').html(msg);
      }
	})
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


function flight_quote_process(emp_id){
	$.ajax({
      url: "http://localhost/hotel-mario/index.php/quotation/flight_quote_insert/0",
      global: false,
      type: "POST",
      data: ({	flights_quote : flights_quote }),
      async:false,
	  dataType:"html",
      success: function(msg){
			$('#flight_process_button').html('');
			flight_quote_id = msg;
					
			for(i=0; i < flights_array.length; i++){
				$('#drop_flight_div'+i).html('');
			}
					
			alert('Cotizacion de vuelo agregada con exito: '+flight_quote_id);
			
			$('#close_quotation').html('<div class="separador"></div> <div class="separadorv_gris"></div> <table align="center"> <tr><td align="center"> <img src="http://localhost/hotel-mario/designed_views/imagenes/finalizar.jpg" onclick="process_quotation('+emp_id+');" align="middle" /></td></tr> </table>');
      }
	})
}

function back_data(cont_flight){
	var round_trip = $('#round_trip'+cont_flight).val();
	
	//alert(round_trip);
	if ($('#round_trip'+cont_flight+':checked').val()){
		$('#back'+cont_flight).show(); 
		$('#back_data'+cont_flight).show(); 
	}
	else {
		$('#back'+cont_flight).hide(); 
		$('#back_data'+cont_flight).hide(); 
	}
}

function generic_set_total(number){
	var description = $('#description'+number).val();
	var cant = $('#cant'+number).val();
	var price = $('#price'+number).val();
	
	var total = parseInt(cant) * parseFloat(price);
	$('#generic_total'+number).html('BsF '+total);
}

function generic_q(){
	var clean_array = new Array();
	generic_quote_array = clean_array;
	generic_total = 0;
	
	for(i=0; i <= generic_number; i++){	
		if(($('#description'+i).val() != '') || ($('#cant'+i).val() != '') || ($('#price'+i).val() != '')){
			var length = generic_quote_array.length;
			generic_quote_array[length] = new Array();
			generic_quote_array[length][0] = $('#description'+i).val();
			generic_quote_array[length][1] = $('#cant'+i).val();
			generic_quote_array[length][2] = $('#price'+i).val();
			generic_quote_array[length][3] = parseInt( $('#cant'+i).val() ) * parseFloat( $('#price'+i).val() );
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

	$.ajax({
      url: "http://localhost/hotel-mario/index.php/quotation/generic_summary",
      global: false,
      type: "POST",
      data: ({generic_quote : generic_quote ,
   			  generic_total : generic_total}),
      async:false,
	  dataType:"html",
      success: function(msg){
		$('#generic_summary').html(msg);
      }
	})
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
	$('#generic_info').show();
	generic_number = generic_number + 1;
	var tr = '<tr> <td align="center"><input type="text" id="description'+generic_number+'" name="description'+generic_number+'" size="60"></td>     <td align="center"><input type="text" id="cant'+generic_number+'" name="cant'+generic_number+'" size="3" maxlength="2" ></td> <td align="center">BsF.<input type="text" id="price'+generic_number+'" name="price'+generic_number+'" onBlur="generic_set_total('+generic_number+');" ></td> <td class="rojo totall"><div id="generic_total'+generic_number+'"></div></td> <td></td><td></td> </tr>'; 
	
	$("#generic_table").append(tr);
}

function generic_process(emp_id){
	$.ajax({
      url: "http://localhost/hotel-mario/index.php/quotation/generic_process",
      global: false,
      type: "POST",
      data: ({generic_quote : generic_quote,
		  	  generic_total : generic_total}),
      async:false,
	  dataType:"html",
      success: function(msg){
				$('#generic_info').hide();
				$('#generic_process_button').html('');
				generic_quote_id = msg;
				alert('Cotizacion generica agregada con exito: '+generic_quote_id);
				
				$('#close_quotation').html('<div class="separador"></div> <div class="separadorv_gris"></div> <table align="center"> <tr><td align="center"> <img src="http://localhost/hotel-mario/designed_views/imagenes/finalizar.jpg" onclick="process_quotation('+emp_id+');" align="middle" /></td></tr> </table>');
				
      }
	})
}

function find_traveler(cont_flight, cont_traveler, type){	
	var traveler_ci = $('#'+cont_flight+'_'+type+cont_traveler+'_ci').val();
	$.ajax({
      url: 'http://localhost/hotel-mario/index.php/quotation/find_traveler/'+traveler_ci,
      global: false,
      type: "POST",
      data: ({}),
      async:false,
	  dataType:"html",
      success: function(msg){
				if (msg != ''){
					msg = msg.split('|');
					$('#'+cont_flight+'_'+type+cont_traveler+'_name').val(msg[0]);
					$('#'+cont_flight+'_'+type+cont_traveler+'_lastname').val(msg[1]);
					$('#'+cont_flight+'_'+type+cont_traveler+'_passport').val(msg[2]);
					$('#'+cont_flight+'_'+type+cont_traveler+'_email').val(msg[3]);
				}
				else alert(traveler_ci+' Viajero nuevo');
      }
	})
}

function process_quotation(emp_id){
	$.ajax({
      url: "http://localhost/hotel-mario/index.php/quotation/process_quotation",
      global: false,
      type: "POST",
      data: ({hotel_quote_id : hotel_quote_id,
			   flight_quote_id : flight_quote_id,
			   generic_quote_id : generic_quote_id,
			   package_quote_id : package_quote_id,
			   customer_id: customer_id,
			   employees_id : emp_id}),
      async:true,
	  dataType:"html",
      success: function(msg){
		alert('Cotizacion finalizada');
		hotel_quote_id = null;
		flight_quote_id = null;
		generic_quote_id = null;
		package_quote_id = null;
		//$('#quotation').html(msg);
		
				$.ajax({
				  url: "http://localhost/hotel-mario/index.php/customer/customer_after_quote/"+customer_id,
				  global: false,
				  type: "POST",
				  data: ({}),
				  async:true,
				  dataType:"html",
				  success: function(msg2){
					$('#quotation').html(msg2);
				  }
				})
      }
	})
}

function existing_quotation(customer){
	$.ajax({
      url: 'http://localhost/hotel-mario/index.php/customer/existing_quotation/'+customer,
      global: false,
      type: "POST",
      data: ({}),
      async:false,
	  dataType:"html",
      success: function(msg){
				if(msg != 'no-quote')	$('#existing_quotation').html(msg);
				else					alert('El cliente no posee cotizaciones hasta el momento');
      }
	})
}

function existing_quote_details(quote_id, close_div){
	if(close_div == '1'){
		$('#existing_quote_details'+quote_id).html('');
		$('#existing_quote_details_button'+quote_id).html('<a href="#"><img src="http://localhost/hotel-mario/designed_views/imagenes/fazul.jpg" alt="" onclick="existing_quote_details('+quote_id+',0);" /></a>');
	}
	else{
			$.ajax({
			  url: "http://localhost/hotel-mario/index.php/customer/existing_quote_details",
			  global: false,
			  type: "POST",
			  data: ({quote_id : quote_id}),
			  async:false,
			  dataType:"html",
			  success: function(msg){
					$('#existing_quote_details'+quote_id).html(msg);
					$('#existing_quote_details_button'+quote_id).html('<a href="#"><img src="http://localhost/hotel-mario/designed_views/imagenes/fazul_abajo.jpg" alt="" onclick="existing_quote_details('+quote_id+',1);" /></a>');
			  }
			})
	}
}

function search_client(customer){	
	$.ajax({
      url: "http://localhost/hotel-mario/index.php/customer/search_form",
      global: false,
      type: "POST",
      data: ({ci_client : customer}),
      async:false,
	  dataType:"html",
      success: function(msg){
			if (msg == 'non_existent'){
				
				if ( confirm('No se encuentra registrado, ¿Desea agregarlo?') ){
					new_client(customer);
				}
			}
			else $('#customer').html(msg);      
	  }
	})
}

function new_client(customer){	
	$.ajax({
      url: 'http://localhost/hotel-mario/index.php/customer/new_client/'+customer,
      global: false,
      type: "POST",
      data: ({}),
      async:false,
	  dataType:"html",
      success: function(msg){
		 $('#customer').html(msg);      
	  }
	})
}

function new_client_data(){
	var ci_client = $('#client_id').val();
	var name = $('#name').val();
	var lastname = $('#lastname').val();
	var phone = $('#phone').val();
	var email = $('#email').val();
	var address = $('#address').val();
	var birthdate = $('#birthdate').val();
	var sex = $('input:radio[name=sex]:checked').val();
	
	if((ci_client != '') && (name != '') && (lastname != '') && (phone != '') && (email != '') && (address != '') && (birthdate != '')){
	
	  $.ajax({
		  url: 'http://localhost/hotel-mario/index.php/customer/new_client/'+ci_client,
		  global: false,
		  type: "POST",
		  data: ({ci_client :ci_client,
				   name : name,
				   lastname : lastname,
				   phone : phone,
				   email : email,
				   address : address,
				   birthdate : birthdate,
				   sex : sex}),
		  async:false,
		  dataType:"html",
		  success: function(msg){
				if(msg == 'exist') {
					alert('Ya existe un cliente en el sistema con ese numero de cedula');
				}
				else {
					alert('Cliente agregado con exito');
					search_client(ci_client);
				}
		  }
		})
	 
	 
	}
	else alert('Hay campo(s) obligatorios vacios');
}

function modify_client_button(customer){
	$.ajax({
      url: "http://localhost/hotel-mario/index.php/customer/modify_client",
      global: false,
      type: "POST",
      data: ({ci_client : customer}),
      async:false,
	  dataType:"html",
      success: function(msg){
		$("#customer").html(msg);
      }
	})
}

function modify_client(){
	var ci_client = $('#client_id').val();
	var name = $('#name').val();
	var lastname = $('#lastname').val();
	var phone = $('#phone').val();
	var email = $('#email').val();
	var address = $('#address').val();
	var birthdate = $('#birthdate').val();
	var sex = $('input:radio[name=sex]:checked').val();
	
	if((ci_client != '') && (name != '') && (lastname != '') && (phone != '') && (email != '') && (address != '') && (birthdate != '')){
		
	$.ajax({
      url: "http://localhost/hotel-mario/index.php/customer/modify_client",
      global: false,
      type: "POST",
      data: ({ci_client :ci_client,
			   name : name,
			   lastname : lastname,
			   phone : phone,
			   email : email,
			   address : address,
			   birthdate : birthdate,
			   sex : sex}),
      async:false,
	  dataType:"html",
      success: function(msg){
			alert('Informacion actualizada!');
			search_client(ci_client);
      }
	})
	
	
	}
	else alert('Hay campo(s) obligatorios vacios');
}

function delete_client(customer){
	if( confirm('¿Realmente desea eliminar este cliente?') ){
		$.ajax({
		  url: 'http://localhost/hotel-mario/index.php/customer/delete_client/'+customer,
		  global: false,
		  type: "POST",
		  data: ({}),
		  async:false,
		  dataType:"html",
		  success: function(msg){
				 alert('Cliente eliminado');
				 $.ajax({
					  url: "http://localhost/hotel-mario/index.php/customer/search_form",
					  global: false,
					  type: "POST",
					  data: ({}),
					  async:false,
					  dataType:"html",
					  success: function(msg){
						$("#quotation").html(msg);
					  }
					})
		  }
		})
	}
}

function delete_matrix(season_id, hotel_id, prices){
	alert('delete');
	alert('season '+season_id+', hotel: '+hotel_id);
}

function login(){
	var user_id = $("#user_id").val();
	var user_password = $('#user_password').val();
	
	$.ajax({
      url: "http://localhost/hotel-mario/index.php/seller/login",
      global: false,
      type: "POST",
      data: ({user_id : user_id,
			  user_password : user_password}),
      async:false,
	  dataType:"html",
      success: function(msg){
		if (msg == ('error1')) 	alert('Combinacion erronea de Usuario y Password');
		else					$("#login").html(msg);
      }
	}
	)
}

function add_seller(){
	var re=/^([0-9])*$/;
	var name = $('#seller_name').val();
	var lastname = $('#seller_lastname').val();
	var id = $('#seller_id').val();
	var email = $('#email').val();
	var nick_name = $('#nick_name').val();
	var type = $('#seller_type').val();
	var password = $('#password').val();
	
	$('#user_name_div').css("background-color","#FFFFFF");
	$('#user_id_div').css("background-color","#FFFFFF");
	$('#pass_div').css("background-color","#FFFFFF");
	
	if((name == "")||(lastname == "")||(id == "")||(email == "")||(nick_name == "")||(password == "")){
		alert("Dejo uno o mas campos obligatorios vacios");
	}
	else if(re.exec(password)){
		if((password.length > 5) && (password.length < 16)){
				 $.ajax({
				  url: "http://localhost/hotel-mario/index.php/seller/add_seller",
				  global: false,
				  type: "POST",
				  data: ({name : name,
						   lastname : lastname,
						   id : id,
						   email : email,
						   nick : nick_name,
						   type : type,
						   password : password}),
				  async:false,
				  dataType:"html",
				  success: function(msg){
					  if(msg == "nick"){
						  $('#user_name_div').css("background-color","#FFFF33");
						  alert("El Nombre de Usuario introducido ya existe, introducir otro.");
					  }
					  else if(msg == "existing"){
						  $('#user_id_div').css("background-color","#FFFF33");
						  alert("Ya existe un empleado ACTIVO en el sistema con ese numero de cedula.");
					  }
					  else{
							alert('Agregado con exito.');
							$('#seller').html(msg);
					  }
				  }
				})
		}
		else{
			$('#pass_div').css("background-color","#FFFF33");
			alert("La clave debe tener minimo 5 caracteres y maximo 16");
		}
	}
	else{
		$('#pass_div').css("background-color","#FFFF33");
		alert("La clave debe ser numerica");
	}
}

function delete_seller(employees){
	$.ajax({
      url: "http://localhost/hotel-mario/index.php/seller/delete_seller/"+employees,
      global: false,
      type: "POST",
      data: ({}),
      async:false,
	  dataType:"html",
      success: function(msg){
		  alert("Empleado eliminado exitosamente");
		$("#management_seller").html(msg);
      }
	})
}

function categorie_packages(){
	var categorie_id = $('#categories').val();
	
	 $.ajax({
      url: "http://localhost/hotel-mario/index.php/packages/categorie_packages/0",
      global: false,
      type: "POST",
      data: ({categorie_id : categorie_id}),
      async:false,
	  dataType:"html",
      success: function(msg){
		$("#packages").html(msg);
      }
	})
}

function package_details(pack_id, close_div){
	var ruta = "<?php echo('fazul_abajo.jpg');?>";
	if(close_div == '1'){
		$('#package'+pack_id).html('');
		$('#package_arrow'+pack_id).html('<a href="#"><img src="http://localhost/hotel-mario/designed_views/imagenes/fazul.jpg" alt="" onclick="package_details('+pack_id+',0);" /></a>');
	}
	else{
			$.ajax({
			  url: "http://localhost/hotel-mario/index.php/packages/package_details",
			  global: false,
			  type: "POST",
			  data: ({pack_id : pack_id}),
			  async:false,
			  dataType:"html",
			  success: function(msg){
					$('#package'+pack_id).html(msg);
					$('#package_arrow'+pack_id).html('<a href="#"><img src="http://localhost/hotel-mario/designed_views/imagenes/'+ruta+'" alt="" onclick="package_details('+pack_id+',1);" /></a>');
			  }
			})
	}
}

//'np' stands for New Package
function new_package(){
	package_count = 1;
	
	 $.ajax({
      url: "http://localhost/hotel-mario/index.php/packages/new_package/1/0",
      global: false,
      type: "POST",
      data: ({count : package_count}),
      async:false,
	  dataType:"html",
      success: function(msg){
		$("#new_package").html(msg);
      }
	})
}

function new_package_categories(){
	var number_of_categories = $('#number_of_categories').val();

	 $.ajax({
      url: "http://localhost/hotel-mario/index.php/packages/package_categories",
      global: false,
      type: "POST",
      data: ({number_of_categories : number_of_categories}),
      async:false,
	  dataType:"html",
      success: function(msg){
		$("#new_package_categories").html(msg);
      }
	})
}

function new_categorie(cont){
	var categorie = $('#categories'+cont).val();
	if(categorie == 'new'){
		$('#categorie'+cont).html('Nueva: <input type="text" id="categories'+cont+'" name="categories'+cont+'">');
	}
}

function new_package_hotels(){
	if ( ($('#name') != '') && ($('#number_of_categories') != 0) && ($('#date_start') != '')&& ($('#date_end') != '') && ($('#description') != '')&& ($('#days') != '00')&& ($('#nights') != '00') ){
	
		package_name = $('#name').val();
		package_number_of_categories = $('#number_of_categories').val();
		package_date_start = $('#date_start').val();
		package_date_end = $('#date_end').val();
		package_description = $('#description').val();
		package_days = $('#days').val();
		package_nights = $('#nights').val();
		
		
		for(i=0; i < parseInt(package_number_of_categories); i++){
			package_categories += $('#categories'+i).val()+'|';
		}
		
		$.ajax({
		  url: "http://localhost/hotel-mario/index.php/packages/new_package_hotels/1",
		  global: false,
		  type: "POST",
		  data: ({}),
		  async:false,
		  dataType:"html",
		  success: function(msg){
			$("#new_package").html(msg);
		  }
		})
	}	
	else alert('Debe llenar todos los campos obligatorios antes de Agregar Hoteles-Precios');
}

function np_print_hotels(){
	var clean_array = new Array();
	package_hotels_array = clean_array;
	
	np_number_of_hotels = $('#number_of_hotels').val();
	
	  $.ajax({
		  url: "http://localhost/hotel-mario/index.php/packages/new_package_hotels/0",
		  global: false,
		  type: "POST",
		  data: ({number_of_hotels : np_number_of_hotels}),
		  async:false,
		  dataType:"html",
		  success: function(msg){
				$('#new_package').html(msg);
				$('#new_package_process_button').html('<div class="separadorv"></div> <table><tr><td><img src="http://localhost/hotel-mario/designed_views/imagenes/bprocesar.jpg" onclick="process_package();" /></td></tr></table>');
		  }
		})
}

function np_process_hotels(number_of_hotel){
	var hotel_id = $('#hotel'+number_of_hotel).val();
	
	if(hotel_id != ''){
//in package_hotels_array is stored the id of the current chosen hotel, at the position wich is printed on the screen, so it's easier to know wich hotel was chosen and when. And also initialize the rooms counter that shows how many rooms were picked to belongs to the new package.   		
		
		package_hotels_array[number_of_hotel] = new Array();
		package_hotels_array[number_of_hotel][0] = hotel_id;
		package_hotels_array[number_of_hotel][1] = 1;

		$.ajax({
		  url: "http://localhost/hotel-mario/index.php/packages/new_package/0/1",
		  global: false,
		  type: "POST",
		  data: ({hotel_id : hotel_id,
				   count : 1,
				   number_of_hotel : number_of_hotel}),
		  async:false,
		  dataType:"html",
		  success: function(msg){
				$('#np_hotel'+number_of_hotel).html(msg);
		  }
		})
	}
	else $('#np_hotel'+number_of_hotel).html('');
}

function new_package_room(hotel_id, number_of_hotel){
	package_hotels_array[number_of_hotel][1] += 1;

	 $.ajax({
      url: "http://localhost/hotel-mario/index.php/packages/new_package/0/0",
      global: false,
      type: "POST",
      data: ({hotel_id : hotel_id,
			   count : package_hotels_array[number_of_hotel][1],
			   number_of_hotel : number_of_hotel}),
      async:false,
	  dataType:"html",
      success: function(msg){
			$("#np_table_hotel"+number_of_hotel).append(msg);
      }
	})
}



function process_package(){
	package_rooms = '';

	for(f=1; f < package_hotels_array.length; f++){
		package_rooms += '|||'+package_hotels_array[f][0];
		
		for(j=1; j <= package_hotels_array[f][1]; j++){
			package_rooms += '||'+$('#rooms'+j+'_'+f).val()+'|'+$('#price_adult'+j+'_'+f).val()+'|'+$('#price_kid'+j+'_'+f).val()+'|'+$('#price_additional'+j+'_'+f).val();
		}
	}

	$.ajax({
      url: "http://localhost/hotel-mario/index.php/packages/add_package",
      global: false,
      type: "POST",
      data: ({name : package_name,
			   date_start : package_date_start,
			   date_end : package_date_end,
			   description : package_description,
			   categories : package_categories,
			   rooms : package_rooms,
			   days : package_days,
			   nights : package_nights}),
      async:false,
	  dataType:"html",
      success: function(msg){
			$('#management_packages').html(msg);
			alert('Paquete agregado con exito');
      }
	})
}


//pq stands for Package Quotation
function pq_select_categorie(){
	var categorie = $('#categories').val();
	$.ajax({
      url: "http://localhost/hotel-mario/index.php/quotation/pq_selected_categorie",
      global: false,
      type: "POST",
      data: ({categorie : categorie}),
      async:false,
	  dataType:"html",
      success: function(msg){
		$("#pq_select_package").html(msg);
      }
	})
}

function pq_select_package(package_id){
	$.ajax({
      url: "http://localhost/hotel-mario/index.php/quotation/pq_selected_package",
      global: false,
      type: "POST",
      data: ({package : package_id}),
      async:false,
	  dataType:"html",
      success: function(msg){
		$("#pq_select_package").html(msg);
      }
	})
}

function pq_details(pack_id, hotel_id){
	pq_count = 1;
	var clean_array = new Array();
	pq_total = clean_array;
	pq_hotel = hotel_id;
	pq_package = pack_id;
	var clean_array = new Array();
	pq_rooms = clean_array;

	$.ajax({
      url: "http://localhost/hotel-mario/index.php/quotation/pq_selected_hotel/1",
      global: false,
      type: "POST",
      data: ({package : pack_id,
			   hotel : hotel_id,
			   pq_count : 1}),
      async:false,
	  dataType:"html",
      success: function(msg){
		$("#pq_details").html(msg);
      }
	})
}

function pq_add_room(){
	pq_count += 1;

	$.ajax({
      url: "http://localhost/hotel-mario/index.php/quotation/pq_selected_hotel/0",
      global: false,
      type: "POST",
      data: ({package : pq_package,
			   hotel : pq_hotel,
			   pq_count : pq_count}),
      async:false,
	  dataType:"html",
      success: function(msg){
			$("#pq_table").append(msg);
      }
	})
}

function pq_set_price(count){
	var pack_room = $('#room'+count).val();
	
	pq_rooms[count] = new Array(); 
		//[0]: rooms_per_package_id, [1]:price per adult,[2]:price per kid,[3]:cant of adults,[4]:cant of kids
						
	pq_rooms[count] = pack_room.split("|");
	$('#pq_price_adult'+count).html('BsF. '+pq_rooms[count][1]);
	$('#pq_price_kid'+count).html('BsF. '+pq_rooms[count][2]);
}

function sum_pq_total(){
	pq_total_numeric = 0;
	for(i=1; i < pq_total.length; i++){
		pq_total_numeric = pq_total_numeric + pq_total[i];
	}
}

//receives two parameters, the number of the subtotal field and the id of the employee loged in to  be stored in the final quotation process

function pq_set_subtotal(count, emp_id){
	var cant_persons = $('#cant_persons'+count).val();
	var cant_kids = $('#cant_kids'+count).val();
	
	pq_rooms[count][3] = cant_persons;
	pq_rooms[count][4] = cant_kids;
	var subtotal = (parseFloat(pq_rooms[count][1])* parseInt(pq_rooms[count][3]))+(parseFloat(pq_rooms[count][2])* parseInt(pq_rooms[count][4]));
	pq_total[count] = subtotal;
	sum_pq_total();
	
	$('#pq_subtotal'+count).html('BsF. '+subtotal);
	for(i=1; i<=count; i++){
		$('#pq_total'+i).html('');
	}
	$('#pq_total'+pq_count).html('----------------- <br />BsF. '+pq_total_numeric);
	if(pq_total_numeric > 0){
		$('#pq_process_button').html('<a href="#"><img src="http://localhost/hotel-mario/designed_views/imagenes/bagregar.jpg" onclick="pq_process(0,'+emp_id+');" /></a>');
		
		
	}
}

function pq_process(summary, emp_id){
	sum_pq_total();
	if(summary == 0){
		pq_check_in = $('#check_in').val();
		pq_check_out = $('#check_out').val();
	}
	var rooms = '';
	for(i=1; i < pq_rooms.length; i++){
		for(j=0; j < pq_rooms[i].length; j++){
			rooms += pq_rooms[i][j]+'|';
		}
		rooms += '|';
	}

    $.ajax({
      url: 'http://localhost/hotel-mario/index.php/quotation/pq_process/'+summary,
      global: false,
      type: "POST",
      data: ({rooms : rooms,
			   pq_total : pq_total_numeric,
			   check_in : pq_check_in,
			   check_out : pq_check_out}),
      async:false,
	  dataType:"html",
      success: function(msg){
				if(summary == 1){
					alert('Paquete agregado con exito');
					package_quote_id = msg;
					$('#pq_process_button_summary').html(msg);
					$('#close_quotation').html('<div class="separador"></div> <div class="separadorv_gris"></div> <table align="center"> <tr><td align="center"> <img src="http://localhost/hotel-mario/designed_views/imagenes/finalizar.jpg" onclick="process_quotation('+emp_id+');" align="middle" /></td></tr> </table>');
				}
				else{
					$('#pq_process_button').html('');
					$('#pq_details').html(msg);
				}
      }
	})
}

function management_hotel_chosen(){
	var hotel_chosen = $('#hotels').val();
	$.ajax({
      url: "http://localhost/hotel-mario/index.php/hotels",
      global: false,
      type: "POST",
      data: ({hotels : hotel_chosen}),
      async:false,
	  dataType:"html",
      success: function(msg){
			$("#management_hotels_div").html(msg);
      }
	})
}

function management_price_matrix(){
	var hotel_chosen = $('#hotels').val();
	$.ajax({
      url: "http://localhost/hotel-mario/index.php/price_matrix/index/1",
      global: false,
      type: "POST",
      data: ({hotels : hotel_chosen}),
      async:false,
	  dataType:"html",
      success: function(msg){
			$("#management_price_matrix_div").html(msg);
      }
	})
}

function price_matrix_hotel(){
	var hotel_chosen = $('#hotels').val();
	$.ajax({
      url: "http://localhost/hotel-mario/index.php/price_matrix/index/0",
      global: false,
      type: "POST",
      data: ({hotels : hotel_chosen}),
      async:false,
	  dataType:"html",
      success: function(msg){
			$("#price_matrix_div").html(msg);
      }
	})
}
