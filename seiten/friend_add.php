<? onlinecheck($pdo); ?>
<?
$freund_id = filter_input(INPUT_GET, "kunqat", FILTER_SANITIZE_STRING);

$statement = $pdo->prepare("SELECT * FROM user WHERE einmalige_id = ?");
$statement->execute(array($freund_id));
while($row = $statement->fetch()) {
  $empfaenger = $row['email'];
  $vorname = $row['vorname'];
  $nachname = $row['nachname'];
}

$statement2 = $pdo->prepare("SELECT * FROM user WHERE email = ?");
$statement2->execute(array($_SESSION['username']));
while($row2 = $statement2->fetch()) {
  $abs_vorname = $row2['vorname'];
  $abs_nachname = substr($row2['nachname'],0 ,1).".";
  $eigene_id = $row2['einmalige_id'];

}

$verify_code1 = md5(uniqid(rand(), TRUE));
$verify_code = password_hash($verify_code1, PASSWORD_DEFAULT);




$stmt3 = $pdo->prepare("INSERT INTO freundesliste (user, freund, verify) VALUES (:user, :freund, :verify)");
$stmt3->bindParam(':user', $eigene_id);
$stmt3->bindParam(':freund', $freund_id);
$stmt3->bindParam(':verify', $verify_code);
$stmt3->execute();


$betreff = "Freundschaftsanfrage auf Projekt:JANUS!";
$from = "From: Projekt:JANUS! <".EMAIL_ADRESSE.">\r\n";
$from .= "Reply-To: ".EMAIL_ADRESSE."\r\n";
$from .= "Content-Type: text/html\r\n";
$text = "<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
$text .= "<link href='https://fonts.googleapis.com/css?family=Oswald&display=swap' rel='stylesheet'>";

$text .= utf8_decode("<body style='background: #19191B; font-family: Oswald, sans-serif; font-size:24px; color:#fff;'>");
$text .= "<center><img src='".URL."/img/2.png' border='0' /></center>";
$text .= utf8_decode("<br><br><center>Hallo ".$vorname." ".$nachname.".<br>");

$text .= utf8_decode("<span style='font-size:18px;'>Du hast eine Freundschaftsanfrage von ".$abs_vorname." ".$abs_nachname." erhalten.
        Wenn dir der Benutzer bekannt ist und du die<br>
        Freundschaftanfrage annehmen willst, klicke bite hier:<br><br>
        <a style='background-color:green; padding:20px; text-decoration:none; color:#fff; border-radius:15px' href=".URL."/friend_add.php?vc=".$verify_code1."&user_id=".$eigene_id."&friend_id=".$freund_id."'>&nbsp;&nbsp;Ja, der Benutzer ist mir bekannt&nbsp;&nbsp;</a>
        <br><hr>
        Wenn dir dieser Benutzer nicht bekannt ist, klicke bitte hier:<br><br>
        <a style='background-color:red; padding:20px; text-decoration:none; color:#fff; border-radius:15px' href=".URL."/friend_delete.php?vc=".$verify_code1."&user_id=".$eigene_id."&friend_id=".$freund_id."'>&nbsp;&nbsp;Nein, den Benutzer kenne ich nicht&nbsp;&nbsp;</a>
        <br><hr>
        Wenn du dir das Profil des Benutzers ansehen willst,<br>
        Klicke bitte hier:<br><br>
        <a style='background-color:#BDBDBD; padding:20px; text-decoration:none; color:#000; border-radius:15px' href=".URL."'>&nbsp;&nbsp;Zur Webseite gehen...&nbsp;&nbsp;</a>
        <br><br><hr></span>

        Vielen Dank !<br>Thommy von Projekt:JANUS!</center>");
$text .= utf8_decode("<br><br><hr><center><span style='font-size:14px; font-face:Arial,Helvetica;'>Du erhälst diese Email, weil du angemeldetet Benutzer auf der Webseite ".URL." bist. Wenn du keine Emailsl mehr erhalten möchstest, <br>ändere deine Einstellungen für Emails und Benachrichtigungen auf der Webseite im Benutzerbereich</span></center>");
mail($empfaenger, $betreff, $text, $from);


echo "<center><br><br>Es wurde eine Freundschaftsanfrage gesendet.<br>Wenn Sie angenommen wird, erscheint der Benutzer in deiner Freundesliste!</center>";

zitat($pdo);?>
<meta http-equiv="refresh" content="3; URL=?q=WO5kP2yk95kf70rD0ok6dN3jZTOi0LVF6GWp4yDKTjToOGgxiBWNUxY625LvPMwuB69FYOSmhORbYuVmzUvA5f54S5EuesVpOQz0">
<?
