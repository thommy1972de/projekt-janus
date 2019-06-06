

<?

$update1 = $pdo->prepare("UPDATE meldungen SET letzte_bearbeitung = :uhrzeit, bearbeiter = :admin WHERE id = :idnr");
$update1->bindParam(':uhrzeit', TIME());
$update1->bindParam(':admin', $_SESSION['username']);
$update1->bindParam(':idnr', $_GET['id']);
$update1->execute();

$meldung = $pdo->prepare("SELECT * FROM meldungen WHERE id = ?");
$meldung->execute(array($_GET['id']));
while($row = $meldung->fetch()) {
echo "<h1>Meldung ".$row['id']." bearbeiten</h1>";
if($row['fertig'] == "ja") { echo "<span style='color:red;'><h2>Meldung wurde als FERTIG markiert !</h2></span>"; }

echo "<form action='#' method='POST'>";
echo "Verstoss: <input type='text' name'verstoss' size='80' value='".$row['verstoss']."' readonly /><br>";
echo "Videolink 1: ".$row['videolink_youtube']."<br>";
echo "Videolink 2: ".$row['videolink_vimeo']."<br>";
echo "Screenshot: <a href='../".$row['hochgeladenes_bild']."' target='_blank'>".$row['hochgeladenes_bild']."</a><br>";

?><br>
Berechtigte Meldung ?: <select name="berechtigt">
  <option value="" <? if($row['berechtigt'] == "---") { echo "selected"; } ?>>---</option>
  <option value="ja" <? if($row['berechtigt'] == "ja") { echo "selected"; } ?>>Ja</option>
  <option value="nein" <? if($row['berechtigt'] == "nein") { echo "selected"; } ?>>Nein</option>
</select>
<br><br>

Neuer Status: <select name="status_neu">
  <option value="In Bearbeitung" <? if($row['status'] == "In Bearbeitung") { echo "selected"; } ?>>In Bearbeitung</option>
  <option value="Anerkannt" <? if($row['status'] == "Anerkannt") { echo "selected"; } ?>>Anerkannt</option>
  <option value="Abgelehnt" <? if($row['status'] == "Abgelehnt") { echo "selected"; } ?>>Abgelehnt</option>
</select>
<br><br>Bei Ablehnung:
<input type="text" name="ablehnungsgrund" size="80" placeholder="Ablehnungsgrund" value="<?=$row['ablehnungsgrund']; ?>" />

<br><br>

Bearbeitung abgeschlossen: <select name="fertig">
  <option value="ja">Ja</option>
  <option value="nein" selected>Nein</option>
</select>

<?
if($row['fertig'] == "ja") { ?>
<br><br><input type="submit" name="senden" value="Ändern" disabled="disabled" />
<? } else { ?>
<br><br><input type="submit" name="senden" value="Ändern" />
<?
}

echo "</form>";
}


if(isset($_POST['senden'])) {

$fertig = $_POST["fertig"];
$berechtigt = $_POST["berechtigt"];
$status_neu = $_POST["status_neu"];
if ($status_neu == "") { $status_neu = "In Bearbeitung"; }
$ablehnungsgrund = $_POST["ablehnungsgrund"];


$update2 = $pdo->prepare("UPDATE meldungen SET status = :status_neu, berechtigt = :berechtigt, ablehnungsgrund = :ablehnungsgrund, fertig = :fertig WHERE id = :idnr");
$update2->bindParam(':status_neu', $status_neu);
$update2->bindParam(':berechtigt', $berechtigt);
$update2->bindParam(':ablehnungsgrund', $ablehnungsgrund);
$update2->bindParam(':fertig', $fertig);
$update2->bindParam(':idnr', $_GET['id']);
$update2->execute();


  ?><center>
  <meta http-equiv="refresh" content="0; URL=?q=meldungen">
  <?

}
?>
