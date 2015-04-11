function displayTab(id)
{
	document.getElementById("tab1").className = "";
	document.getElementById("tab2").className = "";
	document.getElementById("tab" + id).className = "on";

	document.getElementById("contentTab1").style.display = "none";
	document.getElementById("contentTab2").style.display = "none";
	document.getElementById("contentTab" + id).style.display = "block";

	document.getElementById("contentTab1").style.visibility = "hidden";
	document.getElementById("contentTab2").style.visibility = "hidden";
	document.getElementById("contentTab" + id).style.visibility = "visible";

}