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

function test(){
	if (confirm('amame!')){
		return true;
	}
	else return false;
}

function quote(client_id){
	 customer_id = client_id;
     new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/hotel_quote',{
      method: 'post',
      parameters: {customer_id : customer_id
		  			},
	  asynchronous: true,
      onSuccess: function(consultadoA){
		 $('hotel_quote').update(consultadoA.responseText);
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
	$('add_quote_button').update('');
	
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
	  		$('quote_details_form').update(consultadoA.responseText);
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







