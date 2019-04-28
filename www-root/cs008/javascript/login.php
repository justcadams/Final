<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$dbh = new PDO(
    'mysql:host=webdb.uvm.edu;dbname=JADAMS7_viridian',
    $username = 'jadams7_admin',
    $password = 'RisingPhoenix..00',
    array(
        PDO::MYSQL_ATTR_SSL_CA => '/etc/pki/tls/certs/webdb-cacert.pem',
    )
);
print $dbh;
?>