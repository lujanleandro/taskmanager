<?
class ProvinciaManager extends System_Db
{
	var $dbTable = "fit_provincia";
	var $dbId = "provincia_id";

	function getAll()
	{
		$orderby = "provincia_name asc";
		$filters = false;
		return $this->getdata($this->dbTable, "*", $filters, $orderby);
	}
	
	function get($id)
	{
		$filters = array($this->dbId."=".$id);
		$orderby = "provincia_name asc";
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