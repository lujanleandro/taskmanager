<?
require_once(dirname(__FILE__).'/config/base.php');
$template = new Templates($conf['templatesdir']);

if ($username=getvalue('username')){

	$db = New System_Db($conf['sql']);

    if ($db->error){
        $template->setvalue('error','SQL Error');
		$template->setvalue('data',$db);
        $template->add('error.php');
        $template->show();
        exit;
    }

    $user=New User();
    $user->setdb($db);
	
	$username = "'".getvalue('username')."'";
	$password = "'".getvalue('password')."'";

	$cleartext = true;

    $user->getadmin($username,$password,$cleartext);

    if (!($user->valid)){
		//si el usuario no es valido
        $template->setvalue('error', 'The username is not valid or is not logged in');
        $template->setvalue('referer',getvalue('referer'));
        $template->setvalue('request',getvalue('request'));
        $template->setvalue('username',$username);
        $template->add('login.php');
    }else{
		//si el usuario es valido
        $session->setvalue('user',$user);
		setcookie("ALICE_ADMIN", $user->uniq_id,time()+(3600*24)); //SETEA LA COOKIE POR 1 dia
	    if (getvalue('referer')){
			// si vengo de una pagina interna redirecciono a esa página
			$qs = (getvalue('request'))?"?".http_build_query(unserialize(base64_decode(getvalue('request')))):"";
           	redirectto(getvalue('referer').$qs); //REDIRECCIONA A LA PAGINA YA LOGUEADO
       	}else{
			redirectto('index.php');
		}
	}
}else{
	$template->add('login.php');
}
$template->show();