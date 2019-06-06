<?php
error_reporting(E_ALL);
 $db_server2 = 'rdbs5.xenonserver.de';
 $db_name2 = 'k103238web_test3';
 $db_username2 = 'k103238web_test3';
 $db_passwort2 = 'NojFirvyencut7';
 $secret2 = 'GpNP1vCDdfgTzhMmt4euGzf3B0sqclyeeTT2cocKT9hEMXFB';

try {
$pdo_server = new PDO('mysql:host='.$db_server2.';dbname='.$db_name2, $db_username2, $db_passwort2);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}


?>
