<?
class City extends System_Db
{
	var $dbTable = 'fit_city';
	var $dbId = 'city_id';

	/* function get */
	function get($id)
	{
		$fields = array($this->dbTable.'.*');
		$table = $this->dbTable;
		$filters = array($this->dbTable.'.'.$this->dbId."=".$id);
		$orderby = "city_name asc";
		$result = $this->getdata($table, $fields, $filters, $orderby);
		$item = $result[0];
		return $item;
	}

	function create($item, $file_ids = array())
	{
		$this->insertdata($this->dbTable,$item);
		$item[$this->dbId] = $this->lastinsertedid($this->dbTable);
		return $item;
	}
	
	function update($item)
	{
		$filters = array($this->dbId."=".$item[$this->dbId]);
		$result = $this->updatedata($this->dbTable,$item,$filters);
		return $result;
	}

	function getListByCategory($category_id = false)
	{
		$table = $this->dbTable;
		$fields = array('*');
		$filters = false;
		$orderby = "city_name asc";
		if($category_id)
		{
			$filters = array('prop.property_category_id = '.$category_id);
		}
 		return $this->getdata($table, $fields, $filters, $orderby);
	}
	
	function getAll()
	{
		$table = $this->dbTable;
		$fields = array('*');
		$filters = false;
		$orderby = "city_name asc";
		return $this->getdata($table, $fields, $filters,$orderby);
	}
	
	function getCityFromGeography($geography_id)
	{
		$table = $this->dbTable;
		$fields = array('*');
		$filters = array($this->dbTable.".geography_id=".$geography_id);
		$orderby = "city_name asc";
		return $this->getdata($table,$fields,$filters,$orderby);
	}
	
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