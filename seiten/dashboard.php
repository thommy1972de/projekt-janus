<? onlinecheck($pdo);


// ABFRAGEN DEFINIEREN
$statement = $pdo->prepare("SELECT * FROM user WHERE email = ?");
$statement->execute(array($_SESSION['username']));
  while($row = $statement->fetch()) {
        $vorname = $row['vorname'];
        $nachname = $row['nachname'];

        $plz = $row['plz'];
        $plz = ($plz == 0) ? "NA" : $plz;
        $tel_mobil = $row['tel_mobil'];
        $email_gekuerzt = substr($row['email'],0,5)." ............... ".substr($row['email'], -4);
        $created = date('d.m.Y : H:i', $row['created'])." Uhr";
        $last_login = date('d.m.Y : H:i', $row['last_login'])." Uhr";

        $steuerung = $row['steuerung'];
        $lkw_ets = $row['steuerung'];
        $lkw_ats = $row['steuerung'];
        $stadt_ets = $row['steuerung'];
        $stadt_ats = $row['steuerung'];
        $steam_id = $row['steam_id'];
        $euid = $row['einmalige_id'];

        $go_disabled = $row['news_postet'];
        if($go_disabled == 0) { $disabled= ""; } else  {
        if($go_disabled >= time()-300) { $disabled = "disabled='disabled'"; } else { $disabled= ""; }
        }
        $profilbild = $row['profilbild'];
        if($profilbild == "") { $profilbild = "kl.png"; } else { $profilbild = $row['profilbild']; }
    }


?>
<div id="wrapper_in" style="padding-top:20px">
  <div id="header_in"></div>
  <div id="content_in">

    <div id="inner-content_in">
<center>
<table width="100%" cellspacing="50">

<td valign="top" align="center">
      <!--
  <center>
    <table border="1" style="width:690px">
      <td width="30%" align="right">Aktuelle ETS2 Game-Version:</td><td style="width:300px;"><?=Json::supported_game_version_ets();?></td></tr>
      <td width="30%" align="right">Aktuelle ATS Game-Version:</td><td style="width:300px;"><?=Json::supported_game_version_ats();?></td></tr>
      <td width="30%" align="right">Dein Name:</td><td style="width:300px;"><a href="#" onClick="popup()"> Deinen Client-Key anzeigen </a></td></tr>
  </table>
</center>
  <hr>  -->

  <!--<div id="cssmenu_links" style="float:left;">
    <ul>
       <li class="has-sub"><a href="#"><i class="fa fa-fw fa-weixin"></i> Gruppen</a>
          <ul>
             <li><a href="#">Gruppe 1</a></li>
             <li><a href="#">Gruppe 2</a></li>
          </ul>
       </li>
       <li class="has-sub"><a href="#"><i class="fa fa-fw fa-thumbs-up"></i> Vereine</a>
          <ul>
             <li><a href="#">Verein 1</a></li>
             <li><a href="#">Verein 2</a></li>
          </ul>
       </li>
    </ul>
  </div>-->

        <div style="margin-left:0px; width:600px;">
          <form action="#" method="POST" name="mitteilung">

            <img src="img/userimages/<?=$profilbild;?>" width="40px" style="border-radius:50px; margin-bottom:-16px" />
            <input type="text" name="beitrag_neu" size="95" placeholder="Was machst du gerade <?=$vorname;?> ?" autocomplete="off" required />
            <input class='btn_senden' name="mess_eintragen" type="submit" <?=$disabled; ?> value="GO"><p style="font-size:12px">(du kannst nur alle 5 Min. eine Nachricht senden)</p><hr>
          </form>
        </div>

      <?
        // Senden prüfen ///
        if(isset($_POST["mess_eintragen"])) {

          $timestamp = TIME();
          $stmt33 = $pdo->prepare("INSERT INTO beitraege (von_user, uhrzeit, inhalt) VALUES (:von_user, :uhrzeit, :inhalt)");
          $stmt33->bindParam(':von_user', $euid);
          $stmt33->bindParam(':uhrzeit', $timestamp);
          $stmt33->bindParam(':inhalt', $_POST['beitrag_neu']);
          $stmt33->execute();

          $stmt34 = $pdo->prepare("UPDATE user set news_postet = :uhrzeit WHERE einmalige_id = :user_id");
          $stmt34->bindParam(':uhrzeit', $timestamp);
          $stmt34->bindParam(':user_id', $euid);
          $stmt34->execute();
          ?>
          <meta http-equiv="refresh" content="0; URL=?q=diljiY0Bfv9JdgXZopTDeBjwVRGdBHvbKJuprQ716gCQKoZh8lVXnKOvn6vwRSF5i0Wmv0BkKEjV8Bu8qIvM7JwJOdDzpUmY323E">
          <?

        }




      $beitraege = $pdo->prepare("SELECT * FROM beitraege ORDER BY id DESC LIMIT 20");
      $beitraege->execute();
      echo "<center><table border='0' cellspacing='2' cellpadding='5'>";
        while($beitrag = $beitraege->fetch()) {

          $userd = $pdo->prepare("SELECT * FROM user WHERE einmalige_id = ?");
          $userd->execute(array($beitrag['von_user']));
            while($row_u = $userd->fetch()) { $name = $row_u['vorname']." ".substr($row_u['nachname'],0,1)."."; }
                echo "<table width='600px' border='0' cellspacing='5' cellpadding='5' style='position:relative;'>";
                echo "<tr><td width='50%' style='background:grey; padding-left:10px; border:1px solid grey; border-top-left-radius:20px;'>Von: ".$name."</td><td align='right' style='background:grey;padding-right:10px; border:1px solid grey; border-top-right-radius:20px;'>".date('d.m.Y - H:i',$beitrag['uhrzeit'])." Uhr</td><tr>";
                echo "<td colspan='2'style='border-top:0px solid #19191B; background:grey; padding-left:10px; border-bottom-left-radius:20px; border-bottom-right-radius:20px;'>".utf8_encode($beitrag['inhalt'])."</td></tr>";

                // MODERATOR OPTIONEN FÜR HAUPTTEXT //
                if(rang($_SESSION['username'], $pdo) >= 2) {
                  echo "<td colspan='4' style='line-height:0px'>";
                  echo "<span style='font-size:10px;'><a class='link' href='?q=OIc8XrsyaMUz4F9aEwzQBNL2ig31CIgP61ZUC6UHlgvRfY4gVHtHKquwWqh1QQb9PIwG4ZTn6PsUnzXQxawF4bYRCNkOaDrypZTb&id=".$beitrag['id']."' style='padding-right:20px'>Beitrag bearbeiten</a></span>";
                  echo "<span style='font-size:10px; padding-right:20px;'><a class='link' href='#'>Beitrag entfernen</a></span>";

                }
                // ENDE MOD-OPTIONEN //
                echo "</td></table>";
          $beitragsnummer = $beitrag['id'];
          $beitraege2 = $pdo->prepare("SELECT * FROM beitraege_antwort WHERE beitrag = $beitragsnummer");
          $beitraege2->execute();
            $userd2 = $pdo->prepare("SELECT * FROM user WHERE einmalige_id = ?");
            $userd2->execute(array($beitrag['von_user']));
              while($row_u2 = $userd2->fetch()) { $name2 = $row_u2['vorname']." ".substr($row_u2['nachname'],0,1)."."; }

            while($beitrag2 = $beitraege2->fetch()) {
              echo "<table width='600px' style='margin-left:5%;border-bottom:1px solid grey;border-left:1px solid grey; border-bottom-left-radius:10px;'  border='0' cellspacing='5' cellpadding='10'>";
              echo "<td>Antwort von ".$name2.":<br>".utf8_encode($beitrag2['inhalt'])."</td></tr>";

              if(rang($_SESSION['username'], $pdo) >= 2) {
                echo "<td colspan='4' style='line-height:0px'>";
                echo "<span style='font-size:10px;'><a class='link' href='?q=X0irn432WfOUsffGyJHC7ipWHA8otWX0294dPbo9URQh0L7JON95mKRCJudfUEc3SBDyDLSBMZwNrva22GlHlYWa5e4J90unLTpb&id=".$beitrag2['id']."' style='padding-right:20px'>Beitrag bearbeiten</a></span>";
                echo "<span style='font-size:10px; padding-right:20px;'><a class='link' href='#'>Beitrag entfernen</a></span>";
                echo "</td>";
              }
              echo"</table><br>";

            }
            ?><br>
            <form action="#" style="width:600px" method="POST" name="mitteilung2">
              <div style=" padding-left:0px; margin-top:-25px;">
              <img src="img/userimages/<?=$profilbild;?>" width="40px" style="border-radius:50px;margin-bottom:-16px" />
              <input type="text" name="beitrag_neu" size="65" placeholder="Antworte auf diesen Post" autocomplete="off" />
              <input type="hidden" name="zu_beitrag" value="<?=$beitrag['id'];?>" />
              <input type="hidden" name="von_user" value="<?=$euid;?>" />
              <input class='btn_senden' name="ant_eintragen" type="submit" value="GO">
            </form>
            <?


        }
        echo "</table></center>";

        // ANtwort prüfen ///


        // Senden prüfen ///
        if(isset($_POST["ant_eintragen"])) {
          $zu_beitrag = filter_input(INPUT_POST, "zu_beitrag", FILTER_VALIDATE_INT);
          $euid = filter_input(INPUT_POST, "von_user", FILTER_SANITIZE_STRING);

          $timestamp = TIME();
          $stmt332 = $pdo->prepare("INSERT INTO beitraege_antwort (beitrag, von_user, uhrzeit, inhalt) VALUES (:beitrag, :von_user, :uhrzeit, :inhalt)");
          $stmt332->bindParam(':beitrag', $zu_beitrag);
          $stmt332->bindParam(':von_user', $euid);
          $stmt332->bindParam(':uhrzeit', $timestamp);
          $stmt332->bindParam(':inhalt', $_POST['beitrag_neu']);
          $stmt332->execute();

          $stmt34 = $pdo->prepare("UPDATE user set news_postet = :uhrzeit WHERE einmalige_id = :user_id");
          $stmt34->bindParam(':uhrzeit', $timestamp);
          $stmt34->bindParam(':user_id', $euid);
          $stmt34->execute();

          echo $beitrag['id'];
          ?>
          <meta http-equiv="refresh" content="0; URL=?q=diljiY0Bfv9JdgXZopTDeBjwVRGdBHvbKJuprQ716gCQKoZh8lVXnKOvn6vwRSF5i0Wmv0BkKEjV8Bu8qIvM7JwJOdDzpUmY323E">
          <?

        }





      // Message Center Ende //
      ?>
    </div>
  </div>

</td>
<td>


  <div style="width:350px; float:right;">
    <!-- Online-List -->


  <div class="premium_speditionen" style="margin-top:10px; border-radius:20px; border:1px solid grey; padding:0px">
    <h3 style='padding-left:20px; color:#fff;  border-bottom:1px solid grey; padding-bottom: 5px; margin-top:0px;'><u>Speditionen</u></h3>
    <center>
      <?
      $premium_firma = $pdo->prepare("SELECT * FROM firmen WHERE premium = 1");
      $premium_firma->execute();
      $premium_anz = $premium_firma->rowCount();

      if($premium_anz == 0) { echo "Keine Premium-Spedition"; } else {
        while($row_premium = $premium_firma->fetch()) {
          if($row_premium['firmen_logo'] == "") { $row_premium['firmen_logo'] = "kl.png"; }
          echo "<a href='?23f426c4f4013282f0af720151cd52e6=".$row_premium['einmalige_id']."&q=8gVwkb8n8BaBPmY8bDRKzehtfO8l2GIK3tlYxa8JxE5jIFZ7vuWuGFSpVt5hpmBbyjgCWwEs541wScFt3MTZUZyYRS1rcaBKIvZt'><img src='img/firmenlogos/".$row_premium['firmen_logo']."' width='150px' /><br>";
          echo $row_premium['firmenname'];
          echo "</a><hr></center>";
        }
      }

      ?>
  </div>

  <div class="premium_speditionen" style="margin-top:10px; margin-bottom:100px;border-radius:20px; border:1px solid grey;">
    <center>
  <?=Json::serverstatus(); ?>
    <!-- Online List Ende -->
  </center>
  </div>



</div>

</td>
</table>
</center>

<div style="border-top:1px solid grey; margin-top:-40px; text-align:center; padding-bottom:100px;">
<h2>Über Projekt: JANUS!</h2>
Es sind insgesamt: <?=gesamt_benutzer($pdo); ?> Benutzer angemeldet. Der neuste Benutzer ist <?=neuester_benutzer($pdo); ?>. Die neuste Spedition: <?=neuste_spedition($pdo); ?><br>


</div>




<script language="javascript">
  function CheckReturn(){ if (window.event.keyCode == '13') this.form.submit(); }


$('#cssmenu__l li.active').addClass('open').children('ul').show();
$('#cssmenu__l li.has-sub>a').on('click', function(){
  $(this).removeAttr('href');
  var element = $(this).parent('li');
  if (element.hasClass('open')) {
    element.removeClass('open');
    element.find('li').removeClass('open');
    element.find('ul').slideUp();
  } else {
    element.addClass('open');
    element.children('ul').slideDown();
    element.siblings('li').children('ul').slideUp();
    element.siblings('li').removeClass('open');
    element.siblings('li').find('li').removeClass('open');
    element.siblings('li').find('ul').slideUp();
  }
});

function popup()
{
 var breite=1000;
 var hoehe=300;
 var positionX=((screen.availWidth / 2) - breite / 2);
 var positionY=((screen.availHeight / 2) - hoehe / 2);
 var url='<?=URL;?>/client_key.php?euid=<?=$euid;?>';
 pop=window.open('','','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=0,fullscreen=0,width='+breite+',height='+hoehe+',top=10000,left=10000');
 pop.resizeTo(breite,hoehe);
 pop.moveTo(positionX,positionY);
 pop.location=url;
 }
</script>
