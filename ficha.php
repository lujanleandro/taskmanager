<? include('includes/config.inc'); ?>
<? 
	$db = new System_Db($conf['sql']);
	$mgr = new ProductsManager($conf['sql']);
	$tags = new TagManager($conf['sql']);
	$tagList = $tags->getAll();
	$list = $mgr->lists();
	$product_id = Trim($_REQUEST['id']);
	$product = $mgr->get($product_id);

	$tagListbyProduct = $tags->getListByProduct($product_id);
	$productListbyTags = $tags->getListByTags($product_id);

	// Meta
	$page_title = "Roldan - ".$product['product_name'];
	$page_metakeys = "";
	foreach($tagListbyProduct as $key=>$item){
		$page_metakeys .= $item['tag_name'].", ";
	}
	$page_metakeys .= $product['product_name'];
	$page_metadesc = $product['product_description'];
	foreach($tagListbyProduct as $key=>$item){
		$page_metadesc .= ", ".$item['tag_name'];
	}
	
	/*
	echo "<pre>";
	print_r($product);
	echo "</pre>";
	*/
?>
<? include("includes/headhtml.php"); ?>
 <body>
	<?php include_once("includes/analytics.php") ?>
	<? include("includes/header.php"); ?>
	<div id="wrapper">
		<div id="content">
			<? include("includes/aside.php"); ?>
			<section class="indexMain article" itemscope itemtype="http://schema.org/Product">
				<? if(isset($product['images'][0]['file_name'])){ ?>
				<figure class="image">
					<? $file_thumb_id = $product['images'][0]['thumb_id']; ?>
					<? $file_path = FILE_IMAGE . $product['images'][0]['file_id']."." . $product['images'][0]['file_name']; ?>
					<? $file_thumb = THUMB_IMAGE . $file_thumb_id."." . $product['images'][0]['file_name']; ?>
					<img itemprop="image" alt="<?=$product['product_name'];?>" src="/<?=$file_path;?>" />
				</figure>
				<? } //if ?>
				<header>
					<a class="volver" href="/listado/"><i class="fa fa-angle-double-left"></i> Volver</a>
					<h2 itemprop="name"><?=$product['product_name'];?></h2>
				</header>
				<article>
				  <p itemprop="description"><?=$product['product_description'];?></p>
				</article>
				<footer>
					<? if(is_array($tagListbyProduct) && !empty($tagListbyProduct)){ ?>
					<ul class="tags">
						<? foreach($tagListbyProduct as $key=>$item){ ?>
						<li><a href="/tag/<?=$item['tag_id'];?>-<?=convertURL($item['tag_name']);?>/">#<?=$item['tag_name'];?></a></li>
						<? } ?>
					</ul>
					<? } ?>
					<div class="buttons">
						<div class="fb-share-button comparir" data-href="http://antiguedadesroldan.com.ar/producto/<?=$product['product_id'];?>-<?=convertURL($product['product_name']);?>/" data-type="button_count"></div>
						<a href="/producto/<?=$product['product_id'];?>-<?=convertURL($product['product_name']);?>/" class="precio contactDialogLink">Solicitar Precio</a>
					</div>
				</footer>
				<div class="clear"></div>
			</section>
			<div class="clear"></div>

			<section class="indexMain related">
				<h2>Productos Relacionados</h2>
	
					<div class="carousel-rel">
						<div class="prev"><p><i class="fa fa-chevron-left"></i></p></div>
						<div class="next"><p><i class="fa fa-chevron-right"></i></p></div>
						<ul>
							<? if(is_array($productListbyTags)){

								foreach($productListbyTags as $key=>$item){ ?>
								<? if(!empty($item['images'][0]['file_name']) && ($key < 4)){ ?>

									<li>
										<figure class="image">
											<? $file_thumb_id = $item['images'][0]['thumb_id']; ?>
											<? $file_path = FILE_IMAGE . $item['images'][0]['file_id']."." . $item['images'][0]['file_name']; ?>
											<? $file_thumb = THUMB_IMAGE . $file_thumb_id."." . $item['images'][0]['file_name']; ?>
											<a href="/producto/<?=$item['product_id']?>-<?=convertURL($item['product_name']);?>/">
												<img alt="" src="/<?=$file_path;?>" />
												<figcaption><?=$item['product_name'];?></figcaption>
											</a>
										</figure>
									</li>

								<? } //if ?>
								<? } //foreach ?>
							<? } ?>
						</ul>
					</div>
				</section>
			
			<div class="clear"></div>
			<? include("includes/supertags.php"); ?>
		</div>
	</div>

	<? include("includes/modal.php"); ?>
	<? include("includes/footer.php"); ?> 			
	</div> <!-- <div id="wrapper"> -->
 </body>
</html>