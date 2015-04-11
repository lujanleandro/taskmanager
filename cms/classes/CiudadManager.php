<?
class CiudadManager extends System_Db
{
	var $dbTable = 'fit_ciudad';
	var $dbId = 'ciudad_id';

	/* function get */
	function get($id)
	{
		$fields = array($this->dbTable.'.*');
		$table = $this->dbTable;
		$filters = array($this->dbTable.'.'.$this->dbId."=".$id);
		$orderby = "ciudad_name asc";
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
		$orderby = "ciudad_name asc";
		if($category_id)
		{
			$filters = array('prop.property_category_id = '.$category_id);
		}
 		return $this->getdata($table, $fields, $filters, $orderby);
	}
	
	function getAll()
	{
		$table = $this->dbTable . " left join fit_partido on " . $this->dbTable . ".partido_id = fit_partido.partido_id";
		$fields = array('*');
		$filters = false;
		$orderby = "ciudad_name asc";
		return $this->getdata($table, $fields, $filters,$orderby);
	}
	
	function getCiudadFromPartido($provincia_id)
	{
		$table = $this->dbTable;
		$fields = array('*');
		$filters = array($this->dbTable.".partido_id=".$provincia_id);
		$orderby = "ciudad_name asc";
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