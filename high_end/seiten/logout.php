<?
session_unset();
session_destroy();
$_SESSION['admin'] = "";
header("Location: ?q=");
?>
