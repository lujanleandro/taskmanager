<?

class RealstatesManager extends System_Db
{
	var $dbTable = 'fit_realestate';
	var $dbId = 'realestate_id';
	var $dbRelationTable = 'fit_image';
	var $dbFileId = 'file_id';
	var $dbThumbId = 'thumb_id';
	
	function get($id){
		//$fields =array($this->dbTable.'.*', 'fit_category.*','fit_provincia.*','fit_transaction.*','fit_partido.*','fit_ciudad.*','fit_estado.*');
		$fields =array(
			$this->dbTable.'.*', 
			'fit_category.*',
			'fit_provincia.provincia_id',
			'fit_provincia.provincia_name',
			'fit_transaction.*',
			'fit_partido.partido_id',
			'fit_partido.partido_name',
			'fit_ciudad.ciudad_id',
			'fit_ciudad.ciudad_name',
			'fit_estado.*'
		);
	
		$table = $this->dbTable;
		$table .= " LEFT JOIN fit_category ON fit_realestate.category_id = fit_category.category_id";
		$table .= " LEFT JOIN fit_ciudad ON fit_realestate.ciudad_id = fit_ciudad.ciudad_id";
		$table .= " LEFT JOIN fit_partido ON fit_realestate.partido_id = fit_partido.partido_id";
		$table .= " LEFT JOIN fit_provincia ON fit_realestate.provincia_id = fit_provincia.provincia_id";
		$table .= " LEFT JOIN fit_transaction ON fit_realestate.transaction_id = fit_transaction.transaction_id";
		$table .= " LEFT JOIN fit_estado ON fit_realestate.estado_id = fit_estado.estado_id";

		//echo "table:". $table;
		
		$filters = array($this->dbTable.'.'.$this->dbId."=".$id);
		$result = $this->getdata($table, $fields, $filters);

		/*
		echo "result:<pre>";
		print_r($result);
		echo "</pre>";
		*/
		
		$result[0]['images'] = $this->getImages($id);	
		
		$item = $result[0];

		return $item;
	}
	
	function getEstados(){
		$fields = array('fit_estado.*');
		$table = 'fit_estado';
		$orderby = "estado_name asc";
		$result = $this->getdata($table, $fields, $filters, $orderby);
		return $result;
	}	
	
	function getImages($id){		
		$table = $this->dbRelationTable;
		$table .= " LEFT JOIN fit_files ON ".$this->dbRelationTable.".file_id = fit_files.file_id";
		//$table .= " LEFT JOIN fit_files ON ".$this->dbRelationTable.".".$this->$dbFileId." = ".$this->dbRelationTable.".".$this->$dbFileId."";
		$fields = array('*');
		$filters = array($this->dbRelationTable.".".$this->dbId."=".$id);
		
		$result = $this->getdata($table, $fields, $filters);
		return $result;
	}	

	function create($item, $file_ids = array()){
		$this->insertdata($this->dbTable,$item);

		$item[$this->dbId] = $this->lastinsertedid($this->dbTable);
		
		$this->createRelations($item[$this->dbId], $file_ids);

		return $item;
	}
	
	function createRelations($realestate_id, $file_ids = array()){
		if(count($file_ids))
		{
			foreach($file_ids as $files)
			{
				$relation_item = array
				(
					$this->dbId => $realestate_id,
					$this->dbFileId => $files['file_id'],
					$this->dbThumbId => $files['thumb_id']
				);
				
				$this->insertdata($this->dbRelationTable, $relation_item);
			}
		}
	}
	
	function deleteRelations($realestate_id, $file_ids = array()){
		//echo "deleteRelations _________ realestate_id: ";
		//echo $realestate_id;
		if($realestate_id && count($file_ids))
		{
			foreach($file_ids as $files)			
			{
				$filters = array
				(
					$this->dbId."=".$realestate_id,
					$this->dbFileId."=".$files['file_id'],
					$this->dbThumbId."=".$files['thumb_id']
				);
				$this->deletedata($this->dbRelationTable, $filters);
			}
		}
	}	

	function update($item){
		$filters = array($this->dbId."=".$item[$this->dbId]);
		$result = $this->updatedata($this->dbTable,$item,$filters);
		return $result;
	}

	function getListByCategory($category_id = false){
		$table = $this->dbTable.' INNER JOIN fit_realestate_categories cat ON cat.property_category_id = prop.property_category_id';
		$fields = array('*', 'cat.name category');
		$filters = null;
		
		if($category_id){
			$filters = array('prop.property_category_id = '.$category_id);
		}
 
		return $this->getdata($table, $fields, $filters);
	}
	
	function lists($filters = false,$orderby = false,$limit = false){
		$table = $this->dbTable;
		$table .= " LEFT JOIN fit_transaction ON fit_realestate.transaction_id = fit_transaction.transaction_id";
		$table .= " LEFT JOIN fit_estado ON fit_realestate.estado_id = fit_estado.estado_id";

		$fields = array($this->dbTable.'.*','fit_transaction.*','fit_estado.*');

		$filters = ($filters != false)?$filters:null;
		
		if($orderby == false){
			$orderby = "realestate_code desc";
		}

		$limit = ($limit != false)?$limit:false;
		$return = $this->getdata($table, $fields, $filters,$orderby,$limit);
		
		
		foreach($return as $key=>$item){
			$return[$key]["images"] = $this->getImages($item['realestate_id']);
		}
		return $return;
	}

	function getActiveList($inactive_id,$limit = false,$filters = false){
		if($filters != false){
			//array_push($filters, "fit_realestate.estado_id <> " . $inactive_id);
			//print_r($filters);
		}else{
			$filters = array("fit_realestate.estado_id <> " . $inactive_id);
		}
		return $this->lists($filters,$limit);
	}

	function getBannerList($prov_id,$limit = false){
		$filters = array("fit_realestate.provincia_id = " . $prov_id);
		return $this->lists($filters,$limit);
	}

	// FUNC GET DESTACADOS
	function listsHigh($limit = false){
		// 1. traer destacados c/imagen
		$table = $this->dbTable;
		$table .= " LEFT JOIN fit_transaction ON fit_realestate.transaction_id = fit_transaction.transaction_id";
		$table .= " LEFT JOIN fit_ciudad ON fit_realestate.ciudad_id = fit_ciudad.ciudad_id";
		$table .= " LEFT JOIN fit_estado ON fit_realestate.estado_id = fit_estado.estado_id";

		$fields = array($this->dbTable.'.*','fit_transaction.*','fit_estado.*','fit_ciudad.ciudad_name');
		$filters = array("fit_realestate.estado_id = 5");
		$orderby = "realestate_order asc,realestate_id asc";

		$limit = ($limit != false)?$limit:false;
		$return = $this->getdata($table, $fields, $filters,$orderby,$limit);
		
			//echo "<br/>imagen:<br/>";
			//print_r($imageItem);
			//echo "<br/>";
		
		foreach($return as $key=>$item){
			$imageItem = $this->getImages($item['realestate_id']);

			//echo "<br/>imagen:<br/>";
			//print_r($imageItem);
			//echo "<br/>";
			
			if(!empty($imageItem[0])){
				$return[$key]["images"] = $imageItem;
			}
		}
		return $return;
	}

	// Func Delete
	function delete($id){
		if($id){
			$filters = array($this->dbId."=".$id);
			return $this->deletedata($this->dbTable,$filters);
			
		}
	}
}

?>