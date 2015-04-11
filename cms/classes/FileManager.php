<?php
/*
 * Created on Sep 11, 2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

 class FileManager
 {

 	function FileManager()
	{
	}

 	function upload($file,$path)
 	{
 		if ( ($file["error"] == 0) &&  ($file["size"] != 0) )
		{
			$filename_temp	 	= $file["tmp_name"];
			$filename			= str_replace(' ','-',$file["name"]);

			if (move_uploaded_file ($filename_temp,$path.$filename))
			{
				chmod ($path.$filename,0755);
				return true;
			}
		}
		else
		{

			return false;
		}
 	}
 }
?>
