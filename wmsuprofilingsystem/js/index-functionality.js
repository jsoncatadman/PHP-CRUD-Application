function myFunction() {
	var x = document.getElementById("sidebar-container");
	if (x.style.display === "none") {
		x.style.display = "block";
	}
	else {
		x.style.display = "none";
	}
}

window.onresize = () => {
	location.reload();
}