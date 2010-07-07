// JavaScript Document
var customer_id;

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
	var plan_id = $F('plan');
	var date_ini = $F('date_ini');
	var date_end = $F('date_end');
	var hotel_id = $F('hotel_id');
	
	new Ajax.Request('http://localhost/hotel-mario/index.php/quotation/start_quote',{
      method: 'post',
      parameters: {hotel_id : hotel_id,
	  			   plan_id : plan_id,
				   date_ini : date_ini,
				   date_end : date_end
		  			},
	  asynchronous: true,
      onSuccess: function(consultadoA){
		 $('start_quote').update(consultadoA.responseText);
      }
      }
   );
	
	
}

function setting_PU(){
	var room = $F('rooms');
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
		  $('price_per_night').update(consultadoA.responseText);
      }
      }
   );
}

function setting_subtotal(){
	var quantity = $F('quantity');
	var room = $F('rooms');
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
		  //quote_data.quantity.value = consultadoA.responseText;
		  $('subtotal').update(consultadoA.responseText);
      }
      }
   );
}










