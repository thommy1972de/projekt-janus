<? onlinecheck($pdo); 
$stmt4 = $pdo->prepare("SELECT * FROM user WHERE email = :email");
$stmt4->bindParam(':email', $_SESSION['username']);
$stmt4->execute();
while($row = $stmt4->fetch()) {
$vorname = $row['vorname'];
$nachname = $row['nachname'];
}

  ?>
<center>
  <h3>Hier kannst du Fragen stellen oder Anregungen geben.<br>Bitte stelle deine Anfrage präzise oder so genau wie möglich.</h3>
  <form action="#" method="POST" style="margin-top:-40px">
  <input type="hidden" name="email_adresse" value="<?=$_SESSION['username']; ?>" size="40" /><br>
  <input type="hidden" name="vorname" value="<?=$vorname; ?>" size="20" />
  <input type="hidden" name="nachname" value="<?=$nachname; ?>" size="20" /><br>
  <input type="text" name="titel" placeholder="Betreff" size="70" /><br>
<textarea name="inhalt" cols="58" rows="10"></textarea><br><br>
<input class="btn_senden" type="submit" name="absenden3" value="Absenden" />
</form>

<?
if(isset($_POST["absenden3"])) {

$vorname = filter_input(INPUT_POST, "vorname", FILTER_SANITIZE_STRING);
$nachname = filter_input(INPUT_POST, "nachname", FILTER_SANITIZE_STRING);
$email_adresse3 = $_SESSION['username'];
$titel = filter_input(INPUT_POST, "titel", FILTER_SANITIZE_STRING);
$inhalt = filter_input(INPUT_POST, "inhalt", FILTER_SANITIZE_STRING);


  $empfaenger = EMAIL_ADRESSE;
  $betreff = "Neue Anfrage auf ".SITENAME;
  $from = "From: Blasius Thomas <".EMAIL_ADRESSE.">\r\n";
  $from .= "Reply-To: ".EMAIL_ADRESSE."\r\n";
  $from .= "Content-Type: text/html\r\n";
  $text = "Ein User mit der Email ".$email_adresse3." - Name: ".utf8_decode($vorname)." ".utf8_decode($nachname)." hat folgende Frage oder Anregung geschrieben:<br><br> ".utf8_decode($titel)."<br><br>".utf8_decode($inhalt).".";
  mail($empfaenger, $betreff, $text, $from);



}
?>
