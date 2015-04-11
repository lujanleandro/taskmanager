<?
// Configuracion general
define('STYLECSS', "resources/styles/back.css");

define('ACTION_FIELDNAME', 'task');
define('THUMBNAIL_WIDTH', '140');

$cssStyle = "/resources/styles/back.css";

$conf['client_name']		= 'Roldan Antiguedades';
$conf['keywords']			= 'roldan, antiguedades';
$conf['description']		= 'roldan, antiguedades';

$conf['dictionary']        	= 'spanish';
$conf['sql']['phptype']    	= 'mysql';
$conf['sql']['protocol']   	= 'tcp';
$conf['sql']['port']       	= '3306';
$conf['sql']['hostspec']   	= 'localhost';
$conf['sql']['username']   	= 'roldan_userdb';
$conf['sql']['password']   	= '123abc4567';
$conf['sql']['database']   	= 'roldan_db';
$conf['sql']['prefix']   	= 'fit_';


$conf['localbase']    		= '/';
$conf['templatesdir']		= SYSTEM_BASE . '/templates/';
$conf["sitedir"]		= 'http://www.roldan.com.ar/';
$conf['formatohora']		= 'd/m/Y';
$conf['image_path']		= '/fotos/';
$conf['video_path']		= '/videos/';
$conf['audio_path']		= '/audios/';
$conf['uploaded_files_path']	= '/uploadedfiles/';
$conf['admin_folder']		= '/cms';

//DEFAULTS
$conf['AgendaDefaultId']	= '1';

?>