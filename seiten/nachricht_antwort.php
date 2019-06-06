<? onlinecheck($pdo); ?><h2><?=pfeil_back();?> Nachricht Beantworten</h2>
<center>
  <form action="#" method="POST">

<br>
Betreff der Nachricht: <input type="text" name="betreff" size="145" placeholder="Betreff" /><br>
<textarea name="inhalt" cols="133" rows="10" style="border-radius:10px; border:0; padding:10px;"></textarea>
<br><br>


<input type="hidden" name="einmalige_id" value="<?=$_POST['einmalige_id']; ?>" />

<input class="btn_senden" type="submit" name="senden6" value="Abschicken" />

</form>
</center>
<?
if(isset($_POST["senden6"])) {


$an_user = filter_input(INPUT_POST, "an_user", FILTER_VALIDATE_INT);
$titel = filter_input(INPUT_POST, "betreff", FILTER_SANITIZE_STRING);
$inhalt = filter_input(INPUT_POST, "inhalt", FILTER_SANITIZE_STRING);
$einmalige_id1 = filter_input(INPUT_POST, "einmalige_id", FILTER_SANITIZE_STRING);
$einmalige_id2 = uniqid(mt_rand(), true);

$von_user = $_SESSION['username'];

$statement = $pdo->prepare("SELECT * FROM messages WHERE einmalige_id = ?");
$statement->execute(array($einmalige_id1));
while($row2=$statement->fetch()) { $em2 = $row2['von_user']; }

$uhrzeit = TIME();

$stmt3 = $pdo->prepare("INSERT INTO messages (uhrzeit, von_user, an_user, titel, inhalt, einmalige_id) VALUES (:uhrzeit, :von_user, :an_user, :titel, :inhalt, :einmalige_id2)");
$stmt3->bindParam(':uhrzeit', $uhrzeit);
$stmt3->bindParam(':von_user', $von_user);
$stmt3->bindParam(':an_user', $em2);
$stmt3->bindParam(':titel', $titel);
$stmt3->bindParam(':inhalt', $inhalt);
$stmt3->bindParam(':einmalige_id2', $einmalige_id2);
$stmt3->execute();

$logeintrag = utf8_decode('Es wurde auf eine Nachricht von '.$an_user.' geantortet.');
$logeintrag .= utf8_decode('<br>Betreff: '.$titel);
$logeintrag .= utf8_decode('<br>Inhalt: '.$inhalt);
$logeintrag .= utf8_decode('<br>Uhrzeit: '.date("d.m.Y - H:i",$uhrzeit).' Uhr');
$logeintrag .= utf8_decode('<br>Unique ID: '.$einmalige_id2);
logbucheintrag($logeintrag, $pdo);

?>
<meta http-equiv="refresh" content="0; URL=?q=KX8ZpI1TKZjLr1GWbBkMLfNbZuvsdAwJYL6QEjA8VmJrk3FACQY84sbslpc9GGuKiM7gtc3fEHVJfUR3jXkH4SZsKCirvSbPntnH">
<?

}
?>
