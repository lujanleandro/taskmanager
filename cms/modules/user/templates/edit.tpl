<? include ("modules/user/moduleconfig.php"); ?>
<? include ("config/config.inc"); ?>
<? include ("includes/includesTop.php"); ?>
	<h1><?=$mod_conf['title_edit']?></h1>
	<form action="index.php" method="POST" enctype="multipart/form-data" >
	<input type="hidden" name="module" value="<?=$mod_conf['module_name']?>" />
	<input type="hidden" name="user_id" value="<?=$values['item']['id']?>" />
	<input type="hidden" name="<?=ACTION_FIELDNAME;?>" value="editok" />
	<input type="hidden" name="back_submit" id="back_submit" value="0" />
	<? //printr($values['item']); ?>
	<ul class="editForm">
		<li class="floatFix">
			<h2>Nombre del usuario:</h2>
			<input type="text" name="item_name" value="<?=$values['item']['username'];?>" />
		</li>
		<li class="floatFix">
			<h2>Email del usuario:</h2>
			<input type="text" name="item_email" value="<?=$values['item']['email'];?>" />
		</li>										
		<li class="floatFix">
			<h2>Password del usuario:</h2>
			<input type="password" name="item_password" value="" />
		</li>
		<li class="floatFix">
			<h3>&nbsp;</h3>
			<h2>&nbsp;</h2>
			<button name="send" type="submit" class="btn btn-primary button"><i class="fa fa-check-circle"></i> Guardar</button>
			<button name="send" type="button" onclick="submitBack();" class="btn btn-info button"><i class="fa fa-check-circle"></i> Guardar y volver</button>
			<button name="cancel" type="button" onclick="document.location='index.php?module=<?=$mod_conf['module_name']?>&amp;<?=ACTION_FIELDNAME;?>=list'" class="btn btn-default button_cancel"><i class="fa fa-times-circle"></i> Cancelar</button>
		</li>
	</ul>
	</form>
<? include ("includes/includesBottom.php"); ?>