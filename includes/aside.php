<? 
	//$tagManager = new TagManager($conf['sql']);
	$tags = new TagManager($conf['sql']);
	$categoryList = $tags->getAll();

	if(isset($_REQUEST['tag'])&&($_REQUEST['tag'] != '')){
		$tag_id = $_REQUEST['tag'];
	}else{
		$tag_id = false;
	}
	$tagb = ($_REQUEST['tagb'] == '')?false:$_REQUEST['tagb'];
	
	if($tag_id!=false){
		$categoryList = $tags->getTagByProductList($listresult,$tag_id);
		if($tagb!=false){
			$categoryBList = array();
			foreach($categoryList as $key=>$itemCategory){
				if($itemCategory['tag_id']!=$tagb){
					array_push($categoryBList, $itemCategory);
				}
			}
			$categoryList = $categoryBList;
			$tag_data = $tags->get($tag_id);
		}
	}else{
		$categoryList = array_sort($categoryList, 'products_count', SORT_DESC);
	}
	
	/*
	echo "categoryList:<br/><pre>";
	print_r($categoryList);
	echo "</pre>";
	*/
	
		
?>
<aside class="categories">
	<? if(is_array($categoryList)){ ?>
	<? $countList = 0; ?>
	<ul>
		<? foreach($categoryList as $key=>$item){ ?>
			<? if($countList < 12){ ?>
			<? $countList++; ?>
			<?
				$href = "/tag/".$item['tag_id']."-".convertURL($item['tag_name']);
				if($tag_id!=false){
					$href = $item['tag_id']."-".convertURL($item['tag_name']);
				}
				if($tagb!=false){
					//$href = $item['tag_id']."-".$item['tag_name'];
					$href = "/tag/".$tag_id."-".convertURL($tag_data['tag_name'])."/".$item['tag_id']."-".convertURL($item['tag_name']);
				}
			?>
			<li><a href="<?=$href?>/"><span><?=$item['tag_name'];?></span><!--<i><?=$item['products_count'];?></i>--></a></li>
			<? } ?>
		<? } ?>
	</ul>
	<? } ?>
</aside>