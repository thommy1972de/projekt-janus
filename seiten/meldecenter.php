<? onlinecheck($pdo);
$statement971 = $pdo->prepare("SELECT * FROM user WHERE email = ?");
$statement971->execute(array($_SESSION["username"]));
while($row_m1 = $statement971->fetch()) { $melder = $row_m1['einmalige_id']; }

$statement972 = $pdo->prepare("SELECT * FROM meldungen WHERE melder = ?");
$statement972->execute(array($melder));


echo "<center><table width='98%' cellpadding='5'>";
echo "<tr>";
echo "<td width='50px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>Abbr.</td>";
echo "<td width='150px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>Datum</td>";
echo "<td width='200px' align='left' style='background: #2E2E2E;border-bottom:1px solid grey;'>Gemeldeter User</td>";
echo "<td width='350px' align='left' style='background: #2E2E2E;border-bottom:1px solid grey;'>Verstoss</td>";
echo "<td width='150px' align='left' style='background: #2E2E2E;border-bottom:1px solid grey;'>Bearbeiter</td>";
echo "<td width='100px' align='left' style='background: #2E2E2E;border-bottom:1px solid grey;'>Status</td>";
echo "<td width='70px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>Berechtigt</td>";
echo "<td width='350px' align='left' style='background: #2E2E2E;border-bottom:1px solid grey;'>Ablehnungsgrund</td>";
if(rang($_SESSION['username'], $pdo) == 3) {
  echo "<td width='100px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>DEL</td>";
}
echo "<td></td>";
echo "</tr>";
echo "</table>";

echo "<table width='98%' cellpadding='5'>";
  while($row_m = $statement972->fetch()) {
    $statement973 = $pdo->prepare("SELECT * FROM user WHERE einmalige_id = ?");
    $statement973->execute(array($row_m['gemeldeter_user']));
    while($row_m2 = $statement973->fetch()) {
      $name = $row_m2['nachname']." ".$row_m2['vorname'];

    }


    if($row_m['bearbeiter'] == "") { $bearbeiter = "---"; } else { $bearbeiter = $row_m['bearbeiter']; }
    if($row_m['status'] == "") { $status = "---"; } else { $status = $row_m['status']; }
    if($row_m['berechtigt'] == "") { $berechtigt = "---"; } else { $berechtigt = $row_m['berechtigt']; }
        echo "<tr>";
        if($row_m['fertig'] == 'ja') {
          echo "<td width='50px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>---</td>";
        } else {
          echo "<td width='50px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'><a href='?fethilop=".$row_m['einmalige_id']."&q=MkEM39xz0EwLa4MQiSOzbVrW1B385K1DIpmXEOLtGpa56v4rSHXQL44X3iWhPnGgeru4zavTKQEnAhqYYJQ4VSpWAOCFDYfINiYm'><img src='img/not_ok.png' border='0' style='' alt='Meldung abbrechen' title='Meldung abbrechen' /></a></td>";
        }
        echo "<td width='150px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>".date('d.m.Y - H:i', $row_m['datum'])." Uhr</td>";
        echo "<td width='200px' align='left' style='background: #2E2E2E;border-bottom:1px solid grey;'>".$name."</td>";
        echo "<td width='350px' align='left' style='background: #2E2E2E;border-bottom:1px solid grey;'>".$row_m['verstoss']."</td>";
        echo "<td width='150px' align='left' style='background: #2E2E2E;border-bottom:1px solid grey;'>".$bearbeiter."</td>";
        echo "<td width='100px' align='left' style='background: #2E2E2E;border-bottom:1px solid grey;'>".$status."</td>";
        echo "<td width='70px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>".$berechtigt."</td>";
        echo "<td width='350px' align='left' style='background: #2E2E2E;border-bottom:1px solid grey;'>".$row_m['ablehnungsgrund']."</td>";
        if(rang($_SESSION['username'], $pdo) == 3) {
          echo "<td width='100px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'><a class='btn_red' href='#'>DEL</a></td>";
        }
        echo "<td></td>";
        echo "</tr>";
    }
echo "</table></center>";
    ?>
