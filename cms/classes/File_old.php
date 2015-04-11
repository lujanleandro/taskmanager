<?

class File
{
	var $db;
	var $dbTable = 'fit_files';
	var $dbId = 'file_id';
	var $dbName = 'file_name';
	var $dbType = 'file_type';

	var $files_prefix = 'file_';

	/*****************
	 * Constructor
	 *****************/

	function File($db)
	{
		$this->db = $db;
	}

	function get($id)
	{
		$filters = array($this->dbId."=".$id);
		$result = $this->db->getdata($this->dbTable, "*", $filters);
		return $result[0];
	}

	function create($item)
	{
		$this->db->insertdata($this->dbTable, $item);
		$item[$this->dbId] = $this->db->lastinsertedid();
		return $item;
	}

	function delete($id, $folder_path = false)
	{
		if($id)
		{
			if($folder_path != false)
			{
				$item = $this->get($id);

				$filename = $this->getFilename($id, $item[$this->dbName]);

				unlink($folder_path . $filename);
			}

			$filters = array($this->dbId . '=' . $id);

			return $this->db->deletedata($this->dbTable,$filters);
		}
	}

	function saveUploadedFileToSystem($folder_path, $id, $uploaded_file)
	{
		$original_filename = basename($uploaded_file['name']);
		$filename = $this->getFilename($id, $original_filename);
		$uploadfile = $folder_path . $filename;

		if (move_uploaded_file($uploaded_file['tmp_name'], $uploadfile))
		{
	    	return true;
		}
		else
		{
			return false;
		}
	}

	function getFilename($file_id, $filename)
	{
		if($filename != null && $filename != '')
		{
			return $this->files_prefix . $file_id . '.' . $filename;
		}

		return '';
	}

	function saveUploadedFile($uploaded_file, $folder_path)
	{
		$file_id = 0;

		$file_item = array
		(
			'file_name' => $uploaded_file['name'],
			'file_type' => $uploaded_file['type']
		);

		$file_item  = $this->create($file_item);

		$saved = $this->saveUploadedFileToSystem($folder_path, $file_item[$this->dbId], $uploaded_file);

		if($saved)
		{
			$file_id = $file_item[$this->dbId];
		}
		else
		{
			$this->delete($file_item[$this->dbId]);
		}

		return $file_id;
	}

	function createThumbFromFile($file_id, $folder_path, $width)
	{
		$file = $this->get($file_id);

		$orig_file_path = $folder_path . $this->getFilename($file[$this->dbId], $file[$this->dbName]);

		$file_thumb = array
		(
			'file_name' => $file[$this->dbName],
			'file_type' => $file[$this->dbType]
		);

		$file_thumb = $this->create($file_thumb);

		$thumb_file_name = $this->getFilename($file_thumb[$this->dbId], $file_thumb[$this->dbName]);

		resizePic($this->files_prefix, $orig_file_path, $folder_path."thumbs/", $width, 0, 0, $thumb_file_name);

		return $file_thumb[$this->dbId];
	}

}

?>