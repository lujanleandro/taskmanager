<? include ("includes/includesTop.php"); ?>
	<?//printr($values['list']);?>
	<h1><?=$values['mod_conf']['title_dash']?></h1>
		<? if(is_array($values['list']) && count($values['list']) > 0) {?>
		<table>
		<thead>
			<tr>
				<!--<th>ID</th>-->
				<th>Pos</th>
				<th>Cliente / Proyecto</th>
				<th>Estado</th>
			</tr>
		</thead>
		<tbody>
		<? foreach($values['list'] as $item){ ?>
		<tr class="<?=$item['estado_name'];?>">
			<!--<td><p><?=$item['product_id'];?></p></td>-->
			<td><p><?=$item['category_order'];?></p></td>
			<td>
				<a href="index.php?module=<?=$values['mod_conf']['module_name']?>&amp;<?=ACTION_FIELDNAME;?>=list&amp;category_id=<?=$item['category_id']?>"><i class="fa fa-pencil-square"></i> <?=$item['category_name']?></a>
				Tareas:<i>
				<?php $statusPorcent = 0; ?>
				<? foreach($item['status'] as $status){ ?>
					<?php if ($status['estado_id'] == 1 || $status['estado_id'] == 3) {
						$statusPorcent = $status['task_count'] + $statusPorcent;
					} ?>
					<?=$status['estado_name'];?>&nbsp;<?=$status['task_count'];?>/<?=$item['status_max'];?>,&nbsp;
				<? } ?>
				Faltante: <?php echo round((($statusPorcent*100)/$item['status_max']),1);?>%
				</i>
			</td>
			<td><a href="index.php?module=category&amp;<?=ACTION_FIELDNAME;?>=edit&amp;id=<?=$item['category_id']?>"><i class="fa fa-sliders"></i>&nbsp;<?=$item['estado_name'];?></a></td>
		</tr>
		<? } ?>
		</tbody>
		</table>
	<? } ?>

<? include ("includes/includesBottom.php"); ?>