<? onlinecheck($pdo); ?><? $ei = filter_input(INPUT_POST, "e_i", FILTER_SANITIZE_STRING); ?>
<? $was = filter_input(INPUT_POST, "was", FILTER_SANITIZE_STRING); ?>
<center>
Du möchtest also <?=$was; ?> melden. Gut !<br>
  <form action="#" method="POST" style="padding-bottom:100px" enctype="multipart/form-data">
    <h2>Sende uns bitte einen Screenshot oder ein Video !</h2>
    <input type="hidden" name="e_i" value="<?=$ei;?>" />
    <input type="hidden" name="was" value="<?=$was;?>" />
    <h4>Videolink - Youtube:  https://www.youtube.com/watch?v <input type="text" name="yt_link" size="20" /></h4>
    <h4>Videolink - VIMEO:  https://vimeo.com/ <input type="text" name="vimeo_link" size="20" /></h4>
    <h4>Screenshot - Upload: <input type="file" name="fileToUpload" id="fileToUpload"></h4>
    <h4>Kurze Beschreibung des Szenario:<br><textarea name="beschreibung" cols="60" rows="3"></textarea></h4>
<br><br>
      <input type="submit" class="btn_senden" name="meld_send" value="Meldung abschicken" />
    </form>
  </center>

<?
if(isset($_POST["meld_send"])) {

$ei = filter_input(INPUT_POST, "e_i", FILTER_SANITIZE_STRING);
$was = filter_input(INPUT_POST, "was", FILTER_SANITIZE_STRING);
$vl_yt = filter_input(INPUT_POST, "yt_link", FILTER_SANITIZE_STRING);
$vl_vim = filter_input(INPUT_POST, "vimeo_link", FILTER_SANITIZE_STRING);
$beschreibung = filter_input(INPUT_POST, "beschreibung", FILTER_SANITIZE_STRING);

$datum = date("d.m.Y - H:i");

  $statement9 = $pdo->prepare("SELECT * FROM user WHERE email = ?");
  $statement9->execute(array($_SESSION['username']));
    while($row3 = $statement9->fetch()) {
      $name = $row3['nachname']."_".$row3['vorname']."_".$datum."_";
      }


  $target_dir = "img/meldungen_bilder/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      // Bild hochladen
      move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

      $statement91 = $pdo->prepare("SELECT * FROM user WHERE email = ?");
      $statement91->execute(array($_SESSION['username']));
        while($row3 = $statement91->fetch()) {
          $user_einmalige_id = $row3['einmalige_id'];
          $melder = $row3['nachname']." ".$row3['vorname'];
          }

      $statement92 = $pdo->prepare("SELECT * FROM user WHERE einmalige_id = ?");
      $statement92->execute(array($ei));
        while($row5 = $statement92->fetch()) {

          $gemeldeter = $row5['nachname']." ".$row5['vorname'];
          }


$uniq = einmalige_id();

  $stmt2 = $pdo->prepare("INSERT INTO meldungen (einmalige_id, melder, gemeldeter_user, verstoss, datum, videolink_youtube, videolink_vimeo, hochgeladenes_bild, beschreibung) VALUES (:einmalige_id, :melder, :user, :was, :datum, :vl_yt, :vl_vimeo, :bild, :beschreibung)");
  $stmt2->bindParam(':einmalige_id', $uniq);
  $stmt2->bindParam(':melder', $user_einmalige_id);
  $stmt2->bindParam(':user', $ei);
  $stmt2->bindParam(':was', $was);
  $uhrzeit = TIME();
  $stmt2->bindParam(':datum', $uhrzeit);
  $stmt2->bindParam(':vl_yt', $vl_yt);
  $stmt2->bindParam(':vl_vimeo', $vl_vim);
  $stmt2->bindParam(':bild', $target_file);
  $stmt2->bindParam(':beschreibung', $beschreibung);
  $stmt2->execute();

  $empfaenger = EMAIL_ADRESSE;
  $betreff = "Neue Meldung bei ".SITENAME;
  $from = "From: Blasius Thomas <".EMAIL_ADRESSE.">\r\n";
  $from .= "Reply-To: ".EMAIL_ADRESSE."\r\n";
  $from .= "Content-Type: text/html\r\n";
  $text = utf8_decode("Der User: ".$melder." ( Einmalige-ID: ".$user_einmalige_id." )<br>hat eine neue Meldung über<br><b>".$gemeldeter."</b> ( Einmalige-ID :".$ei." ) aus folgendem Grund veranlasst:<br><br>".$was."<br><br>Gemeldeter User: ".$ei."<br>Es hat Gemeldet: ".$user_einmalige_id." !");
  $text .= "<br><br><a href='http://portal.zwpc.de/high_end/index.php'>Zum Adminbereich</a>";
  mail($empfaenger, $betreff, $text, $from);



  ?><center>
  <meta http-equiv="refresh" content="0; URL=?q=9CLzgg2DJVyANcx1l5JKp5pkzVl6S2wqtYUq5KrLcqrozpgd37550YvMJ2gEEuruXVEh6gF9tMpbNBzHdlvlUVjk5GPrnDu8fd1Y">
  <?
}
