<?

class UserManager extends System_Db
{
	var $dbTable = 'fit_admin';
	var $dbId = 'id';
	var $dbRelationTable = 'fit_image';
	var $dbFileId = 'file_id';
	var $dbThumbId = 'thumb_id';
	
	function get($id){
		$fields =array($this->dbTable.'.*');
	
		$table = $this->dbTable;
		//$table .= " LEFT JOIN fit_category ON fit_user.category_id = fit_category.category_id";
		//$table .= " LEFT JOIN fit_estado ON fit_user.estado_id = fit_estado.estado_id";
	
		$filters = array($this->dbTable.'.'.$this->dbId."=".$id);
		$result = $this->getdata($table, $fields, $filters);
		
		//$result[0]['images'] = $this->getImages($id);
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
		if(count($file_ids)){
			foreach($file_ids as $files){
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
		if($realestate_id && count($file_ids)){
			foreach($file_ids as $files){
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
		$table = $this->dbTable;
		$fields = array('*', 'cat.name category');
		$filters = null;
		
		if($category_id){
			//$filters = array('prop.property_category_id = '.$category_id);
		}
 
		return $this->getdata($table, $fields, $filters);
	}

	// Func LIST	
	function lists($filters = false,$limit = false){
		$table = $this->dbTable;
		//$table .= " LEFT JOIN fit_estado ON fit_user.estado_id = fit_estado.estado_id";
		$fields = array($this->dbTable.'.*');

		$filters = ($filters != false)?$filters:null;
		
		$orderby = "username desc";

		$limit = ($limit != false)?$limit:false;
		$return = $this->getdata($table, $fields, $filters,$orderby,$limit);
		
		/*
		foreach($return as $key=>$item){
			$return[$key]["images"] = $this->getImages($item['id']);
		}
		*/
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