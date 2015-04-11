<?
$mod_conf['module_name']	= "tag";
$mod_conf['base_path']		= SYSTEM_BASE."/modules/tag";
$mod_conf['title_create'] 	= "Crear una Carpeta";
$mod_conf['title_edit'] 	= "Modificar una Carpeta";
$mod_conf['title_delete'] 	= "Borrar una Carpeta";
$mod_conf['title_list'] 	= "Carpetas / Etiquetas";
$mod_conf['template_edit']	= "edit.tpl";
$mod_conf['template_list']	= "list.tpl";
$mod_conf['template_create']= "create.tpl";
$mod_conf['manager']		= "TagManager";

//Overwrite global config
$conf['templatesdir']		= $mod_conf['base_path']."/templates/";

require_once(SYSTEM_BASE."/classes/TagManager.php");
?>