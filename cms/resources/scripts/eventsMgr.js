	/*
	Function Edit Event
	*/
	function editEvent(id)
	{
		window.location.href = "index.php?module=events&action=edit&id="+id;
	}

	function deleteEvent(id)
	{
		var resp = confirm("Esta apunto de borrar un evento de la agenda.\n Realmente desea borrarlo?");
		if(resp){
			documen.location.href = "index.php?module=events&action=delete&id="+id;
			return true;
		}
	}
	function createEvent()
	{
		window.location.href = "index.php?module=events&action=create";
	}
	function listEvent()
	{
		window.location.href = "index.php?module=events";
	}

	function submitBack(){
		document.getElementById('back_submit').value = 1;
		document.forms[0].submit();
	}