function AjaxFactory()
{
	var xmlhttplocal;
	try
	{
		xmlhttplocal = new ActiveXObject ("Msxml2.XMLHTTP")
	}
	catch (e)
	{
		try
		{
			xmlhttplocal = new ActiveXObject ("Microsoft.XMLHTTP")
		}
		catch (E)
		{
			xmlhttplocal = false;
		}
  	}

	if (!xmlhttplocal && typeof XMLHttpRequest != 'undefined')
	{
		try
		{
			xmlhttplocal = new XMLHttpRequest ();
		}
		catch (e)
		{
	  		xmlhttplocal = false;
			alert ('couldn\'t create xmlhttp object');
		}
	}
	return (xmlhttplocal);
}