<? include ("includes/htmlHead.php"); ?>
	<body onload="document.getElementById('usernamefield').focus();" >

		<div id="siteWrapper">

			<div id="main-content">
				<form name="login" action="login.php" method="post" >
				<?if ($values['error']) {?>
					<div style="color:#ff0000"><?=$values['error']?></div>
				<? }//endif ?>

				<ul class="loginForm">
					<div id="header">
						<span class="logo">
						<u>f</u><s>it </s><u> <?=$conf['client_name']?></u>
					</span>
					</div>
					<li class="floatFix">
						<h2>Usuario:</h2>
						<input type="text" name="username" id="usernamefield" value="<?=$values['username']?>">
					</li>
					<li class="floatFix">
						<h2>Contraseña:</h2><input type=password name=password>
					</li>
					<li class="floatFix">
						<h2>&nbsp;</h2>
						<input type="submit" name="submit" value="login"  class="button" />
					</li>
				</ul>

				<?php if ($values['referer']) { ?>
					<input type="hidden" name=referer value="<?=$values['referer']?>">
				<?php } ?>
				<?php if ($values['request']) { ?>
					<input type="hidden" name=request value="<?=$values['request']?>">
				<?php } ?>
				</form>

			<div id="footer" style="width:300px;margin:auto;margin-top:5px;">Desarrollado por <a href="http://www.frooit.com/" target="_new" >frooit.com</a></div>
			</div><!-- End main-content -->


		</div><!-- End siteWrapper -->
	</body>
</html>