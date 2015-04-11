<?
class News
{
	var $db;
	var $dbTable = 'fit_news';
	var $dbId = 'news_id';
	var $dbImageFile = 'img_filename';
	var $dbThumbFile = 'thumb_filename';

	function News($db)
	{
		$this->db = $db;
	}

	function Get($id)
	{
		$fields = array($this->dbTable.'.*', 'fit_category.*', 'fit_files.*', 'thumb.file_id file_id_thumb', 'thumb.file_name file_name_thumb');

		$table = $this->dbTable." left join fit_category on ".$this->dbTable.".category_id = fit_category.category_id";
		$table .= " left join fit_files on ".$this->dbTable.".file_id = fit_files.file_id";
		$table .= " left join fit_files as thumb on ".$this->dbTable.".file_thumb_id = thumb.file_id";

		$filters = array($this->dbId."=".$id);

		$result = $this->db->getdata($table, $fields, $filters);

		$item = $result[0];

		$file = new File($this->db);

		$file_id = $item[$file->dbId];
		$file_name = $item[$file->dbName];
		$item[$this->dbImageFile] = $file->GetFilename($file_id, $file_name);

		$file_id = $item[$file->dbId.'_thumb'];
		$file_name = $item[$file->dbName.'_thumb'];
		$item[$this->dbThumbFile] = $file->GetFilename($file_id, $file_name);

		return $item;
	}

	function getDocumentsAsoc($id)
	{
		$table = "fit_document";
		$fields = array("*");
		$filters = array($table.".news_id=".$id);
		$return = $this->db->getdata($table,$fields,$filters);
		return $return;
	}

	function getImagesAsoc($id)
	{
		$table = " fit_files inner join fit_news_images on fit_files.file_id = fit_news_images.file_id ";
		$fields = array("fit_files.*");
		$filters = array($this->dbId."=".$id);
		$return = $this->db->getdata($table,$fields,$filters);
		return $return;
	}

	function Create($item)
	{
		$this->db->insertdata($this->dbTable,$item);
		$item['news_id'] = $this->db->lastinsertedid($this->dbTable);
		return $item;
	}

	function Update($item)
	{
		$filters = array($this->dbId."=".$item[$this->dbId]);
		$result = $this->db->updatedata($this->dbTable,$item,$filters);
		return $result;
	}

	function Lists($catid = 0)
	{
		$table = $this->dbTable . " LEFT JOIN fit_category ON ".$this->dbTable.".category_id = fit_category.category_id ";
		$table .= " LEFT JOIN fit_files ON ".$this->dbTable.".file_id = fit_files.file_id";
		$table .= " LEFT JOIN fit_files AS thumb ON ".$this->dbTable.".file_thumb_id = thumb.file_id";
		$orderby = $this->dbTable.".news_date DESC";
		if($catid)
		{
			$filters = array($this->dbTable.".category_id=".$catid);
			return $this->db->getdata($table, "*",$filters,$orderby);
		}
		else
		{
			$filters = array();

			return $this->db->getdata($table, "*",$filters,$orderby);
		}
	}

	function ListsHome()
	{
		$table = $this->dbTable . " LEFT JOIN fit_category ON ".$this->dbTable.".category_id = fit_category.category_id ";
		$table .= " LEFT JOIN fit_files ON ".$this->dbTable.".file_id = fit_files.file_id";
		$table .= " LEFT JOIN fit_files AS thumb ON ".$this->dbTable.".file_thumb_id = thumb.file_id";
		$limit = 1;
		$orderby = $this->dbTable.".news_date DESC";
		$returnArray = array();

		$filters = array($this->dbTable.".category_id=2");
		$getArray = $this->db->getdata($table, "*",$filters,$orderby,$limit);
		if (!empty($getArray)) {array_push($returnArray,$getArray[0]);}

		$filters = array($this->dbTable.".category_id=3");
		$getArray = $this->db->getdata($table, "*",$filters,$orderby,$limit);
		if (!empty($getArray)) {array_push($returnArray, $getArray[0]);}

		$filters = array($this->dbTable.".category_id=4");
		$getArray = $this->db->getdata($table, "*",$filters,$orderby,$limit);
		if (!empty($getArray)) {array_push($returnArray,$getArray[0]);}

		$filters = array($this->dbTable.".category_id=5");
		$getArray = $this->db->getdata($table, "*",$filters,$orderby,$limit);
		if (!empty($getArray)) {array_push($returnArray,$getArray[0]);}

		return $returnArray;
	}

	function ListByCategory($category_id = false, $orderby = 'news_date DESC', $limit = false)
	{
		$fields = array('*', "concat('file_', fit_files.file_id, '.',fit_files.file_name) img_filename");
		array_push($fields, "concat('file_', thumb.file_id, '.',thumb.file_name) thumb_filename");
		$table = $this->dbTable . " left join fit_category on ".$this->dbTable.".category_id = fit_category.category_id";
		$table .= " left join fit_files on ".$this->dbTable.".file_id = fit_files.file_id";
		$table .= " left join fit_files as thumb on ".$this->dbTable.".file_thumb_id = thumb.file_id";
		$filters = array();
		if($category_id) array_push($filters, $this->dbTable.".category_id IN (".$category_id.") ");
		$return =  $this->db->getdata($table, $fields, $filters, $orderby, $limit);
		return $return;
	}

	function ListByCategoryCount($category_id = false, $in_home = -1, $in_archive = 1)
	{
		$fields = array('count(*) as cant');
		$table = $this->dbTable . " inner join fit_category on ".$this->dbTable.".category_id = fit_category.category_id";
		$filters = array();

		if($category_id)
			array_push($filters, $this->dbTable.".category_id IN (".$category_id.")");

		if($in_home != -1)
			array_push($filters, $this->dbTable.".show_home = ".$in_home);

		$result = $this->db->getdata($table, $fields, $filters);
		return $result[0]["cant"];
	}

	function Delete($id)
	{
		if($id)
		{
			$filters = array($this->dbId."=".$id);
			return $this->db->deletedata($this->dbTable,$filters);
		}
	}
}

?>