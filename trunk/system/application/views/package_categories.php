<table>
<?php for($i=0; $i < ((int)$number_of_categories); $i++){ ?>
		<tr>
        <td>
        <div id="categorie<?php echo($i);?>">
        <select id="categories<?php echo($i);?>" onChange="new_categorie(<?php echo($i);?>);">
        <?php foreach($categories as $categorie){ ?>
        	<option value="<?php echo($categorie['categorie_id']); ?>"><?php echo($categorie['name_spanish']); ?></option>
        <?php } ?>
        <option value="new">--Nueva Categoria--</option> 
        </select>
        </div>
        </td>
        </tr>
<?php } ?>
</table>