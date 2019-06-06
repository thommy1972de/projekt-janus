<h1>Meldungen</h1>
<?
$statement = $pdo->prepare("SELECT * FROM meldungen ORDER BY id DESC");
$statement->execute();
echo "<table width='100%' cellpadding='10' style='background: lightgrey; color:#000;'>";
echo "<tr><td width='30px'>ID</td>";
echo "<td width='150px'>Melder</td>";
echo "<td width='150px'>Gemeldeter</td>";
echo "<td width='400px'>Verstoss</td>";
echo "<td width='150px'>Datum / Uhrzeit</td>";
echo "<td width='200px'>Status</td>";
echo "<td width='150px'>Bearbeiter</td>";
echo "<td width='50px'>Berechtigt</td>";
echo "<td width='200px'>Ablehnungsgrund</td>";
echo "</table>";
echo "<table width='100%' cellpadding='10'>";
while($row = $statement->fetch()) {

echo "<tr><td width='30px'>".$row['id']."</td>";
echo "<td width='150px'>".username_admin ($row['melder'], $pdo)."</td>";
echo "<td width='150px' align='left'>".username_admin ($row['gemeldeter_user'], $pdo)."</td>";
echo "<td width='400px'><a href='?q=meldung_bearbeiten&id=".$row['id']."'>".$row['verstoss']."</a></td>";
echo "<td width='150px'>".date('d.m.Y - H:i', $row['datum'])."Uhr</td>";
echo "<td width='200px'>".$row['status']."</td>";
echo "<td width='150px'>".$row['bearbeiter']."</td>";
echo "<td width='50px'>".$row['berechtigt']."</td>";
echo "<td width='200px'>".$row['ablehnungsgrund']."</td>";

}
echo "</table>";
