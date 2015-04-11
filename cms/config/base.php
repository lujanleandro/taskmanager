<?php
//DEFINE SYSTEM BASE
//define("DOCUMENT_ROOT","/home2/tasks/public_html/");
//define("DOCUMENT_ROOT", "c:/taskmanager/website/");
define("SYSTEM_BASE", DOCUMENT_ROOT . "cms");

//INCLUDE PATH FOR PEAR PACKAGES
define("PEAR_PATH", DOCUMENT_ROOT . "cms/pear");
ini_set("include_path", PEAR_PATH. PATH_SEPARATOR . SYSTEM_BASE);
require_once(PEAR_PATH."/DB.php");

/* PHP CLASSES */
require_once(SYSTEM_BASE."/classes/Session.php");
require_once(SYSTEM_BASE."/classes/File.php");
require_once(SYSTEM_BASE."/classes/FileManager.php");
require_once(SYSTEM_BASE."/classes/Db.php");
require_once(SYSTEM_BASE."/classes/Templates.php");
require_once(SYSTEM_BASE."/classes/Util.php");
require_once(SYSTEM_BASE."/classes/User.php");
require_once(SYSTEM_BASE."/config/config.inc");

/* START SESSION AND INSTANCE TEMPLATES */
$session = new Session();
$session-> start();

$GLOBALS['template'] = new Templates($conf['templatesdir']);

?>