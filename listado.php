<? include('includes/config.inc'); ?>
<? 
	$db = new System_Db($conf['sql']);
	$mgr = new ProductsManager($conf['sql']);
	$tags = new TagManager($conf['sql']);

	$destacados = $mgr->listsHigh();
	
	//* PAGING *//
	$totalInPage	= PAGING_LIMIT;
	$tag_id			= ($_REQUEST['tag'] == '')?null:$_REQUEST['tag'];
	//$page			= ($_REQUEST['page'] == '')?1:$_REQUEST['page'];
	$filter			= (!isset($_REQUEST['estado'])&&($_REQUEST['estado'] == ''))?null:$_REQUEST['estado'];
	$inactive_id		= "2"; //Tomar inactivo de la base.
	$tagb			= ((!isset($_REQUEST['tagb'])) || ($_REQUEST['tagb'] == ''))?false:$_REQUEST['tagb'];

	if($filter!=null){
		$filter = array("fit_product.estado_id = 1");
		$filterlink="&estado=".$_REQUEST['estado'];
	}else{
		$filterlink="";
	}

	if($tag_id==null){
		$listresult = $mgr->getActiveList($inactive_id,$limit,$filter);
	}else{
		$listresult = $tags->getProductListByTag($tag_id,$tagb);
		$tag_data = $tags->get($tag_id);
		if($tagb!=false){
			$tag_dataB = $tags->get($tagb);
		}
	}

	// Meta
	$page_title = "Roldan - ".$tag_data['tag_name'];
	if($tagb!=false){
		$page_title .= ", ".$tag_dataB['tag_name'];
	}
	$page_metakeys = $tag_data['tag_name'];
	if($tagb!=false){
		$page_metakeys .= ", ".$tag_dataB['tag_name'];
	}
	$page_metakeys .= ", Antigüedades, Antigüedades en San Telmo, Antigüedades en Buenos Aires";
	$page_metadesc = "Encuentre Antigüedades ".$tag_data['tag_name'];
	if($tagb!=false){
		$page_metadesc .= ", ".$tag_dataB['tag_name'];
	}
	
	/*
	echo "listresult:<br/><pre>";
	print_r($listresult);
	echo "</pre>";
	*/
	
	// Si no hay resultados, que redireccione al listado.
	if(empty($listresult)){
		header("Location: /listado/");
	}
?>
<? include("includes/headhtml.php"); ?> 
<body>
	<?php include_once("includes/analytics.php") ?>
	<? include("includes/header.php"); ?> 
	<div id="wrapper">
		<div id="content">
			<? include("includes/aside.php"); ?>

			<section class="indexMain listContent">
				<header>
					<a class="volver" href="/listado/"><i class="fa fa-angle-double-left"></i> Volver</a>
					<? if($tag_id!=null){ ?>
					<ul class="breadcrum">
						<li><a href="/tag/<?=$tag_data['tag_id']?>-<?=convertURL($tag_data['tag_name'])?>/">#<?=$tag_data['tag_name']?><i class="fa fa-times-circle"></i></a></li>
						<? if($tagb!=false){ ?>
						<li><a href="/tag/<?=$tag_dataB['tag_id']?>-<?=convertURL($tag_dataB['tag_name'])?>/">#<?=$tag_dataB['tag_name']?><i class="fa fa-times-circle"></i></a></li>
						<? } ?>
						<!--<li><a href="#">#plata</a><i class="fa fa-times-circle"></i></li>-->
					</ul>
					<? } ?>
				</header>
				<ul class="list">
						<? if(is_array($listresult)){
							$skip = 5;
							foreach($listresult as $key=>$item){ ?>
							<!-- TIENE IMAGEN? -->
							<? //if(!empty($item['images'][0]['file_name'])){ ?>
								<? if ((($key) % $skip ) == ($skip-1)) { ?>
									<li class="last" itemscope itemtype="http://schema.org/Product">
								<? }else{ ?>
									<li itemscope itemtype="http://schema.org/Product">
								<? } ?>
								<!--<li>-->
									<figure class="image">
										<? $file_thumb_id = $item['images'][0]['thumb_id']; ?>
										<? $file_path = FILE_IMAGE . $item['images'][0]['file_id']."." . $item['images'][0]['file_name']; ?>
										<? $file_thumb = THUMB_IMAGE . $file_thumb_id."." . $item['images'][0]['file_name']; ?>
										<a href="/producto/<?=$item['product_id']?>-<?=convertURL($item['product_name'])?>/"><img alt="<?=convertURL($item['product_name']);?>" itemprop="image" src="/<?=$file_thumb;?>" /></a>
									</figure>
									<h3><a href="/producto/<?=$item['product_id']?>-<?=convertURL($item['product_name'])?>/"  itemprop="name"><?=$item['product_name'];?></a></h3>
									<p><a class="contactDialogLink" href="/producto/<?=$item['product_id']?>-<?=convertURL($item['product_name'])?>/">Solicitar Precio</a></p>
								</li>

							<? //} //if ?>
							<!-- /TIENE IMAGEN? -->
							<? } //foreach ?>
						<? } ?>
					</ul>

				</div>
			</div>
		</div>

	<? include("includes/modal.php"); ?>		
	<? include("includes/footer.php"); ?> 			
	</div> <!-- <div id="wrapper"> -->
 </body>
</html>