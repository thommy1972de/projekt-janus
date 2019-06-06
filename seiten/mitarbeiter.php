<? onlinecheck($pdo); ?><h2>Deine Mitarbeiter</h2>
<div style="margin-left:100px;">
  <?
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
$stmt4 = $pdo->prepare("SELECT * FROM user WHERE in_spedition = ?");
$stmt4->execute(array($id));
while($row = $stmt4->fetch()) {

  echo $row['vorname']. " ".$row['nachname'];
 }



?>
</div>
