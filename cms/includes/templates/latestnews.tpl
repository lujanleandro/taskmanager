<table width="771" border="0" cellpadding="0" cellspacing="0">
<tr valign="top">
<?php
	foreach($values['news'] as $news)
	{
?>
	<td width="83" height="90" valign="top" onMouseOver="getElementById('featuredOne').style.color='#0E2943';" onMouseOut="getElementById('featuredOne').style.color='';">
		<img src="<?='backoffice/uploadedfiles/' . $news['thumb_filename']?>" width="83" />
	</td>
	<td width="250" valign="top" style="CURSOR:pointer" onClick="location='news_detail.php?id=<?=$news['news_id']?>';"onmouseover="getElementById('featuredOne').style.color='#0E2943';" onMouseOut="getElementById('featuredOne').style.color='';">
		<div id="featuredOne"  style="PADDING-RIGHT:5px;PADDING-LEFT:5px;PADDING-BOTTOM:5px;WIDTH:284px;PADDING-TOP:5px">
			<?=$news['teaser']?>	
		</div>
	</td>
<?php
	}
?>
</tr>
</table>