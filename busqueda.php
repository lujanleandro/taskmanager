<? 
include('includes/config.inc');

//Form process
$actionPost = Trim($_REQUEST['postForm']);
$tag_post = Trim($_REQUEST['tag']);
if (!empty($actionPost)){ 

	$db = new System_Db($conf['sql']);
	$mgr = new TagManager($conf['sql']);

	$tag = $mgr->search($tag_post);

	/*
	echo "tag result:";
	echo "<pre>";
	print_r($tag[0]);
	echo "</pre>";
	*/
	
	if(!empty($tag[0]['tag_id'])){ 
		header("Location: /tag/".$tag[0]['tag_id']."-".$tag[0]['tag_name']."/");
	}else{
		header("Location: /listado/");
	}

}else{ 
	//echo "actionPost:".$actionPost;
	header('Location: /index.php');
}
?>