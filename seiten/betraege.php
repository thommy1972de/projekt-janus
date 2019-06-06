<? onlinecheck($pdo); ?>
<?
$id = filter_input(INPUT_GET, "forum", FILTER_VALIDATE_INT);

$statement = $pdo->prepare("SELECT * FROM forenposts WHERE forum = ? ORDER BY id ASC");
$statement->execute(array($id));
echo "<table width='100%' cellpadding='5' cellspacing='5'>";

echo "<tr><td colspan='5'>";
echo "<a class='link' href='?q=qEdaQNmcn15SA1pX4L3OZM5pZKKuE49LkHa8d3ABeKJWBeG5ZymRoYGUr4aW5fFZiZa39pgXVA2jJJNknY12buIUa2YumZBkFnuM'>Startseite</a>";


echo "</td></tr>";

while($row = $statement->fetch()) {

  $user_id = $row['ersteller'];
  $user = $pdo->prepare("SELECT * FROM user WHERE einmalige_id = ? LIMIT 1");
  $user->execute(array($user_id));
  while($row_u = $user->fetch()) {
    $nachname = $row_u['nachname'];
    $vorname = $row_u['vorname'];
  }

  if($user_id == '686ef2068b8fb64eb279bd192053a7a0') { $vorname = "<span style='color:red;'>Projekt: JANUS!</span>"; $nachname = ""; }

  $titel = $row['titel'];
  $datum = date('d.m.Y', $row['uhrzeit']);
  $uhr = date('H:i', $row['uhrzeit']);

  echo "<tr><td style='padding:20px;background:#2E2E2E'><h3>Von ".utf8_encode($vorname)." ".substr($nachname, 0,1)."  schrieb am ".$datum." um ".$uhr." Uhr</h3><h2>".utf8_encode($row['titel'])."</h2><hr>";
  echo nl2br(utf8_encode($row['inhalt']))."<br>";
  echo "</td></tr>";



}

if($_GET['ant'] == 1) {
  echo "<tr><td>";
  ?><center>
  <form action="#" method="POST">

    <textarea name="ant_text" rows="5" style="width:80%"></textarea><br><br>
    <input type="submit" name="ant_senden" class="btn_green" value="Antwort absenden" />
  </form>
</center>
<?   echo "</td></tr>"; } else { echo "<center><h2>Antworten sind in diesem Forum gesperrt !</h2></center>"; }

echo "</table>";





if(isset($_POST['ant_senden'])) {

  $inhalt = filter_input(INPUT_POST, "ant_text", FILTER_SANITIZE_STRING);
  $uhrzeit = TIME();

  $user = $pdo->prepare("SELECT * FROM user WHERE email = ? LIMIT 1");
  $user->execute(array($_SESSION['username']));
  while($row_u2 = $user->fetch()) {
    $user_id2 = $row_u2['einmalige_id'];
  }

  $titel_ant = "<u>RE:</u> ".$titel;
  try {
  $antwort = $pdo->prepare("INSERT INTO forenposts (forum, titel, inhalt,ersteller) VALUES (:forum,:titel,:inhalt,:ersteller)");
  $antwort->bindParam(':forum', $_GET['forum']);
  $antwort->bindParam(':titel', $titel_ant);
  $antwort->bindParam(':inhalt', $inhalt);
  $antwort->bindParam(':ersteller', $user_id2);
  $antwort->bindParam(':uhrzeit', $uhrzeit);
  $antwort->execute();
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}
  ?>
  <meta http-equiv="refresh" content="0; URL=?q=qEdaQNmcn15SA1pX4L3OZM5pZKKuE49LkHa8d3ABeKJWBeG5ZymRoYGUr4aW5fFZiZa39pgXVA2jJJNknY12buIUa2YumZBkFnuM">
  <?
}
?>
