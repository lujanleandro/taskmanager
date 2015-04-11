<?
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

//define("DOCUMENT_ROOT", "/home2/roldan/public_html/");
//define("SYSTEM_BASE","/home2/roldan/public_html/cms/");

define("DOCUMENT_ROOT", "c:/trabajo/productos/website/");
define("SYSTEM_BASE", DOCUMENT_ROOT . "cms/");
define('DIRECTORIO_IMAGENES', 'cms/uploadedfiles/');
define('FILE_IMAGE', 'cms/uploadedfiles/file_');
define('THUMB_IMAGE', 'cms/uploadedfiles/thumbs/file_');
define('HOME_PAGE', 'index.php');
define('PAGING_LIMIT',100);

ini_set("include_path", SYSTEM_BASE . "pear/");

include($_SERVER['DOCUMENT_ROOT'].'/cms/config/config.inc');
include($_SERVER['DOCUMENT_ROOT'].'/cms/classes/Db.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/classes/ProductsManager.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/classes/CategoryManager.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/classes/TagManager.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/classes/Category.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/classes/File.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/classes/Search.php');
include($_SERVER['DOCUMENT_ROOT'].'/cms/classes/Util.php');
?>