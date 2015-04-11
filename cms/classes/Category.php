<?
class Category
{
	var $db;
	var $dbTable = "fit_category";
	var $dbId = "category_id";

	function category($db)
	{
		$this->db = $db;
	}

	function getAll()
	{
		$orderby = "category_name asc";
		$filters = false;
		return $this->db->getdata($this->dbTable, "*", $filters, $orderby);
	}
	
	function get($id)
	{
		$filters = array($this->dbId."=".$id);
		$orderby = "category_name asc";
		$result = $this->db->getdata($this->dbTable, '*', $filters, $orderby);
		
		return $result[0];
	}
}
?>