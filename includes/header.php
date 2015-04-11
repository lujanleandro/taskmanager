<?
	$mgr = new TagManager($conf['sql']);
	$tagDatalist = $mgr->getAll();
?>
		<!-- Compartir Button -->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.0";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>	
		
		<!-- Traductor Google -->
		<script type="text/javascript">
			function googleTranslateElementInit() {
				new google.translate.TranslateElement({pageLanguage: 'es', includedLanguages: 'de,en,fr,it,pt,zh-CN', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, multilanguagePage: true, gaTrack: true, gaId: 'UA-51448104-1'}, 'google_translate_element');
			}
		</script>
		<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			$('#google_translate_element').bind('DOMNodeInserted', function(event) {
				$('.goog-te-menu-value span:first').html('<i class="icon-flag-circled"></i>');
				$('.goog-te-menu-value span:nth-child(3)').hide();
				$('.goog-te-menu-value span:last').hide();
			});
		})
		</script>
	<div class="header-wrapper">
		<header class="header-secction">

			<section class="logo">
				<a class="logolink" href="/index.php">&nbsp;</a>
			</section>
			
			<nav id="navBar">
				<ul>
					<li><a href="#" class="menu" title="Menu"><i class="fa fa-bars"></i></a></li>
					<li><a href="/index.php" class="inicio" title="Inicio"><i class="fa fa-home"></i><b>Inicio</b></a></li>
					<li><a href="/blog/" target="new" class="blog" title="Blog"><i class="fa fa-file-text"></i><b>Blog</b></a></li>
					<li><a href="/categorias/" class="categorias" title="Categorias"><i class="fa fa-folder-open"></i><b>Categor&iacute;as</b></a></li>
					<li><a href="/contactenos/" class="contacto" title="Contacto"><i class="fa fa-envelope"></i><b>Cont&aacute;ctenos</b></a></li>
					<!--<li class="last"><a href="#" class="subastas">Subastas</a></li>-->
				</ul>
			</nav>

			<section class="social">
				<ul>
					<li><a title="facebook" target="_blank" href="https://www.facebook.com/antiguedades.roldan"><i class="icon-facebook-circled"></i></a></li>
					<li><a title="pinterest" target="_blank" href="http://www.pinterest.com/antiquesroldan"><i class="icon-pinterest-circled"></i></a></li>
					<li><div id="google_translate_element"></div></li>
				</ul>
			</section>

			<section class="search">
				<form action="/busqueda.php">
					<input type="hidden" name="postForm" value="1" />
					<label>
					<input type="search" name="tag" placeholder="Buscar" list="tags">
					<? if(is_array($tagDatalist)){ ?>
						<datalist id="tags">
						<?	foreach($tagDatalist as $key=>$item){ ?>
							 <option value="<?=$item['tag_name']?>" label="<?=$item['tag_name'];?>">
						<? } //foreach ?>
						</datalist>
					<? } ?>
					<!--
					<datalist id="tags">
					  <option value="http://www.ayudaenlaweb.com" label="Ayuda en la Web">
					  <option value="Ceramicas">
					  <option value="Muebles">
					  <option value="Pinturas">
					  <option value="Escultura">
					</datalist>
					-->
					<button type="submit"><i class="fa fa-search"></i></button>
					</label>
				</form>
			</section>
		
		</header> <!-- <div id="header"> -->
	</div>