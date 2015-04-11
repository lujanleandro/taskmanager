<?
class TagManager extends System_Db
{
	var $dbTable = 'fit_tag';
	var $dbRelationTable = 'fit_tag_relation';
	var $dbProductTable = 'fit_product';
	var $dbImageTable = 'fit_image';
	var $dbId = 'tag_id';

	/* function get */
	function get($id)	{
		$fields = array($this->dbTable.'.*');
		$table = $this->dbTable;
		$filters = array($this->dbTable.'.'.$this->dbId."=".$id);
		$orderby = "tag_name asc";
		$result = $this->getdata($table, $fields, $filters, $orderby);
		$item = $result[0];
		return $item;
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
		$orderby = "tag_name asc";
		if($category_id){
			$filters = array('prop.property_category_id = '.$category_id);
		}
 		return $this->getdata($table, $fields, $filters, $orderby);
	}

	function search($item_name){
		$table = $this->dbTable;
		$fields = array('*');
		$filters = array('fit_tag.tag_name = "'.$item_name.'"');
		$orderby = false;
 		return $this->getdata($table, $fields, $filters, $orderby);
	}

	function getListByProduct($product_id = false){
		$table = $this->dbTable;
		$table .= ' LEFT JOIN '.$this->dbRelationTable;
		$table .= ' ON '.$this->dbRelationTable.'.tag_id = '.$this->dbTable.'.tag_id';

		$fields = array('*');
		$filters = false;
		$orderby = "tag_name asc";
		if($product_id){
			$filters = array($this->dbRelationTable.'.product_id = '.$product_id);
		}
 		return $this->getdata($table, $fields, $filters, $orderby);
	}

	function getListByTags($product_id = false){

		$return = array();
		$newArray = array();

		// 1. Tomo la lista en array de tags por el product_id
		$tagList = $this->getListByProduct($product_id);

		// 2. Recorro el array y traigo el listado de productos por esos tags
		foreach($tagList as $key=>$item){
			$productList = $this->getProductListByTag($item['tag_id']);
			foreach($productList as $key=>$itemProduct){
				array_shift($itemProduct);
				array_push($newArray,$itemProduct);
			}
		}

		// 3. Formatear array y sacar duplicados.
		foreach($newArray as $key=>$itemResult){
			if(!array_search($itemResult, $return)){
				array_push($return, $itemResult);
			}
		}

 		return $return;
	}

	function getProductListByTag($tag_id = false,$tagb_id = false){
		$table = $this->dbRelationTable;
		$table .= ' INNER JOIN '.$this->dbProductTable;
		$table .= ' ON '.$this->dbProductTable.'.product_id = '.$this->dbRelationTable.'.product_id';

		$fields = array('*');
		$filters = false;
		$orderby = false;
		if($tag_id){
			$filters = array($this->dbRelationTable.'.tag_id = '.$tag_id);
		}

		$return = $this->getdata($table, $fields, $filters,$orderby,$limit=false, $exclusive=True);

		// Si tengo 2 tags
		if($tagb_id){
			$filters = array($this->dbRelationTable.'.tag_id = '.$tagb_id);
			$returnA = $return;
			$returnB = $this->getdata($table, $fields, $filters,$orderby,$limit=false, $exclusive=True);
			$return = array();
			
			// Busco en los arrays solo los tags que tienen product_id iguales
			foreach($returnA as $key=>$itemResultA){
				foreach($returnB as $key=>$itemResultB){
					// Si el resultado esta repetido, omitirlo.
					if($itemResultA['product_id']==$itemResultB['product_id']){
						array_push($return, $itemResultB);
					}
				}
			}
		}

		
		foreach($return as $key=>$item){
			$return[$key]["images"] = $this->getImages($item['product_id']);
			$return[$key]["tags"] = $this->getListByProduct($item['product_id']);
		}
		
		return $return;

	}

	function getTagByProductList($product_list,$tag_id = false){
		
		$return = array();
		$newArray = array();

		// Hago foreach de la lista
		foreach($product_list as $key=>$item){
			// Pido un array con los tag de un producto, sacando el $tag_id del listado
			$newArray = $this->getTagRelations($item['product_id'],$tag_id);

			// Recorro el listado y lo agrego individualmente a $return
			foreach($newArray as $key=>$itemResult){
				// Si el resultado esta repetido, omitirlo.
				if(!array_search($itemResult, $return)){
					array_push($return, $itemResult);
				}
			}
		}

		//$result = array_unique($return);

		$result = array();
		$result = $this->limpiarArray($return);
	
		return $result;

	}

	// Limpia datos repetidos en array
    function limpiarArray($array){ 
        $retorno=null; 
        if($array!=null){ 
            $retorno[0]=$array[0]; 
        } 
        for($i=1;$i<count($array);$i++){ 
            $repetido=false; 
            $elemento=$array[$i]; 
            for($j=0;$j<count($retorno) && !$repetido;$j++){ 
                if($elemento==$retorno[$j]){ 
                    $repetido=true; 
                } 
            } 
            if(!$repetido){ 
                $retorno[]=$elemento; 
            } 
        } 
        return $retorno; 
    }  

	function getTagRelations($product_id,$tag_id = false)	{
		$fields = array('fit_tag_relation.tag_id,fit_tag.tag_name');

		$table = $this->dbRelationTable;
		$table .= ' INNER JOIN '.$this->dbTable;
		$table .= ' ON '.$this->dbTable.'.tag_id = '.$this->dbRelationTable.'.tag_id';

		if($tag_id){
			$filters = array($this->dbRelationTable.'.product_id='.$product_id, $this->dbRelationTable.'.tag_id<>'.$tag_id);
		}else{
			$filters = array($this->dbRelationTable.'.product_id='.$product_id);
		}
		$orderby = "fit_tag_relation.tag_id asc";
		$result = $this->getdata($table, $fields, $filters, $orderby);
		return $result;
	}
	
	function getImages($id){		
		$table = $this->dbImageTable;
		$table .= " LEFT JOIN fit_files ON ".$this->dbImageTable.".file_id = fit_files.file_id";
		$fields = array('*');
		$filters = array($this->dbImageTable.".product_id=".$id);
		
		$result = $this->getdata($table, $fields, $filters);
		return $result;
	}	

	function getAll(){
		$table = $this->dbTable;
		$fields = array('*');
		$filters = false;
		$orderby = "tag_name asc";
		$return = $this->getdata($table, $fields, $filters,$orderby);
		foreach($return as $key=>$item){
			$return[$key]["products_count"] = $this->getProductRelations($item['tag_id']);
		}
		return $return;
	}

	function getProductRelations($tag_id)	{
		$fields = array('fit_tag_relation.tag_id');
		$table = $this->dbRelationTable;
		$filters = array($this->dbRelationTable.'.tag_id='.$tag_id);
		$result = $this->count($table, $filters);
		return $result;
	}

	function getRelations($product_id)	{
		$fields = array('*');
		$table = $this->dbRelationTable;
		$filters = array($this->dbRelationTable.'.product_id='.$product_id);
		$orderby = "tag_id asc";
		$result = $this->getdata($table, $fields, $filters, $orderby);
		//$item = $result[0];
		return $result;
	}

	function createRelations($product_id, $file_ids = array()){
		if(count($file_ids)){
			foreach($file_ids as $key=>$files){
				$relation_item = array
				(
					$this->dbId => $files,
					"product_id" => $product_id
				);
				$this->insertdata($this->dbRelationTable, $relation_item);
			}
		}
	}
	
	function deleteRelations($product_id){
		//echo "deleteRelations _________ product_id: ";
		//echo $product_id;
		if($product_id){
			$filters = array("product_id=".$product_id);
			$this->deletedata($this->dbRelationTable, $filters);
		}
	}
	
	function delete($id){
		if($id){
			$filters = array($this->dbId."=".$id);
			return $this->deletedata($this->dbTable,$filters);
		}
	}
}

?>