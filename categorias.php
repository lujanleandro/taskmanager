<? include('includes/config.inc'); ?>
<? include("includes/headhtml.php"); ?>
<? 
	$db = new System_Db($conf['sql']);
	$mgr = new TagManager($conf['sql']);
	$list = $mgr->getAll();
	//echo "<pre>";
	//print_r($list);
	//echo "</pre>";
?>
 <body>
	<?php include_once("includes/analytics.php") ?>
	<? include("includes/header.php"); ?>
	<div id="wrapper">
		<div id="content">
			<section class="indexMain categoriaslist">
				<h2>Categor&iacute;as</h2>
				<ul>
					<? if(is_array($list)){
						$skip = 6;
						foreach($list as $key=>$item){ ?>
							<? if ((($key) % $skip ) == ($skip-1)) { ?>
								<li class="last">
							<? }else{ ?>
								<li>
							<? } ?>
								<a href="/tag/<?=$item['tag_id']?>-<?=convertURL($item['tag_name']);?>/"><?=$item['tag_name'];?></a>
							</li>
						<? } //foreach ?>
					<? } ?>
					</ul>
				</section>
			</div>
		<?// include("includes/sidebar.php"); ?>
		</div>
		
	<? include("includes/footer.php"); ?> 			
	</div> <!-- <div id="wrapper"> -->
 </body>
</html>