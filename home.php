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
	<h1>Welcome to Campus Kitchen and Aviation Deli!</h1>
	<figure class="coverpic">
            <img class="coverimg" src="images/KKStorefront.jpg" alt="Campus Kitchen Storefront">
                <figcaption>Campus Kitchen Storefront</figcaption>
            </figure>

</article>
<?php include 'footer.php';?>