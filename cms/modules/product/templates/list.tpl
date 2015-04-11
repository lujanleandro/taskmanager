<? include ("includes/includesTop.php"); ?>
	<?//printr($values['list']);?>
	<form action="index.php" method="get">
	<input type="hidden" name="module" value="product"/>
	<input type="hidden" name="task" value="list"/>
	<h1><?=$values['mod_conf']['title_list']?>
	<select name="category_id" id="category_id" class="pull-right" style="margin:5px 0 0 5px;font-size:16px;">
		<option value="0">[ Filtrar por Clientes ]</option>
		<?
			if(is_array($values['categories'])){
				foreach($values['categories'] as $cat){
					$selected = '';
					if($cat['category_id'] == $values['categoryRequest']){
						$selected = 'selected="selected"';
					}
					?><option value="<?=$cat['category_id'];?>" <?=$selected;?>><?=$cat['category_name'];?></option><?
				}
			}else{
				?><option value="0">No Hay Datos</option><?
			}							
		?>
	</select>		
	<select name="tag_id" id="tag_id" class="pull-right" style="margin:5px 0 0;font-size:16px;">
		<option value="0">[ Filtrar por Carpeta ]</option>
		<?
			if(is_array($values['tags'])){
				foreach($values['tags'] as $tag){
					$selected = '';
					if($tag['tag_id'] == $values['tagRequest']){
						$selected = 'selected="selected"';
					}
					?><option value="<?=$tag['tag_id'];?>" <?=$selected;?>><?=$tag['tag_name'];?></option><?
				}
			}else{
				?><option value="0">No Hay Datos</option><?
			}							
		?>
	</select>
	</h1>
	</form>
	<script type="text/javascript">
		$("#tag_id").change(function(){
    		$('form').submit();
		});
		$("#category_id").change(function(){
    		$('form').submit();
		});		
	</script>	
		<? if(is_array($values['list']) && count($values['list']) > 0) {?>
		<table>
		<thead>
			<tr>
				<!--<th>ID</th>-->
				<th>Pos</th>
				<th>Nombre</th>
				<th>Estado</th>
				<th>Categoria</th>
				<th>Cliente</th>
				<th colspan="2">Acciones</th>
			</tr>
		</thead>
		<tbody>
		<?
		// Preparo Datos
		$aux = 2;
		foreach($values['list'] as $item){
			$aux2 = $aux %2;
			$color = ($aux2 == 0)? "#ffffff": "#f2f2f2";
			$aux ++;

			//Preparo Imagen 
			$file_name = $item['images'][0]['file_name'];
			$file_thumb_id = $item['images'][0]['thumb_id'];
			$file_path = $values['conf']['admin_folder'] . $values['conf']['uploaded_files_path'] . "file_".$item['images'][0]['file_id']."." . $file_name;
			$file_thumb = $values['conf']['admin_folder'] . $values['conf']['uploaded_files_path'] . "thumbs/file_".$file_thumb_id."." . $file_name;

			// Preparo Categorias
			$category = array("");
			if(is_array($values['categories'])){
				foreach($values['categories'] as $itemCategory){
					if($itemCategory['category_id'] == $item['category_id']){
						$category = array($itemCategory['category_name'], $itemCategory['category_description']);
					}
				}
			}

			// Preparo Tabs
			$tags = "";
			$tagsDescription = "";
			if(is_array($item['tags'][0])){
				foreach($item['tags'] as $tag){
					$tags = $tags.$tag['tag_name']." ";
					$tagsDescription = $tagsDescription.$tag['tag_description'].", ";
				}
			}
		?>
		<tr class="<?=$item['estado_name'];?>">
			<!--<td><p><?=$item['product_id'];?></p></td>-->
			<td><p><?=$item['product_order'];?></p></td>
			<td><a href="index.php?module=<?=$values['mod_conf']['module_name']?>&amp;id=<?=$item['product_id']?>&amp;<?=ACTION_FIELDNAME;?>=edit"><i class="fa fa-pencil-square"></i> <?=$item['product_name']?></a></td>
			<td><p><?=$item['estado_name'];?></p></td>
			<td><p title="<?=$tagsDescription;?>"><i><?=$tags;?></i></p></td>
			<td><p title="<?=$category[1];?>"><?=$category[0];?></p></td>
			<td><a class="btn btn-primary" href="index.php?module=<?=$values['mod_conf']['module_name']?>&amp;id=<?=$item['product_id']?>&amp;<?=ACTION_FIELDNAME;?>=edit"><i class="fa fa-pencil-square"></i> Editar</a></td>
			<td><a class="btn btn-danger" href="javascript:deleteItem('<?=$values['mod_conf']['module_name']?>',<?=$item['product_id']?>);"><i class="fa fa-times-circle"></i> Borrar</a></td>
		</tr>
		<? } } ?>
		</tbody>
	</table>


<? include ("includes/includesBottom.php"); ?>