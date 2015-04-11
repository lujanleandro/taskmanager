<?
class Search extends System_Db {

	var $results = array();
	var $limit = 0;
	var $offset = 0;
	var $page;
	var $term;
	var $searchType = 'realestates';
	var $returnElements = true;

	function generateLinks($qryStg,$pagNum,$pages)
	{
		$qry = array ();
		for ($i=0;$i<$pages;$i++){
			$aux = $i + 1;
			$qry[$i] = $qryStg."&page=".$aux;
		}
		return $qry;
	}

	function doSearch($category_id = 0,$transaction_id=0,$location = array(),$priceStart=0,$priceEnd=0)
	{
				//Search in Realestates
				$params = array(
					"category_id"=>$category_id,
					"transaction_id"=>$transaction_id,
					"location"=>$location,
					"priceStart"=>$priceStart,
					"priceEnd"=>$priceEnd,

				);
				$result = $this->searchRealestates($params);
				return $result;
    }

	//Search Real Estates
	function searchRealestates($params)
	{
		$fields = array("fit_realestate.realestate_id");
		$table = " fit_realestate ";
		$filters = array();
		if($params['category_id']!=0) array_push($filters,"fit_realestate.category_id=".$params['category_id']);
		if($params['transaction_id']!=0) array_push($filters,"fit_realestate.transaction_id=".$params['transaction_id']);

		if($params['location']['provincia_id']!=0) array_push($filters,"fit_realestate.provincia_id=".$params['location']['provincia_id']);
		if($params['location']['partido_id']!=0) array_push($filters,"fit_realestate.partido_id=".$params['location']['partido_id']);
		if($params['location']['ciudad_id']!=0) array_push($filters,"fit_realestate.ciudad_id=".$params['location']['ciudad_id']);
		
		if($params['priceStart']!=0) array_push($filters,"fit_realestate.realestate_price>=".$params['priceStart']);
		if($params['priceEnd']!=0) array_push($filters,"fit_realestate.realestate_price<=".$params['priceEnd']);
		$orderby = "fit_realestate.realestate_code desc";
		$limit = $this->offset.", ".$this->limit;
		$result = $this->getdata($table,$fields,$filters,$orderby,$limit);

		if(is_array($result) && $this->returnElements)
		{
			require(SYSTEM_BASE.'/config/config.inc');
			$mgr = new RealstatesManager($conf['sql']);
			foreach($result as $key=>$value)
			{
				$result[$key] = $mgr->get($value['realestate_id']);
			}
			return $result;
		}
		else
		{
			return count($result);
		}
		
	}

}

?>