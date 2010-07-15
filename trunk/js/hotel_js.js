// JavaScript Document
var counter = 0;
var subtotal = 0;
var sub_array = new Array();
var customer_id;
var rooms_selected = new Array();

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
	subtotal = 0;
	rooms_selected = clean_array;
	sub_array = clean_array;
	var plan_id = $F('plan');
	var date_ini = $F('date_start');
	var date_end = $F('date_end');
	var hotel_id = $F('hotel_id');
	
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/start_quote/0',{
      method: 'post',
      parameters: {hotel_id : hotel_id,
	  			   plan_id : plan_id,
				   date_ini : date_ini,
				   date_end : date_end,
				   counter : 0
		  			},
	  asynchronous: true,
      onSuccess: function(consultadoA){
		  counter = 0;
		 $('quote_details_form').update(consultadoA.responseText);
      }
      }
   );	
}

function setting_PU(countaux, form){
	var room = $F('rooms'+countaux);
	rooms_selected[countaux] = room;
	var date_start = $F('date_start');
	var date_end = $F('date_end');
	var plan = $F('plan');
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/setting_PU',{
      method: 'post',
      parameters: {room : room,
	  			   date_start : date_start,
				   date_end : date_end,
				   plan : plan
		  			},
	  asynchronous: true,
      onSuccess: function(consultadoA){
		  $('price_per_night'+countaux).update(consultadoA.responseText);
		  $('subtotal'+countaux).update('');
      }
      }
   );
}

function calculate_sub(){
	subtotal = 0;
	for (i=0; i < sub_array.length; i++){
		if (sub_array[i]){
			subtotal = subtotal + sub_array[i];
		}
	}
}

function setting_subtotal(countaux){
	var quantity = $F('quantity'+countaux);
	var room = $F('rooms'+countaux);
	var date_start = $F('date_start');
	var date_end = $F('date_end');
	var plan = $F('plan');
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/setting_subtotal',{
      method: 'post',
      parameters: {room : room,
	  			   date_start : date_start,
				   date_end : date_end,
				   plan : plan,
				   quantity : quantity
		  			},
	  asynchronous: true,
      onSuccess: function(consultadoA){
		  sub_array[countaux] = parseFloat(consultadoA.responseText);
		  calculate_sub();
		  $('subtotal'+countaux).update('BsF. '+consultadoA.responseText);
		  $('total'+counter).update('---------------- <br />BsF.'+subtotal);		  
	  }
      }
   );
}

function add_room(){ 
	var plan_id = $F('plan');
	var date_ini = $F('date_start');
	var date_end = $F('date_end');
	var hotel_id = $F('hotel_id');
	
	$('total'+counter).update('');
	counter = counter + 1;
	
	var imploded = 0;
	if (rooms_selected[0]){
		for (i=0; i<rooms_selected.length; i++) {
			imploded += '|' + rooms_selected[i];
		}
	}
		
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/start_quote/1',{
      method: 'post',
      parameters: {hotel_id : hotel_id,
	  			   plan_id : plan_id,
				   date_ini : date_ini,
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









