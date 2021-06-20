<?php
error_reporting(E_ALL);
 $db_server = '';
 $db_name = '';
 $db_username = '';
 $db_passwort = '';
 $secret = '';

try {
$pdo = new PDO('mysql:host='.$db_server.';dbname='.$db_name, $db_username, $db_passwort);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}


?>
