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
<h1>Kampus Kitche Deli</h1>
<h2>273 Colchester Avenue<br>BUrlington, VT 05401<br>Phone: (802) 863-9105<br>kampuskitchendeli@gmail.com</h2>
</article>
<?php include 'footer.php';?>