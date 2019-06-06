<?
$statement = $pdo->prepare("SELECT * FROM logfiles ORDER BY id DESC");
$statement->execute(array($email));
echo "<table width='100%' border='1' cellpadding='10'>";
while($row_log=$statement->fetch()) {
  echo "<tr>";
echo "<td width='10%'>".date("d.m.Y - H:i", $row_log['datum'])." Uhr</td>";
echo "<td width='90%'>".$row_log['eintrag']."</td>";


echo "</tr>";
}
?>
