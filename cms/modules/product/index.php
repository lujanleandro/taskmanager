<?
include("moduleconfig.php");

$template = new Templates($conf['templatesdir']);
$template->setvalue("mod_conf",$mod_conf);
$template->setvalue("conf",$conf);

$db				= new System_Db($conf['sql']);
$file			= new File($db);
$category		= new CategoryManager($conf['sql']);
$tag			= new TagManager($conf['sql']);
$mgr			= new ProductsManager($conf['sql']);

$file->debug = false;
$mgr->debug = false;
$category->debug = false;

switch(getaction()){
	case 'delete':
			$mgr->delete(getvalue('id'));
			header("Location:index.php?module=".$mod_conf['module_name']."&".ACTION_FIELDNAME."=list");
	break;

	case 'edit':
			$template->setvalue('categories', $category->getAll());
			$template->setvalue('tags', $tag->getAll());
			$template->setvalue('tagsRelations', $tag->getRelations(getvalue('id')));
			$template->setvalue('estadoList', $mgr->getEstados());
			$template->setvalue('item',$mgr->get(getvalue('id')));
			$template->add($mod_conf['template_edit']);
			$template->show();
	break;

	case 'editok':

	/***************************************/
	// Tomar Datos
	// 1. Imagenes Subidas
	// 2. Id del realstate

	$file_ids = array();
	$file_ids = $_REQUEST['filesForUpload'];
	$file_Upload = $_REQUEST['filesUploaded'];	
	$product_id = $_REQUEST['item_id'];
	$procedeOp = $_REQUEST['newFilesUpload'];

	// Si tengo nuevos archivos cargados, entonces borro y cargo nuevos.

	if(isset($procedeOp) && !empty($procedeOp) ){

		// Borrar todos los archivos
		// 1. Recorro todas los registros que con el product_id tomado.
		// 2. Borro registros con ese id

		// Cargo nuevos datos

		if(isset($file_ids) && !empty($file_ids)){
			$fileArrayName = array();
			foreach ($file_ids as $key=>$fileItem) {
				$fileArrayName = pathinfo($fileItem);

				$file_item = array(
					'file_name' => $fileArrayName['basename'],
					'file_type' => $fileArrayName['extension']
				);
				
				// Creo el file en la db

				$fileCreated = $file->create($file_item);
				$fileCreated_id = $fileCreated['file_id'];


				if($fileCreated['file_id'] != 0){

					$file_item['file_id'] = $fileCreated_id;
					// Agrego el count cuando tengo imagenes ya cargadas
					if(isset($file_Upload) && !empty($file_Upload)){
						$file_item['image_order'] = count($file_Upload)+$key+1;
					}else{
						$file_item['image_order'] = $key+1;
					}
					
					// Si tengo el nombre del id a generar, significa que esta generado
					// No hacer rename si ya esta generado.

					$oldname = SYSTEM_BASE.$conf['uploaded_files_path'].$fileArrayName['basename'];
					$newname = SYSTEM_BASE.$conf['uploaded_files_path'].$file->getFilename($fileCreated_id, $fileArrayName['basename']);

					if(!file_exists($newname)){

						// Renombro el file agregando el id y prefijo
			
						if (file_exists($oldname)){
							rename($oldname,$newname);
						}

						// Creo el thumb a 300px de ancho
						$thumb_id = $file->createThumbFromFile($fileCreated_id,SYSTEM_BASE.$conf['uploaded_files_path'], '300');
						$file_item['thumb_id'] = $thumb_id;
					}

				}

				$file_ids[$key] = $file_item;
			}

			// Cargo relaciones
			$mgr->createRelations($product_id, $file_ids);
		}
	}

	/***************************************/

	// Creo el array con los datos del formulario
	$item = array(			
		'estado_id' => $_REQUEST['estado_id'],		
		'product_id' => $_REQUEST['item_id'],
		'product_name' => $mgr->quote($_REQUEST['item_name']),
		'product_description' => $mgr->quote($_REQUEST['item_description']),
		'product_document' => $mgr->quote($_REQUEST['item_document']),
		'product_order' => ckInt($_REQUEST['item_order']),
		'product_date' => $mgr->quote(date("Y-m-d")),			
		'category_id' => $_REQUEST['category_id']
	);
	
	// Actualizo datos
	$tag->deleteRelations($_REQUEST['item_id'],$_REQUEST['tag_id']);
	$tag->createRelations($_REQUEST['item_id'],$_REQUEST['tag_id']);	
	$mgr->update($item);

	//if ($mgr->debug == false){
	if($_REQUEST['back_submit']==1){
		header("Location:index.php?module=".$mod_conf['module_name']."&".ACTION_FIELDNAME."=list");
	}else{
		header("Location:index.php?module=".$mod_conf['module_name']."&".ACTION_FIELDNAME."=edit&id=".$_REQUEST['item_id']);
	}
	//}
			
	break;

	case 'deleteimages':

		$product_id =  $_REQUEST['id'];

		// Borro todas las imagenes con este id.
		$currentFiles = $mgr->getImages($product_id);

		if(isset($currentFiles) && !empty($currentFiles)){
			foreach ($currentFiles as $item) {
				$file->delete($item['file_id']);
			}

			$mgr->deleteRelations($product_id, $currentFiles);	

			//echo "<p>Archivos borrados, array vacio</p>";
			//printr($mgr->getImages($product_id));
		}

		// Borro todas las relaciones con este id.

		// Redirecciono al edit.	
		header("Location:index.php?module=".$mod_conf['module_name']."&".ACTION_FIELDNAME."=edit&id=".$product_id."#cargarFotos");
		

	break;

	case 'create':
			$template->setvalue('categories', $category->getAll());
			$template->setvalue('estadoList', $mgr->getEstados());
			$template->add($mod_conf['template_create']);
			$template->show();
	break;

	case 'createok':			
			$item = array(	
			'estado_id' => $_REQUEST['estado_id'],		
			'product_name' => $_REQUEST['item_name'],
			'product_description' => $_REQUEST['item_description'],
			'product_order' => 0,
			'product_date' => date("Y-m-d"),				
			'category_id' => $_REQUEST['category_id']
			);
			$item = $mgr->create($item, $file_ids);
			if ($mgr->debug == false){
				header("Location:index.php?module=".$mod_conf['module_name']."&".ACTION_FIELDNAME."=edit&id=".$item['product_id']);
			}			
	break;

	case 'list':
			$tagRequest = $_REQUEST['tag_id'];
			$categoryRequest = $_REQUEST['category_id'];
			$template->setvalue("tagRequest",$tagRequest);
			$template->setvalue("categoryRequest",$categoryRequest);
			$filters = array("fit_product.estado_id <> 2");
			$orderby = "";
			if (!empty($tagRequest)) {
				$template->setvalue("list", $mgr->getProductByTag($tagRequest));
			}else{
				if (!empty($categoryRequest)) {
					$template->setvalue("list", $mgr->getListByCategory($categoryRequest));
				}else{
					$template->setvalue("list", $mgr->lists($filters,$orderby));
				}
			}
			$template->setvalue('tags', $tag->getAll());
			$template->setvalue('categories', $category->getAll());
			$template->add($mod_conf['template_list']);
			$template->show();
	break;


	case 'dashboard':
	default:
			//printr($category->getListStatus());
			$template->setvalue("page","1");
			$template->setvalue("list", $category->getListStatus());
			$template->add($mod_conf['template_dash']);
			$template->show();
	break;		
}
?>
