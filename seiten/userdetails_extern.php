<? onlinecheck($pdo);

$userid = filter_input(INPUT_GET, "ufrtbfbdsfs", FILTER_SANITIZE_STRING); ?>

<h2>Das User-Profil</h2>
<?


$stmt4 = $pdo->prepare("SELECT * FROM user WHERE einmalige_id = :userid");
$stmt4->bindParam(':userid', $userid);
$stmt4->execute();

echo "<table width='60%' style='float:left;'><tr>";
while($row = $stmt4->fetch()) {

  $json_url2 = "https://api.truckyapp.com/v2/truckersmp/player?playerID=".$row['truckers_mp'];
  $json2 = file_get_contents($json_url2);
  $data2 = json_decode($json2, TRUE);
  $steam_id_neu = $data2['response']['response']['steamID64'];


    $steameintrag = $pdo->prepare("UPDATE user SET steam_id = :steam WHERE email = :email");
    $steameintrag->bindParam(':steam', $steam_id_neu);
    $steameintrag->bindParam(':email', $row['email']);
    $steameintrag->execute();

if($plz == 0) { $plz = "---"; } else {$plz = $row['plz']; }
if(empty($row['facebook'])) { $facebook = "n.A."; } else { $facebook = "<a href='https://www.facebook.com/".$row['facebook']."' target='_blank'>".$row['facebook']."</a>"; }

echo "<tr><td width='60px' align='right'>Name:</td><td>".$row['vorname']." ".substr($row['nachname'],0,1).".</td></tr>";
echo "<tr><td align='right'>PLZ:</td><td>".$plz."</td></tr>";
if(!empty($row['tel_mobil'])) {
echo "<tr><td align='right'>Mobil:</td><td>".substr($row['tel_mobil'],0,3)."xxxxxxxxxx".substr($row['tel_mobil'],-4)."</td></tr>";
}
if(!empty($row['facebook'])) {
echo "<tr><td align='right'>Facebook:</td><td>".$facebook."</td></tr>";
}
if(!empty($row['discord'])) {
echo "<tr><td align='right'>Discord: #</td><td>".$row['discord']."</td></tr>";
}
if($row['truckers_mp'] != 0) {
echo "<tr><td align='right'>TruckersMP-ID: #</td><td><a class='link' href='?q=J50CfwLjOGlkyLsroaR2ngsuYbpJcypzipTCzX3DD8G0BKQPBF3G9wfbf4SOdZ08UOTkj5jfkledhBXE8XlttmAW65THKiFSg2Rg&player_id=".$row['truckers_mp']."'>".$row['truckers_mp']."</a></td></tr>";
}
if($row['steam_id'] != 0) {
echo "<tr><td align='right'>STEAM-ID: #</td><td><a class='link' href='https://steamcommunity.com/profiles/".$row['steam_id']."' target='_blank'>".$row['steam_id']."</a></td></tr>";
}

echo "<tr><td align='right'>Du spielst mit:</td><td>".$row['steuerung']."</td></tr>";

if($row['lkw_ets'] != "Auswahl") {
echo "<tr><td align='right'>Dein LKW in ETS2:</td><td>".$row['lkw_ets']."</td></tr>";
}
if($row['lkw_ats'] != "Auswahl") {
echo "<tr><td align='right'>Dein LKW in ATS:</td><td>".$row['lkw_ats']."</td></tr>";
}
if($row['stadt_ets'] != "Auswahl") {
echo "<tr><td align='right'>Deine Stadt in ETS2:</td><td>".$row['stadt_ets']."</td></tr>";
}
if($row['stadt_ats'] != "Auswahl") {
echo "<tr><td align='right'>Deine Stadt in ATS:</td><td>".$row['stadt_ats']."</td></tr>";
}
echo "<tr><td width='60px' align='right'>Going East!</td><td style='width:30px'>";
   if($row['dlc_going'] == 1) { echo "<img src='img/ok.png' border='0' style='padding-left:10px' />"; } else { echo "<img src='img/not_ok.png' border='0' style='padding-left:10px' />"; }
echo "</td>";

echo "<td width='60px' align='right'>Scandinavia</td><td style='width:30px'>";
   if($row['dlc_scandinavia'] == 1) { echo "<img src='img/ok.png' border='0' style='padding-left:10px' />"; } else { echo "<img src='img/not_ok.png' border='0' style='padding-left:10px' />"; }
echo "</td>";

echo "<td width='60px' align='right'>Vive la France !</td><td style='width:30px'>";
   if($row['dlc_france'] == 1) { echo "<img src='img/ok.png' border='0' style='padding-left:10px' />"; } else { echo "<img src='img/not_ok.png' border='0' style='padding-left:10px' />"; }
echo "</td>";

echo "<tr><td width='60px' align='right'>Italia</td><td style='width:30px'>";
   if($row['dlc_italia'] == 1) { echo "<img src='img/ok.png' border='0' style='padding-left:10px' />"; } else { echo "<img src='img/not_ok.png' border='0' style='padding-left:10px' />"; }
echo "</td>";

echo "<td width='60px' align='right'>Beyond the Baltic Sea</td><td style='width:30px'>";
   if($row['dlc_baltic'] == 1) { echo "<img src='img/ok.png' border='0' style='padding-left:10px' />"; } else { echo "<img src='img/not_ok.png' border='0' style='padding-left:10px' />"; }
echo "</td>";

echo "<td width='60px' align='right'>Arizona</td><td style='width:30px'>";
   if($row['dlc_arizona'] == 1) { echo "<img src='img/ok.png' border='0' style='padding-left:10px' />"; } else { echo "<img src='img/not_ok.png' border='0' style='padding-left:10px' />"; }
echo "</td>";

echo "<tr><td width='60px' align='right'>New Mexico</td><td style='width:30px'>";
   if($row['dlc_mexico'] == 1) { echo "<img src='img/ok.png' border='0' style='padding-left:10px' />"; } else { echo "<img src='img/not_ok.png' border='0' style='padding-left:10px' />"; }
echo "</td>";

echo "<td width='60px' align='right'>Oregon</td><td style='width:30px'>";
   if($row['dlc_oregon'] == 1) { echo "<img src='img/ok.png' border='0' style='padding-left:10px' />"; } else { echo "<img src='img/not_ok.png' border='0' style='padding-left:10px' />"; }
echo "</td>";

echo "<td width='60px' align='right'>Washington</td><td style='width:30px'>";
   if($row['dlc_washington'] == 1) { echo "<img src='img/ok.png' border='0' style='padding-left:10px' />"; } else { echo "<img src='img/not_ok.png' border='0' style='padding-left:10px' />"; }
echo "</td>";

echo "</table>";



echo "<table style='width:40%;'><tr>";



$profilbild = $row['profilbild'];
if($profilbild == "") { $profilbild = "kl.png"; } else { $profilbild = $row['profilbild']; }
}
echo "<tr><td>Profilbild:</td></tr>";
echo "<tr><td><img src='img/userimages/".$profilbild."' border='1' style='padding:10px;width:350px' /></td></tr>";


echo "</table>";


?>
