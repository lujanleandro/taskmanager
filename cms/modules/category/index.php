<?
include("moduleconfig.inc");

$template 		= new Templates($conf['templatesdir']);
$template->setvalue("mod_conf",$mod_conf);
$template->setvalue("conf",$conf);
$Mgr 			= new $mod_conf['manager']($conf['sql']);
$Mgr->debug = false;

switch(getaction()){
	case 'edit':
			$template->setvalue("item",$Mgr->get(getvalue('id')));
			$template->setvalue('estadoList', $Mgr->getEstados());
			$template->add($mod_conf['template_edit']);
			$template->show();
	break;

	case 'delete':
			$Mgr->delete(getvalue('id'));
			$template->setvalue("list",$Mgr->getAll());
			$template->add($mod_conf['template_list']);
			$template->show();
	break;

	case 'create':
			$template->add($mod_conf['template_create']);
			$template->show();
	break;

	case 'createok':
			$item = array ("category_name" => $_REQUEST['category_name']);
			$Mgr->create($item);
			$template->setvalue("list",$Mgr->getAll());
			$template->add($mod_conf['template_list']);
			$template->show();
	break;

	case 'editok':
			$item = array (
				"category_id" => $_REQUEST['category_id'],
				"category_name" => $Mgr->quote($_REQUEST['name']),
				"category_description" => $Mgr->quote($_REQUEST['description']),
				"category_order" => $_REQUEST['item_order'],
				"estado_id" => $_REQUEST['estado_id']
			);
			$Mgr->update($item,$item['category_id']);
			$template->setvalue("list",$Mgr->getAll());
			$template->add($mod_conf['template_list']);
			$template->show();
	break;

	case 'list':
	default:
			$template->setvalue("list",$Mgr->getAll());
			$template->add($mod_conf['template_list']);
			$template->show();
	break;
}

?>
