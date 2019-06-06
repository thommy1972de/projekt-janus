<h1>User</h1>
<?
$statement = $pdo->prepare("SELECT * FROM user ORDER BY id DESC");
$statement->execute();
echo "<table width='80%' cellpadding='10'>";
while($row = $statement->fetch()) {

echo "<tr><td width='20px'>".$row['id']."</td>";
echo "<td width='100px'>".$row['vorname']."</td>";
echo "<td width='100px'>".$row['nachname']."</td>";
echo "<td width='100px'>".$row['email']."</td>";
if($row['freigabe'] == 0) { echo "<td width='100px'><a href='?q=freigabe&id=".$row['id']."'>".$row['freigabe']." Freigeben</a></td>"; } else {
  echo "<td width='100px'><a href='?q=sperren&id=".$row['id']."'>".$row['freigabe']." Sperren</a></td>";
}
echo "<td width='100px'>".$row['client_key']."</td></tr>";
}
echo "</table>";
