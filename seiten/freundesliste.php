<? onlinecheck($pdo); ?><?=pfeil_back();?>
<?
echo "<div class='box'>";
echo "<h2>Deine Freundesliste</h2>";

$statement = $pdo->prepare("SELECT * FROM user WHERE email = ?");
$statement->execute(array($_SESSION['username']));
while($row = $statement->fetch()) {
  $eigener_name = $row['vorname'];
  $meine_id = $row['einmalige_id'];
}

$statement2 = $pdo->prepare("SELECT * FROM freundesliste WHERE user = ? AND bestaetigt = 1");
$statement2->execute(array($meine_id));
while($row2 = $statement2->fetch()) {

  $statement3 = $pdo->prepare("SELECT * FROM user WHERE einmalige_id = ?");
  $statement3->execute(array($row2['freund']));
  echo "<ul style='padding-left:200px'>";
  while($row3 = $statement3->fetch()) {
    $name_freund = $row3['vorname'];

    if($row3['einmalige_id'] != $meine_id) {
    echo "<li>".$row3['vorname']." ".$row3['nachname']."</li>";
    }
  }
  echo "</ul>";

}
echo "</div>";


echo "<div  class='box'>";
echo "<h2>Freundschaftsanfragen</h2>";

echo "<table style='width:500px;' cellspacing='20'>";
$statement2 = $pdo->prepare("SELECT * FROM freundesliste WHERE user = ? AND bestaetigt = 0");
$statement2->execute(array($meine_id));
$anzahl_freundschaftsanfragen = $statement2->rowCount();
if($anzahl_freundschaftsanfragen == 0) { echo "<center>Du hast keine neuen Anfragen !</center>"; } else {
while($row2 = $statement2->fetch()) {

  $statement3 = $pdo->prepare("SELECT * FROM user WHERE einmalige_id = ?");
  $statement3->execute(array($row2['freund']));

  while($row3 = $statement3->fetch()) {
    $verify = $row2['verify'];
    $empfaenger = $row3['email'];

    echo "<form action='#' method='POST'>";

    echo "<td width='250px' align='center' valign='top'>";
    echo "<a href='?ufrtbfbdsfs=".$row3['einmalige_id']."&q=oQVloXhGyxwmFyIqnbznZ89QvvEsXz1TbIlwJafYV8ffc6IVieaU6bC7qrhhgTZEMBo9gvrCw8PCrul4ZwFheqRNJXHscYDXXoTI'>";
    echo "<img src='img/userimages/".$row3['profilbild']."' border='0' height='120px'><br>";
    echo $row3['vorname']." ".substr($row3['nachname'],0,1).".<br><br>";
    echo "<input type='hidden' name='idnr' value='".$verify."' />";
    echo "<input class='btn_green' type='submit' name='annehmen' value='Annehmen' /> <br><br>";
    echo "<input class='btn_red' type='submit' name='ablehnen' value='Ablehnen' /> <br><br>";
    echo "</a></form></td>";

  }


}
echo "</table>";
}
echo "</div>";


if(isset($_POST["annehmen"])) {

$idnummer = $_POST["idnr"];
$ausfuehren = $pdo->prepare("UPDATE freundesliste SET bestaetigt = 1 WHERE verify = :verify");
$ausfuehren->bindParam(':verify', $idnummer);
$ausfuehren->execute();

$betreff = "Freundschaftsanfrage auf Projekt:JANUS!";
$from = "From: Projekt:JANUS! <".EMAIL_ADRESSE.">\r\n";
$from .= "Reply-To: ".EMAIL_ADRESSE."\r\n";
$from .= "Content-Type: text/html\r\n";
$text = "<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
$text .= "<link href='https://fonts.googleapis.com/css?family=Oswald&display=swap' rel='stylesheet'>";

$text .= utf8_decode("<body style='background: #19191B; font-family: Oswald, sans-serif; font-size:24px; color:#fff;'>");
$text .= "<center><img src='".URL."/img/2.png' border='0' /></center>";
$text .= utf8_decode("<br><br>Hallo ".$eigener_name.",<br>");

$text .= utf8_decode("<span style='font-size:18px;'>Deine Freundschaftsanfrage an wurde Angenommen.
        <br>
        du siehst deinen neuen Freund nun in deiner Freundesliste. Gehe dazu einfach auf  >> Deine Freunde <<
<br><br>
        Vielen Dank !<br>Thommy von Projekt:JANUS!");
$text .= "<br><br><hr><center><span style='font-size:14px; font-face:Arial,Helvetica;'>Du erhälst diese Email, weil du angemeldetet Benutzer auf der Webseite ".URL." bist. Wenn du keine Emails mehr erhalten möchstest, <br>ändere deine Einstellungen für Emails und Benachrichtigungen auf der Webseite im Benutzerbereich</span></center>";
mail($empfaenger, $betreff, $text, $from);
?><meta http-equiv="refresh" content="0; URL=?q=ceRlDqQm8ANdNHbQ0nMBkAykhU47WHt5CVfEe9gShF0ib1C1F9lNpuTT0eWmLVDRQOIWDEICMC9XsFGuUTF3pJQcGV54JXLZA2ul"><?

}

if(isset($_POST["ablehnen"])) {
$idnummer = $_POST["idnr"];
$ausfuehren2 = $pdo->prepare("DELETE FROM freundesliste WHERE verify = :verify");
$ausfuehren2->bindParam(':verify', $idnummer);
$ausfuehren2->execute();

$betreff = "Freundschaftsanfrage auf Projekt:JANUS!";
$from = "From: Projekt:JANUS! <".EMAIL_ADRESSE.">\r\n";
$from .= "Reply-To: ".EMAIL_ADRESSE."\r\n";
$from .= "Content-Type: text/html\r\n";
$text = "<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
$text .= "<link href='https://fonts.googleapis.com/css?family=Oswald&display=swap' rel='stylesheet'>";

$text .= utf8_decode("<body style='background: #19191B; font-family: Oswald, sans-serif; font-size:24px; color:#fff;'>");
$text .= "<center><img src='".URL."/img/2.png' border='0' /></center>";
$text .= utf8_decode("<br><br>Hallo ".$eigener_name.",<br>");

$text .= utf8_decode("<span style='font-size:18px;'>Deine Freundschaftsanfrage an wurde leider Abgelehnt.
        <br>
        Du kannst dem Benutzer eine persönliche Nachricht senden, fallst du der Meinung bist, es Handelt sich um ein Versehen.
<br><br>
        Vielen Dank !<br>Thommy von Projekt:JANUS!");
$text .= "<br><br><hr><center><span style='font-size:14px; font-face:Arial,Helvetica;'>Du erhälst diese Email, weil du angemeldetet Benutzer auf der Webseite ".URL." bist. Wenn du keine Emails mehr erhalten möchstest, <br>ändere deine Einstellungen für Emails und Benachrichtigungen auf der Webseite im Benutzerbereich</span></center>";
mail($empfaenger, $betreff, $text, $from);

?><meta http-equiv="refresh" content="0; URL=?q=ceRlDqQm8ANdNHbQ0nMBkAykhU47WHt5CVfEe9gShF0ib1C1F9lNpuTT0eWmLVDRQOIWDEICMC9XsFGuUTF3pJQcGV54JXLZA2ul"><?
}


?>
