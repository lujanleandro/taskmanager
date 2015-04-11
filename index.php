<? include('includes/config.inc'); ?>
<? include("includes/headhtml.php"); ?>
<? 
	$db = new System_Db($conf['sql']);
	$mgr = new ProductsManager($conf['sql']);
	$tags = new TagManager($conf['sql']);
	$tagList = $tags->getAll();
	$categories = new CategoryManager($conf['sql']);
	$categoryList = $categories->getAll();
	$list = $mgr->lists();
	$listsHigh = $mgr->listsHigh();
?>
 <body>
	<?php include_once("includes/analytics.php") ?>
	<? include("includes/header.php"); ?>
	<div id="wrapper">
		<div id="content">
			<? include("includes/aside.php"); ?>
			<section class="indexMain highlight">
				<h2>Productos Destacados</h2>
	
					<div class="carousel">
						<div class="prev"><p><i class="fa fa-chevron-left"></i></p></div>
						<div class="next"><p><i class="fa fa-chevron-right"></i></p></div>
						<ul class="listHigh">
							<? if(is_array($listsHigh)){
								foreach($listsHigh as $key=>$item){ ?>
								<? if(!empty($item['images'][0]['file_name']) && ($key < 4)){ ?>
									<li itemscope itemtype="http://schema.org/Product">
										<figure class="image">
											<? $file_thumb_id = $item['images'][0]['thumb_id']; ?>
											<? $file_path = FILE_IMAGE . $item['images'][0]['file_id']."." . $item['images'][0]['file_name']; ?>
											<? $file_thumb = THUMB_IMAGE . $file_thumb_id."." . $item['images'][0]['file_name']; ?>
											<a href="/producto/<?=$item['product_id']?>-<?=convertURL($item['product_name']);?>/">
												<img itemprop="image" alt="<?=$item['product_name'];?>" src="/<?=$file_path;?>" />
												<figcaption><p itemprop="name"><?=$item['product_name'];?></p></figcaption>
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
		
	<? include("includes/footer.php"); ?> 			
	</div> <!-- <div id="wrapper"> -->
 </body>
</html>