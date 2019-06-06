<? onlinecheck($pdo);


if(rang($_SESSION['username'], $pdo) >= 2) {

  $eintrag_id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
echo "Dein Rang: ".rang($_SESSION['username'], $pdo)."<br>";
echo "Zu Editierender Beitrag: ".$eintrag_id."<br>";

echo "<center><form action='#' method='POST'>";

$beitrag = $pdo->prepare("SELECT * FROM beitraege_antwort WHERE id = ?");
$beitrag->execute(array($eintrag_id));
  while($row_u = $beitrag->fetch()) {
    echo "<textarea name='inhalt_neu' cols='80' rows='10'>".utf8_encode($row_u['inhalt'])."</textarea><br>";
    echo "<input type='hidden' name='inhalt_alt' value='".utf8_encode($row_u['inhalt'])."' />";
    echo "<input type='text' name='grund' placeholder='Grund für die Änderung eintragen' style='width:565px' />";
    echo "<br><input class='btn_senden' type='submit' name='aendern' value='Ändern' />";


  }
echo "</form></center>";

}


if(isset($_POST['aendern'])) {

$admin_user = $_SESSION['username'];
$inhalt_alt = filter_input(INPUT_POST, "inhalt_alt", FILTER_SANITIZE_STRING);
$inhalt_neu = filter_input(INPUT_POST, "inhalt_neu", FILTER_SANITIZE_STRING);
$uhrzeit = TIME();
$grund = filter_input(INPUT_POST, "grund", FILTER_SANITIZE_STRING);

$ausfuehren = $pdo->prepare("INSERT INTO aenderungen_mod (admin_user, inhalt_alt, inhalt_neu, uhrzeit, grund) VALUES (:admin_user, :inhalt_alt, :inhalt_neu, :uhrzeit,:grund)");
$ausfuehren->bindParam(':admin_user', $admin_user);
$ausfuehren->bindParam(':inhalt_alt', utf8_decode($inhalt_alt));
$ausfuehren->bindParam(':inhalt_neu', utf8_decode($inhalt_neu));
$ausfuehren->bindParam(':uhrzeit', $uhrzeit);
$ausfuehren->bindParam(':grund', $grund);
$ausfuehren->execute();

$log = utf8_decode("Der Admin / Mod ".$admin_user." hat einen Betrag von ".$inhalt_alt." || geändert in || ".$inhalt_neu." || Uhrzeit: ".date('d.m.Y : H:i',$uhrzeit)." Uhr. Grund: ".$grund);
logbucheintrag($log, $pdo);

$aendern = $pdo->prepare("UPDATE beitraege_antwort SET inhalt = :inhalt_neu, aenderung_mod = 1 WHERE id = :id");
$aendern->bindParam(':inhalt_neu', $inhalt_neu);
$aendern->bindParam(':id', $eintrag_id);
$aendern->execute();
?><meta http-equiv="refresh" content="0; URL=?q=diljiY0Bfv9JdgXZopTDeBjwVRGdBHvbKJuprQ716gCQKoZh8lVXnKOvn6vwRSF5i0Wmv0BkKEjV8Bu8qIvM7JwJOdDzpUmY323E"><?

}




 ?>
