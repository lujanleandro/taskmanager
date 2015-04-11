<?
class Transaction extends System_Db
{
	var $dbTable = "fit_transaction";
	var $dbId = "transaction_id";

	function getAll()
	{
		$orderby = "transaction_name asc";
		$filters = false;	
		return $this->getdata($this->dbTable, "*", $filters, $orderby);
	}
	
	function get($id)
	{
		$filters = array($this->dbId."=".$id);
		$orderby = "transaction_name asc";
		$result = $this->getdata($this->dbTable, '*', $filters, $orderby);
		
		return $result[0];
	}
}
?>