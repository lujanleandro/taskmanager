<? 
	$db = new System_Db($conf['sql']);
		
	$transaction = new Transaction($conf['sql']);
	$category = new Category($db);
	$provincia = new ProvinciaManager($conf['sql']);
	$ciudad = new CiudadManager($conf['sql']);
	$partido = new PartidoManager($conf['sql']);
	
	$transactionList = $transaction->getAll();
	$categoryList = $category->getAll();
	$provinciaList = $provincia->getAll();
	$ciudadList = $ciudad->getAll();
	$partidoList = $partido->getAll();	
?>
		<div class="banner-slide">
			<a href="/banner-capilla.php">
				<img alt="" src="images/content/banner-capilla-side.jpg" />
			</a>
		</div>

		<div id="sideBar">
			<img alt="" src="images/bkg/side_top.gif" />
				<div class="content">
					<h1>B&uacute;squeda <i>R&aacute;pida</i></h1>
					<form action="/resultados.php" method="post" >
						<ul class="search">
							<li><p><b>Tipo de Propiedad:</b></p><select name="cat" ><option value="0">[ Todas ]</option>
							<? foreach($categoryList as $data){ ?>
								<option value="<?=$data['category_id']?>" <?=($data['category_id'] == $category_id)?"selected=\"selected\"":"";?> ><?=$data['category_name']?></option>
							<? } ?>
							</select></li>
							<li><p><b>Operaci&oacute;n:</b></p><select name="tran"><option value="0">[ Todas ]</option>
							<? foreach($transactionList as $data){ ?>
								<option value="<?=$data['transaction_id']?>" <?=($data['transaction_id'] == $transaction_id)?"selected=\"selected\"":"";?> ><?=$data['transaction_name']?></option>
							<? } ?>							
							</select></li>
							<li><p><b>Provincia:</b></p>
								<select name="provincia_id" onchange="getPartidos(this.value);" onfocus="getPartidos(this.value);" >
									<option value="0">[ Todas ]</option>
									<? foreach($provinciaList as $data){ ?>
										<option value="<?=$data['provincia_id']?>" <?=($data['provincia_id'] == $location['provincia_id'])?"selected=\"selected\"":"";?> ><?=$data['provincia_name']?></option>
									<? } ?>
								</select>
							</li>
							<li>
								<p><b>Partido:</b></p>
								<div id="partidos">
								<select>
									<option value="0">[ Todas ]</option>			
								</select>
							</div>
							</li>
							<li>
								<p><b>Ciudad/Localidad:</b></p>
								<div id="ciudades">
								<select>
									<option value="0">[ Todos ]</option>						
								</select>
								</div>
							</li>
							<li><p><b>Precio:</b></p></li>
							<li><label>Desde:U$S </label><input name="priceStart" title="text" style="width:33px;" value="<?=$priceStart?>" />
								<label>Hasta:U$S </label><input name="priceEnd" title="text" style="width:33px;" value="<?=$priceEnd?>" /></li>
							<li class="alignBtn"><input type="submit" value="BUSCAR" class="inputBtn" /></li>
					</form>
				</div>
			<img alt="" src="images/bkg/side_foot.gif" />
		</div>