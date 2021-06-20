<?php
error_reporting(E_ALL);
 $db_server2 = '';
 $db_name2 = '';
 $db_username2 = '';
 $db_passwort2 = '';
 $secret2 = '';

try {
$pdo_server = new PDO('mysql:host='.$db_server2.';dbname='.$db_name2, $db_username2, $db_passwort2);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}


?>
