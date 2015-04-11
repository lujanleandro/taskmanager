<? include ("modules/product/moduleconfig.php"); ?>
<? include ("config/config.inc"); ?>
<? include ("includes/includesTop.php"); ?>

<!--<h1><?=$mod_conf['title_edit']?></h1>-->
<form id="fileupload" action="index.php" method="POST" enctype="multipart/form-data" >
<input type="hidden" name="module" value="<?=$mod_conf['module_name']?>" />
<input type="hidden" name="item_id" value="<?=$values['item']['product_id']?>" class="form-control" />
<input type="hidden" name="<?=ACTION_FIELDNAME;?>" value="editok" />
<input type="hidden" name="back_submit" id="back_submit" value="0" />
<? //printr($values['item']); ?>

<ul class="editForm">
	<li>
		<h3>1. Informaci&oacute;n principal&nbsp;
		<?php 
			if(!empty($values['item']['product_document'])){
			echo "-&nbsp;<a class='btn btn-primary' target='new' href='".$values['item']['product_document']."'><i class='fa fa-file'></i>&nbsp;Doc</a>";
		}?>
		</h3>
	</li>
	<li class="floatFix">
		<h2>Estado:</h2>
		<select name="estado_id">
		<? foreach($values['estadoList'] as $estado) { ?>
		<option value="<?=$estado['estado_id']?>" <?=($estado['estado_id'] == $values['item']['estado_id'] )?'selected="selected"':""?> ><?=$estado['estado_name']?></option>
		<? } ?>
		</select>

		<b>Orden:</b>
		<select name="item_order">							
			<option value="0" <?=($values['item']['product_order'] == 0)?'selected="selected"':''; ?>>[ 0 ]</option>
			<option value="1" <?=($values['item']['product_order'] == 1)?'selected="selected"':''; ?>>1</option>
			<option value="2" <?=($values['item']['product_order'] == 2)?'selected="selected"':''; ?>>2</option>
			<option value="3" <?=($values['item']['product_order'] == 3)?'selected="selected"':''; ?>>3</option>
			<option value="4" <?=($values['item']['product_order'] == 4)?'selected="selected"':''; ?>>4</option>
			<option value="5" <?=($values['item']['product_order'] == 5)?'selected="selected"':''; ?>>5</option>
			<option value="6" <?=($values['item']['product_order'] == 6)?'selected="selected"':''; ?>>6</option>
			<option value="7" <?=($values['item']['product_order'] == 7)?'selected="selected"':''; ?>>7</option>
			<option value="8" <?=($values['item']['product_order'] == 8)?'selected="selected"':''; ?>>8</option>
			<option value="9" <?=($values['item']['product_order'] == 9)?'selected="selected"':''; ?>>9</option>
			<option value="10" <?=($values['item']['product_order'] == 10)?'selected="selected"':''; ?>>10</option>
		</select>
	</li>
	<li class="floatFix">
		<h2>Nombre:</h2>
		<input type="text" name="item_name" value="<?=$values['item']['product_name'];?>" autofocus />
	</li>
	<li class="floatFix">
		<h2>Cliente:</h2>
		<select name="category_id">
		<?
			if(is_array($values['categories'])){
				foreach($values['categories'] as $category){
					$selected = '';
					if($category['category_id'] == $values['item']['category_id'])
						$selected = 'selected="selected"';
					?>
					<option value="<?=$category['category_id'];?>" <?=$selected;?>><?=$category['category_name'];?></option>
					<?php
				}
			}else{
				?><option value="0">No Hay Categorias</option><?
			}
		?>
		</select>
		<b>Carpeta:</b>
		<select name="tag_id[]" id="tag_id[]">
		<?
			if(is_array($values['tags'])){
				foreach($values['tags'] as $tag){
					$selected = '';
					if(is_array($values['tagsRelations'])){
						foreach($values['tagsRelations'] as $tagRelation){
							if($tag['tag_id'] == $tagRelation['tag_id']){
								$selected = 'selected="selected"';
							}
						}
						?><option value="<?=$tag['tag_id'];?>" <?=$selected;?>><?=$tag['tag_name'];?></option><?						
					}
				}
			}else{
				?><option value="0">No Hay Tags</option><?
			}							
		?>
		</select>		
	</li>

	<li class="floatFix">
		<h2>Descripcion:</h2>
		<div style="float:left;margin-bottom:15px;width:650px;">
		<textarea name="item_description" id="item_description" rows="10" cols="80"><?=$values['item']['product_description'];?></textarea>
		</div>
		<script>CKEDITOR.replace('item_description');</script>
	</li>
	<li class="floatFix">
		<h2>Documento:</h2>
		<input type="text" name="item_document" value="<?=$values['item']['product_document'];?>" />
	</li>
	<li>
	<h3 id="cargarFotos">
		2 . Agregar Fotos o Videos&nbsp;&nbsp;
		<button name="send" type="submit" class="btn btn-primary button"><i class="fa fa-check-circle"></i> Guardar Fotos</button>
		<?php $urlDelete = "index.php?module=".$mod_conf['module_name']."&amp;".ACTION_FIELDNAME."=deleteimages&amp;id=".$values['item']['product_id']; ?>
		<a href="<?=$urlDelete;?>" class="btn btn-danger button"><i class="fa fa-times-circle"></i> Borrar Fotos</a>
	</h3>
	</li>
	<?php include ("image_upload.php"); ?>
</ul>
<div class="buttonContent">
	<h2>Finalizar:</h2>
	<button name="send" type="submit" class="btn btn-primary button"><i class="fa fa-check-circle"></i> Guardar</button>
	<button name="send" type="button" onclick="submitBack();" class="btn btn-success button"><i class="fa fa-check-circle"></i> Guardar y volver</button>
	<button name="cancel" type="reset" onclick="document.location='index.php?module=<?=$mod_conf['module_name']?>&amp;<?=ACTION_FIELDNAME;?>=list'" class="btn btn-default button_cancel"><i class="fa fa-times-circle"></i> Cancelar</button>
</div>
</form>
<? include ("includes/includesBottom.php"); ?>