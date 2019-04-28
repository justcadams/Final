<?php 
$currentDirectory = getcwd();
if($currentDirectory != '/users/j/a/jadams7/www-root/cs008/final') {
	chdir('/users/j/a/jadams7/www-root/cs008/final');
	include 'top.php';
}
else {
	include 'top.php';
}
?>
<article>
<h1>Campus Kitchen Deli</h1>
<h2>273 Colchester Avenue<br>Burlington, VT 05401<br>Phone: (802) 863-9105<br>kampuskitchendeli@gmail.com</h2>
</article>
<div id="googleMap" style="width: 100%;height: 500px"></div>
<script>
	function myMap(){
	var mapSize = {
		center:new google.maps.LatLng(44.483105,-73.190147),
		zoom:17,
	};
	var map = new
	google.maps.Map(document.getElementById("googleMap"),mapSize);
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBO0XvT7GDVmdD1KNtbVVz5ApbFvZF5EE4&callback=myMap"></script>  
<?php include 'footer.php';?>