<?
include 'inc/functions.php';
include 'inc/defines.php';
include 'db/conn.php';
?>
<!DOCTYPE html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link href="https://fonts.googleapis.com/css?family=Merienda" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/rangeslider.js"></script>
<script src="//code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<title>Verifizierung für Projekt:JANUS!</title>
<meta name="description" content="Projekt:JANUS - denn es geht auch einfach!">
</head>
<body>
  <center><img src="<?=URL;?>/img/2.png" border="0" /></center>
<?


$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_STRING);

$stmt2 = $pdo->prepare("SELECT * FROM user WHERE verify = ?");
$stmt2->execute(array($id));
$anz = $stmt2->rowCount();


if($anz >= 1) {

  $stmt3 = $pdo->prepare("UPDATE user SET freigabe = 1 WHERE verify = ?");
  $stmt3->execute(array($id));


echo utf8_decode("<center><h2><br><br>Dein Account wurde Freigeschaltet !<br>Du kannst dich nun auf ".URL." anmelden !<br><br>Du wirst zur Startseite weitergeleitet...</h2></center>");
?>
<meta http-equiv="refresh" content="3; URL=http://portal.zwpc.de/index_2.php">
<?

} else {

  echo utf8_decode("<center><h2><br><br>Entweder ist dein Bestätigungscode falsch oder deine Registrierung ist schon zu lange her.<br>Bitte wende dich an einen Administrator von ".URL." !</h2></center>");

}
