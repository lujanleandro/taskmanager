function deleteItem(moduleName,id){
	ok = confirm("Esta seguro que quiere borrar este elemento?");
	if(ok == true && moduleName !='' && id != '')
	{
		document.location = "index.php?task=delete&module=" + moduleName +  "&id=" + id  ;
	}
}