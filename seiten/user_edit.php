<? onlinecheck($pdo); ?><h2>Dein Profil ändern  <?=pfeil_back();?></h2>

<?
$statement = $pdo->prepare("SELECT * FROM user WHERE email = ?");
$statement->execute(array($_SESSION['username']));
  while($row = $statement->fetch()) {
        $vorname = $row['vorname'];
        $nachname = $row['nachname'];
        $plz = $row['plz'];
        if($plz == 0) { $plz = ""; }
        $tel_mobil = $row['tel_mobil'];
        $facebook = $row['facebook'];
        $twitter = $row['twitter'];
        $discord = $row['discord'];
        $truckers_mp = $row['truckers_mp'];
        $steam_id = $row['steam_id'];

        $steuerung = $row['steuerung'];
        $lkw_ets = $row['lkw_ets'];
        $lkw_ats = $row['lkw_ats'];
        $stadt_ets = $row['stadt_ets'];
        $stadt_ats = $row['stadt_ats'];

        $dlc_going = $row['dlc_going'];
        $dlc_scandinavia = $row['dlc_scandinavia'];
        $dlc_france = $row['dlc_france'];
        $dlc_italia = $row['dlc_italia'];
        $dlc_baltic = $row['dlc_baltic'];
        $dlc_arizona = $row['dlc_arizona'];
        $dlc_mexico = $row['dlc_mexico'];
        $dlc_oregon = $row['dlc_oregon'];
        $dlc_washington = $row['dlc_washington'];
    }

    ?>

<form action="#" method="POST">
  <table width="600px" style="float:left;"><tr>

    <td width="150px" align="right">Vorname: </td><td><input type="text" name="vorname" style="text-align:left;" value="<?=$vorname;?>" size="43" /></td><tr>
    <td width="150px" align="right">Nachname: <br><span style="font-size:10px">( Wird nur gekürzt angezeigt )</span> </td><td><input type="text" name="nachname" style="text-align:left;" value="<?=$nachname;?>" size="43" /></td><tr>
    <td width="150px" align="right">Postleitzahl: <br><span style="font-size:10px">( Wird nicht angezeigt )</span></td><td><input type="text" name="plz" style="text-align:center" value="<?=$plz;?>" size="7" /></td><tr>
    <td width="150px" align="right">Tel-Mobil: <br><span style="font-size:10px">( Wird nicht angezeigt )</span></td><td><input type="text" name="tel_mobil" value="<?=$tel_mobil;?>" size="43" /></td><tr>
    <td width="150px" align="right">Email-Adresse: <br><span style="font-size:10px">( Wird nicht angezeigt )</span></td><td><input type="text" name="email" value="<?=$_SESSION['username'];?>" size="43" disabled="disabled" /><?=help("Aus Sicherheitsgründen haben wir das Ändern der Email-Adresse vorerst gesperrt ! Zur manuellen Änderung, wende dich bitte an einen Admin.");?></td><tr>
    <td width="150px" align="right"><img src="img/facebook.png" border="0" style="" /></td><td>https://www.facebook.com/<input type="text" style="text-align:left" name="facebook" value="<?=$facebook;?>" size="17" /><?=help("Mit deinen Facebook Daten kannst du deine Events und Werbung kostenfrei auf Facebook posten !");?></td><tr>
    <td width="150px" align="right"><img src="img/twitter.png" border="0" style="width:170px" /></td><td>@<input type="text" style="text-align:left" name="twitter" value="<?=$twitter;?>" size="40" /><?=help("Mit deinem Twitter Account kannst du deine Events und Werbung kostenfrei auf Twitter twittern !");?></td><tr>

    <td width="150px" align="right">Discord: #</td><td><input type="text" name="discord" value="<?=$discord;?>" size="10" maxlength="7" style="text-align:center;" /></td><tr>
    <td width="150px" align="right">TruckersMP-ID: </td><td><input type="text" name="truckers_mp" value="<?=$truckers_mp;?>" size="10" style="text-align:center;" /></td><tr>
    <td width="150px" align="right">STEAM-ID: </td><td><input type="text" name="steam_id" value="<?=$steam_id;?>" size="25" style="text-align:center;" /></td><tr>

</table>

<table width="600px" style="float:left; padding-bottom:100px;"><tr>

  <td width="150px" align="right">Du spielst mit: </td><td>
    <select name="steuerung" style="width:250px">
      <option selected>Auswahl</option>
      <option value="Tastatur/Maus">Tastatur/Maus</option>
      <?
      $statement = $pdo->prepare("SELECT * FROM lenkraeder ORDER BY name ASC");
      $statement->execute(array($email));
      while($row_wheel=$statement->fetch()) { ?>
        <option value="<?=$row_wheel['name']; ?>" <? if($row_wheel['name'] == $steuerung) { echo "selected"; } ?>><?=$row_wheel['name'];?></option>
      <? } ?>
    </select>
  </td><tr>
  <td width="150px" align="right">Lieblinks-LKW in ETS: </td><td>
    <select name="lkw_ets" style="width:250px">
      <option selected>Auswahl</option>
      <option value="Mercedes" <? if($lkw_ets == "Mercedes") { echo "selected"; } ?>>Mercedes</option>
      <option value="Volvo" <? if($lkw_ets == "Volvo") { echo "selected"; } ?>>Volvo</option>
      <option value="IVECO" <? if($lkw_ets == "IVECO") { echo "selected"; } ?>>IVECO</option>
      <option value="MAN" <? if($lkw_ets == "MAN") { echo "selected"; } ?>>MAN</option>
      <option value="Renault" <? if($lkw_ets == "Renault") { echo "selected"; } ?>>Renault</option>
      <option value="DAF" <? if($lkw_ets == "DAF") { echo "selected"; } ?>>DAF</option>
      <option value="Scania" <? if($lkw_ets == "Scania") { echo "selected"; } ?>>Scania</option>
    </select>
  </td><tr>

    <td width="150px" align="right">Lieblinks-LKW in ATS: </td><td>
      <select name="lkw_ats" style="width:250px">
        <option selected>Auswahl</option>
        <option value="Peterbilt" <? if($lkw_ats == "Peterbilt") { echo "selected"; } ?>>Peterbilt</option>
        <option value="Kenworth" <? if($lkw_ats == "Kenworth") { echo "selected"; } ?>>Kenworth</option>
        <option value="Volvo" <? if($lkw_ats == "Volvo") { echo "selected"; } ?>>Volvo</option>
      </select>
    </td><tr>

      <td width="150px" align="right">Lieblings-Stadt in ETS: </td><td>
        <select name="stadt_ets" style="width:250px">
            <option selected>Auswahl</option><?
            $URL = file_get_contents("https://api.truckyapp.com/v2/map/cities/ets2");
            $data = json_decode($URL, true);
            $anzahl = count($data['response']);
            $i = 0;
            while($i<=$anzahl-1) { ?><option value="<?=$data['response'][$i]['realName'];?>"<? if($data['response'][$i]['realName'] == $stadt_ets) { echo "selected"; } ?>><?=$data['response'][$i]['realName'];?></option><? $i++; } ?>
      </select>
      </td><tr>

        <td width="150px" align="right">Lieblings-Stadt in ATS: </td><td>
          <select name="stadt_ats" style="width:250px">
              <option selected>Auswahl</option><?
              $URL = file_get_contents("https://api.truckyapp.com/v2/map/cities/ats");
              $data = json_decode($URL, true);
              $anzahl = count($data['response']);
              $i = 0;
              while($i<=$anzahl-1) { ?><option value="<?=$data['response'][$i]['realName'];?>"<? if($data['response'][$i]['realName'] == $stadt_ats) { echo "selected"; } ?>><?=$data['response'][$i]['realName'];?></option><? $i++; } ?>
        </select>
        </td><tr>

          <td width="150px" align="right" style="padding-top:15px" valign="top"><h2>Deine ETS2 DLC:</h2></td><td style="padding-top:20px">
                  <input type="checkbox" name="dlc_going" id="11" value="1" <? if($dlc_going == 1) { echo "checked='checked'"; } ?>><label for="11">Going East!</label><br><br>
                  <input type="checkbox" name="dlc_scandinavia" id="12" value="1" <? if($dlc_scandinavia== 1) { echo "checked='checked'"; } ?>><label for="12">Scandinavia</label><br><br>
                  <input type="checkbox" name="dlc_france" id="13" value="1" <? if($dlc_france == 1) { echo "checked='checked'"; } ?>><label for="13">Vive la France !</label><br><br>
                  <input type="checkbox" name="dlc_italia" id="14" value="1" <? if($dlc_italia == 1) { echo "checked='checked'"; } ?>><label for="14">Italia</label><br><br>
                  <input type="checkbox" name="dlc_baltic" id="15" value="1" <? if($dlc_baltic == 1) { echo "checked='checked'"; } ?>><label for="15">Beyond the Baltic Sea</label><br><br>
        </td><tr>

          <td width="150px" align="right" valign="top"><h2>Deine ATS DLC:</h2></td><td>
                  <input type="checkbox" name="dlc_arizona" id="21" value="1" <? if($dlc_arizona == 1) { echo "checked='checked'"; } ?>><label for="21">Arizona</label><br><br>
                  <input type="checkbox" name="dlc_mexico" id="22" value="1" <? if($dlc_mexico == 1) { echo "checked='checked'"; } ?>><label for="22">New Mexico</label><br><br>
                  <input type="checkbox" name="dlc_oregon" id="23" value="1" <? if($dlc_oregon == 1) { echo "checked='checked'"; } ?>><label for="23">Oregon</label><br><br>
                  <input type="checkbox" name="dlc_washington" id="24" value="1" <? if($dlc_washington == 1) { echo "checked='checked'"; } ?>><label for="24">Washington</label><br><br>
        </td><tr>



</table>

<table width="600px" style="float:left;"><tr>
<td width="150px" align="right" valign="top"><h2>Zeit für Neues !</h2></td><td>

</td><tr>
</table>

<br>
<center><input class="btn_senden" type="submit" name="update" style="position:absolute; top:400px; right:100px;" value="Daten ändern" /></center>

<br><br><br><br><br><br><br><br>
</form>

<?
if(isset($_POST["update"])) {

$vorname = filter_input(INPUT_POST, "vorname", FILTER_SANITIZE_STRING);
$nachname = filter_input(INPUT_POST, "nachname", FILTER_SANITIZE_STRING);
$plz = filter_input(INPUT_POST, "plz", FILTER_SANITIZE_STRING);
$tel_mobil = filter_input(INPUT_POST, "tel_mobil", FILTER_SANITIZE_STRING);
$facebook = filter_input(INPUT_POST, "facebook", FILTER_SANITIZE_STRING);
$twitter = filter_input(INPUT_POST, "twitter", FILTER_SANITIZE_STRING);
$discord = filter_input(INPUT_POST, "discord", FILTER_SANITIZE_STRING);
$truckers_mp = filter_input(INPUT_POST, "truckers_mp", FILTER_SANITIZE_NUMBER_INT);
$steam_id = filter_input(INPUT_POST, "steam_id", FILTER_SANITIZE_STRING);

$steuerung = filter_input(INPUT_POST, "steuerung", FILTER_SANITIZE_STRING);
$lkw_ets = filter_input(INPUT_POST, "lkw_ets", FILTER_SANITIZE_STRING);
$lkw_ats = filter_input(INPUT_POST, "lkw_ats", FILTER_SANITIZE_STRING);
$stadt_ets = filter_input(INPUT_POST, "stadt_ets", FILTER_SANITIZE_STRING);
$stadt_ats = filter_input(INPUT_POST, "stadt_ats", FILTER_SANITIZE_STRING);

$dlc_going = filter_input(INPUT_POST, "dlc_going", FILTER_VALIDATE_INT);
$dlc_scandinavia = filter_input(INPUT_POST, "dlc_scandinavia", FILTER_VALIDATE_INT);
$dlc_france = filter_input(INPUT_POST, "dlc_france", FILTER_VALIDATE_INT);
$dlc_italia = filter_input(INPUT_POST, "dlc_italia", FILTER_VALIDATE_INT);
$dlc_baltic = filter_input(INPUT_POST, "dlc_baltic", FILTER_VALIDATE_INT);
$dlc_arizona = filter_input(INPUT_POST, "dlc_arizona", FILTER_VALIDATE_INT);
$dlc_mexico = filter_input(INPUT_POST, "dlc_mexico", FILTER_VALIDATE_INT);
$dlc_oregon = filter_input(INPUT_POST, "dlc_oregon", FILTER_VALIDATE_INT);
$dlc_washington = filter_input(INPUT_POST, "dlc_washington", FILTER_VALIDATE_INT);


  $stmt1 = $pdo->prepare("UPDATE user SET vorname = :vorname,
    nachname = :nachname,
    plz = :plz,
    tel_mobil = :tel_mobil,
    facebook = :facebook,
    twitter = :twitter,
    discord = :discord,
    truckers_mp = :truckers_mp,
    steam_id = :steam_id,
    steuerung = :steuerung,
    lkw_ets = :lkw_ets,
    lkw_ats = :lkw_ats,
    stadt_ets = :stadt_ets,
    stadt_ats = :stadt_ats,
    dlc_going = :dlc_going,
    dlc_scandinavia = :dlc_scandinavia,
    dlc_france = :dlc_france,
    dlc_italia = :dlc_italia,
    dlc_baltic = :dlc_baltic,
    dlc_arizona = :dlc_arizona,
    dlc_mexico = :dlc_mexico,
    dlc_oregon = :dlc_oregon,
    dlc_washington = :dlc_washington
    WHERE email = :email");

  $stmt1->bindParam(':vorname', $vorname);
  $stmt1->bindParam(':nachname', $nachname);
  $stmt1->bindParam(':plz', $plz);
  $stmt1->bindParam(':tel_mobil', $tel_mobil);
  $stmt1->bindParam(':facebook', $facebook);
  $stmt1->bindParam(':twitter', $twitter);
  $stmt1->bindParam(':discord', $discord);
  $stmt1->bindParam(':truckers_mp', $truckers_mp);
  $stmt1->bindParam(':steam_id', $steam_id);
  $stmt1->bindParam(':steuerung', $steuerung);
  $stmt1->bindParam(':lkw_ets', $lkw_ets);
  $stmt1->bindParam(':lkw_ats', $lkw_ats);
  $stmt1->bindParam(':stadt_ets', $stadt_ets);
  $stmt1->bindParam(':stadt_ats', $stadt_ats);
  $stmt1->bindParam(':dlc_going', $dlc_going);
  $stmt1->bindParam(':dlc_scandinavia', $dlc_scandinavia);
  $stmt1->bindParam(':dlc_france', $dlc_france);
  $stmt1->bindParam(':dlc_italia', $dlc_italia);
  $stmt1->bindParam(':dlc_baltic', $dlc_baltic);
  $stmt1->bindParam(':dlc_arizona', $dlc_arizona);
  $stmt1->bindParam(':dlc_mexico', $dlc_mexico);
  $stmt1->bindParam(':dlc_oregon', $dlc_oregon);
  $stmt1->bindParam(':dlc_washington', $dlc_washington);
  $stmt1->bindParam(':email', $_SESSION['username']);
  $stmt1->execute();

  $logeintrag = utf8_decode('Es wurden Daten von '.$vorname.' '.$nachname.' geändert. Folgendes wurde eingetragen: ');
  $logeintrag .= utf8_decode("Vorname: ".$vorname).", ";
  $logeintrag .= utf8_decode("Nachname: ".$nachname).", ";
  $logeintrag .= utf8_decode("Strasse: ".$strasse).", ";
  $logeintrag .= utf8_decode("Hausnummer: ".$hsnr).", ";
  $logeintrag .= utf8_decode("PLZ: ".$plz).", ";
  $logeintrag .= utf8_decode("Ort: ".$ort).", ";
  $logeintrag .= utf8_decode("Telefon Mobil: ".$tel_mobil).", ";
  $logeintrag .= utf8_decode("Facebook: ".$facebook).", ";
  $logeintrag .= utf8_decode("Twitter: ".$twitter).", ";
  $logeintrag .= utf8_decode("Discord: ".$discord).", ";
  $logeintrag .= utf8_decode("Steuerung: ".$steuerung).", ";
  $logeintrag .= utf8_decode("LKW ETS: ".$lkw_ets).", ";
  $logeintrag .= utf8_decode("LKW ATS: ".$lkw_ats).", ";
  $logeintrag .= utf8_decode("Stadt ETS: ".$stadt_ets).", ";
  $logeintrag .= utf8_decode("Stadt ATS: ".$stadt_ats).", ";
  $logeintrag .= utf8_decode("DLC Going: ".$dlc_going).", ";
  $logeintrag .= utf8_decode("DLC Scandinavia: ".$dlc_scandinavia).", ";
  $logeintrag .= utf8_decode("DLC France: ".$dlc_france).", ";
  $logeintrag .= utf8_decode("DLC Italia: ".$dlc_italia).", ";
  $logeintrag .= utf8_decode("DLC Baltic: ".$dlc_baltic).", ";
  $logeintrag .= utf8_decode("DLC Arizona: ".$dlc_arizona).", ";
  $logeintrag .= utf8_decode("DLC Mexico: ".$dlc_mexico).", ";
  $logeintrag .= utf8_decode("DLC Oregon: ".$dlc_oregon).", ";
  $logeintrag .= utf8_decode("DLC Washington: ".$dlc_washington);
  logbucheintrag($logeintrag, $pdo);
  ?>
  <meta http-equiv="refresh" content="0; URL=?q=10ioL9Kzm2YaEG6Tb4tot2bpGWr3kXO678zXFsATuJEaynLaGmD0jloGEDRdnwJtULKZg9uyuMVvvrY227nEugzfacQmZL4n3CTG">
  <?

}

?>
