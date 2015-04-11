<?
$mod_conf['module_name']	= "category";
$mod_conf['base_path']		= SYSTEM_BASE."/modules/category";
$mod_conf['title_create'] 	= "Crear un Cliente";
$mod_conf['title_edit'] 	= "Modificar un Cliente";
$mod_conf['title_delete'] 	= "Borrar un Cliente";
$mod_conf['title_list'] 	= "Clientes / Proyectos";
$mod_conf['template_edit']	= "edit.tpl";
$mod_conf['template_list']	= "list.tpl";
$mod_conf['template_create']	= "create.tpl";
$mod_conf['manager']		= "CategoryManager";

//Overwrite global config
$conf['templatesdir']		= $mod_conf['base_path']."/templates/";

require_once(SYSTEM_BASE."/classes/CategoryManager.php");
?>