<?
$mod_conf['module_name']	= "product";
$mod_conf['base_path']		= SYSTEM_BASE."/modules/product";
$mod_conf['title_create'] 	= "Crear una Tarea";
$mod_conf['title_edit'] 	= "Modificar una Tarea";
$mod_conf['title_add'] 		= "Agregar una Tarea";
$mod_conf['title_delete'] 	= "Borrar una Tarea";
$mod_conf['title_list'] 	= "Listado de tareas";
$mod_conf['title_dash'] 	= "Dashboard";
$mod_conf['template_edit']	= "edit.tpl";
$mod_conf['template_list']	= "list.tpl";
$mod_conf['template_dash']	= "dashboard.tpl";
$mod_conf['template_create']= "create.tpl";

$mod_conf['max_number_images']= 5;

//Overwrite global config
$conf['templatesdir']		= $mod_conf['base_path']."/templates/";

require_once(SYSTEM_BASE."/classes/ProductManager.php");
require_once(SYSTEM_BASE."/classes/TagManager.php");
require_once(SYSTEM_BASE."/classes/CategoryManager.php");
require_once(SYSTEM_BASE."/config/config.inc");
?>