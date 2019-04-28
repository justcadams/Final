<?php
	$dbConn = new PDO(
	    'mysql:host=webdb.uvm.edu;dbname=EKLOETI_MOTH',
	    $username = 'ekloeti_admin',
	    $password = 'N9EcXX6V40aZ',
	    array(
	        PDO::MYSQL_ATTR_SSL_CA => '../certs/webdb-cacert.pem',
	    )
	);
?>