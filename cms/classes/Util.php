<?

function formatDate ($date){
	$pieces = explode ("-",$date);
	$date = $pieces[2]."-".$pieces[1]."-".$pieces[0];
	return $date;
}

function ckInt($data){
	if(isset($data)&&(!empty($data))){
		$return = $data;
	}else{
		$return = 0;
	}
	return $return;
}	

function UserFormatDate ($date){
	$pieces = explode ("-",$date);
	switch ($pieces[1]){
		case "01": $month = "Ene";break;
		case "02": $month = "Feb";break;
		case "03": $month = "Mar";break;
		case "04": $month = "Abr";break;
		case "05": $month = "May";break;
		case "06": $month = "Jun";break;
		case "07": $month = "Jul";break;
		case "08": $month = "Ago";break;
		case "09": $month = "Sep";break;
		case "10": $month = "oct";break;
		case "11": $month = "Nov";break;
		case "12": $month = "Dic";break;
	}
	$year = substr ($pieces[0],2,2);
	$date = "$pieces[2].$month.$year";
	return $date;
}

function UserFormatDateTime ($date,$withTime = false){
	$pieces = explode (" ",$date);
	$time = $pieces[1];
	$timePieces = explode(":",$time);
	$pieces = explode ("-",$pieces[0]);
	switch ($pieces[1]){
		case "01": $month = "Ene";break;
		case "02": $month = "Feb";break;
		case "03": $month = "Mar";break;
		case "04": $month = "Abr";break;
		case "05": $month = "May";break;
		case "06": $month = "Jun";break;
		case "07": $month = "Jul";break;
		case "08": $month = "Ago";break;
		case "09": $month = "Sep";break;
		case "10": $month = "oct";break;
		case "11": $month = "Nov";break;
		case "12": $month = "Dic";break;
	}
	$year = substr ($pieces[0],2,2);
	$date = "$pieces[2].$month.$year";
	if($withTime) $date.= " ".$timePieces[0].":".$timePieces[1];
	return $date;
}

function DBFormatDate($date){
	$pieces = explode ('/',$date);

	return $pieces[2].'-'.$pieces[1].'-'.$pieces[0];
}

function UserFormatDateFromDB($date){
	$pieces = explode ('-',$date);

	return $pieces[2].'/'.$pieces[1].'/'.$pieces[0];
}

function AgendaFormatDateTime ($date,$withTime = false){
	$pieces = explode (" ",$date);
	//$time = $pieces[1];
	$time = explode (":",$pieces[1]);
	$mydate = explode ("-",$pieces[0]);
	switch ($mydate[1]){
		case "01": $month = "Enero";break;
		case "02": $month = "Febrero";break;
		case "03": $month = "Marzo";break;
		case "04": $month = "Abril";break;
		case "05": $month = "Mayo";break;
		case "06": $month = "Junio";break;
		case "07": $month = "Julio";break;
		case "08": $month = "Agosto";break;
		case "09": $month = "Sept.";break;
		case "10": $month = "Octubre";break;
		case "11": $month = "Nov.";break;
		case "12": $month = "Dic.";break;
	}


	$year = substr ($mydate[0],2,2);
	$date = $mydate[2].' '.$month."<b>".AgendaGetDayOfWeek($mydate)."</b>";
	//if($withTime) $date.= "<span>".$time[0].":".$time[1]." hs</span>";
	return $date;
}

function AgendaGetDayOfWeek($mydate){
	$weekNumber = date("w",mktime(0, 0, 0, $mydate[1], $mydate[2], $mydate[0]));
	switch($weekNumber){
		case 0: return 'DOM.';break;
		case 1: return 'LUN.';break;
		case 2: return 'MAR.';break;
		case 3: return 'MIE.';break;
		case 4: return 'JUE.';break;
		case 5: return 'VIE.';break;
		case 6: return 'SAB.';break;
	}

}

function generateLinks($qryStg,$pagNum,$pages){
		$qry = array ();
		for ($i=0;$i<$pages;$i++){
			$aux = $i + 1;
			$qry[$i] = $qryStg."&page=".$aux;
		}
		return $qry;
}

function getYear($date){
	$pieces = explode ("-",$date);
	return $pieces[0];
}

function printr($valor){
	print "<pre>";
	print_r ($valor);
	print "</pre>";
}

function encrypt($password) {
	return crypt($password,'frooit'.$password.'frooit');
}

function fechaEstado($estado_id){
	$return ="-";
	if($estado_id) {
		switch  ($estado_id){
			case 1:$return = "Fecha Actual";break;
			case 2:$return = "Fecha Por Jugar";break;
			case 3:$return = "Fecha Jugada";break;
			case 4:$return = "Fecha Próxima";break;
		}
	}
	return $return;
}

function getFechaEstados (){
	$estados = array ("1" => "Fecha Actual",
					"2" => "Fecha Por Jugar",
					"3" => "Fecha Jugada",
					"4" => "Fecha Próxima"
	);
	return $estados;
}

function getvalue($name,$default=false,$nosession=false){
    if (isset($_POST[$name])) {
        return $_POST[$name];
    } elseif (isset($_GET[$name])) {
        return $_GET[$name];
    } elseif (isset($_SESSION[$name]) && (!($nosession))) {
        return $_SESSION[$name];
    } else {
        return $default;
    }
}

function validateuser($session,$db){
    $template=$GLOBALS['template'];
    $user=$session->getvalue('user');

    if ((!(is_a($user,'User'))) || (!($user->valid))){
        //$template->setvalue('error',$error);
        $template->setvalue('referer',$_SERVER['PHP_SELF']);
        $template->setvalue('request',base64_encode(serialize($_REQUEST)));
		$template->add("login.php");
        $template->show();
        exit;
    }
    $db->connect();
    $user->setdb($db);
    return $user;
}


function redirectto($url) {
    if (strstr($_SERVER["SERVER_SOFTWARE"],"Apache/2")) {
        if (substr($url,0,strlen('http'))!='http') {
            if (substr($url,0,strlen('/'))!='/') {
                $url='http://'.$_SERVER['SERVER_NAME'].getbaseurl($_SERVER['REQUEST_URI']).$url;
            } else {
                $url='http://'.$_SERVER['SERVER_NAME'].$url;
            }
        }
    } else {
        if (substr($url,0,strlen('http'))!='http') {
            if (substr($url,0,strlen('/'))!='/') {
                $url=getbaseurl($_SERVER['SCRIPT_URI']).$url;
            } else {
                $url='http://'.$_SERVER['SERVER_NAME'].$url;
            }
        }
    }
    header("Location: $url");
    print "<a href=$url>$url</a>";
    exit;
}

function getbaseurl($url) {
    return substr($url,0,strrpos($url,'/')).'/';
}

if(!function_exists('http_build_query')){
   function http_build_query($formdata, $numeric_prefix = ''){
       return _http_build_query($formdata,$numeric_prefix);
   }
   function _http_build_query($formdata, $numeric_prefix = '',$key_prefix=''){
       if($numeric_prefix != '' && !is_numeric($numeric_prefix)){
           $prefix=$numeric_prefix;
       } else {
           $prefix = '';
       }
       if(!is_array($formdata)) return '';
       $str='';
       foreach($formdata as $key => $val){
           if(is_numeric($key))$key=$prefix.$key;
           if($str != '') $str.='&';
           if($key_prefix != '') {
               $mykey = $key_prefix."[$key]";
           } else {
               $mykey=&$key;
           }
           if(is_array($val)){
               $str.=_http_build_query($val,'',$mykey);
           } else {
               $str.=$mykey.'='.urlencode($val);
           }
       }
       return $str;
   }
}

if (!(function_exists("file_get_contents"))) {
function file_get_contents($file) {
    if ($f=@fopen($file,"rb")) {
        while ($chunk=fread($f,1024))
            $return.=$chunk;
        fclose($f);
        return $return;
    } else {
        return "";
    }
}
}

function getids($arr, $id='id') {
    $result=array();
    if (is_array($arr)) {
        foreach ($arr as $ar) {
            array_push($result, $ar[$id]);
        }
    }
    return $result;
}

function getaction(){
	$action = getvalue(ACTION_FIELDNAME); //getvalue('task_action') ? getvalue('task_action') : getvalue('action');

	return $action;
}

function resizePic($prefix, $original_file, $dDir, $maxWidth, $maxHeight, $resizeFlag, $tempName){
	if (!file_exists($original_file)) {
		print ("File not found: $file...\n");
	}
	
	if ($tempName == '') { 
		$tempName = $prefix."_".mt_rand().".jpg"; 
	}
	
	//hard copy of picture
	$src_img = $original_file;

	//destination
	$dest = $dDir.$tempName;
	
	//get source dimentions
	$src_dims = getimagesize($src_img);
	
	//create appropriate temp image
	switch ($src_dims[2]) {
		case 1: //GIF
			$srcImage = imagecreatefromgif($src_img);
		break;
		
		case 2: //JPEG
			$srcImage = imagecreatefromjpeg($src_img);
		break;
		
		case 3: //PNG
			$srcImage = imagecreatefrompng($src_img);
		break;
		
		default:
			return false;
		break;
	}
	
	$srcRatio = $src_dims[0]/$src_dims[1]; // width/height ratio
	
	$destRatio = 1;
	
	if($maxHeight != 0)
		$destRatio = $maxWidth/$maxHeight;
	
	if ($destRatio > $srcRatio && $maxHeight != 0) 
	{
		$destSize[1] = $maxHeight;
		$destSize[0] = $maxHeight*$srcRatio;
	}
	else
	{
		$destSize[0] = $maxWidth;
		$destSize[1] = $maxWidth/$srcRatio;
	}
	
	//if set image dimensions are required:
	if ($resizeFlag == 1) 
	{
		$destSize[0] = $maxWidth;
		$destSize[1] = $maxHeight;
	}
	
	$thumb_w = $destSize[0];
	$thumb_h = $destSize[1];
	$dst_img = imagecreatetruecolor($thumb_w,$thumb_h);
	
	imagecopyresampled($dst_img,$srcImage,0,0,0,0,$thumb_w,$thumb_h,$src_dims[0],$src_dims[1]);
	
	switch ($src_dims[2]) 
	{
		case 1:
			$result = imagegif($dst_img, $dest);
		break;
		case 2:
			$result = imagejpeg($dst_img, $dest, 75); //75 denotes image quality / compression ratio
		break;		
		case 3:
			$result = imagepng($dst_img, $dest, 75); 
		break;
	}
	
	return $tempName;
}


function printGlobalVars(){
	echo "Global Vars:<br/>";
	echo "<pre>";
	print_r($GLOBALS);
	echo "</pre><br/>";
	
	return false;
}

/************************************/
/* Ordena por campo especifico */

function array_sort($array, $on, $order=SORT_ASC)
{
	$new_array = array();
	$sortable_array = array();

	if (count($array) > 0) {
		foreach ($array as $k => $v) {
			if (is_array($v)) {
				foreach ($v as $k2 => $v2) {
					if ($k2 == $on) {
						$sortable_array[$k] = $v2;
					}
				}
			} else {
				$sortable_array[$k] = $v;
			}
		}

		switch ($order) {
			case SORT_ASC:
				asort($sortable_array);
			break;
			case SORT_DESC:
				arsort($sortable_array);
			break;
		}

		foreach ($sortable_array as $k => $v) {
			$new_array[$k] = $array[$k];
		}
	}

	return $new_array;
}

/*******************************************************/
// Urls

function convertURL($string, $space="-") {

	$string = str_replace("á", "a", $string);
	$string = str_replace("é", "e", $string);
	$string = str_replace("í", "i", $string);
	$string = str_replace("ó", "o", $string);
	$string = str_replace("ú", "u", $string);
	$string = str_replace("ñ", "n", $string);

	$string = utf8_encode($string);
	if (function_exists('iconv')) {
		$string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
	}

	$string = preg_replace("/[^a-zA-Z0-9 \-]/", "", $string);
	$string = trim(preg_replace("/\\s+/", " ", $string));
	$string = strtolower($string);
	$string = str_replace(" ", $space, $string);

	return $string;
}

?>