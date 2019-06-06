<? onlinecheck($pdo); ?><?
$idnr = filter_input(INPUT_GET, "gzkgjrt4hh58jjt65" ,FILTER_SANITIZE_STRING);


$stmt = $pdo->prepare("SELECT * FROM firmen WHERE einmalige_id = :idnr LIMIT 1");
$stmt->bindParam(':idnr', $idnr);
$stmt->execute();
while($row = $stmt->fetch()) {
  $fa_name = $row['firmenname'];
  $db_email = $row['email'];
  $mindesalter = $row['mindestalter'];
  if($mindesalter == 0) { $mindesalter = 12; }
  $bewerberhinweis = htmlentities($row['bewerber_hinweis']);
}

if($db_email == $_SESSION['username']) { echo "<center><h1>Du kannst dich nicht in deiner eigenen Firma bewerben !</h1><a href='?q=veic1YOxiHOXn922WC2jDixVx8DpAaUCFTFk5vtuboBsJMlndOpswFeCxnV7InywDZ2Vz6TiIYjkBkLpglaLSVboX5ELDivvLipc'>Zurück</a></center>"; }
else
{ ?><center>
<form action="#" style="width:600px;" method="POST">

    Dein Alter:
    <select name="alter">
      <? $i = $mindesalter; while($i<= 99) { ?>
        <option value="<?=$i;?>"><?=$i;?></option>
        <? $i++;
      } ?></select> <? if($mindesalter >= 1) { echo "Diese Spedition setzt ein<br>Mindesalter von <span style='font-size:30px;'>".$mindesalter." Jahren</span> vorraus !"; } ?>
       <hr>
<br>
    Erzähle dieser Spedition ein klein wenig über dich:<br>

  <textarea name="bew_text" cols="70" rows="10"></textarea>
<br>
<? if($bewerberhinweis != "") { echo "Hinweis der Spedition: <br><h3>".$bewerberhinweis."</h3>"; } ?>

<input class="btn_green" type="submit" name="bewerben" style="width:350px" value="Bewerbung an die Spedition senden !" />
</form>
</center>
<br><br><br>
<? }

if(isset($_POST['bewerben'])) {

$von_user = $_SESSION['username'];
$user_alter = filter_input(INPUT_POST, "alter" ,FILTER_VALIDATE_INT);
$bew_text = filter_input(INPUT_POST, "bew_text" ,FILTER_SANITIZE_STRING);
$timestamp = TIME();

$stmt1 = $pdo->prepare("INSERT INTO bewerbungen (von_user, user_alter, an_firma, bew_text, datum) VALUES (:von_user, :user_alter, :an_firma, :bew_text, :datum)");
$stmt1->bindParam(':von_user', $von_user);
$stmt1->bindParam(':user_alter', $user_alter);
$stmt1->bindParam(':an_firma', $idnr);
$stmt1->bindParam(':bew_text', $bew_text);
$stmt1->bindParam(':datum', $timestamp);
$stmt1->execute();

$sperre_bis = strtotime(BEWERBUNGSSPERRE);

$stmt2 = $pdo->prepare("UPDATE user SET naechste_bewerbung = :zeit WHERE email = :user_mail");
$stmt2->bindParam(':zeit', $sperre_bis);
$stmt2->bindParam(':user_mail', $von_user);
$stmt2->execute();

$betreff = "Projekt:JANUS! - Bewerbung";
$from = "From: Projekt:JANUS! <".EMAIL_ADRESSE.">\r\n";
$from .= "Reply-To: ".EMAIL_ADRESSE."\r\n";
$from .= "Content-Type: text/html\r\n";
$text = "<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
$text .= "<link href='https://fonts.googleapis.com/css?family=Oswald&display=swap' rel='stylesheet'>";

$text .= utf8_decode("<body style='background: #19191B; font-family: Oswald, sans-serif; font-size:24px; color:#fff;'>");
$text .= "<center><img src='".URL."/img/2.png' border='0' /></center>";
$text .= utf8_decode("<br><br><center>Hallo, ".$von_user.".<br>");

$text .= utf8_decode("<span style='font-size:18px;'>Du hast eine neue Bewerbung von ".$von_user." erhalten.
        Wenn dir der/die Benutzer(in) bekannt ist und du Ihn/Sie<br>
        als Fahrer annehmen willst, klicke bite hier:<br><br>
        <a style='background-color:green; padding:20px; text-decoration:none; color:#fff; border-radius:15px' href=".URL."/fahrer_add.php?vc=".$verify_code1."&fa_id=".$idnr."&fahrer_id=".$von_user."'>&nbsp;&nbsp;Ja, der Benutzer ist mir bekannt&nbsp;&nbsp;</a>
        <br><hr>
        Wenn dir dieser Benutzer nicht bekannt ist, klicke bitte hier:<br><br>
        <a style='background-color:red; padding:20px; text-decoration:none; color:#fff; border-radius:15px' href=".URL."/fahrer_delete.php?vc=".$verify_code1."&fa_id=".$idnr."&fahrer_id=".$von_user."'>&nbsp;&nbsp;Nein, den Benutzer kenne ich nicht&nbsp;&nbsp;</a>
        <br><hr>
        Wenn du dir das Profil des Benutzers ansehen willst,<br>
        Klicke bitte hier:<br><br>
        <a style='background-color:#BDBDBD; padding:20px; text-decoration:none; color:#000; border-radius:15px' href=".URL."'>&nbsp;&nbsp;Zur Webseite gehen...&nbsp;&nbsp;</a>
        <br><br><hr></span>

        Vielen Dank !<br>Thommy von Projekt:JANUS!</center>");
$text .= utf8_decode("<br><br><hr><center><span style='font-size:14px; font-face:Arial,Helvetica;'>Du erhälst diese Email, weil du angemeldetet Benutzer auf der Webseite ".URL." bist. Wenn du keine Emailsl mehr erhalten möchstest, <br>ändere deine Einstellungen für Emails und Benachrichtigungen auf der Webseite im Benutzerbereich</span></center>");
mail($db_email, $betreff, $text, $from);




?>
<meta http-equiv="refresh" content="0; URL=?q=veic1YOxiHOXn922WC2jDixVx8DpAaUCFTFk5vtuboBsJMlndOpswFeCxnV7InywDZ2Vz6TiIYjkBkLpglaLSVboX5ELDivvLipc">
<?
}
