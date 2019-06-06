<? onlinecheck($pdo); ?><h2>Alle Events</h2>
<?
$events = $pdo->prepare("SELECT * FROM events");
$events->execute();

echo "<center><table width='98%' cellpadding='5'>";
echo "<tr>";
echo "<td width='50px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>Info</td>";
echo "<td width='100px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>Datum</td>";
echo "<td width='150px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>Uhrzeit</td>";
echo "<td width='350px' align='left' style='background: #2E2E2E;border-bottom:1px solid grey;'>Von</td>";
echo "<td width='350px' align='left' style='background: #2E2E2E;border-bottom:1px solid grey;'>Nach</td>";
echo "<td width='200px' align='left' style='background: #2E2E2E;border-bottom:1px solid grey;'>Server</td>";
echo "<td width='100px' align='left' style='background: #2E2E2E;border-bottom:1px solid grey;'>Zusagen</td>";
echo "<td width='70px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>Absagen</td>";
echo "<td></td>";
echo "</tr>";
echo "</table>";

echo "<table width='98%' cellpadding='5'>";

while($row_e = $events->fetch()) {

  $datum1 = explode("-", $row_e["datum"]);
  $tag = $datum1[2];
  $monat = $datum1[1];
  $jahr = $datum1[0];
  $nummer_alt = $row_e['id'];
  $nummer_neu = $row_e['id']+46983464;

  $zusagen = $pdo->prepare("SELECT * FROM event_teilnehmer WHERE event_id = ? AND entscheidung = ?");
  $zusagen->execute(array($nummer_alt, "Zusage"));
  $anz_zusagen = $zusagen->rowCount();

  $absagen = $pdo->prepare("SELECT * FROM event_teilnehmer WHERE event_id = ? AND entscheidung = ?");
  $absagen->execute(array($nummer_alt, "Absage"));
  $anz_absagen = $absagen->rowCount();



  echo "<tr>";
  echo "<td width='50px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'><a class='link' href='?event=".$nummer_neu."&q=VQSgWN2CfvBUhEIHezKXRsO3Zk6xq1y5FljMi47TGbtwn8DAap0Ym9JrdcLu'>Info</a></td>";
  echo "<td width='100px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>".$tag.".".$monat.".".$jahr."</td>";
  echo "<td width='150px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>".$row_e['uhrzeit']." Uhr</td>";
  echo "<td width='350px' align='left' style='background: #2E2E2E;border-bottom:1px solid grey;'>".$row_e['von_wo']."</td>";
  echo "<td width='350px' align='left' style='background: #2E2E2E;border-bottom:1px solid grey;'>".$row_e['nach_wo']."</td>";
  echo "<td width='200px' align='left' style='background: #2E2E2E;border-bottom:1px solid grey;'>".$row_e['server']."</td>";
  echo "<td width='100px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>".$anz_zusagen."</td>";
  echo "<td width='70px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>".$anz_absagen."</td>";
  echo "<td></td>";
  echo "</tr>";

    }

echo "</table><br><br><a class='btn_senden' href='?q=qLBUhJkpwoOaPd5VselfiMxCS09EYTFWb4gynt8NKcQ16H2Iz7u3jADmvrZR'>Neues Event erstellen</a></center>";
    ?>
