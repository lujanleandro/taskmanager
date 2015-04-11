<?php

require("config/base.php"); // Importar globales
$db = new System_Db($conf['sql']); // Ejecuto la DB
$user = validateuser($session,$db); // Valido usuario
if(getaction()){
	include(SYSTEM_BASE."/modules/".getvalue('module')."/index.php");
}else{
	include(SYSTEM_BASE."/modules/product/index.php");
}

?>