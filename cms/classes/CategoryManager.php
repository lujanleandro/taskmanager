<?
class CategoryManager extends System_Db
{
	var $dbTable = 'fit_category';
	var $dbId = 'category_id';

	/* function get */
	function get($id){
		$fields = array($this->dbTable.'.*');
		$table = $this->dbTable;
		$table .= " LEFT JOIN fit_estado ON fit_category.estado_id = fit_estado.estado_id";
		$filters = array($this->dbTable.'.'.$this->dbId."=".$id);
		$orderby = "category_name asc";
		$result = $this->getdata($table, $fields, $filters, $orderby);
		$item = $result[0];
		return $item;
	}

	function getEstados(){
		$fields = array('fit_estado.*');
		$table = 'fit_estado';
		//$filters = array($this->dbTable.'.fit_estado<>2');
		$orderby = "estado_name asc";
		$result = $this->getdata($table, $fields, $filters, $orderby);
		return $result;
	}
	function getStatus($category_id){		
		$table = 'fit_estado';
		$table .= " LEFT JOIN fit_product ON fit_product.estado_id = fit_estado.estado_id";
		$fields = array(
			'COUNT(*) AS task_count',
			'fit_estado.estado_name AS estado_name',
			'fit_estado.estado_id AS estado_id'
		);

		$filters = array("fit_product.category_id=".$category_id);
		$groupby = "fit_estado.estado_id";
		$orderby = "fit_estado.estado_id ASC";
		$limit = false;
		$exclusive = true;

		$result = $this->getdata($table, $fields, $filters, $orderby, $limit, $exclusive, $groupby);
		return $result;
	}	

	function create($item, $file_ids = array()){
		$this->insertdata($this->dbTable,$item);
		$item[$this->dbId] = $this->lastinsertedid($this->dbTable);
		return $item;
	}
	
	function update($item){
		$filters = array($this->dbId."=".$item[$this->dbId]);
		$result = $this->updatedata($this->dbTable,$item,$filters);
		return $result;
	}

	function getListByCategory($category_id = false){
		$table = $this->dbTable;
		$fields = array('*');
		$filters = false;
		$orderby = "category_name asc";
		if($category_id){
			$filters = array($table.'_category_id = '.$category_id);
		}
 		return $this->getdata($table, $fields, $filters, $orderby);
	}
	
	function getAll(){
		$table = $this->dbTable;
		$table .= " LEFT JOIN fit_estado ON fit_category.estado_id = fit_estado.estado_id";
		$fields = array('*');
		$filters = array($this->dbTable.'.estado_id <> 2');
		$orderby = "fit_estado.estado_id, category_order asc";
		return $this->getdata($table, $fields, $filters,$orderby);
	}

	function getListStatus(){
		$table = $this->dbTable;
		$table .= " LEFT JOIN fit_estado ON fit_category.estado_id = fit_estado.estado_id";
		$fields = array('*');
		$filters = array($this->dbTable.'.estado_id <> 2');
		$orderby = "fit_estado.estado_id, category_order asc";
		$return = $this->getdata($table, $fields, $filters,$orderby);
		// Traigo Estados
		foreach($return as $key=>$item){
			$return[$key]["status"] = $this->getStatus($item['category_id']);
			$taskMaxCount = 0;
			foreach($return[$key]["status"] as $task_count){
				$taskMaxCount = $taskMaxCount+$task_count['task_count'];
			}
			$return[$key]["status_max"] = $taskMaxCount;
		}


		return $return;		
	}
	
	function getCiudadFromPartido($provincia_id){
		$table = $this->dbTable;
		$fields = array('*');
		$filters = array($this->dbTable.".partido_id=".$provincia_id);
		$orderby = "ciudad_name asc";
		return $this->getdata($table,$fields,$filters,$orderby);
	}
	
	function delete($id){
		if($id){
			$filters = array($this->dbId."=".$id);
			return $this->deletedata($this->dbTable,$filters);
		}
	}
}

?>