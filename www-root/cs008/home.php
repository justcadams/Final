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
<figure class="logo shadow float right">
    <img alt="Deli Duo" src="images/campus-kitchen.jpg" class="logo">
	<figcaption class="center">Campus Kitchen serves fresh food with a smile. Swing by for our daily specials. We update our menu weekly, and serve McKenzie meats, cheeses, and fresh deli produce. Visit Campus Kitchen on campus today to enjoy Vermont's best locally sourced products.</figcaption>
</figure>
<?php include 'footer.php';?>