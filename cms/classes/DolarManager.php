<?
class DolarManager extends System_Db
{
	var $dbTable = 'fit_dolar';
	var $dbId = 'dolar_id';

	/* function get */
	function get($id)
	{
		$fields = array($this->dbTable.'.*');
		$table = $this->dbTable;
		$filters = array($this->dbTable.'.'.$this->dbId."=".$id);
		$result = $this->getdata($table, $fields, $filters);
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
		
		$item = array("dolar_price" => $item);
		//echo "<br/>item:".printr($item);
		$filters = array($this->dbId."=1");
		$result = $this->updatedata($this->dbTable,$item,$filters);
		//echo "<br/>return:".$result;
		if($result){
			// Traer lista de valores
			$Manager = new RealstatesManager($this->params);
			$ListEstates = $Manager->lists();
			//printr($ListEstates);
			foreach($ListEstates as $estate){
				if($estate['realestate_dolar']){
					$newDolar = round($estate['realestate_dolar'] * $item['dolar_price']);
				}else{
					$newDolar = 0;
				}
				$estateID = $estate['realestate_id'];
				//echo "<br/>pesos:".$estate['realestate_price'];
				//echo "<br/>dolar:".$estate['realestate_dolar'];
				//echo "<br/>nuevo:".round($newDolar);
				$newArrayData = array(
					"realestate_id" => $estateID,
					"realestate_price" => $newDolar
				);
				$resultEstates = $Manager->update($newArrayData);
			}
			//echo $resultEstates;
		}

		return $result;
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