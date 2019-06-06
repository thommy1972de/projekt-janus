<? onlinecheck($pdo); ?><?=pfeil_back();?><h2>Truckers-MP Spieler-Suche</h2>
<?if(!isset($_POST['suche'])) { ?>
<center>
<form action="#" method="POST" name="form1">
  <? if(!empty($_GET['player_id'])) { echo "<center>Die Player-ID wurde eingetragen !</center>"; } ?>
  <input type="text" name="player_id" placeholder="Player-ID z.b. 3463" value="<?=$_GET['player_id']; ?>" size="20" /><br><br>
  <input type="submit" class="btn_senden" id="suche" name="suche" value="Suchen..." />

</form>
</center>

<?
} else {

  echo "<a class='btn_senden' href='https://projekt-janus.de/index_2.php?q=uI9jjtmKqbNxXx3f5nHDnkwapFh2T7xar4XW1ayIkyCueTT3z0K8BbYsgL5xv1gsdKmPMh1bthgxPtS2VZJv2EYtgM7XRkL3mNJD'>Neue Suche starten</a>";
}


if(isset($_POST["suche"])) {

$playerID = filter_input(INPUT_POST, "player_id", FILTER_SANITIZE_NUMBER_INT);
$json_url = "https://api.truckyapp.com/v2/truckersmp/player?playerID=".$playerID;
$json = file_get_contents($json_url);
$data = json_decode($json, TRUE);

echo "<center><hr><table width='400px' style='float:left' cellpadding='2' cellspacing='2'>";
if($data['response']['error'] == false) { echo "<tr><td align='right'>Spieler gefunden: <span style='color:lightgreen;'>Ja</span></td></tr>"; } else { echo "<tr><td align='right'>Spieler gefunden: <span styl='color:red'>Nein</span></td></tr>"; }
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
echo "</table></center>";
}
?>
