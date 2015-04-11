<?
include("moduleconfig.inc");

$template 		= new Templates($conf['templatesdir']);
$template->setvalue("mod_conf",$mod_conf);
$template->setvalue("conf",$conf);
$Mgr 			= new $mod_conf['manager']($conf['sql']);
$Mgr->debug = false;

switch(getaction())
{
	case 'edit':
			$template->setvalue("item",$Mgr->get(getvalue('id')));
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
			$item = array (
				"tag_name" => $_REQUEST['name']
			);
			$Mgr->create($item);
			$template->setvalue("list",$Mgr->getAll());
			$template->add($mod_conf['template_list']);
			$template->show();
	break;

	case 'editok':
			$item = array (
				"tag_id" => $_REQUEST['id'],
				"tag_description" => $Mgr->quote($_REQUEST['description']),
				"tag_name" => $Mgr->quote($_REQUEST['name'])
			);
			$Mgr->update($item,$item['id']);
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
