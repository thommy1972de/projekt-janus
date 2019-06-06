<? onlinecheck($pdo); ?><? if(!isset($_POST["abort"])){ ?>

<h2>Meldung abbrechen</h2>

<? $ei2 = filter_input(INPUT_GET, "fethilop", FILTER_SANITIZE_STRING);

?>
<center>
<form action="#" method="POST">
  <h2>Warum brichtst du die Meldung ab ?</h2>
  <br>
  <input type="hidden" name="e_i" value="<?=$ei2;?>" />
  <select name="grund">
      <option selected>Bitte Grund auswählen</option>
      <option value="Falscher Verdacht">Falscher Verdacht</option>
      <option value="Ich habe mich geirrt">Ich habe mich geirrt</option>
      <option value="Falscher Spieler gemeldet">Falscher Spieler gemeldet</option>
      <option value="War doch nicht so schlimm">War doch nicht so schlimm</option>
  </select><br><br>
  <input class="btn_red" type="submit" name="abort" value="Anfrage zum Abbruch senden" />
</form><br><br>
<? } ?>
</center>

<?
  if(isset($_POST['abort'])) {

    $grund = filter_input(INPUT_POST, "grund", FILTER_SANITIZE_STRING);

  $empfaenger = EMAIL_ADRESSE;
  $betreff = "Anfrage auf Abbruch bei ".SITENAME;
  $from = "From: Blasius Thomas <".EMAIL_ADRESSE.">\r\n";
  $from .= "Reply-To: ".EMAIL_ADRESSE."\r\n";
  $from .= "Content-Type: text/html\r\n";
  $text = "Ein User hat den Abbruch von Meldung ".$ei2." aus folgendem Grund veranlasst: ".$grund."<br><br>Check das !";
  $text .= "<br><br><a href='http://portal.zwpc.de/high_end/index.php'>Zum Adminbereich</a>";
  mail($empfaenger, $betreff, $text, $from);

echo "<center><h2><br><br>Deine Anfrage ist eingegangen. Bitte lass uns etwas Zeit um die Sache zu klären !</h2>";
zitat($pdo);

}
