<h2>Deine Freunde bei Steam</h2>
<?
$stmt4 = $pdo->prepare("SELECT * FROM user WHERE email = :email");
$stmt4->bindParam(':email', $_SESSION['username']);
$stmt4->execute();
while($row = $stmt4->fetch()) { $steam_id = $row['steam_id']; }

if(!isset($steam_id)) { echo "<center>Du hast keine Steam ID angegeben !<br>Gehe in dein Profil und ändere deine STEAM-ID.</center>"; } else {

  $json_url = "https://api.truckyapp.com/v2/steam/getFriendsData?steamid=".$steam_id;
  $json = file_get_contents($json_url);
  $data = json_decode($json, TRUE);
  $anz = count($data['response']);
  $soll = 0;
  $ter = 0;
  echo "<table width='100%'>";

  while($soll <= $anz-1) {
    echo "<td width='250px' align='center' style='border:1px solid grey'>";
    echo "<h4>STEAM</h4></center>";
    echo "<a href='".$data['response'][$soll]['steamUser']['profileurl']."' target='_blank'>".ucfirst($data['response'][$soll]['steamUser']['personaname'])."<br>";
    echo "<img src='".$data['response'][$soll]['steamUser']['avatarfull']."' style='width:150px' border='0' /></a><br>";
    echo $data['response'][$soll]['steamUser']['realname']."<br>";
    echo "<hr><h4>Truckers-MP</h4></center>";
    echo "Name: ".$data['response'][$soll]['truckersMPUser']['name']."<br>";
    echo "ID: ".$data['response'][$soll]['truckersMPUser']['id']."<br>";
    echo "Gruppe: ".$data['response'][$soll]['truckersMPUser']['groupName']."<br>";

    if($data['response'][$soll]['truckersMPUser']['banned'] == false) { $gebannt = "Nein"; } else { $gebannt = "<span style='color:red'>Ja</span>"; }
    echo "Gebannt: ".$gebannt."<br><br>";



    echo "</td>";

    $ter++; if($ter == 5) { echo "<tr>"; $ter = 0; }
    $soll++;
  }
  echo "</table>";
}
