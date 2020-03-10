<?php
error_reporting(E_ALL);
 $db_server = 'rdbs5.xenonserver.de';
 $db_name = 'k103238web_paradise';
 $db_username = 'k103238web_parad';
 $db_passwort = '';
 $secret = 'GpNP1vCDdfgTzhMmt4euGzf3B0sqclyeeTT2cocKT9hEMXFB';

try {
$pdo = new PDO('mysql:host='.$db_server.';dbname='.$db_name, $db_username, $db_passwort);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}


?>
