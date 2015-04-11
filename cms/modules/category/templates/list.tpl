<? include ("includes/includesTop.php"); ?>
	<h1><?=$values['mod_conf']['title_list']?></h1>
		<? if($values['list']) {?>
		<table>
		<thead>
			<tr>
				<th>#</th>
				<th>Nombre</th>
				<th>Descripcion</th>
				<th>Estado</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
		<?
		foreach($values['list'] as $item) {
		?>
		<tr>
			<td style="width:60px"><?=$item['category_order']?></td>
			<td><a href="index.php?module=<?=$values['mod_conf']['module_name']?>&amp;<?=ACTION_FIELDNAME;?>=edit&amp;id=<?=$item['category_id']?>"><i class="fa fa-pencil-square"></i> <?=$item['category_name']?></a></td>
			<td><p><?=$item['category_description'];?></p></td>
			<td><p><?=$item['estado_name'];?></p></td>
			<td style="width:100px"><a class="btn btn-primary" href="index.php?module=<?=$values['mod_conf']['module_name']?>&amp;<?=ACTION_FIELDNAME;?>=edit&amp;id=<?=$item['category_id']?>"><i class="fa fa-pencil-square"></i> Editar</a></td>
		</tr>
		<? } }?>
		</tbody>
	</table>
<? include ("includes/includesBottom.php"); ?>