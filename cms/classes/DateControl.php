<?php

class DateControl
{
	var $day;
	var $month;
	var $year;

	var $name;

	function DateControl($name, $date)
	{
		$this->name 	= $name;
		$datearr 		= split('/', $date);
		$this->day 		= $datearr[0];
		$this->month 	= $datearr[1];
		$this->year 	= $datearr[2];
	}

	function Render()
	{
		$dayId = $this->name . '_day';
		$monthId = $this->name . '_month';
		$yearId = $this->name . '_year';

		?>
			<select name="<?=$dayId;?>" id="<?=$dayId;?>"></select>
			<select name="<?=$monthId;?>" id="<?=$monthId;?>" onchange="LoadDay('<?=$dayId;?>', '<?=$monthId;?>', '<?=$yearId;?>');"></select>
			<select name="<?=$yearId;?>" id="<?=$yearId;?>" onchange="LoadDay('<?=$dayId;?>', '<?=$monthId;?>', '<?=$yearId;?>');"></select>
			<script type="text/javascript" src="resources/scripts/date-control.js"></script>
			<script type="text/javascript">
				LoadDate('<?=$dayId;?>', '<?=$monthId;?>', '<?=$yearId;?>', '<?=$this->day;?>', '<?=$this->month;?>', '<?=$this->year;?>');
			</script>
		<?
	}
}

?>