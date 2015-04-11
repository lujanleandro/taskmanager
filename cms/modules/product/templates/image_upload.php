<?php
	function uploadGetFilename($file_id, $filename){
		if( ($filename != null ) && ($filename != '' )){
			return "file_" . $file_id . '.' . $filename;
		}
		return '';
	}
?>
<li class="floatFix">
	<p>&nbsp;&nbsp;Para cargar fotos, apretar en elegir fotos y seleccionar todas las fotos a cargar.<br></p>
	<p>&nbsp;&nbsp;Luego espere que muestre el mensaje de carga correcta para guardar la propiedad.<br><br></p>
</li>
<li>
	<h2>Imagenes:</h2>
	<div class="content">
		<input type="file" id="images" name="images[]" multiple/>
	</div>
</li>
<li class="floatFix imagenContent">
	<h2>&nbsp;</h2>
	<div class="content">
		<ul id="lista-imagenes">
		    
		</ul>
		<div id="response"></div>
	</div>
	<script src="modules/product/javascript/upload.js"></script>
</li>
<?php foreach($values['item']['images'] as $key=>$imageItem){ ?>
<li class="floatFix imagenContent">
	<h2>Imagen <?=$imageItem['image_order'];?>:</h2>
	<?php
		$file_img_name = uploadGetFilename($imageItem['file_id'], $imageItem['file_name']);
		$file_path = $conf['admin_folder'] . $conf['uploaded_files_path'] . $file_img_name;
	?>
	<a href="<?=$file_path;?>" target="_blank"><img src="<?=$file_path;?>" alt=""/></a>
	<input type="hidden" name="filesUploaded[]" value="<?=$file_img_name;?>" />
</li>
<? } ?>