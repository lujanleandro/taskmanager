<?
if(isset($page_title)&&!empty($page_title)){
	$page_title = $page_title;
}else{
	$page_title = "Antigüedades Roldan";
}
if(isset($page_metakeys)&&!empty($page_metakeys)){
	$page_metakeys = $page_metakeys;
}else{
	$page_metakeys = "Antigüedades, articulos antiguos, antigüedades san telmo, san telmo, antigüedades buenos aires";
}
if(isset($page_metadesc)&&!empty($page_metadesc)){
	$page_metadesc = $page_metadesc;
}else{
	$page_metadesc = "Antigüedades en San Telmo, Antigüedades en Buenos Aires. Compra y Venta. Consúltenos. Marfiles, Decoración.";
}
?>
<!DOCTYPE html>
<html>
	<head>
	<title><?=$page_title?></title>
	<meta charset="ISO-8859-1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="keywords" content="<?=$page_metakeys?>" />
	<meta name="description" content="<?=$page_metadesc?>" />
	<meta name="google-translate-customization" content="aed4ea521ab202fe-0c00d7e216c77448-g3ab59ff23f6abc5c-19"></meta>

	<!--[if lt IE 9]><script src="scritps/html5shiv.js"></script><![endif]-->
	
	<link rel="stylesheet" href="/styles/main.css" type="text/css" />

	<link rel="stylesheet" href="/Scripts/jquery/jquery-ui.css">
	<script type="text/javascript" src="/Scripts/jquery/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="/Scripts/jquery/jquery-ui.min.js"></script>

	<!-- icons -->
	<link rel="stylesheet" href="/styles/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/styles/fontello/css/fontello.css">
    <link rel="stylesheet" href="/styles/fontello/css/animation.css"><!--[if IE 7]><link rel="stylesheet" href="/styles/fontello/css/fontello-ie7.css"><![endif]-->


	<!-- dialog -->
	<!-- 
	<link rel="stylesheet" type="text/css" href="/Scripts/jquery/jquery.mobile-1.0.1.min.css" />
	<link rel="stylesheet" type="text/css" href="/Scripts/dialog/jquery.mobile.simpledialog.min.css" /> 
	<script type="text/javascript" src="/Scripts/jquery/jquery.mobile-1.4.3.min"></script>
	<script type="text/javascript" src="/Scripts/dialog/jquery.mobile.simpledialog.js"></script>
	 -->



	<script type="text/javascript">
	$(document).ready(function() {
		//hide input text
		//$(".form .input-name").val("Nombre");

		$(".form .input-name").on("focus", function(){
			$(".form .input-name").val("");
		});

		$(".form .inputBtn").on("click", function(event){
			$(".form .input-name").val("");
		});
	});
	</script>

	<!-- Slide carrusel de varios objetos -->
	<script type="text/javascript" src="/Scripts/jcarousellite_1.0.1.min.js"></script>
	<script>
		$(function() {
			$(".carousel").jCarouselLite({
				auto: 2000,
				speed: 2000,
				btnNext: ".next",
				btnPrev: ".prev"
			});
		});
		$(function() {
			$(".carousel-rel").jCarouselLite({
				visible: 4,
				speed: 2000,
				mouseWheel:true,
				btnNext: ".next",
				btnPrev: ".prev"
			});
		});
	</script>
	
	<!-- Menu Mobile -->
    <script type="text/javascript">
    $(function() {
		$('#navBar ul li a.menu').click(function() {
			 $('aside.categories').toggle("slow", function() {
			// Animation complete.
			});
		});
    });
    </script>

<!--

	<script type="text/javascript" src="/scritps/validation.js"></script>
	<script type="text/javascript" src="/scritps/popup.js"></script>
	<script type="text/javascript" src="/scritps/ajax.js"></script>
	<script type="text/javascript" src="/scritps/ajax-scripts.js"></script>

	<script type="text/javascript" src="/scritps/jquery/core/jquery.js"></script>
	<script type="text/javascript" src="/scritps/jquery/ui/ui.core.js"></script>
	<script type="text/javascript" src="/scritps/easyslider/js/easySlider1.7.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				auto: true,
				continuous: true,
				controlsShow: false,
				speed: 1200,
				pause: 4000
			});
		});	
	</script>

	
	<script type="text/javascript" src="/js/jquery/ui/jquery-easing.1.2.pack.js" ></script>
	<script type="text/javascript" src="/js/jquery/ui/jquery-easing-compatibility.1.2.pack.js" ></script>
	<script type="text/javascript" src="js/jquery/lightbox/js/jquery.lightbox-0.5.js"></script>
    <link rel="stylesheet" type="text/css" href="/js/jquery/lightbox/css/jquery.lightbox-0.5.css" media="screen" />

    <script type="text/javascript">
    $(function() {
			$('.galery a').lightBox({
				maxHeight: 500,
				maxWidth: 700
		});
    });
    </script>
-->

 </head>