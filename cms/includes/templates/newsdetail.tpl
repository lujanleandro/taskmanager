<table width="588" cellpadding="0" cellspacing="0" border="0">
<tr valign="top">
	<td>
		<h2>
			<span class="csHdrOne"><?php echo $values['item']['title']; ?></span><br>
			<span class="execTeamName"><?php echo date("d.m.Y", strtotime($values['item']['news_date']));?></span>
		</h2>
		<p>
			<?php echo $values['item']['teaser']; ?>
		</p>
		<p>
			<table border="0" cellpadding="0" cellspacing="5">
			<tr>
				<td>
					<img src="<?='backoffice/uploadedfiles/' . $values['item']['img_filename']?>" width="250"/>
				</td>
				<td valign="top">
					<?php echo $values['item']['body']; ?>
				</td>
			</tr>
			</table>
		</p>
		<br>		
	</td>
</tr>