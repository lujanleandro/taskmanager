<?
// Configuracion general
define('STYLECSS', "resources/styles/back.css");

define('ACTION_FIELDNAME', 'task');
define('THUMBNAIL_WIDTH', '140');

$cssStyle = "/resources/styles/back.css";

$conf['client_name']		= 'Tasks Manager';
$conf['keywords']			= 'Tasks Manager';
$conf['description']		= 'Tasks Manager';

$conf['dictionary']        	= 'spanish';
$conf['sql']['phptype']    	= 'mysql';
$conf['sql']['protocol']   	= 'tcp';
$conf['sql']['port']       	= '3306';
$conf['sql']['hostspec']   	= 'localhost';
$conf['sql']['username']   	= 'root';
$conf['sql']['password']   	= '';
$conf['sql']['database']   	= 'tasks_db';
$conf['sql']['prefix']   	= 'fit_';

$conf['localbase']    		= '/';
$conf['templatesdir']		= SYSTEM_BASE . '/includes/templates/';
$conf["sitedir"]			= 'http://www.tasks.com.ar/';
$conf['formatohora']		= 'd/m/Y';
$conf['image_path']			= '/fotos/';
$conf['video_path']			= '/videos/';
$conf['audio_path']			= '/audios/';
$conf['uploaded_files_path']= '/uploadedfiles/';
$conf['admin_folder']		= '/cms';

//DEFAULTS
$conf['AgendaDefaultId']	= '1';

?>