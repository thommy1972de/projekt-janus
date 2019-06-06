<form action="#" method="POST">
  <center>
  <input type="text" name="titel" size="70" placeholder="Titel" /><br><br>
  <textarea name="inhalt" cols="70" rows="20"></textarea><br><br>
  <input type="submit" name="eintrag" value="Eintragen" />
</center>
</form>

<?

if(isset($_POST["eintrag"])) {
  $titel = filter_input(INPUT_POST, "titel", FILTER_SANITIZE_STRING);
  $inhalt = filter_input(INPUT_POST, "inhalt", FILTER_SANITIZE_STRING);
  
  $timestamp = TIME();
  $verfasser = "Thommy";
  $timestamp = TIME();
  $stmt3 = $pdo->prepare("INSERT INTO news (datum, verfasser, titel, inhalt) VALUES (:datum, :verfasser, :titel, :inhalt)");
  $stmt3->bindParam(':datum', $timestamp);
  $stmt3->bindParam(':verfasser', $verfasser);
  $stmt3->bindParam(':titel', $titel);
  $stmt3->bindParam(':inhalt', $inhalt);
  $stmt3->execute();

header("Location: ?q=startseite");


}
