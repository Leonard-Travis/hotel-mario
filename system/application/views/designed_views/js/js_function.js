var x;
x=$(document);
x.ready(inicializarEventos);

function inicializarEventos()
{
  var x;
  x=$("#enviar");
  x.click(presionBoton)
}

function presionBoton()
{
  alert("Se presion� el bot�n");
}