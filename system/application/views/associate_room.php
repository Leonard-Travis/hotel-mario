<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gestion</title>
</head>

<body>
<table border="1" align="center" width="100%"> <tr>
    <td colspan="3" align="center"><strong>HOTELES.COM.VE</strong></td> </tr>
    <tr>
	<td width="33%" align="center"> <a href="<?php echo base_url(); ?>customer/search_form"><strong>Clientes</strong></a> </td>
    <td width="33%" align="center"> <a href="<?php echo base_url(); ?>home/management"><strong>Gestion</strong></a> </td>
    <td width="33%" align="center"> <a href="<?php echo base_url(); ?>price_matrix/index/0"><strong>Matriz de Precios</strong></a> </td> 
</tr> </table>
<table border="1" align="center" width="100%"> <tr>
    <td colspan="4" align="center"><strong>GESTION</strong></td> </tr>
    <tr>
	<td width="25%" align="center"> <a href="<?php echo base_url(); ?>hotels"><strong>Hoteles</strong></a> </td>
    <td width="25%" align="center"> <a href="<?php echo base_url(); ?>rooms"><strong>Habitaciones</strong></a> </td>
    <td width="25%" align="center"> <a href="<?php echo base_url(); ?>plans"><strong>Planes</strong></a> </td> 
    <td width="25%" align="center"> <a href="<?php echo base_url(); ?>price_matrix/index/1"><strong>Matriz de Precios</strong></a> </td> 
</tr> </table>
	
<?php if ($query) {?>
	<?php foreach ($query as $hotel) { ?>
        <table align="center" width="40%">
            <tr> <td colspan="2"><strong>Asociacion Hotel con tipo de Habitacion</strong></td></tr>
            <tr>
                <td>Nombre</td>
                <td><input type="text" name="name" readonly="readonly" value="<?php echo($hotel['name']); ?>"  /></td>
            </tr>
            <tr>
                <td>Habitaciones (seleccione la que desea asociar al hotel)</td> 
                <td>		
            <form method="post" action="<?php echo base_url(); ?>hotels/associate_room">
                <select name="rooms" id="rooms">
                <?php foreach ($rooms as $room) { ?>
                    <option value="<?php echo ($room['room_id']);?>"><?php echo ($room['name']);?></option> 
                <?php }?>
                </select>
                </td> 
                </tr>
                <tr>
                <td>Descripcion de la Habitacion</td> 
                <td><input type="text" name="description" id="description" /></td>
                </tr>
                <tr>
                <td>¿Es comisionable para el hotel?</td>
                <td> <input type="radio" name="commissionable" id="commissionable" value="1" checked="checked" />SI
                	 <input type="radio" name="commissionable" id="commissionable" value="0" />NO </td>
                </tr>
                <tr>
                <td> <input name="send" type="submit" value="Aceptar" /> </td> </tr>
                <input type="hidden" name="hotel_id" id="hotel_id" value="<?php echo($hotel['hotel_id']); ?>"  />
            </form>
        </table>
    <?php }?>
<?php }?>

</body>
</html>