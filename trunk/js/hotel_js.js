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
















