<?php include ("includes/htmlHead.php"); ?>
<?php 
$headerTitle = $GLOBALS['conf']['client_name'];
if(isset($mod_conf['title_edit']) && !empty($mod_conf['title_edit']) && ($_REQUEST['task']=='edit')){
	$headerTitle = $mod_conf['title_edit'];
}
if(isset($mod_conf['title_add']) && !empty($mod_conf['title_add']) && ($_REQUEST['task']=='create')){
	$headerTitle = $mod_conf['title_add'];
}
?>
<? $module = (isset($_REQUEST["module"]))?$_REQUEST["module"]:"product"; ?>
<body>
	<div id="siteWrapper">
		<div id="header">
			<div class="navegacionA">
				<div id="tabs1">
					<ul class="left">
						<!--<li><a href="" title="menu"><span><i class="fa fa-bars"></i></span></a></li>-->
						<li><a href="index.php"><span><?=$headerTitle?></span></a></li>
					</ul>
					<ul class="right">
						<!--<li><a href=""><span><i class="fa fa-search"></i></span></a></li>-->
						<li><a class="<?=($_REQUEST['module']=='product')?'activo':'inactivo';?>" href="?module=product&amp;<?=ACTION_FIELDNAME;?>=list" title="Listado de Tareas"><span><i class="fa fa-tasks"></i></span></a></li>
						<li><a class="<?=($_REQUEST['module']=='category')?'activo':'inactivo';?>" href="?module=category&amp;<?=ACTION_FIELDNAME;?>=list" title="Clientes / Proyectos"><span><i class="fa fa-briefcase"></i></span></a></li>
						<li><a class="<?=($_REQUEST['module']=='tag')?'activo':'inactivo';?>" href="?module=tag&amp;<?=ACTION_FIELDNAME;?>=list" title="Categorias/Carpetas"><span><i class="fa fa-folder-open"></i></span></a></li>
						<li><a class="<?=($_REQUEST['module']=='user')?'activo':'inactivo';?>" href="?module=user&amp;<?=ACTION_FIELDNAME;?>=list" title="Perfil de Usuario"><span><i class="fa fa-user"></i></span></a></li>
						<li><a class="inactivo" href="login.php" title="Salir"><span><i class="fa fa-sign-in"></i></span></a></li>							
					</ul>
				</div>
			</div>
			<div class="navegacionC">
				<ul>
					<li><a href="?module=<?=$module?>&amp;<?=ACTION_FIELDNAME;?>=list"><i class="fa fa-list-ol"></i>Listado</a></li>
					<li><a href="?module=<?=$module?>&amp;<?=ACTION_FIELDNAME;?>=create"><i class="fa fa-file"></i>Nuevo</a></li>
				</ul>
			</div>
		</div>

		<div id="main-content">