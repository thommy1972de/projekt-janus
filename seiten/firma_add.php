<? onlinecheck($pdo);  ?>
<form  action="#" method="POST" style="width:60%; text-align:center; border:1px solid #fff; margin:0px auto; padding:10px;">


  <input type="text" name="firmenname" placeholder="Firmenname" value="<?=$_POST['firmenname'];?>" style="font-size:22px;width:450px" required /><br>
  <input type="text" name="vorname" placeholder="Dein Vorname" value="<?=$_POST['vorname'];?>" style="font-size:22px;width:450px" required /><br/>
  <input type="text" name="nachname" placeholder="Dein Nachname" value="<?=$_POST['nachname'];?>" style="font-size:22px;width:450px" required /><br/>
  <input type="email" name="email" placeholder="Deine Email Adresse" value="<?=$_POST['email'];?>" style="font-size:22px;width:450px" required /><br/>
  <input type="password" name="pass1" placeholder="Passwort wählen" value="<?=$_POST['pass1'];?>" style="font-size:22px;width:450px" required /><br>

  <input type="password" name="pass2" placeholder="Passwort bestätigen" value="<?=$_POST['pass2'];?>" style="font-size:22px;width:450px" required /><br/>

  <input type="checkbox" name="DS" id="DS" value="1" /> <label for="DS">Ich habe die <a href="?q=OUzEIPRWaIubLCaiK0A3KieWSS884yyB63vLK1eBIXK8w7YrO2B7gqFCwYoV6asgavpydXklM3WcSTif3BFfcYx5X7Yx5SszR7PU">Datenschutzhinweise</a> gelesen und stimme diesen zu.</label><br/><br/>
  <input type="submit" name="senden" class="btn1" value="Deine Firma jetzt eintragen" style="font-size:22px" /><br/><br/>
</form>

<?
if(isset($_POST['senden'])) {

$firmenname = filter_input(INPUT_POST, 'firmenname', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$vorname = filter_input(INPUT_POST, 'vorname', FILTER_SANITIZE_STRING);
$nachname = filter_input(INPUT_POST, 'nachname', FILTER_SANITIZE_STRING);
$pass1 = filter_input(INPUT_POST, 'pass1', FILTER_SANITIZE_STRING);
$pass2 = filter_input(INPUT_POST, 'pass2', FILTER_SANITIZE_STRING);
$hash = password_hash($pass1, PASSWORD_DEFAULT);
$DS = $_POST["DS"];
$timestamp = TIME();
$client_key = getPassword(100);
$e_id = einmalige_id();



if($pass1 !== $pass2) { alert("Die Passwörter stimmen leider nicht überein !"); exit; }
if($DS != 1) { alert("Die Datenschutzbestimmungen müssen Akzeptiert werden !"); exit; }

try{

  $stmt1 = $pdo->prepare("INSERT INTO firmen (einmalige_id, datum, firmenname, email, vorname, nachname, mitarbeiter) VALUES (:einmalige_id, :datum, :firmenname, :email, :vorname, :nachname, 1)");
  $stmt1->bindParam(':einmalige_id', $e_id);
  $stmt1->bindParam(':datum', $timestamp);
  $stmt1->bindParam(':firmenname', $firmenname);
  $stmt1->bindParam(':email', $email);
  $stmt1->bindParam(':vorname', $vorname);
  $stmt1->bindParam(':nachname', $nachname);

  $stmt2 = $pdo->prepare("INSERT INTO user (email, passwort, vorname, nachname, created, client_key) VALUES (:email, :passwort, :vorname, :nachname, :created, :client_key)");
  $stmt2->bindParam(':email', $email);
  $stmt2->bindParam(':passwort', $hash);
  $stmt2->bindParam(':vorname', $vorname);
  $stmt2->bindParam(':nachname', $nachname);
  $stmt2->bindParam(':created', $timestamp);
  $stmt2->bindParam(':client_key', $client_key);

  postToDiscord("Wir dürfen die Firma: ".$firmenname." auf Projekt:JANUS! herzlich Willkommen heissen !");

  $logeintrag = utf8_decode('Es wurde ein Firmen-Benutzerkonto für '.$vorname.' '.$nachname.' mit der Email Adresse '.$email.' erstellt');
  logbucheintrag($logeintrag, $pdo);

  $empfaenger = EMAIL_ADRESSE;
  $betreff = "Neuer Benutzer auf SMS";
  $from = "From: Blasius Thomas <".EMAIL_ADRESSE.">\r\n";
  $from .= "Reply-To: ".EMAIL_ADRESSE."\r\n";
  $from .= "Content-Type: text/html\r\n";
  $text = "Ein hat sich ".$vorname." ".$nachname." mit der Email ".$email." auf der Seite registriert !";
  $text .= "<a href='http://portal.zwpc.de/high_end/index.php'>Zum Adminbereich</a>";
  mail($empfaenger, $betreff, $text, $from);

  $stmt1->execute();
  $stmt2->execute();

} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}

header("Location: ?q=8InCVldG0kIjzTmlCpTWkgU5phsreCZmTRqFrOObXeakhxe4ndjA9HQv7ZPbkpw3281xjap7XzQzz4UTT9907V6BhiYWzElD8kSK");

}
?>
