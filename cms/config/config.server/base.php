<?
//DEFINE SYSTEM BASE
define("DOCUMENT_ROOT","/home2/roldan/public_html/");
define("SYSTEM_BASE", DOCUMENT_ROOT . "cms");
define("PEAR_PATH", DOCUMENT_ROOT . "cms/pear");

//INCLUDE PATH FOR PEAR PACKAGES
ini_set("include_path", PEAR_PATH. PATH_SEPARATOR . SYSTEM_BASE);

/* PHP CLASSES */
require_once(SYSTEM_BASE."/classes/Session.php");
require_once(SYSTEM_BASE."/classes/File.php");
require_once(SYSTEM_BASE."/classes/FileManager.php");
require_once(PEAR_PATH."/DB.php");
require_once(SYSTEM_BASE."/classes/Db.php");
require_once(SYSTEM_BASE."/classes/Templates.php");
require_once(SYSTEM_BASE."/classes/Util.php");
require_once(SYSTEM_BASE."/classes/User.php");
require_once(SYSTEM_BASE."/FCKeditor/fckeditor.php");
require_once(SYSTEM_BASE."/config/config.inc");

/* START SESSION AND INSTANCE TEMPLATES */
$session = new Session();
$session-> start();
?>