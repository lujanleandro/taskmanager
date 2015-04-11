	/*
	Function Edit Event
	*/
	function editEvent(id)
	{
		var ajax = new AjaxFactory();
		var url = "index.php?action=editevent&id=" + id;
		ajax.open ("GET", url, true);
		ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;charset:iso-8859-1');

		ajax.onreadystatechange = function ()
		{
			if (ajax.readyState == 4)
			{
				displayEditBox(ajax.responseText);
			}
			else
			{
				loadingEvent();
			}
		}

		ajax.send(null);
	}


	function ajaxAddEvent(titulo,fecha,precio,descripcion,tags,agenda,lugar,foto,fotohome,genero)
	{
		var ajax	= new AjaxFactory();
		var url		= "index.php?action=" + ADD_TO_CART + "&article_id=" + article_id + "&amount=" + amount;
		ajax.open ("GET", url, true);
		ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;charset:iso-8859-1');
		ajax.onreadystatechange = function ()
		{
				if (ajax.readyState == 4)
				{
					if (ajax.responseText != "" )
					{

						document.getElementById("carrito").style.display = "block";
						document.getElementById("precio").innerHTML = '$'+ajax.responseText;
						hideLoading();
					}
					else
						alert("Error sending information. Please Try again.");
				}
				else
				{
					loading();
				}
		}
		ajax.send(null);
	}

	function loadingEvent(){

	}

	function displayEditBox(text){
		var newDiv = document.createElement ('div');
		newDiv.innerHTML = text;
		var newAtt = document.createAttribute("id");
		newAtt.nodeValue = "editBox";
		newDiv.setAttributeNode(newAtt);
  		var body = document.getElementsByTagName("body");
  		document.appendChild(newDiv);
  		alert(document.getElementById("editBox").innerHTML);
	}