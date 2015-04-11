<? include ("{$_SERVER['DOCUMENT_ROOT']}/admin/includes/includesTop.php"); ?>
<? include("{$_SERVER['DOCUMENT_ROOT']}/admin/conf/conf.php");?>
				<h2>Editar Imagen</h2>
				
				<? $item = $values['item']; ?>
				<form method="post" action="" enctype="multipart/form-data" >
				<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
				<input type="hidden" name="id" value="<?=$item['id']?>" />
				<input type="hidden" name="action" value="<?=EDITAR_IMAGEN_OK?>" />
				
				<ul class="editForm">
					
					
					<li class="floatFix">
						<h2>Fecha:</h2>
						<?
						$pieces;
						if($item['fecha']!=''){
							$pieces = explode ("-",$item['fecha']);
							
						}
						?>
						<input name="dd" size="2" value="<?=$pieces[2]?>" type="text" style="width:15px;" maxlength="2" /> / 
						<input name="mm" size="2" value="<?=$pieces[1]?>" type="text" style="width:15px;" maxlength="2" /> / 
						<input name="yy" size="4" value="<?=$pieces[0]?>" type="text" style="width:30px;"maxlength="4" />
						
					</li>
					
					<li class="floatFix">
						<h2>Orden:</h2>
						<input name="orden" size="2" value="<?=$item['orden']?>" type="text" />
						
					</li>
					<li class="floatFix">
						<h2>Titulo:</h2>
						<input name="titulo" size="30" value="<?=$item['titulo']?>" type="text" />
						
					</li>
					<li class="floatFix">
						<h2>Categoria:</h2>
						<select name="categoria">
							<? if($values['categorias']) { foreach($values['categorias'] as $categoria) {?>
							<option value="<?=$categoria['id']?>" <? if($categoria['id'] == $item['categoria_id']) print "selected";  ?> ><?=$categoria['titulo']?></option>
							<? }}?>
						</select>
					</li>
					<li class="floatFix">
						<h2>Archivo:</h2>
						<input name="image_file" size="30" value="" type="file" />
						
					</li>
					<li class="floatFix">
						
						<h2></h2>
						<img src="<?=$conf["categorias"][$item['categoria_id']]["path"].$item['archivo']?>" alt="" border=""/>
						
					</li>

					
					
					
					<li class="floatFix">
						<h2>&nbsp;</h2>
						<input name="send" value="Enviar"  type="submit" class="boton" />
						
					</li>
				</ul>
				 
					 
				</form>
<? include ("{$_SERVER['DOCUMENT_ROOT']}/admin/includes/includesBottom.php"); ?>