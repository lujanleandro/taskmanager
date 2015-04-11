<?
include("moduleconfig.php");

$template = new Templates($conf['templatesdir']);
$template->setvalue("mod_conf",$mod_conf);
$template->setvalue("conf",$conf);

$db			= new System_Db($conf['sql']);
$file		= new File($db);
$category	= new CategoryManager($conf['sql']);
$mgr		= new UserManager($conf['sql']);

$mgr->debug = false;
$file->debug = false;

switch(getaction())
{
	case 'delete':			
			$mgr->delete(getvalue('id'));
			header("Location:index.php?module=".$mod_conf['module_name']."&".ACTION_FIELDNAME."=list");
	break;

	case 'edit':
			//$template->setvalue('categories', $category->getAll());
			//$template->setvalue('estadoList', $mgr->getEstados());
			$template->setvalue('item',$mgr->get(getvalue('id')));
			$template->add($mod_conf['template_edit']);
			$template->show();
	break;

	case 'editok':
			// Creo el array con los datos del formulario
			$item = array(			
				'id' => $_REQUEST['user_id'],
				'username' => $mgr->quote($_REQUEST['item_name']),
				'email' => $mgr->quote($_REQUEST['item_email']),
				'accesstype' => $_REQUEST['item_accesstype']
			);

			// Agrego contraseña si no esta vacio
			if(!empty($_REQUEST['item_password'])){
				$item['password'] = $mgr->quote($_REQUEST['item_password']);
			}
			
			$mgr->update($item);

			if ($mgr->debug == false){
				if($_REQUEST['back_submit']==1){
					header("Location:index.php?module=".$mod_conf['module_name']."&".ACTION_FIELDNAME."=list");
					}else{
					header("Location:index.php?module=".$mod_conf['module_name']."&".ACTION_FIELDNAME."=edit&id=".$_REQUEST['user_id']);
				}
			}
			
	break;

	case 'create':
			//$template->setvalue('categories', $category->getAll());
			//$template->setvalue('estadoList', $mgr->getEstados());
			$template->add($mod_conf['template_create']);
			$template->show();
	break;

	case 'createok':			
			$item = array(			
				'accesstype' => $_REQUEST['item_accesstype'],
				'username' => $_REQUEST['item_name'],
				'email' => $_REQUEST['item_email']
			);

			$item = $mgr->create($item, $file_ids);	
			header("Location:index.php?module=".$mod_conf['module_name']."&".ACTION_FIELDNAME."=edit&id=".$item['id']);
	break;

	case 'list':
	default:
			$template->setvalue("list", $mgr->lists());
			$template->add($mod_conf['template_list']);
			$template->show();
	break;
}
?>
