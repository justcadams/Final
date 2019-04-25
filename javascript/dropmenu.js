function drowDownMenu() {
	var x = document.getElementById("nav");
	if (x.className.indexOf("show") == -1) { 
		x.className += "show";
	} else {
		x.className = x.className.replace("show", "");
	}
}