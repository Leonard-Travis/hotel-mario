// JavaScript Document

function test(){
	if (confirm('amame!')){
		return true;
	}
	else return false;
}

function test2(){
	$('libro').update("Consultando...");
     new Ajax.Request('http://localhost/hotel-mario/index.php/hotels',{
      method: 'post',
      parameters: {},
	  asynchronous: true,
      onSuccess: function(consultadoA){
		 //$('libro').update(consultadoA.responseText);
      }
      }
   );
}