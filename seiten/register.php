
<form  action="#" method="POST" style="width:60%; text-align:center; border:1px solid #fff; margin:0px auto; padding:10px;">

  <input type="text" name="vorname" placeholder="Dein Vorname" value="<?=$_POST['vorname'];?>" style="font-size:22px;width:450px" required /><span style="color:red;">*</span><br/>
  <input type="text" name="nachname" placeholder="Dein Nachname" value="<?=$_POST['nachname'];?>" style="font-size:22px;width:450px" required /><span style="color:red;">*</span><br/>
  <input type="email" name="email" placeholder="Deine Email Adresse" value="<?=$_POST['email'];?>" style="font-size:22px;width:450px" required /><span style="color:red;">*</span><br/>

    <input type="checkbox" value="other" id="other" name="animals" class="animals" /><label for="other">Truckers MP Account ?</label>


      <div id="tmp1" style="display:none;">
          <input type="text" name="truckers_mp" id="truckers_mp" placeholder="TruckersMP-ID" value="" style="font-size:22px;width:140px" maxlength="8" /><span style="color:red;">*</span> <a href="truckers_mp.php" target="_blank"><img src="img/help.png" border="0" /></a><br/>
      </div>
<br>
  <input type="password" name="pass1" placeholder="Passwort wählen" value="<?=$_POST['pass1'];?>" style="font-size:22px;width:450px" required /><span style="color:red;">*</span><br>

  <input type="password" name="pass2" placeholder="Passwort bestätigen" value="<?=$_POST['pass2'];?>" style="font-size:22px;width:450px" required /><span style="color:red;">*</span><br/>

  <input type="checkbox" name="DS" id="DS" value="1" /> <label for="DS">Ich habe die <a class="link" href="?q=OUzEIPRWaIubLCaiK0A3KieWSS884yyB63vLK1eBIXK8w7YrO2B7gqFCwYoV6asgavpydXklM3WcSTif3BFfcYx5X7Yx5SszR7PU">Datenschutzhinweise</a> gelesen und stimme diesen zu. <span style="color:red;">*</span></label><br/><br/>
  <input type="submit" name="senden3" class="btn1" value="Deinen Account jetzt beantragen" style="font-size:22px" /><br/><br/>
<br><span style="color:red;">*</span> = Benötigt
</form>
<script>
$(".animals").change(function () {
    //check if its checked. If checked move inside and check for others value
    if (this.checked && this.value === "other") {
        //show a text box
        $("#tmp1").show( "slow", function() {});
    } else if (!this.checked && this.value === "other"){
        //hide the text box
        $("#tmp1").hide( "slow", function() {});
    }
});
</script>
<?
if(isset($_POST['senden3'])) {

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$vorname = filter_input(INPUT_POST, 'vorname', FILTER_SANITIZE_STRING);
$nachname = filter_input(INPUT_POST, 'nachname', FILTER_SANITIZE_STRING);
$truckers_mp = filter_input(INPUT_POST, 'truckers_mp', FILTER_VALIDATE_INT);
$pass1 = filter_input(INPUT_POST, 'pass1', FILTER_SANITIZE_STRING);
$pass2 = filter_input(INPUT_POST, 'pass2', FILTER_SANITIZE_STRING);
$hash = password_hash($pass1, PASSWORD_DEFAULT);
$DS = $_POST["DS"];

if($DS == 1) { $datenschutz_akzeptiert = "Ja"; }

$timestamp = TIME();
$client_key = getPassword(100);

if($pass1 !== $pass2) { alert("Die Passwörter stimmen leider nicht überein !"); exit; }
if($DS != 1) { alert("Die Datenschutzbestimmungen müssen Akzeptiert werden !"); exit; }

$statement = $pdo->prepare("SELECT * FROM user WHERE email = ? LIMIT 1");
$statement->execute(array($email));
$anz = $statement->rowCount();
if($anz >= 1) { echo "<center><h2 style='color:red;; margin-top:-550px;'>Es existiert bereits ein Account mit dieser Email-Adresse !</h2><br/><br/><br/></center>"; } else {

  $playerID = filter_input(INPUT_POST, "player_id", FILTER_SANITIZE_NUMBER_INT);
  $json_url = "https://api.truckyapp.com/v2/truckersmp/player?playerID=".$playerID;
  $json = file_get_contents($json_url);
  $data = json_decode($json, TRUE);
  $steam_id = $data['response']['response']['steamUser'];

try{



  $einmalige_id = einmalige_id();

  $link_id = einmalige_id();
  $generate_link = URL."/verify.php?id=".$link_id;

  $stmt2 = $pdo->prepare("INSERT INTO user (email, passwort, vorname, nachname, created, last_login, client_key, einmalige_id, truckers_mp, verify) VALUES (:email, :passwort, :vorname, :nachname, :created, :last_login, :client_key, :einmalige_id, :truckers_mp, :verify)");
  $stmt2->bindParam(':email', $email);
  $stmt2->bindParam(':passwort', $hash);
  $stmt2->bindParam(':vorname', $vorname);
  $stmt2->bindParam(':nachname', $nachname);
  $stmt2->bindParam(':created', $timestamp);
  $stmt2->bindParam(':last_login', $timestamp);
  $stmt2->bindParam(':client_key', $client_key);
  $stmt2->bindParam(':einmalige_id', $einmalige_id);
  $stmt2->bindParam(':truckers_mp', $truckers_mp);
  $stmt2->bindParam(':verify', $link_id);
  $stmt2->execute();




  $nachname_kurz = substr($nachname,0,1);

  postToPersonaNews("Wir dürfen ".$vorname." ".$nachname_kurz.". auf Projekt:JANUS! begrüßen !");

  $logeintrag = utf8_decode('Es wurde ein User-Benutzerkonto für '.$vorname.' '.$nachname.' mit der Email Adresse '.$email.' erstellt');
  logbucheintrag($logeintrag, $pdo);

  $empfaenger = EMAIL_ADRESSE;
  $betreff = "Neuer Benutzer auf ".SITENAME;
  $from = "From: Projekt JANUS! <".EMAIL_ADRESSE.">\r\n";
  $from .= "Reply-To: ".EMAIL_ADRESSE."\r\n";
  $from .= "Content-Type: text/html\r\n";
  $text = "Ein hat sich ".utf8_decode($vorname)." ".utf8_decode($nachname)." mit der Email ".$email." auf der Seite registriert !";
  $text .= "<br><br><a href='http://portal.zwpc.de/high_end/index.php'>Zum Adminbereich</a>";
  mail($empfaenger, $betreff, $text, $from);


// Bestätigungs-Email senden
  $betreff = "Registrierung Projekt:JANUS!";
  $from = "From: Projekt:JANUS! <".EMAIL_ADRESSE.">\r\n";
  $from .= "Reply-To: ".EMAIL_ADRESSE."\r\n";
  $from .= "Content-Type: text/html\r\n";

  $text = "<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
  $text .= "<link href='https://fonts.googleapis.com/css?family=Oswald&display=swap' rel='stylesheet'>";

  $text .= "<body style='background: #19191B; font-family: Oswald, sans-serif; font-size:24px; color:#fff;'>";
  $text .= "<center><img src='".URL."/img/2.png' border='0' /></center>";
  $text .= utf8_decode("<br><br>Hallo ".$vorname."!<br>Du hast dich Erfolgreich auf Projekt:JANUS! registriert.<br>Um deine Anmeldung zu Bestätigen klicke bitte auf den folgenden Link:<br><br>");
  $text .= "<a href='".$generate_link."' target='_blank' style='color:#FFBF00'>".$generate_link."</a>";
  $text .= utf8_decode("<br><br>Falls du dich nicht auf Projekt:JANUS! registriert haben solltest, lösche einfach diese Email.<br><br>Vielen Dank !<br>Thommy von Projekt:JANUS!");
  $text .= utf8_decode("<br><br><hr><center><span style='font-size:14px; font-face:Arial,Helvetica;'>Du erhälst diese Email, weil du dich auf der Webseite ".URL." angemeldet hast. Wenn du keine Emailsl mehr erhalten möchstest, <br>ändere deine Einstellungen für Emails und Benachrichtigungen auf der Webseite im Benutzerbereich</span></center>");
  mail($email, $betreff, $text, $from);


} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}

?>
<meta http-equiv="refresh" content="0; URL=?q=H2YjlxC243YkGrUn7J0PO0oCHcs3lvBqNKjYiHCZNo7Bw6WnY7pZTo9QoBHOGmeE5dcxH5evv958EaZL8nLXzOZCuTCOWe0iXZUH">
<?


  }

}
?>
