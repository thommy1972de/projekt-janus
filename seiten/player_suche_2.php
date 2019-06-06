<? onlinecheck($pdo); ?>
<?=pfeil_back();?><h2>Truckers-MP Spieler-Suche</h2>
<?

$playerID = filter_input(INPUT_GET, "player_id", FILTER_SANITIZE_NUMBER_INT);
$json_url = "https://api.truckyapp.com/v2/truckersmp/player?playerID=".$playerID;
$json = file_get_contents($json_url);
$data = json_decode($json, TRUE);

echo "<center><hr><table width='400px' style='float:left' cellpadding='2' cellspacing='2'>";
if($data['response']['error'] == false) { echo "<tr><td align='right'>Spieler gefunden: <span style='color:lightgreen;'>Ja</span></td></tr>"; } else { echo "<tr><td align='right'>Spieler gefunden: <span styl='color:red'>Nein</span></td><tr>"; }
echo "<tr><td width='200px' align='right'>Username:</td><td>".$data['response']['response']['name']."</td></tr>";
echo "<tr><td align='right'>User-ID:</td><td>".$data['response']['response']['id']."</td></tr>";
echo "<tr><td align='right'>Mitglied seit:</td><td>".$data['response']['response']['joinDate']."</td></tr>";
echo "<tr><td align='right'>Steam ID:</td><td>".$data['response']['response']['steamID64']."</td></tr>";
echo "<tr><td align='right'>Gruppen-Name:</td><td>".$data['response']['response']['groupName']."</td></tr>";
if($data['response']['response']['banned'] == true) { $gebannt = "Ja"; } else { $gebannt = "Nein"; }
echo "<tr><td align='right'>Gebannt:</td><td>".$gebannt."</td></tr>";
echo "<tr><td align='right'>Discord:</td><td>".$data['response']['response']['discord']['name']."</td></tr>";

if($data['response']['response']['permissions']['isGameAdmin'] == true) { echo "<tr><td align='right'>Spieler ist Admin:</td><td>Ja</td></tr>"; } else { echo "<tr><td align='right'>Spieler ist Admin:</td><td>Nein</td></tr>"; }

echo "</table>";

echo "<center><table width='400px' cellpadding='2' cellspacing='2'>";
echo "<td align='right' valign='top'>Avatar:</td><td><img src='".$data['response']['response']['avatar']."' border='0' /></td></tr>";
echo "</table><hr></center>";
