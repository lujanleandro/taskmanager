<? include ("includes/includesTop.php"); ?>
<h1><?=$values['mod_conf']['title_edit']?></h1>
<form method="post" action="index.php" enctype="multipart/form-data" >
<input type="hidden" name="module" value="<?=$values['mod_conf']['module_name']?>" />
<input type="hidden" name="id" value="<?=$values['item']['tag_id']?>" />
<input type="hidden" name="<?=ACTION_FIELDNAME;?>" value="editok" />
	<ul class="editForm">
		<li class="floatFix">
			<h2>Titulo:</h2>
			<input type="text" name="name" value="<?=$values['item']['tag_name']?>" />
		</li>	
		<li class="floatFix">
			<h2>Descripci&oacute;n:</h2>
			<input type="text" name="description" value="<?=$values['item']['tag_description']?>" />
		</li>			
		<li class="floatFix">
			<h2>&nbsp;</h2>
			<button name="send" type="submit" class="btn btn-primary button"><i class="fa fa-check-circle"></i> Guardar</button>
			<button name="cancel" type="reset" class="btn btn-default button_cancel" onclick="document.location='index.php?module=<?=$values['mod_conf']['module_name']?>&amp;<?=ACTION_FIELDNAME;?>=list'"> Cancelar</button>
		</li>
	</ul>
</form>
<? include ("includes/includesBottom.php"); ?>