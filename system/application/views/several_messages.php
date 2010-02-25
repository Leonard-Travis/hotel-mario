<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Mensaje</title>
</head>

<body>
<table>
<?php if ($message_index == 'success'){ ?>
<tr> <td> <strong> El cliente fe agregado exitosamente! <strong> </td> </tr>
<?php } 

	  else if ($message_index == 'unknown') {?>
<tr> <td> <strong>El cliente no existe en la base de datos! <strong> </td> </tr>
<tr> <td> <a href="new_client">Click para agregarlo</a> </td> </tr>
<?php } ?>

<tr> <td> <a href="form_controller">Volver a Pagina Principal</a> </td> </tr>
</table>
</body>
</html>