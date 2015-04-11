<?

class ProductsManager extends System_Db
{
	private $dbTable = 'fit_product';
	private $dbId = 'product_id';
	public $dbRelationTable = 'fit_image';
	private $dbFileId = 'file_id';
	private $dbThumbId = 'thumb_id';


	function get($id){
		// Defino campos
		$fields = array($this->dbTable.'.*','fit_category.*','fit_estado.*');
	
		// Defino tablas y relaciones
		$table = $this->dbTable;
		$table .= " LEFT JOIN fit_category ON fit_product.category_id = fit_category.category_id";
		$table .= " LEFT JOIN fit_estado ON fit_product.estado_id = fit_estado.estado_id";
	
		// Asigno filtros y ejecuto la consulta
		$filters = array($this->dbTable.'.'.$this->dbId."=".$id);
		$result = $this->getdata($table, $fields, $filters);
		$result = $result[0];
		
		//Adjunto imagenes
		$result['images'] = $this->getImages($id);
		
		//Adjunto tags
		$result['tags'] = $this->getTags($id);
		$item = $result;
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
		$fields = array('*');
		$filters = array($this->dbRelationTable.".".$this->dbId."=".$id);
		$orderby = $this->dbRelationTable.".image_order ASC";
		
		$result = $this->getdata($table, $fields, $filters, $orderby);
		return $result;
	}

	function getTags($id){
		$table = "fit_tag_relation";
		$table .= " LEFT JOIN fit_tag ON fit_tag_relation.tag_id = fit_tag.tag_id";
		//$table .= " RIGHT JOIN fit_tag ON fit_tag_relation.tag_id = fit_tag_relation.tag_id";
		$fields = array('*');
		$filters = array("fit_tag_relation.".$this->dbId."=".$id);
		
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
			foreach($file_ids as $key=>$files){
				$relation_item = array(
					$this->dbId => $realestate_id,
					$this->dbFileId => $files['file_id'],
					$this->dbThumbId => $files['thumb_id'],
					"image_order" => $files['image_order']
				);
				
				$this->insertdata($this->dbRelationTable, $relation_item);
			}
		}
	}
	
	function deleteRelations($product_id, $file_ids = array()){
		//echo "deleteRelations _________ product_id: ";
		//echo $product_id;
		if($product_id && count($file_ids)){
			foreach($file_ids as $files){
				$filters = array
				(
					$this->dbId."=".$product_id,
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

	function getProductByTag($tag_id = false){
		$table = $this->dbTable;
		$table .= " INNER JOIN fit_estado ON fit_product.estado_id = fit_estado.estado_id";
		$table .= " INNER JOIN fit_tag_relation ON fit_tag_relation.product_id = ".$this->dbTable.".product_id";

		$fields = array('*');
		$filters = false;
		$orderby = "fit_product.estado_id,fit_product.product_order,fit_product.product_id DESC";

		if($tag_id){
			$filters = array('fit_tag_relation.tag_id = '.$tag_id,'fit_product.estado_id <> 2');
		}
 		$return = $this->getdata($table, $fields, $filters, $orderby);

		// Traigo Media
		foreach($return as $key=>$item){
			$return[$key]["images"] = $this->getImages($item['product_id']);
			$return[$key]['tags'] = $this->getTags($item['product_id']);
		}

		return $return;
	}

	function getListByCategory($category_id = false){
		$table = $this->dbTable;
		$table .= " INNER JOIN fit_estado ON fit_product.estado_id = fit_estado.estado_id";
		$table .= " INNER JOIN fit_category ON fit_category.category_id = ".$this->dbTable.".category_id";

		$fields = array('*');
		$filters = false;
		$orderby = "fit_product.estado_id,fit_product.product_order,fit_product.product_id DESC";

		if($category_id){
			$filters = array('fit_category.category_id = '.$category_id,'fit_product.estado_id <> 2');
		}
 		$return = $this->getdata($table, $fields, $filters, $orderby);

		// Traigo Media
		foreach($return as $key=>$item){
			$return[$key]["images"] = $this->getImages($item['product_id']);
			$return[$key]['tags'] = $this->getTags($item['product_id']);
		}

		return $return;
	}

	function getCategoryList(){
		$table = $this->dbTable;
		$table .= ' INNER JOIN fit_product_categories cat ON cat.property_category_id = prop.property_category_id';
		$fields = array('*', 'cat.name category');
		$filters = array('prop.property_category_id = '.$category_id);

		// Ejecuto
		$return = $this->getdata($table, $fields, $filters,$orderby,$limit);			
 
		// Traigo Media
		foreach($return as $key=>$item){
			$return[$key]["images"] = $this->getImages($item['product_id']);
			$return[$key]['tags'] = $this->getTags($item['product_id']);
		}

		return $return;
	}	
	
	function lists($filters = false,$orderby = false,$limit = false){
		$table = $this->dbTable;
		$table .= " LEFT JOIN fit_estado ON fit_product.estado_id = fit_estado.estado_id";
		$fields = array($this->dbTable.'.*','fit_estado.*');

		if($filters == false){ //Default
			$filters = null;
		}
		if($orderby == false){ //Default
			$orderby = "fit_product.estado_id,fit_product.product_order,fit_product.product_id DESC";
		}
		if($limit == false){ //Default
			$limit = false;
		}

		// Ejecuto
		$return = $this->getdata($table, $fields, $filters,$orderby,$limit);		
		
		// Traigo Media
		foreach($return as $key=>$item){
			$return[$key]["images"] = $this->getImages($item['product_id']);
			$return[$key]['tags'] = $this->getTags($item['product_id']);
		}

		// Retorno
		return $return;
	}

	function getActiveList($inactive_id,$limit = false,$filters = false){
		if($filters != false){
			//array_push($filters, "fit_product.estado_id <> " . $inactive_id);
			//print_r($filters);
		}else{
			$filters = array("fit_product.estado_id <> " . $inactive_id);
		}
		return $this->lists($filters,$limit);
	}

	function getBannerList($prov_id,$limit = false){
		$filters = array("fit_product.provincia_id = " . $prov_id);
		return $this->lists($filters,$limit);
	}

	// FUNC GET DESTACADOS
	function listsHigh($limit = false){
		// 1. traer destacados c/imagen
		$table = $this->dbTable;
		$table .= " LEFT JOIN fit_estado ON fit_product.estado_id = fit_estado.estado_id";

		$fields = array($this->dbTable.'.*','fit_estado.*');
		$filters = array("fit_product.estado_id = 5");
		$orderby = "product_id asc";

		$limit = ($limit != false)?$limit:false;
		$return = $this->getdata($table, $fields, $filters,$orderby,$limit);		
		
		foreach($return as $key=>$item){
			$imageItem = $this->getImages($item['product_id']);
			
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