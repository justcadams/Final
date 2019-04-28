<?php 
$currentDirectory = getcwd();
if($currentDirectory != '/users/j/a/jadams7/www-root/cs008/final') {
	chdir('/users/j/a/jadams7/www-root/cs008/final');
	require 'top.php';
}
else {
	require 'top.php';
}
?>
<article>Some content!</article>
<?php require 'footer.php';?>