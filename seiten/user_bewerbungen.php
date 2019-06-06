<? onlinecheck($pdo); ?>
<h2>Bewerbungen für deine Spedition</h2>
<?
$stmt4 = $pdo->prepare("SELECT * FROM firmen WHERE email = :email");
$stmt4->bindParam(':email', $_SESSION['username']);
$stmt4->execute();
while($row2 = $stmt4->fetch()) { $ein_id = $row2['einmalige_id']; }




$stmt412 = $pdo->prepare("SELECT * FROM bewerbungen WHERE an_firma = ?");
$stmt412->execute(array($ein_id));
while($row = $stmt412->fetch()) {

  // UPDATE Bewerbung
  $update = $pdo->prepare("UPDATE bewerbungen SET gelesen = '1' WHERE id = :f_id");
  $update->bindParam(':f_id', $row['id']);
  $update->execute();





  $stmt413 = $pdo->prepare("SELECT * FROM user WHERE email = ?");
  $stmt413->execute(array($row['von_user']));
  while($row3 = $stmt413->fetch()) {
    $user_e_id = $row3['einmalige_id'];
    if($row3['bewerbungs_email'] == 1) {
      echo "Email senden!";
    }




echo "<table width='60%' style='float:left;'><tr>";

echo "<tr><td width='200px' align='right'>Bewerber Name: </td><td><a class='link' href='?q=oQVloXhGyxwmFyIqnbznZ89QvvEsXz1TbIlwJafYV8ffc6IVieaU6bC7qrhhgTZEMBo9gvrCw8PCrul4ZwFheqRNJXHscYDXXoTI&ufrtbfbdsfs=".$row3['einmalige_id']."'>".$row3['nachname']." ".$row3['vorname']."</a></td></tr>";
echo "<tr><td width='200px' align='right'>Bewerbungstext: </td><td>".$row['bew_text']."</td></tr>";


echo "</table>";
}
}


$stmt413 = $pdo->prepare("SELECT * FROM fahrer WHERE fahrer_id = :fahrer_id AND sped_id =:sped_id");
$stmt413->bindParam(':fahrer_id', $user_e_id);
$stmt413->bindParam(':sped_id', $ein_id);
$stmt413->execute();

if($stmt413->rowCount() >= 1) { echo "Du hast diesen Fahrer schon eingestellt !"; } else {
echo "<a class='btn_senden' href='?q=G5cs6tTXaIFV72a5UAajA69Bar1B143WsOeE1U62xjRK8MTHnfEn0tRxabOg5PHMTs7mh0QJulUaAgPb3IYmoCfv6MvaKjDbu3UC&keretimat=".$user_e_id."&sped_id=".$ein_id."'>Fahrer einstellen</a>";
}
?>
