<? include ("includes/htmlHead.php"); 
if (!isset($values['username'])){
	$values['username'] = "";
}
if (!isset($values['error'])){
	$values['error'] = "";
}
if (!isset($values['referer'])){
	$values['referer'] = "";
}
if (!isset($values['request'])){
	$values['request'] = "";
}
?>
	<body onload="document.getElementById('usernamefield').focus();" >

		<div id="siteWrapper">

			<div id="main-content">
				<form name="login" action="login.php" method="post" >
				<?if ($values['error']) {?>
					<div style="color:#ff0000"><?=$values['error']?></div>
				<? }//endif ?>

				<div id="header">
					<span class="logo">
					<s><?=$GLOBALS['conf']['client_name']?></s>
					</span>
				</div>

				<ul class="loginForm">
					<li>
						<h2>Usuario:</h2>
						<input type="text" name="username" id="usernamefield" value="<?=$values['username']?>">
					</li>
					<li>
						<h2>Contraseña:</h2><input type="password" name="password">
					</li>
					<li>
						<button type="submit" name="enter" class="btn btn-primary button"><i class="fa fa-check-circle"></i> Entrar</button>
					</li>
				</ul>

				<?php if ($values['referer']) { ?>
					<input type="hidden" name=referer value="<?=$values['referer']?>">
				<?php } ?>
				<?php if ($values['request']) { ?>
					<input type="hidden" name=request value="<?=$values['request']?>">
				<?php } ?>
				</form>

			<? include ("includes/includesBottom.php"); ?>
			</div><!-- End main-content -->


		</div><!-- End siteWrapper -->
	</body>
</html>