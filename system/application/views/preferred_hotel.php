<?php if($hotels){ ?>
<script type="text/javascript">
	$(function() {
		var availableTags = new Array();
		<?php for($i=0; $i <  count($hotels) ; $i++){?>
			availableTags[<?php echo($i); ?>] = {label: "<?php echo($hotels[$i]['name']);?>",
												 value: "<?php echo($hotels[$i]['hotel_id']);?>"};
		<?php } ?>	
		
		$('#tags').autocomplete({
			minLength: 0,
			source: availableTags,
			focus: function(event, ui) {
				$('#tags').val(ui.item.label);
				return false;
			},
			select: function(event, ui) {
				$('#tags').val(ui.item.label);
				$('#hotels').val(ui.item.value);				
				return false;
			}
		});
	});
</script>

    <td align="center">           
            <input id="tags" />
     </td> 
     <td> 
         <a href="javascript:void(0);" onClick="preferred_chosen();">
         	<img src="<?php echo IMG; ?>bbuscar.jpg" onclick="preferred_chosen();" />
         </a>
         <input type="hidden" id="hotels" name="hotels" />
     </td> 
<?php } ?> <!--end of if hotels-->


<?php if($hotel_selected){ 
		$add_or_remove = '<img src="'.IMG.'bagregar.jpg" onclick="preferred_update(1);" />';
		if($hotel_selected[0]['preferred'] == '1') 
			$add_or_remove = '<button value="Eliminar" onclick="preferred_update(0);">Eliminar</button>';?>
	<br /><br />
	<input type="hidden" id="hotel_id" value="<?php echo($hotel_selected[0]['hotel_id']);?>">
	<table align="center" width="50%">
    	<tr>
            <td align="center" colspan="2">
            	<span class="naranja"><?php echo($hotel_selected[0]['name']);?></span>
            </td>
        </tr>
        <tr>
        	<td align="center"><strong>Direcci&oacute;n: </strong></td>
            <td align="center"><?php echo($hotel_selected[0]['address']);?></td>
        </tr>
        <tr>
        	<td align="center"><strong>Tel&eacute;fono: </strong></td>
            <td align="center"><?php echo($hotel_selected[0]['phone']);?></td>
        </tr>
        <tr>
        	<td colspan="2" align="center">
            <?php echo($add_or_remove);?>
            </td>
        </tr>
       
    </table>
<?php } ?>