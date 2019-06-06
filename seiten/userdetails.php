<? onlinecheck($pdo); ?>

<h2>Dein Profil  <a href="?q=QSNiuE1TcGw8TaCw7WCVdOw4MOlb2FYDEJPyrI5RKaqv4iuEhNBnG0NjC7m2nyCCc6rId7VbyNhR6RhZbYfLZhVf6JpP0hdRNvDQ"><img alt="Dein Profil ändern" title="Dein Profil ändern" src="img/edit.png" border="0" style="margin-left:20px; margin-bottom:-3px;width:24px" /></a></h2>
<?


$stmt4 = $pdo->prepare("SELECT * FROM user WHERE email = :email");
$stmt4->bindParam(':email', $_SESSION['username']);
$stmt4->execute();

echo "<table width='60%' style='float:left;'><tr>";
while($row = $stmt4->fetch()) {


if(empty($row['steam_id'])) {
    $json_url2 = "https://api.truckyapp.com/v2/truckersmp/player?playerID=".$row['truckers_mp'];
    $json2 = file_get_contents($json_url2);
    $data2 = json_decode($json2, TRUE);
    $steam_id_neu = $data2['response']['response']['steamID64'];


      $steameintrag = $pdo->prepare("UPDATE user SET steam_id = :steam WHERE email = :email");
      $steameintrag->bindParam(':steam', $steam_id_neu);
      $steameintrag->bindParam(':email', $_SESSION['username']);
      $steameintrag->execute();
}

if($plz == 0) { $plz = "---"; } else {$plz = $row['plz']; }

if(empty($row['facebook'])) { $facebook = "n.A."; } else { $facebook = "<a href='https://www.facebook.com/".$row['facebook']."' target='_blank'>".$row['facebook']."</a>"; }

echo "<tr><td width='60px' align='right'>Dein Vorname:</td><td>".$row['vorname']."</td></tr>";
echo "<tr><td align='right'>Dein Nachname:</td><td>".$row['nachname']."</td></tr>";
echo "<tr><td align='right'>PLZ:</td><td>".$plz."</td></tr>";
echo "<tr><td align='right'>Mobil:</td><td>".$row['tel_mobil']."</td></tr>";
echo "<tr><td align='right'>Facebook:</td><td>".$facebook."</td></tr>";
echo "<tr><td align='right'>Discord: #</td><td>".$row['discord']."</td></tr>";
echo "<tr><td align='right'>TruckersMP-ID: #</td><td>".$row['truckers_mp']."</td></tr>";
echo "<tr><td align='right'>Steam-ID: #</td><td><a class='link' target='_blank' href='https://steamcommunity.com/profiles/".$row['steam_id']."'>".$row['steam_id']."</a></td></tr>";

echo "<tr><td align='right'>Du spielst mit:</td><td>".$row['steuerung']."</td></tr>";
echo "<tr><td align='right'>Dein LKW in ETS2:</td><td>".$row['lkw_ets']."</td></tr>";
echo "<tr><td align='right'>Dein LKW in ETS2:</td><td>".$row['lkw_ats']."</td></tr>";
echo "<tr><td align='right'>Deine Stadt in ETS2:</td><td>".$row['stadt_ets']."</td></tr>";
echo "<tr><td align='right'>Deine Stadt in ATS:</td><td>".$row['stadt_ats']."</td></tr>";

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
echo "<tr><td>Profilbild: (Zum Ändern, anklicken)</td></tr>";
echo "<tr><td><a href='?q=H8eDZU12NCwcfOGeqyUP1bxOyVbM4hOR34njdVYWQaC2z4gzpQkEGtwobQht24UAsJYLnPhR0uptxxmAbKGaVjjgFS2Qe6hycwTc'><img src='img/userimages/".$profilbild."' border='1' style='padding:10px;width:200px' /></a></td></tr>";


echo "</table>";


?>
