<?
class Town extends System_Db
{
	var $dbTable = "fit_town";
	var $dbId = "town_id";

	
	/* function get */
	function get($id)
	{
		$filters = array($this->dbId."=".$id);
		$orderby = "town_name asc";
		$result = $this->getdata($this->dbTable, '*', $filters, $orderby);
		return $result[0];
	}

	/* function create */
	function create($item, $file_ids = array())
	{
		$this->insertdata($this->dbTable,$item);
		$item[$this->dbId] = $this->lastinsertedid($this->dbTable);
		return $item;
	}

	/* function update */
	function update($item)
	{
		$filters = array($this->dbId."=".$item[$this->dbId]);
		$result = $this->updatedata($this->dbTable,$item,$filters);
		return $result;
	}

	/* function getAll */
	function getAll()
	{
		$table = $this->dbTable;
		$fields = array('*');
		$filters = false;
		$orderby = "town_name asc";
		return $this->getdata($table, $fields, $filters,$orderby);
	}
	
	/* function getTownFromCity */
	function getTownFromCity($city_id)
	{
		$table = $this->dbTable;
		$fields = array('*');
		$filters = array($this->dbTable.".city_id=".$city_id);
		$orderby = "town_name asc";
		return $this->getdata($table,$fields,$filters,$orderby);
	}	
	
	/* function delete */
	function delete($id)	
	{
		if($id)
		{
			$filters = array($this->dbId."=".$id);
			return $this->deletedata($this->dbTable,$filters);
		}
	}


}
?>