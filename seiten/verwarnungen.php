<? onlinecheck($pdo); ?>
<?=pfeil_back();?><h2>Verwarnungen</h2>
<?
$user_id = filter_input(INPUT_GET, "terebskptlq", FILTER_SANITIZE_STRING);

$sql_verw = $pdo->prepare("SELECT * FROM verwarnungen WHERE einmalige_id = :uniq_id ORDER BY datum DESC");
$sql_verw->bindParam(':uniq_id',$user_id);
$sql_verw->execute();
$i = 1;
echo "<table width='1000px' cellspacing='10' cellpadding='5'>";
while($row_v = $sql_verw->fetch()) {
  if($i == 1) {
    echo "<td width='150px' align='left' valign='top' style='border-bottom:1px solid grey; border-top:1px solid grey;'>".date("d.m.Y - H:i", $row_v['datum'])." Uhr</td>";
  } else {
    echo "<td width='150px' align='left' valign='top' style='border-bottom:1px solid grey;'>".date("d.m.Y - H:i", $row_v['datum'])." Uhr</td>";
}
if($i == 1) {
  echo "<td width='850px' align='left' valign='top' style='border-bottom:1px solid grey;border-top:1px solid grey;'>".$row_v['verstoss']."</td><tr>";
} else {
  echo "<td width='850px' align='left' valign='top' style='border-bottom:1px solid grey;'>".utf8_encode($row_v['verstoss'])."</td><tr>";
}

  $i++;
}
echo "</table>";
?>
