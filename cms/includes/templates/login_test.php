<html>
	<head>
		<title>ABM</title>
		<link rel=stylesheet HREF="<?=$GLOBALS['conf']['localbase']?>style.css" TYPE="text/css">
		<script>
		function setfocus() {
		    if (document.login.username.value) {
		        document.login.password.focus();
		    } else {
		        document.login.username.focus();
		    }
		}
		</script>
	</head>

<body onLoad="javascript:setfocus();">
<form name=login action=<?=$GLOBALS['conf']['localbase']?>login_test.php method=post>
<table>

<?
	if ($values['error']) 
	{
?>
	<tr><td colspan=2><font color=red><?=$values['error']?></font></td></tr>
<? 
	}//endif
?>

<tr>
<td>User name:</td><td><input type=text name=username value="<?=$values['username']?>"></td>
</tr><tr>
<td>Password:</td><td><input type=password name=password></td>
</tr><tr>
<td colspan=2><input type=submit name=submit value=Ok></td>
</tr></table>
<?php if ($values['referer']) { ?>
<input type="hidden" name=referer value="<?=$values['referer']?>">
<?php } ?>
<?php if ($values['request']) { ?>
<input type="hidden" name=request value="<?=$values['request']?>">
<?php } ?>
</form>
</body>
</html>