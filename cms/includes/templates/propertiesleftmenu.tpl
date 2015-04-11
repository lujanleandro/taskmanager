<!-- START: left nav -->
<table cellspacing="0" cellpadding="0" width="171" border="0">
  <!-- green hdr cell -->
  <tr valign="top">
	<td class="lnavHeaderBar"></td>
  </tr>
  <?
  	foreach($values['properties'] as $item)
  	{
  		$eventHandlers = '';
  		if($item['property_id'] == getvalue('id'))
  		{
  			$cssClass = 'lnavSectionTdOn';
  		}
  		else
  		{
  			$cssClass = 'lnavTdOff';
  			$eventHandlers = "'onMouseOver=\"this.className='lnavTdOver';\" onMouseOut=\"this.className='lnavTdOff';\"'";
  		}
  ?>
  <!-- off estate top level -->
  <tr valign="top">
	<td class="<?=$cssClass?>" onClick="location='real-estate.php?id=<?=$item['property_id'];?>'" <?=$eventHandlers; ?> ><?=$item['name']; ?></td>
  </tr>
  <!-- small horizontal \\\ rule -->
  <?
	}
  ?>
  <!-- bottom space : only added when last item is not "on" -->
  <tr valign="top">
	<td class="lnavBottom"></td>
  </tr>
</table>
<!-- END : left nav -->
