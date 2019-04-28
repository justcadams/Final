<?php
    chdir('../../../inc');
    print getcwd() . '<br>';
    require 'login.php';
    chdir('/users/j/a/jadams7/www-root/cs008/final');
    print getcwd() .'<br>';
    // require 'phpFunctions.php';
    print getcwd() . '<br>';
    $files = scandir('.');
    print_r($files);
    print '<br>';
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbConn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    print "hello PDO!<br>";
    $status = $dbConn->getAttribute(PDO::ATTR_CONNECTION_STATUS);
    print $status . '<br>';
    print "hello world!<br>";
?>