var x;
x=$(document);
x.ready(start_event);

function start_event()
{
  var p;
  p=$("#modify_button");
  p.click(modify_button)
}

function modify_button()
{
   var y = $('#ci_customer').attr("value")
   alert("la cedula es: "+y);
   
  $.ajax({
	  url: 'modify_client',
	  type: 'POST',
	  dataType: "html",
      contentType: "application/x-www-form-urlencoded",
	  async: true,
	  data: {ci : y},
	  success: function test() {
		  $("#datos").text('<a href="modify_client">Click para continuar</a>');
		  },
	  error:function (xhr, ajaxOptions, thrownError){
		   			alert ('Hay un error en el ajax');
                    alert(xhr.status);
	  }
  }).responseText;
   
   alert ('dspues ajax');
}