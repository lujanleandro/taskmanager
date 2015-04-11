<? include ("includes/includesTop.php"); ?>
	<h1><?=$values['mod_conf']['title_list']?></h1>
		<p class="bg-info">Controle los datos antes de ingresarlos.</p>
		<? if($values['list']) {?>
		<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Descripci&oacute;n</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
		<? foreach($values['list'] as $item) { ?>
		<tr>
			<td style="width:80px;"><p><?=$item['tag_id']?></p></td>
			<td><a href="index.php?module=<?=$values['mod_conf']['module_name']?>&amp;<?=ACTION_FIELDNAME;?>=edit&amp;id=<?=$item['tag_id']?>"><i class="fa fa-pencil-square"></i> <?=$item['tag_name']?></a></td>
			<td><?=$item['tag_description']?></td>
			<td style="width:100px;"><a class="btn btn-primary" href="index.php?module=<?=$values['mod_conf']['module_name']?>&amp;<?=ACTION_FIELDNAME;?>=edit&amp;id=<?=$item['tag_id']?>"><i class="fa fa-pencil-square"></i> Editar</a></td>
		</tr>
		<? } }?>
		</tbody>
	</table>
<? include ("includes/includesBottom.php"); ?>