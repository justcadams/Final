<?php
// Update cookies and temp files every time the page is loaded.
ob_start();
session_start();
// Retrieves the current html document object model from the server.
$phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");
// Obtains the path, filename, and extension of the current file
$path_parts = pathinfo($phpSelf);
// Storing the file path for later use.
$filePath = $path_parts['dirname'];
// Storing the file name for later use.
$fileName = $path_parts['filename'];
// Parsing the parent folder from the file path.
$parentFolder = substr($filePath, 7, 5);

// Append the file name to the html element with obj prepended to make a background.
print '<!DOCTYPE html>' . PHP_EOL . '<html lang="en" id="obj' . $fileName . '">' . PHP_EOL;

// Include the standard header file containing information about the website and css link.
include 'head.php';
print PHP_EOL;

// Set working directory to a known location, which is the root directory.
chdir('/users/e/k/ekloeti/www-root/cs008/final');

// Javascript dependencies go here.

// Navigation and security dependencies go here.
if(($parentFolder == 'final') && ($fileName == 'order')) {

	$debug = false;

	// This if statement allows us to see what the varitables are in a classroom setting

	if(isset($_GET["debug"])) {
		$debug = true;
	}

	// PATH SETUP

	$domain = '//';

	$server = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, 'UTF-8');

	$domain .= $server;

	if ($debug) {
		print '<p>php Self: ' . $phpSelf;
		print '<p>domain: ' . $domain;
		print '<p>Path Parts<pre>';
		print_r($path_parts);
		print '</pre></p>';
	}




//########################################### Include all libraries ###########################################//


	print PHP_EOL . '<!--########################################## Include all libraries ##########################################-->' . PHP_EOL;

	require_once 'lib/security.php';

	include_once 'lib/validation-functions.php';

	include_once 'lib/mail-message.php';

	print '<link rel="stylesheet" href="css/custom.css">' . PHP_EOL;

	print '</head>' . PHP_EOL;
	
	print PHP_EOL . '<!--####################################### Finished including libraries ######################################-->' . PHP_EOL;
	
	print '<body id="' . $fileName . '">' . PHP_EOL;

	print PHP_EOL . '<!--####################################### Building Website Navigation ######################################-->' . PHP_EOL;

	require 'nav.php';
	print PHP_EOL;
	
	if($debug) {
		print '<p>DEBUG MODE IS ON</p>';
	}

	print PHP_EOL . '<!--############################################## End of top.php #############################################-->' . PHP_EOL;
}
else if(($parentFolder == 'final') && ($fileName == 'nightowl')) {
	print PHP_EOL . '<link rel="stylesheet" href="css/style1.css">' . PHP_EOL;
	print PHP_EOL . '</head>' . PHP_EOL;
	require 'nav.php';
}
else if(($parentFolder == 'final') && ($fileName == 'earlybird')) {
	print PHP_EOL . '<link rel="stylesheet" href="css/style2.css">' . PHP_EOL;
	print PHP_EOL . '</head>' . PHP_EOL;
	require 'nav.php';

}
else if(($parentFolder == 'final') && ($fileName == 'imparedsight')) {
	print PHP_EOL . '<link rel="stylesheet" href="css/style3.css">' . PHP_EOL;
	print PHP_EOL . '</head>' . PHP_EOL;
	require 'nav.php';

}
else {

	print '<link rel="stylesheet" href="css/custom.css">' . PHP_EOL;
	
	print '</head>' . PHP_EOL;
	
	print PHP_EOL . '<!--####################################### Finished including libraries ######################################-->' . PHP_EOL;
	
	print '<body id="' . $fileName . '">' . PHP_EOL;

	print PHP_EOL . '<!--####################################### Building Website Navigation ######################################-->' . PHP_EOL;
	
	require 'nav.php';
	print PHP_EOL;

	print PHP_EOL . '<!--############################################## End of top.php #############################################-->' . PHP_EOL;

}

?>

<!--############################################## Main Section ##############################################-->