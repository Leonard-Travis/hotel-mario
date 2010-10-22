<div class="separadorv"></div>
<div class="separadorv"></div>

<table width="100%">
    <tr>
    
    <td>
    <span class="naranja">Descripcion: </span> <?php echo($description); ?>
    </td>
    
     <td width="50%">
        <table width="100%">
            <thead>
                <tr class="pthead">
                    <td align="center">Habitaciones</td> <td align="center">Precio p/persona</td>
                </tr>
            </thead>
            
            <?php foreach($rooms as $room){ ?>
            <tr>
            <td align="center"><?php echo($room['name_spanish']); ?></td> 
            <td align="center">BsF. <?php echo($room['price_per_person']); ?></td>
            </tr>
            <?php } ?>
        </table>
    </td>
    
   
</table>
<br  />
<br  />