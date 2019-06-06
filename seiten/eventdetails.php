<? onlinecheck($pdo); ?>
<?
$ev_id = filter_input(INPUT_GET, "event", FILTER_VALIDATE_INT);
$ev_id = $ev_id-46983464;

$events = $pdo->prepare("SELECT * FROM events WHERE id = ? LIMIT 1");
$events->execute(array($ev_id));



while($row_e = $events->fetch()) {
  $header = ($row_e['header'] == "" OR $row_e['header'] == "Auswahl") ? "header_1.png" : $row_e['header'];

  $datum1 = explode("-", $row_e["datum"]);
  $tag = $datum1[2];
  $monat = $datum1[1];
  $jahr = $datum1[0];

  echo "<img src='img/eventheader/".$header."' border='0' width='35%' style='position:absolute; right: 20px' />";
echo "<table width='98%' cellpadding='5'>";
echo "<table width='500px' cellpadding='5'>";
echo "<tr><td width='200px' align='right'>Datum:</td><td>".$tag.".".$monat.".".$jahr."</td></tr>";
echo "<tr><td align='right'>Datum:</td><td>".$row_e['uhrzeit']." Uhr</td></tr>";
echo "<tr><td align='right'>Von:</td><td>".$row_e['von_wo']."</td></tr>";
echo "<tr><td align='right'>Nach:</td><td>".$row_e['nach_wo']."</td></tr>";
echo "<tr><td align='right'>Pause:</td><td>".$row_e['pause']." Min.</td></tr>";
echo "<tr><td align='right'>Pause wo:</td><td>".$row_e['pausenort']."</td></tr>";
echo "<tr><td align='right'>Streckenlänge ca.:</td><td>".$row_e['streckenlaenge']." KM</td></tr>";
if($row_e['trailer'] == 1) { $trailer = "Ja"; } else { $trailer = "Nein"; }

echo "<tr><td align='right'>Trailer:</td><td>".$trailer."</td></tr>";
echo "</table>";

echo "</td><td>";


$dlc_going_east = ($row_e['dlc_going_east'] == 1) ? "Ja&nbsp;&nbsp;&nbsp;&nbsp;" : "Nein";
$dlc_scandinavia = ($row_e['dlc_scandinavia'] == 1) ? "Ja&nbsp;&nbsp;&nbsp;&nbsp;" : "Nein";
$dlc_france = ($row_e['dlc_france'] == 1) ? "Ja&nbsp;&nbsp;&nbsp;&nbsp;" : "Nein";
$dlc_italia = ($row_e['dlc_italia'] == 1) ? "Ja&nbsp;&nbsp;&nbsp;&nbsp;" : "Nein";
$dlc_baltic = ($row_e['dlc_baltic'] == 1) ? "Ja&nbsp;&nbsp;&nbsp;&nbsp;" : "Nein";
$dlc_arizona = ($row_e['dlc_arizona'] == 1) ? "Ja&nbsp;&nbsp;&nbsp;&nbsp;" : "Nein";
$dlc_mexico = ($row_e['dlc_mexico'] == 1) ? "Ja&nbsp;&nbsp;&nbsp;&nbsp;" : "Nein";
$dlc_oregon = ($row_e['dlc_oregon'] == 1) ? "Ja&nbsp;&nbsp;&nbsp;&nbsp;" : "Nein";
$dlc_washington = ($row_e['dlc_washington'] == 1) ? "Ja&nbsp;&nbsp;&nbsp;&nbsp;" : "Nein";


echo "<div style='width:300px;'>";
echo "Benötigte DLC ETS2:<br>";
echo "<ul style='text-align:right; list-style:none;'>";
echo "<li>Going East!: ".$dlc_going_east."</li>";
echo "<li>Scandinavia: ".$dlc_scandinavia."</li>";
echo "<li>France: ".$dlc_france."</li>";
echo "<li>Italia: ".$dlc_italia."</li>";
echo "<li>Baltic Sea: ".$dlc_baltic."</li>";
echo "</ul>";

echo "Benötigte DLC ATS:<br>";
echo "<ul style='text-align:right; list-style:none;'>";
echo "<li>Arizona: ".$dlc_arizona."</li>";
echo "<li>New Mexico: ".$dlc_mexico."</li>";
echo "<li>Oregon: ".$dlc_oregon."</li>";
echo "<li>Washington: ".$dlc_washington."</li>";
echo "</ul>";

echo "</div>";


echo "</td></table>";

if(date('Y-m-d', TIME()) <= $row_e['datum']) {
echo "<a class='btn_senden' target='_blank' href='event_posting.php?id=".$row_e['id']."' style='float:right;  margin-top:-100px;'>Event auf Facebook posten...</a>";
} else {
  echo "<span style='float:right; margin-top:-100px; padding-right:20%; text-align:center;'>Das Event ist vorrüber und kann<br>nicht mehr Geteilt werden !</span>";
}


}

echo "<hr>";

$abstimmung = $pdo->prepare("SELECT * FROM event_teilnehmer WHERE username = ? AND event_id = ?");
$abstimmung->execute(array(user_id($pdo), $ev_id));
while($row_event = $abstimmung->fetch()) {
  $ausgang =$row_event['entscheidung'];
}

$abgestimmt = $abstimmung->rowCount();
?>
<center>
<? if($abgestimmt >= 1) { echo "<center style='padding-bottom:100px'>Du hast für dieses Event schon mit einer &raquo;".$ausgang."&laquo; abgestimmt !</center>"; } else { ?>

<form action="#" method="POST">
  <input class="btn_green" style="margin-right: 50px" type="submit" name="teilnehmen" value="Ja, ich nehme daran Teil" />
  <input class="btn_red" type="submit" name="nicht_teilnehmen" value="Nein, ich nehme nicht daran Teil" />
</form>
<br><br><br>
<?
}


if(isset($_POST["teilnehmen"])) {


  $user_id = user_id($pdo);
$entscheidung = "Zusage";
  $stmt3 = $pdo->prepare("INSERT INTO event_teilnehmer (username,event_id,entscheidung) VALUES (:username,:event_id,:entscheidung)");
  $stmt3->bindParam(':username', $user_id);
  $stmt3->bindParam(':event_id', $ev_id);
  $stmt3->bindParam(':entscheidung', $entscheidung);
  $stmt3->execute();

?><meta http-equiv="refresh" content="0; URL=?q=V8nGOa5P7sXdN2et3xuzpRQHS6IChEqLBDMTky4wJoWYlcKrF90Zimfg1jvb"><?

}


if(isset($_POST["nicht_teilnehmen"])) {

    $user_id = user_id($pdo);
  $entscheidung = "Absage";
    $stmt3 = $pdo->prepare("INSERT INTO event_teilnehmer (username,event_id,entscheidung) VALUES (:username,:event_id,:entscheidung)");
    $stmt3->bindParam(':username', $user_id);
    $stmt3->bindParam(':event_id', $ev_id);
    $stmt3->bindParam(':entscheidung', $entscheidung);
    $stmt3->execute();

  ?><meta http-equiv="refresh" content="0; URL=?q=V8nGOa5P7sXdN2et3xuzpRQHS6IChEqLBDMTky4wJoWYlcKrF90Zimfg1jvb"><?




}












?>
