<?

abmelden($_SESSION['username'], $pdo);

session_unset();
session_destroy();

$_SESSION['username'] = "";
?><meta http-equiv="refresh" content="0; URL=?q="><?
