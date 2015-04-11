<?
header("Content-Type: text/html; charset=ISO-8859-1");
// Include Classes
require($_SERVER['DOCUMENT_ROOT'].'/includes/config.inc');
// Instance DB
$db = new System_Db($conf['sql']);

// Functions

switch($_REQUEST['action'])
{
	case 'getpartidos':
		$partidoMgr = new PartidoManager($conf['sql']);
		$return = '<select id="partido_id" name="partido_id" onchange="getCiudades(this.value);" onfocus="getCiudades(this.value);">';
		$return .= '<option value="0">[ Seleccione ]</option>';
		$partidoResult = $partidoMgr->getPartidoFromProvincia($_REQUEST['provincia_id']);
		foreach($partidoResult as $partido){
			$return .= '<option value="'.$partido["partido_id"].'">'.$partido["partido_name"].'</option>';
		}
		$return .= '</select>';
		
		print $return;
	break;
	case 'getciudades':
		$ciudadMgr = new CiudadManager($conf['sql']);
		$return = '<select id="ciudad_id" name="ciudad" >';
		$return .= '<option value="0">[ Seleccione ]</option>';
		$ciudadResult = $ciudadMgr->getCiudadFromPartido($_REQUEST['partido_id']);
		foreach($ciudadResult as $ciudad){
			$return .= '<option value="'.$ciudad["ciudad_id"].'">'.$ciudad["ciudad_name"].'</option>';
		}
		$return .= '</select>';
		print $return;
	break;
}
?>