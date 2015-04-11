<table width="588" cellpadding="0" cellspacing="0" border="0">
<?php
	foreach($values['news'] as $news)
	{
?>
	<tr valign="top">
		<td>
			<h2>
				<span class="csHdrOne"><?php echo $news['title']; ?></span>
				<span class="execTeamName"><?php echo date("d.m.Y", strtotime($news['news_date']));?></span>
			</h2>
			<p>
				<?php echo $news['teaser']; ?><br>					
				<a href="news_detail.php?id=<?php echo $news['news_id'];?>">Leer m&aacute;s... </a> 
			</p>
			<br>
		</td>
	</tr>
<?php
	}
	
	if($values['show_pager'])
	{
?>
	<tr valign="top">
		<td>
			<p>
				<?php
					if($values['show_pager_previous']) 
					{
				?>
						<a href="?page=<?php echo $values['current_page'] - 1;?>"><<</a>
				<?php
					}
				?>
				P&aacute;gina <?php echo $values['current_page']; ?> de <?php echo $values['total_pages']; ?>
				<?php
					if($values['show_pager_next']) 
					{
				?>
						<a href="?page=<?php echo $values['current_page'] + 1;?>">>></a>
				<?php
					}
				?>
				 
			</p>
		</td>
	</tr>
<?php
	}
?>
</table>