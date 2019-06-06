<? onlinecheck($pdo); ?>

<h2>Alle Community-Mitglieder</h2>

<?

echo "<center><table width='98%' cellpadding='5' style='padding-bottom:100px'>";
echo "<tr><form action='#' method='POST'><td align='left' colspan='5'><input type='text' name='suche' placeholder='Suche nach Spielername' /><a href='?q=WO5kP2yk95kf70rD0ok6dN3jZTOi0LVF6GWp4yDKTjToOGgxiBWNUxY625LvPMwuB69FYOSmhORbYuVmzUvA5f54S5EuesVpOQz0'> Alle User</a></form></td></tr>";
echo "<tr>";
echo "<td width='50px' align='center' style='background: #2E2E2E; border-bottom:1px solid grey;padding-right:20px'>Info's</td>";
echo "<td width='60px' align='center' style='background: #2E2E2E; border-bottom:1px solid grey;padding-right:20px'>Bild</td>";
echo "<td width='150px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>Vorname</td>";
echo "<td width='70px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>NN (gek.)</td>";
echo "<td width='150px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>PLZ</td>";
echo "<td width='70px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>Discord</td>";
echo "<td width='100px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>Dabei seit</td>";
echo "<td width='100px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>Last Login</td>";
echo "<td width='100px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>Freund</td>";
echo "<td width='100px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>Melden</td>";
echo "<td width='100px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>Meldungen</td>";
echo "<td width='500px' style='background: #2E2E2E;border-bottom:1px solid grey;'>Spedition<td>";
echo "<td></td></tr>";


if(isset($_POST['suche'])) {
  $suche = filter_input(INPUT_POST, "suche", FILTER_SANITIZE_STRING);

  if(empty($suche)) {
    $statement97 = $pdo->prepare("SELECT * FROM user WHERE mitglieder_liste = ?");
    $statement97->execute(array(0));
   } else {
     $suche = $suche.'%';
     $statement97 = $pdo->prepare("SELECT * FROM user WHERE mitglieder_liste = ? AND vorname LIKE ? OR nachname LIKE ?");
     $statement97->execute(array(0, $suche, $suche));
   }

 } else {
   $statement97 = $pdo->prepare("SELECT * FROM user WHERE mitglieder_liste = ?");
   $statement97->execute(array(0));
 }




  while($row55 = $statement97->fetch()) {

    if($row55['profilbild'] == "") { $profilbild = "kl.png"; } else { $profilbild = $row55['profilbild']; }
        echo "<tr><td width='50px' align='center'><a class='link' href='?ufrtbfbdsfs=".$row55['einmalige_id']."&q=oQVloXhGyxwmFyIqnbznZ89QvvEsXz1TbIlwJafYV8ffc6IVieaU6bC7qrhhgTZEMBo9gvrCw8PCrul4ZwFheqRNJXHscYDXXoTI'><img style='width:24px; margin-bottom:-7px;' src='https://img.icons8.com/color/48/000000/info.png'></a></td>";
        echo "<td width='60px' align='center' style='padding-right:20px'><img src='img/userimages/".$profilbild."' border='0' style='width:50px' /></td>";
        echo "<td width='150px' align='left'>".$row55['vorname']."</td>";
        echo "<td width='70px'>".substr($row55['nachname'],0,1).".</td>";
        echo "<td width='150px'>".$row55['plz']."</td>";
        echo "<td width='70px' align='center'>".$row55['discord']."</td>";
        echo "<td width='100px' align='center'>".date('d.m.Y', $row55['created'])."</td>";
        echo "<td width='100px' align='center'>".date('d.m.Y', $row55['last_login'])."</td>";

        $freund_id = $row55['einmalige_id'];
        $user_id = user_id($pdo);

            $freund = $pdo->prepare("SELECT * FROM freundesliste WHERE user = :user AND freund = :freund");
            $freund->bindParam(':user', $user_id);
            $freund->bindParam(':freund', $freund_id);
            $freund->execute();
            $ist_freund = $freund->rowCount();



            if($ist_freund == 0) { echo "<td width='100px' align='center' style='padding-right:20px'>";
              echo "<a href='?kunqat=".$row55['einmalige_id']."&q=ADbQbyKNMjJ9I7lYJ9W8fNjg6YEdE1Hg59E311t98hQqVN08v3zJ5NW19uzefJFoXn9gYfKRYqsq3894fiHePLgOZa8OZEy85XVw'>";
              echo "<img src='img/friend.png' border='0' style='width:26px' />";
              echo "</a>";
              echo "</td>"; }

            if($ist_freund == 1) {

              // Abfrage ob freundschaftsanfrage schon bestätigt wurde
              while($row_freund = $freund->fetch()) {
                 $bestaetigt = $row_freund['bestaetigt'];
                 if($bestaetigt == 1) {
                   echo "<td width='100px' align='center' style='padding-right:20px'><img src='img/ok.png' border='0' style='width:16px' /></td>";
                 } else {
                   echo "<td width='100px' align='center' style='padding-right:20px'><img src='img/waiting.png' border='0' style='width:16px' /></td>";
                 }
               }


           }


      $user_einmalige_id = $row55['einmalige_id'];

      $statement974 = $pdo->prepare("SELECT * FROM meldungen WHERE gemeldeter_user = ?");

      if($statement974->rowCount() >= 1) {
        $schon_gemeldet = "<img style='margin-top:-5px' src='../../img/waiting.png' border='0' alt='Anfrage ausstehend' title='Anfrage ausstehend' />";
      } else {
        $schon_gemeldet = "<a href='?zetifaq=".$row55['einmalige_id']."&q=LfEYBayGw2QouVCWFTzyvvB2KsHxS544bSMf55agrXuezsyDkG8NQLRWn4JI4yqaWMAT38dSleWPJHRdxwuyBwihyM73X1Ky3lGU'><img src='img/alert.png' border='0' style='width:24px' /></a>";
      }

        echo "<td width='100px' align='center'>".$schon_gemeldet."</td>";

        echo "<td width='100px' align='center'><a href='?uruskapet=".$row55['einmalige_id']."&q=hnl32IfnRFQ0Jjy2cy47nUme6xQGI91d1DpSyCD1gKgYfIVUdA869KdpWKanjuzaTm8txrzCPlxbL22HZYtqzCBSmMtuZoLWKwGR'><img style='margin-top:-5px' src='../../img/info.png' border='0' /></a></td>";
        if($row55['in_spedition'] == 0) {

          $inhaber = $pdo->prepare("SELECT * FROM firmen WHERE email = :email");
          $inhaber->bindParam(':email', $row55['email']);
          $inhaber->execute();
          while($row_inh = $inhaber->fetch()) { $name_firma = $row_inh['firmenname']; }

          if($inhaber->rowCount() >= 1) {
            echo "<td width='500px'>Inhaber der ".$name_firma."</td>";
          } else {

          echo "<td width='500px'>In keiner Spedition</td>";
        }} else {
          echo "<td width='500px'>".$row55['in_spedition']."</td>";
        }


        echo "<td></td></tr>";
    }

echo "</table></center>";


    ?>
