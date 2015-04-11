<? include ("includes/includesTop.php"); ?>
<h1><?=$values['mod_conf']['title_edit']?></h1>
<form method="post" action="index.php" enctype="multipart/form-data" >
<input type="hidden" name="module" value="<?=$values['mod_conf']['module_name']?>" />
<input type="hidden" name="category_id" value="<?=$values['item']['category_id']?>" />
<input type="hidden" name="<?=ACTION_FIELDNAME;?>" value="editok" />
	<ul class="editForm">
		<li class="floatFix">
			<h2>Estado:</h2>
			<select name="estado_id">
			<? foreach($values['estadoList'] as $estado) { ?>
			<option value="<?=$estado['estado_id']?>" <?=($estado['estado_id'] == $values['item']['estado_id'] )?'selected="selected"':""?> ><?=$estado['estado_name']?></option>
			<? } ?>
			</select>
			<b>Orden:</b>
			<select name="item_order">							
				<option value="0" <?=($values['item']['category_order'] == 0)?'selected="selected"':''; ?>>[ 0 ]</option>
				<option value="1" <?=($values['item']['category_order'] == 1)?'selected="selected"':''; ?>>1</option>
				<option value="2" <?=($values['item']['category_order'] == 2)?'selected="selected"':''; ?>>2</option>
				<option value="3" <?=($values['item']['category_order'] == 3)?'selected="selected"':''; ?>>3</option>
				<option value="4" <?=($values['item']['category_order'] == 4)?'selected="selected"':''; ?>>4</option>
				<option value="5" <?=($values['item']['category_order'] == 5)?'selected="selected"':''; ?>>5</option>
				<option value="6" <?=($values['item']['category_order'] == 6)?'selected="selected"':''; ?>>6</option>
				<option value="7" <?=($values['item']['category_order'] == 7)?'selected="selected"':''; ?>>7</option>
				<option value="8" <?=($values['item']['category_order'] == 8)?'selected="selected"':''; ?>>8</option>
				<option value="9" <?=($values['item']['category_order'] == 9)?'selected="selected"':''; ?>>9</option>
				<option value="10" <?=($values['item']['category_order'] == 10)?'selected="selected"':''; ?>>10</option>
			</select>
		</li>
		<li class="floatFix">
			<h2>Titulo:</h2>
			<input type="text" name="name" value="<?=$values['item']['category_name']?>" />
		</li>		
		<li class="floatFix">
			<h2>Descripci&oacute;n:</h2>
			<input type="text" name="description" value="<?=$values['item']['category_description']?>" />
		</li>			
		<li class="floatFix">
			<h2>&nbsp;</h2>
			<button name="send" type="submit" class="btn btn-primary button"><i class="fa fa-check-circle"></i> Guardar</button>
			<button name="cancel" type="reset" class="btn btn-default button_cancel" onclick="document.location='index.php?module=<?=$values['mod_conf']['module_name']?>&amp;<?=ACTION_FIELDNAME;?>=list'"> Cancelar</button>
		</li>
	</ul>
</form>
<? include ("includes/includesBottom.php"); ?>