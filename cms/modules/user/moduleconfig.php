<?
$mod_conf['module_name']	= "user";
$mod_conf['base_path']		= SYSTEM_BASE."/modules/user";
$mod_conf['title_create'] 	= "Crear un Usuario";
$mod_conf['title_edit'] 	= "Modificar un Usuario";
$mod_conf['title_add'] 		= "Agregar un Usuario";
$mod_conf['title_delete'] 	= "Borrar un Usuario";
$mod_conf['title_list'] 	= "Usuarios";
$mod_conf['template_edit']	= "edit.tpl";
$mod_conf['template_list']	= "list.tpl";
$mod_conf['template_create']= "create.tpl";

$mod_conf['max_number_images']= 20;

//Overwrite global config
$conf['templatesdir']		= $mod_conf['base_path']."/templates/";

require_once(SYSTEM_BASE."/classes/UserManager.php");
require_once(SYSTEM_BASE."/classes/CategoryManager.php");
require_once(SYSTEM_BASE."/config/config.inc");
?>