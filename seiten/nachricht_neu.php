<? onlinecheck($pdo); ?><h2><?=pfeil_back();?> Neue Nachricht</h2>
<center>
  <form action="#" method="POST">

An wen geht die Nachricht ?<br>
  <select name="an_user" style="width:150px">
    <?

    $statement99 = $pdo->prepare("SELECT * FROM freundesliste WHERE user = ?");
    $statement99->execute(array(user_id($pdo)));
    while($row99 = $statement99->fetch()) {

      $statement101 = $pdo->prepare("SELECT * FROM user WHERE einmalige_id = ?");
      $statement101->execute(array($row99['freund']));



      while($row101 = $statement101->fetch()) { $id_nu = $row101['id'];  $name = $row101['vorname']; $nachname = substr($row101['nachname'],0 ,1); }
      ?>
      <option value="<?=$id_nu;?>"><?=$name;?> <?=$nachname; ?>.</option>

    <? } ?>
  </select> oder <a href="?q=WO5kP2yk95kf70rD0ok6dN3jZTOi0LVF6GWp4yDKTjToOGgxiBWNUxY625LvPMwuB69FYOSmhORbYuVmzUvA5f54S5EuesVpOQz0">Nach Freunden suchen <img style="width:32px; margin-bottom:-11px" src="https://img.icons8.com/office/40/000000/search-contacts.png"></a>
<br>
<br><input type="text" name="betreff" size="100" placeholder="Betreff" /><br>
<textarea name="inhalt" cols="133" rows="10" style="border-radius:10px; border:0; padding:10px;"></textarea>
<br><br>

<input class="btn_senden" type="submit" name="senden" value="Abschicken" />

</form>
</center>
<?
if(isset($_POST["senden"])) {

$an_user = filter_input(INPUT_POST, "an_user", FILTER_VALIDATE_INT);
$titel = filter_input(INPUT_POST, "betreff", FILTER_SANITIZE_STRING);
$inhalt = filter_input(INPUT_POST, "inhalt", FILTER_SANITIZE_STRING);
$einmalige_id = uniqid(mt_rand(), true);
$von_user = $_SESSION['username'];

$statement = $pdo->prepare("SELECT * FROM user WHERE id = ?");
$statement->execute(array($an_user));
while($row2=$statement->fetch()) { $em2 = $row2['email']; $an_user_vorname = $row2['vorname']; $an_user_nachname = $row2['nachname'];}

$uhrzeit = TIME();

$stmt3 = $pdo->prepare("INSERT INTO messages (uhrzeit, von_user, an_user, titel, inhalt, einmalige_id) VALUES (:uhrzeit, :von_user, :an_user, :titel, :inhalt, :einmalige_id)");
$stmt3->bindParam(':uhrzeit', $uhrzeit);
$stmt3->bindParam(':von_user', $von_user);
$stmt3->bindParam(':an_user', $em2);
$stmt3->bindParam(':titel', $titel);
$stmt3->bindParam(':inhalt', $inhalt);
$stmt3->bindParam(':einmalige_id', $einmalige_id);
$stmt3->execute();

$logeintrag = utf8_decode('Es wurde eine Nachricht von '.$von_user.' an '.$an_user_vorname.' '.$an_user_nachname.' geschrieben');
$logeintrag .= utf8_decode('<br>Betreff: '.$titel);
$logeintrag .= utf8_decode('<br>Inhalt: '.$inhalt);
$logeintrag .= utf8_decode('<br>Uhrzeit: '.date("d.m.Y - H:i",$uhrzeit).' Uhr');
$logeintrag .= utf8_decode('<br>Unique ID: '.$einmalige_id);
logbucheintrag($logeintrag, $pdo);

?>
<meta http-equiv="refresh" content="0; URL=?q=KX8ZpI1TKZjLr1GWbBkMLfNbZuvsdAwJYL6QEjA8VmJrk3FACQY84sbslpc9GGuKiM7gtc3fEHVJfUR3jXkH4SZsKCirvSbPntnH">
<?
}
?>
