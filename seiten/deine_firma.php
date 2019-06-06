
<? onlinecheck($pdo); ?><h2>Deine Firma</h2>
<!-- Your share button code -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v3.3"></script>

<?
$stmt4 = $pdo->prepare("SELECT * FROM firmen WHERE email = :email");
$stmt4->bindParam(':email', $_SESSION['username']);
$stmt4->execute();


while($row = $stmt4->fetch()) {

// Offene Bewerbungen laden //

  $e_id = $row['einmalige_id'];
  $stmt411 = $pdo->prepare("SELECT * FROM bewerbungen WHERE an_firma = ? AND gelesen = 0");
  $stmt411->execute(array($row['einmalige_id']));
  $anz_21 = $stmt411->rowCount();
  if($anz_21 >=1) { $jetzt_l = "<a class='link' href='?q=la5xBRZdfUcDgkMw7SwQVI9AtNSR6I0Kbf7EUaV4CFYRaLdekL9f6vdb7k3lLWpYoTmwn0ws3R6UBVSi9vRoJQGmOsFoeM1QEEUj'>Jetzt lesen</a>"; } else { $jetzt_l = "<a href='?q=la5xBRZdfUcDgkMw7SwQVI9AtNSR6I0Kbf7EUaV4CFYRaLdekL9f6vdb7k3lLWpYoTmwn0ws3R6UBVSi9vRoJQGmOsFoeM1QEEUj'>Zum Bewerberportal</a>";; }

  $stmt412 = $pdo->prepare("SELECT * FROM bewerbungen WHERE an_firma = ?");
  $stmt412->execute(array($row['einmalige_id']));
  $anz_22 = $stmt412->rowCount();



  $id_fa = $row['id'];
  $firmenname = $row['firmenname'];
  $firmenlogo = $row['firmen_logo'];
  $firmenheader = $row['firmen_header'];
  $firmen_id = $row["id"];
  $werbebild = $row["werbebild"];
  $werbetext = $row["werbetext"];
  $ts_server = $row['teamspeak_url'];
  $ts_port = $row['teamspeak_port'];
  $abrechnungssystem = $row['abrechnungssystem'];
  $mindestalter = $row['mindestalter'];

  if($mindestalter == 0) { $mindestalter = MINDESTALTER; }

  if($firmenlogo == "") { $firmenlogo = "kl.png"; } else { $firmenlogo = $row['firmen_logo']; }
  if($firmenheader == "") { $firmenheader = "kl1.png"; } else { $firmenheader = $row['firmen_header']; }
  if($row['premium'] == 0) { $premium = "Kein Premium aktiviert !"; } else { $premium = "<img src='https://img.icons8.com/flat_round/100/000000/crown.png' style='width:24px; padding:5px; margin-bottom:-10px;'><span style='color:orange;'>Premium aktiv bis ".date('d.m.Y', $row['premium_bis'])."</span>"; }


echo "<table width='60%' style='float:left;' cellpadding='5'><tr>";
echo "<tr><td width='200px' align='right'>Firmenname:</td><td>".$row['firmenname']."</td></tr>";
echo "<tr><td width='200px' align='right'>Premium-Dienste:</td><td>".$premium."</td></tr>";
echo "<tr><td width='200px' align='right'>Erstellt am:</td><td>".date('d.m.Y', $row['datum'])." um ".date('H:i', $row['datum'])." Uhr</td></tr>";
echo "<tr><td width='200px' align='right'>Mitarbeiter:</td><td><a href='?q=rVsuDuaj1ZAd6iRviHVfGWwerVnGg53vnPKFB1ZblLqv81odn8meTgHH56jEIYO5PF8AvHECGicUyJjX9sVYOpJSmOECZQthI1b2&id=".$id_fa."'>".$row['mitarbeiter']." Anzeigen</a></td></tr>";
echo "<tr><td width='200px' align='right' valign='top'>Offene Bewerbungen:</td><td>".$anz_21." ".$jetzt_l."<br>(Gesamt: ".$anz_22.")</td></tr>";
}

echo "<tr><td colspan='2' style='background:#2E2E2E; text-align:center;'><h2 style='margin-top:20px;'>Werbe-Einstellungen</h2></td></tr>";
echo "<tr><td width='200px' align='right'>Facebook:</td><td>";
?>
<a class="btn_green" href="https://www.facebook.com/sharer/sharer.php?u=<?=URL;?>/f_ann.php?id=<?=$id_fa;?>" target="_blank">
  Werben auf Facebook
</a>
<? echo "</td></tr>";

if(empty($werbebild)) { $werbebild = "werbung_1.jpg"; }

echo "<tr><td width='200px' align='right' valign='top'>Dein Werbebild:</td><td>


<img src='img/firmenwerbung2/".$werbebild."' border='0' width='350px' />

</td></tr>";

echo "<tr><td width='200px' align='right' valign='top'>Dein Werbebild:</td><td>";
?>
<form action="#" method="POST">
  <input type="hidden" name="idnummer" value="<?=$id_fa;?>" />
<select name="werbeschild" onchange="this.form.submit()">
  <option value="werbung_1.jpg" <? if($werbebild == "werbung_1.jpg") { echo "selected"; } ?>>Schild 1</option>
  <option value="werbung_2.jpg" <? if($werbebild == "werbung_2.jpg") { echo "selected"; } ?>>Schild 2</option>
  <option value="werbung_3.jpg" <? if($werbebild == "werbung_3.jpg") { echo "selected"; } ?>>Schild 3</option>
  <option value="werbung_4.jpg" <? if($werbebild == "werbung_4.jpg") { echo "selected"; } ?>>Schild 4</option>
  <option value="werbung_5.jpg" <? if($werbebild == "werbung_5.jpg") { echo "selected"; } ?>>Schild 5</option>
  <option value="werbung_6.jpg" <? if($werbebild == "werbung_6.jpg") { echo "selected"; } ?>>Schild 6</option>
  <option value="werbung_7.jpg" <? if($werbebild == "werbung_7.jpg") { echo "selected"; } ?>>Schild 7</option>
  <option value="werbung_8.jpg" <? if($werbebild == "werbung_8.jpg") { echo "selected"; } ?>>Schild 8</option>
</select>
</form>
<?
echo "</td></tr>";
echo "<form action='?q=ALYxvq8vyUnY1i9E0cRd9KZnpqSPwOtC7MshKIBKqCMRBfZjNKVl8nzOSau3bJy23mFcqkLPaVqzVdT2Ybrj6Oi4lx6fY05CXBkI' method='POST'>";
echo "<tr><td width='200px' align='right' valign='top'>Dein Werbe-Text:</td><td>";
?>
  <textarea name="werbetext" cols="70" rows="5"><?=$werbetext; ?></textarea>
<br>(Facebook erkennt keine Zeilenumbrüche ! Alles wird in eine Reihe geschrieben !)
<?
echo "</td></tr>";


echo "<tr><td colspan='2' style='background:#2E2E2E; text-align:center;'><h2 style='margin-top:20px;'>Sonstige Einstellungen</h2></td></tr>";

echo "<input type='hidden' name='idnummer' value='".$id_fa."' />";
echo "<tr><td width='200px' align='right'>Teamspeak-Server:</td><td><input type='text' size='35' name='teamspeak_server' placeholder='IP oder http:// Adresse' value='".$ts_server."' /> <span style='position:relative; font-size:28px;'>:</span> <input type='text' size='4' name='teamspeak_port' placeholder='1234' value='".$ts_port."' /></td></tr>";

echo "<tr><td width='200px' style='margin-bottom:150px' align='right'>Abrechnung:</td><td>";

echo "<select name='abrechnungssystem'>";
?>
<option <? if($abrechnungssystem == "") { echo "selected"; } ?>>Auswahl</option>
<option value="SPED-V" <? if($abrechnungssystem == "SPED-V") { echo "selected"; } ?>>SPED-V</option>
<option value="TrucksBook" <? if($abrechnungssystem == "TrucksBook") { echo "selected"; } ?>>TrucksBook</option>
<option value="Trucking VS" <? if($abrechnungssystem == "Trucking VS") { echo "selected"; } ?>>Trucking VS</option>
<option value="Sonstige" <? if($abrechnungssystem == "Sonstige") { echo "selected"; } ?>>Sonstige</option>
<?
echo "</select>";
echo "</td></tr>";


echo "<tr><td width='200px' align='right'>Mindestalter:</td><td><select name='mindestalter'>";

$i = $mindestalter;
while($i <= 99) { ?>
  <option value="<?=$i;?>" <? if($i == $mindestalter) { echo "selected"; } ?>><?=$i;?></option>
<?
$i++;
}


echo "</select>";
echo "</td></tr>";

echo "<tr><td width='200px' align='right'></td><td><input type='submit' name='update_firma' class='btn_green' value='Firmendaten editieren' /></td></tr>";

echo "<tr><td width='200px' style='padding-bottom:100px;' align='right'>&nbsp;</td><td></td></tr>";


echo "</form></table><br><br><br>";

echo "<table style='width:40%;'><tr>";

echo "<tr><td>Firmen-Logo: (Zum Ändern, anklicken)</td></tr>";
echo "<tr><td><a href='?q=LaKDJoiCwnuRsezIPzEUBeJHYFhWM8UcaUHJVg4CkiMEz9XNi2F72pFunQscghwXWHHO4kGFKL04wha6uR3g796Zdxm0OZ5pNER5'><img src='img/firmenlogos/".$firmenlogo."' border='1' style='padding:10px;width:200px' /></a></td></tr>";

echo "<tr><td style='padding-top:50px'>Firmen-Header: (Zum Ändern, anklicken)</td></tr>";
echo "<tr><td><a href='?q=XOdIJuwyguxB8KwRAxNL0Wcx8tGOgRfyT1u2TYfa5DI8TSjuMGsrNi4yYhn71p7OhVo86umg30XsjzbJfQd4x1YUjmvJP3WcnvJo'><img src='img/firmenheader/".$firmenheader."' border='1' style='padding:10px;width:500px' /></a></td></tr>";

echo "</table>";




if(isset($_POST["werbeschild"])) {

$schild = $_POST["werbeschild"];
$idnummer = $_POST["idnummer"];

$stmt3 = $pdo->prepare("UPDATE firmen SET werbebild = :schild WHERE id = :idnummer");
$stmt3->bindParam(':schild', $schild);
$stmt3->bindParam(':idnummer', $idnummer);
$stmt3->execute();

?>
<meta http-equiv="refresh" content="0; URL=?q=pWqaLqQmWSK2QgjLJRneDWLi7yVSjp7emExFpgldauYiOke6Dg5dTDxoaUzYPU3y6aNrOMXmD08ZJC3zzi8c3svA1YH2YOLujOWT">
<?

}



?>
