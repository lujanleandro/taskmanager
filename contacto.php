<? include('includes/config.inc'); ?>
<? include("includes/headhtml.php"); ?> 			
<!-- **** END HTML **** -->
	<?
	//Mail process

	$db = new System_Db($conf['sql']);
	$mgr = new ProductsManager($conf['sql']);
	$list = $mgr->lists();
	$tags = new TagManager($conf['sql']);
	$tagList = $tags->getAll();

	$actionPost = Trim($_REQUEST['postForm']);
	if (!empty($actionPost)){ 

		//Posts
		$name		= Trim($_REQUEST['name']);
		$email		= Trim($_REQUEST['email']);
		$phono		= Trim($_REQUEST['phono']);
		$comment	= Trim($_REQUEST['comment']);
		
		//$mailto		= "lujan.leandro@gmail.com";
		$mailto		= "info@antiguedadesroldan.com";
		$from		= "Consulta <".$mailto.">";
		$subject	= "Consulta enviada por antiguedadesroldan.com.ar";
		$reply		= "From:".$from."\nReply-To:".$from."\nMIME-Version: 1.0\nContent-type: text/html; charset=iso-8859-1\n";

		$content = '<html><head><title>Contacto enviado desde la web antiguedadesroldan.com.ar</title></head>';
		$content.= '<body><h2>Se enviaron los siguientes datos:</h2>';
		$content.= '<p><b>Nombre: </b>'.$name.'</p>';
		$content.= '<p><b>Correo electrónico: </b>'.$email.'</p>';
		$content.= '<p><b>Teléfono: </b>'.$phono.'</p>';
		$content.= '<p><b>Consulta: </b>'.$comment.'</p>';

		if(isset($_REQUEST['productLink'])&&!empty($_REQUEST['productLink'])){
			$productLink = "http://antiguedadesroldan.com.ar".Trim($_REQUEST['productLink']);
			$content.= '<p><b>Link al Producto </b><a href="'.$productLink.'">'.$productLink.'</a></p>';
		}

		$content.= '</body></html>';

		if (mail($mailto, $subject,$content, $reply)){
			$returnMessage = "<p>Muchas Gracias. ".$name."<br /> Se realizó el envió correctamente.</p>";
		}else{
			$returnMessage = "<p>Error en el envío, por favor intente nuevamente.</p>";
		}
	}
	?>
 <body>
	<?php include_once("includes/analytics.php") ?>
	<? include("includes/header.php"); ?>
	<div id="wrapper">
		<div id="content">
			<? include("includes/aside.php"); ?>
			<section class="indexMain contact" itemscope itemtype="http://schema.org/LocalBusiness">
				<section class="form">
					<? if (empty($returnMessage)){ ?>
						<h3>Realice su consulta:</h3>
						<p>Responderemos a la brevedad.</p>
						<form id="formID" name="form2" method="post" action="/contactenos/">
						<input type="hidden" name="postForm" value="1" />
						<ul>
							<li><input type="text" name="name" class="input-name" value="Nombre" /></li>
							<li><input type="text" name="email" class="input-email" value="Email" /></li>
							<li><input type="text" name="phono" class="input-phono" value="Telefono" /></li>
							<li><textarea id="textareaID" name="comment" class="input-consulta" rows="7" cols="17">Consulta</textarea></li>
							<li><input type="submit" id="btnID" value="Ingresar" class="inputBtn" /></li>
						</ul>
						</form>
					<?}else{?>
						<h3>Consulta:</h3>
						<p><?=$returnMessage?></p>
					<?}?>
				</section>
				<header>
					<a class="volver" href="/"><i class="fa fa-angle-double-left"></i> Volver</a>
					<h2>Cont&aacute;ctenos - <span itemprop="name">Antiguedades Roldan</span></h2>
				</header>
				<article itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
				  <p><b>Tel&eacute;fono:</b><br/><span itemprop="telephone">(5411) 4300-0760 / 4300-9359 / 3750-7639</span></p>
				  <p><b>E-mail:</b><br/>info@antiguedadesroldan.com</p>
				<figure class="gmap">
					<iframe width="175" height="160" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com.ar/maps?hl=es&amp;q=Defensa+1025+capital+federal&amp;ie=UTF8&amp;hq=&amp;hnear=Defensa+1025,+San+Telmo,+Ciudad+Aut%C3%B3noma+de+Buenos+Aires&amp;gl=ar&amp;ll=-34.619738,-58.371525&amp;spn=0.011178,0.026157&amp;t=m&amp;z=14&amp;output=embed"></iframe>
				</figure>
				  <p><b>Nuestro Local:</b><br/><span class="notranslate" itemprop="streetAddress">Defensa 1025 (CP 1065)</span>, <span class="notranslate" itemprop="addressLocality">San Telmo, Buenos Aires</span>, <span itemprop="addressRegion">AR</span>.</p>
				  <p><b>Horarios de Atención:</b><br/>Lunes a Domingos, de 10 a 20hs.</p>
				</article>
			</section>
			<div class="clear"></div>
			<? include("includes/supertags.php"); ?>
		</div>
	</div>
	<? include("includes/footer.php"); ?> 			
	</div> <!-- <div id="wrapper"> -->
 </body>
</html>