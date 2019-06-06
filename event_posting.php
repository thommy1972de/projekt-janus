<?
include 'inc/functions.php';
include 'inc/defines.php';
include 'db/conn.php';
$event_id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

$stmt4 = $pdo->prepare("SELECT * FROM events WHERE id = :id");
$stmt4->bindParam(':id', $event_id);
$stmt4->execute();


while($row_e = $stmt4->fetch()) {

  $header = ($row_e['header'] == "" OR $row_e['header'] == "Auswahl") ? "eventheader_1.png" : $row_e['header'];

  $datum1 = explode("-", $row_e["datum"]);
  $tag = $datum1[2];
  $monat = $datum1[1];
  $jahr = $datum1[0];

  $event_titel = $row_e['titel'];
  $server = $row_e['server'];
  $von_wo = $row_e['von_wo'];
  $nach_wo = $row_e['nach_wo'];
  $pause = $row_e['pause'];
  $pause_wo = $row_e['pausenort'];
  $beschreibung = $row_e['beschreibung'];
  $uhrzeit = $row_e['uhrzeit'];

  $dlc_going_east = ($row_e['dlc_going_east'] == 1) ? "Ja&nbsp;&nbsp;&nbsp;&nbsp;" : "Nein";
  $dlc_scandinavia = ($row_e['dlc_scandinavia'] == 1) ? "Ja&nbsp;&nbsp;&nbsp;&nbsp;" : "Nein";
  $dlc_france = ($row_e['dlc_france'] == 1) ? "Ja&nbsp;&nbsp;&nbsp;&nbsp;" : "Nein";
  $dlc_italia = ($row_e['dlc_italia'] == 1) ? "Ja&nbsp;&nbsp;&nbsp;&nbsp;" : "Nein";
  $dlc_baltic = ($row_e['dlc_baltic'] == 1) ? "Ja&nbsp;&nbsp;&nbsp;&nbsp;" : "Nein";
  $dlc_arizona = ($row_e['dlc_arizona'] == 1) ? "Ja&nbsp;&nbsp;&nbsp;&nbsp;" : "Nein";
  $dlc_mexico = ($row_e['dlc_mexico'] == 1) ? "Ja&nbsp;&nbsp;&nbsp;&nbsp;" : "Nein";
  $dlc_oregon = ($row_e['dlc_oregon'] == 1) ? "Ja&nbsp;&nbsp;&nbsp;&nbsp;" : "Nein";
  $dlc_washington = ($row_e['dlc_washington'] == 1) ? "Ja&nbsp;&nbsp;&nbsp;&nbsp;" : "Nein";
}
?>
<!DOCTYPE html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Merienda" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
<meta property="og:title" content="<?=$event_titel;?>" />
<meta property="og:type" content="website" />
<meta property="fb:app_id" content="299605944253163" />
<meta property="ia:rules_url" content="<?=URL;?>/index_2.php?q=OUzEIPRWaIubLCaiK0A3KieWSS884yyB63vLK1eBIXK8w7YrO2B7gqFCwYoV6asgavpydXklM3WcSTif3BFfcYx5X7Yx5SszR7PU" />
<meta property="og:url" content="<?=URL;?>/event_posting.php?id=<?=$event_id;?>" />
<meta property="og:image" content="<?=URL;?>/img/eventheader/<?=$header;?>" />
<meta property="og:description" content="<?=$werbetext;?>" />
</head>
<html  style="background-color: #19191B;">
<body>
<center>
  <img src="img/eventheader/<?=$header;?>" width="700px" border="0" /><br>
<h2><?=$event_titel;?></h2>
<p style="font-size:34px">
Wir starten am <?=$tag.".".$monat.".".$jahr;?> um <?=$uhrzeit; ?> Uhr von <?=$von_wo; ?>.<br>
<?
if ($pause_wo == "" OR $pause_wo == "Wird spontan Entschieden") {
  echo "Unser Pause wird ".$pause." Min. betragen. Der genaue Pausenort wird unterwegs Entschieden.";
} else {
  echo "Unser Pause wird ".$pause." Min. betragen. Der genaue Pausenort ist: ".$pause_wo.".";
} ?><br>
Benötigte DLC's:<br>
</p>
<ul style="list-style:none; font-size:34px">
  <li>Going-EAST!: <?=$dlc_going_east; ?></li>
  <li>France: <?=$dlc_france; ?></li>
  <li>Scandinavia: <?=$dlc_scandinavia; ?></li>
  <li>Italia: <?=$dlc_italia; ?></li>
  <li>Baltic-Sea: <?=$dlc_baltic; ?></li>
  <li>Arizona: <?=$dlc_arizona; ?></li>
  <li>Mexico: <?=$dlc_mexico; ?></li>
  <li>Oregon: <?=$dlc_oregon; ?></li>
  <li>Washington: <?=$dlc_washington; ?></li>

</ul>
<p style="font-size:34px">
Beschreibung des Events:<br>
<?=$beschreibung;?>




</p>
<hr>
<a class="btn_green" target="_blank" href="<?=URL;?>">Sieh dir dieses Event auf Projekt: JANUS! an</a>

<br><br>oder, teile dieses Event auf deiner Facebook-Seite:<br><br>
<div style="position:fixed; bottom:10px; right:10px; text-align: reight; padding-right:20px;"><a href="<?URL;?>/index.php" target="_blank">Projekt:JANUS!</a></div>

<script type="text/javascript">
function fbshare(){
var sharer = "https://www.facebook.com/sharer/sharer.php?u=";
window.open(sharer + location.href,'sharer', 'width=626,height=436');
}
</script>
<a href="" class="btn_green" onclick="fbshare();">Diese Seite auf Facebook teilen</a>


<br><br><br>

</body>
</html>
