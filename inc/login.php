<?php
	$dbConn = new PDO(
	    'mysql:host=webdb.uvm.edu;dbname=JADAMS7_viridian',
	    $username = 'jadams7_admin',
	    $password = 'vNvZLnij9J4k',
	    array(
	        PDO::MYSQL_ATTR_SSL_CA => '../certs/webdb-cacert.pem',
	    )
	);
?>