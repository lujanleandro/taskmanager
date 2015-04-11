<? include ("includes/includesTop.php"); ?>
	<h1><?=$values['mod_conf']['title_list']?></h1>
		<? if(is_array($values['list']) && count($values['list']) > 0) { ?>
		<table>
		<thead>
			<tr>
				<th>#</th>
				<th>Nombre del usuario</th>
				<th>Email del usuario</th>
				<th colspan="2">Acciones</th>
			</tr>
		</thead>
		<tbody>
		<?
		$aux = 2;
		foreach($values['list'] as $item){
			/*
			$aux2 = $aux %2;
			$color = ($aux2 == 0)? "#ffffff": "#f2f2f2";
			$aux ++;
			$file_name = $item['images'][0]['file_name'];
			$file_thumb_id = $item['images'][0]['thumb_id'];
			$file_path = $values['conf']['admin_folder'] . $values['conf']['uploaded_files_path'] . "file_".$item['images'][0]['file_id']."." . $file_name;
			$file_thumb = $values['conf']['admin_folder'] . $values['conf']['uploaded_files_path'] . "thumbs/file_".$file_thumb_id."." . $file_name;
			*/
		?>
		<tr>
			<td><p><?=$item['id'];?></p></td>
			<td><a href="index.php?module=<?=$values['mod_conf']['module_name']?>&amp;id=<?=$item['id']?>&amp;<?=ACTION_FIELDNAME;?>=edit"><i class="fa fa-pencil-square"></i> <?=$item['username']?></a></td>
			<td><p><?=$item['email'];?></p></td>
			<td style="width:90px;">
				<a class="btn btn-primary btn-sm" href="index.php?module=<?=$values['mod_conf']['module_name']?>&amp;id=<?=$item['id']?>&amp;<?=ACTION_FIELDNAME;?>=edit"><i class="fa fa-pencil-square"></i> Editar</a>
			</td>
			<td style="width:90px;">
				<?php if ($item['id']!=1) { ?>
				<a href="index.php?module=<?=$values['mod_conf']['module_name']?>&amp;id=<?=$item['id']?>&amp;<?=ACTION_FIELDNAME;?>=delete" class="btn btn-danger btn-sm"><i class="fa fa-times-circle"></i> Borrar</a>
				<? } ?>
			</td>
		</tr>
		<? } } ?>
		</tbody>
	</table>
<? include ("includes/includesBottom.php"); ?>