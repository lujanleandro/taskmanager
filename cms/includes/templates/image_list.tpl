<? include ("{$_SERVER['DOCUMENT_ROOT']}/admin/includes/includesTop.php"); ?>
<? include("{$_SERVER['DOCUMENT_ROOT']}/admin/conf/conf.php");?>
	<h2>Imagenes</h2>

				

	<div class="floatFix">
		<div style="float:left;width:200px;padding-left:10px;" ><a href="imagenes.php?action=<?=CREAR_IMAGEN?><? if($values['categoria']) print "&categoria=".$values['categoria']; ?>" ><img src="images/add.png"  border="0" alt="" /> Agregar Imagen </a></div>
		<div style="float:right;width:300px;text-align:right;">
			Categoria: 
			<select name="categoria" onchange="document.location='imagenes.php?categoria='+this.value;">
				<option value="">Todas</option>
				<? if($values['categorias']) { foreach($values['categorias'] as $categoria) {?>
				<option value="<?=$categoria['id']?>" <? if($categoria['id'] == $values['categoria']) print "selected";?> ><?=$categoria['titulo']?></option>
				<? }}?>
				
			</select>
		</div>
	</div>

	<ul class="listado">
		<? if($values['listado']) { ?>
			<li class="floatFix header">
				<div class="fecha"  style="width:50px;">Orden</div>
				<div class="fecha">Fecha</div>
				
				<h2 style="width:300px">Titulo</h2>
			</li>
			<? foreach($values['listado'] as $item) { ?>
				<li class="floatFix" >
					<div style="width:50px;float:left;"><?=$item['orden']?> </div>
					<div class="fecha"> <a href="imagenes.php?action=<?=EDITAR_IMAGEN?>&id=<?=$item['id']?>"><img src="<?=$conf["categorias"][$item['categoria_id']]["path"].$item['archivo']?>" width="100" border="0"/></a></div>
					<h2 style="width:300px"> <a href="imagenes.php?action=<?=EDITAR_IMAGEN?>&id=<?=$item['id']?>"><?=$item['titulo']?></a></h2>
					<div class="fecha"><?=$item['categoria']?></div>
					<div class="fecha">
						<a href="javascript:void(0);" onclick="window.location='imagenes.php?action=<?=BORRAR_IMAGEN_OK?>&id=<?=$item['id']?>';" ><img src="images/delete.png"  border="0" alt="borrar" /> Borrar</a>
					</div>
						
				</li>
			<? } ?>
		<? } ?>
	</ul>
	<a href="imagenes.php?action=<?=CREAR_IMAGEN?>" >Agregar Imagen <img src="images/add.png"  border="0" alt="" /></a>



<? include ("{$_SERVER['DOCUMENT_ROOT']}/admin/includes/includesBottom.php"); ?>