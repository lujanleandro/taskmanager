<?
class PartidoManager extends System_Db
{
	var $dbTable = "fit_partido";
	var $dbId = "partido_id";

	
	/* function get */
	function get($id)
	{
		$filters = array($this->dbId."=".$id);
		$orderby = "partido_name asc";
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
		$table = $this->dbTable . " left join fit_provincia on " . $this->dbTable . ".provincia_id = fit_provincia.provincia_id ";
		$fields = array('*');
		$filters = false;
		$orderby = "partido_name asc";
		return $this->getdata($table, $fields, $filters,$orderby);
	}
	
	/* function getTownFromCity */
	function getPartidoFromProvincia($partido_id)
	{
		$table = $this->dbTable;
		$fields = array('*');
		$filters = array($this->dbTable.".provincia_id=".$partido_id);
		$orderby = "partido_name asc";
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