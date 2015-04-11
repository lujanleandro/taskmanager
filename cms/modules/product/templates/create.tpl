<? include ("includes/includesTop.php"); ?>

<h1><?=$values['mod_conf']['title_create']?></h1>

<form action="index.php" method="POST" enctype="multipart/form-data" >
<input type="hidden" name="module" value="<?=$values['mod_conf']['module_name']?>" />
<input type="hidden" name="<?=ACTION_FIELDNAME;?>" value="createok" />
	<ul class="editForm">
		<li class="floatFix">
			<h2>Estado:</h2>
			<!-- <pre><?= print_r($values['estadoList']) ?></pre> -->
			<select name="estado_id">
			<?
				if(is_array($values['estadoList'])){
					foreach($values['estadoList'] as $estado){
						?><option value="<?=$estado['estado_id'];?>"><?=$estado['estado_name'];?></option><?
					}
				}								
			?>
			</select>
		</li>						
		<li class="floatFix">
			<h2>Nombre:</h2>
			<input type="text" name="item_name" />
		</li>				
		<li class="floatFix" >
			<h2>Descripcion:</h2>
			<div style="float:left;margin-bottom:15px;width:500px;">
				<textarea name="item_description" id="item_description" rows="10" cols="80" placeholder="Escribir Descripcion..."></textarea>
			</div>
			<script>CKEDITOR.replace('item_description');</script>
		</li>

		<li class="floatFix">
			<h2>Cliente:</h2>
			<!-- <pre><?= print_r($values['categories']) ?></pre> -->
			<select name="category_id"  onchange="changeOpr(this.value);" onfocus="changeOpr(this.value);">
			<?
				if(is_array($values['categories'])){
					foreach($values['categories'] as $category){
						?><option value="<?=$category['category_id'];?>"><?=$category['category_name'];?></option><?
					}
				}								
			?>
			</select>
		</li>
	</ul>
	<div class="buttonContent">
		<h2>Finalizar:</h2>
		<button name="send" type="submit" class="btn btn-primary button"><i class="fa fa-check-circle"></i> Crear</button>
		<button name="cancel" type="button" onclick="document.location='index.php?module=<?=$values['mod_conf']['module_name'];?>&amp;<?=ACTION_FIELDNAME;?>=list'" class="btn btn-default button_cancel"><i class="fa fa-times-circle"></i> Cancelar</button>
	</div>
</form>
<? include ("includes/includesBottom.php"); ?>