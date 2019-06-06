<?
include 'inc/functions.php';
include 'inc/defines.php';
include 'db/conn.php';

$user_id = filter_input(INPUT_GET, "user_id", FILTER_SANITIZE_STRING);
$friend_id = filter_input(INPUT_GET, "friend_id", FILTER_SANITIZE_STRING);
$verify_code = filter_input(INPUT_GET, "vc", FILTER_SANITIZE_STRING);


$stmt2 = $pdo->prepare("SELECT * FROM freundesliste WHERE user = :user_id AND freund = :friend_id");
$stmt2->bindParam(':user_id', $user_id);
$stmt2->bindParam(':friend_id', $friend_id);
$stmt2->execute();
while($row_veri = $stmt2->fetch()) { $db_verify = $row_veri['verify']; }


if (!password_verify($verify_code, $db_verify))  {
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
<meta name="description" content="Projekt: JANUS! - denn es geht auch einfach!">
</head>
<body>
  <center><img src="<?=URL;?>/img/2.png" border="0" /></center>

<h2><center>Die Freundschaftsanfrage existiert nicht mehr<br>oder der Sicherheitscode stimmt nicht überein !<br><br><hr><a class="btn_green" href="<?=URL;?>">Wende dich bitte an einen Administrator</a></center></h2>


</body>
</html>

<? exit(); }




$stmt3 = $pdo->prepare("DELETE FROM freundesliste WHERE user = :user_id AND freund = :friend_id");
$stmt3->bindParam(':user_id', $user_id);
$stmt3->bindParam(':friend_id', $friend_id);
$stmt3->execute();




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
<meta name="description" content="Projekt: JANUS! - denn es geht auch einfach!">
</head>
<body>
  <center><img src="<?=URL;?>/img/2.png" border="0" /></center>

<h2><center>Die Freundschaft-Anfrage wurde entfernt !<br><br><hr><a class="btn_green" href="<?=URL;?>">Gehe zur Webseite zurück</a></center></h2>


</body>
</html>
