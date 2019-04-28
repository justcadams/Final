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

<?php include 'footer.php';?>