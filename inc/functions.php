<?

class J_User {

   public function userdaten($id,$pdo) {

            $statement = $pdo->prepare("SELECT * FROM user WHERE id = ?");
            $statement->execute(array($id));
              while($row = $statement->fetch()) {
                    $_SESSION['vorname'] = $row['vorname'];
                    $_SESSION['nachname'] = $row['nachname'];
                    $_SESSION['last_login'] = $row['last_login'];
                }
    }


    public function zufallsstring($laenge) {
       //Mögliche Zeichen für den String
      return substr(md5(mt_rand(0,999999999)), 0, $laenge);

    }





}

class J_config {


	public $helpurl = '';
	public $ftp_host = '';
	public $ftp_port = '';
	public $ftp_user = '';
	public $ftp_pass = '';
	public $ftp_root = '';
	public $ftp_enable = '0';
	public $offset = 'Europe/Berlin';
	public $mailonline = '1';
	public $mailer = 'mail';
	public $sendmail = '/usr/sbin/sendmail';
	public $MetaDesc = 'Wir betreuen Kinderfeste und Geburtstage in Zweibrücken und Umgebung.';

}

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

function link_holen($key, $pdo) {

  $statement = $pdo->prepare("SELECT * FROM decoding WHERE schluessel = ? LIMIT 1");
  $statement->execute(array($key));

    while($row = $statement->fetch()) {
          return $row['link'];

      }
 }

function client_key_anzeigen($user, $pdo) {

    $statement = $pdo->prepare("SELECT * FROM user WHERE email = ? LIMIT 1");
    $statement->execute(array($user));

      while($row = $statement->fetch()) {
            echo $row['client_key'];

        }
   }

function gesamt_benutzer($pdo) {
  $ges = $pdo->prepare("SELECT * FROM user");
  $ges->execute();
  return $ges->rowCount();
}

function neuester_benutzer($pdo) {
  $neuster = $pdo->prepare("SELECT * FROM user ORDER BY id DESC LIMIT 1");
  $neuster->execute();
  while($row = $neuster->fetch()) {
    return $row['vorname']." ".substr($row['nachname'],0,1);
  }
}

function neuste_spedition($pdo) {
  $neuster = $pdo->prepare("SELECT * FROM firmen ORDER BY id DESC LIMIT 1");
  $neuster->execute();
  while($row = $neuster->fetch()) {
    return $row['firmenname'];
  }
}


 function rang($user, $pdo) {

   $statement = $pdo->prepare("SELECT * FROM user WHERE email = ?");
   $statement->execute(array($user));

     while($row = $statement->fetch()) {
           return $row['rang'];
       }
  }


 function postToDiscord($message)
 {
     $data = array("content" => $message, "username" => "Webhooks");
     $curl = curl_init("https://discordapp.com/api/webhooks/581691033491079199/WDDrxznVc1o0FDGX6NAru6J34ATqX7ih3bqsOMVMZO7Yes0AMaCVPloqtPjqwFRJ7iLr");
     curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
     curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
     return curl_exec($curl);
 }

 function postToPersonaNews($message)
 {
     $data = array("content" => $message, "username" => "Webhooks");
     $curl = curl_init("https://discordapp.com/api/webhooks/581694091322982440/HwRp23pT0jZvpALJwciWHqk2UhwPgiyat9MxQqpRGRJlSRVl2r4p96-64g71euf4SC1p");
     curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
     curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
     return curl_exec($curl);
 }

 function postToUpdate_News($message)
 {
     $data = array("content" => $message, "username" => "Webhooks");
     $curl = curl_init("https://discordapp.com/api/webhooks/581328787619446805/mjbQAyFKPXxU6OuyxnYl0OYKTyJ0vuKiUxZQb-kSjRDB7C0Z-GJlMsz9CQw3_yvxxcR4");
     curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
     curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
     return curl_exec($curl);
 }





 function user_id($pdo) {

   $statement = $pdo->prepare("SELECT einmalige_id FROM user WHERE email = ?");
   $statement->execute(array($_SESSION['username']));
     while($row = $statement->fetch()) {
           return $row['einmalige_id'];
       }
  }

  function userfarbe($user, $pdo) {
    $statement = $pdo->prepare("SELECT rang FROM user WHERE email = ?");
    $statement->execute(array($user));
      while($row = $statement->fetch()) {
            if($row['rang'] == 0) { $farbe = "#fff"; }
            if($row['rang'] == 1) { $farbe = "#00BFFF"; }
            if($row['rang'] == 2) { $farbe = "#8000FF"; }
            if($row['rang'] == 3) { $farbe = "#FD0000"; }

        }

          return $farbe;

   }

   function userrang($user, $pdo) {
     $statement = $pdo->prepare("SELECT * FROM user WHERE email = ?");
     $statement->execute(array($user));
       while($row_rang = $statement->fetch()) {
         if($row_rang['rang'] == 0) { $rang_titel = "<span style='position:absolute; font-size:10px; margin-top:3px; margin-left:10px;'> User</span>"; }
         if($row_rang['rang'] == 1) { $rang_titel = "<span style='position:absolute; font-size:10px; margin-top:3px; margin-left:10px;'>&bigodot; Skripter</span>"; }
         if($row_rang['rang'] == 2) { $rang_titel = "<span style='position:absolute; font-size:10px; margin-top:3px; margin-left:10px;'>&bigodot; Moderator</span>"; }
         if($row_rang['rang'] == 3) { $rang_titel = "<span style='position:absolute; font-size:10px; margin-top:3px; margin-left:10px;'>&bigodot; Administrator</span>"; }
         }
           return $rang_titel;
    }

    function neue_freundschaftsanfrage($user, $pdo) {

         $stmt3 = $pdo->prepare("SELECT * FROM freundesliste WHERE user = :user AND bestaetigt = 0");
  	     $stmt3->bindParam(':user', $user);
         $stmt3->execute();
         return $stmt3->rowCount();
    }



  function set_online($user, $pdo) {
    $stmt3 = $pdo->prepare("UPDATE user SET online = 1, last_login = :jetzt1, last_update = :jetzt2 WHERE email = :email");
	$stmt3->bindParam(':jetzt1', TIME());
	$stmt3->bindParam(':jetzt2', TIME());
	$stmt3->bindParam(':email', $user);
    $stmt3->execute();



  }


function logbucheintrag($eintrag, $pdo) {
  $timestamp = TIME();
  $stmt3 = $pdo->prepare("INSERT INTO logfiles (datum, eintrag) VALUES (:datum, :eintrag)");
  $stmt3->bindParam(':datum', $timestamp);
  $stmt3->bindParam(':eintrag', $eintrag);
  $stmt3->execute();
}

function last_login($user, $pdo) {

		// $timestamp = TIME();
		// $stmt3 = $pdo->prepare("UPDATE user SET last_login = :last WHERE email = :email");
		// $stmt3->bindParam(':last', $timestamp);
		// $stmt3->bindParam(':email', $user);
		// $stmt3->execute();


}

function onlinecheck($pdo) {


	$statement = $pdo->prepare("UPDATE user SET online = 1, last_update = ? WHERE email = ?");
	$statement->execute(array(TIME(), $_SESSION['username']));

	$logout_time = TIME() + 5000;

	$statement2 = $pdo->prepare("UPDATE user SET online = 0 WHERE last_update <  (now() + INTERVAL 5 MINUTES)");
	$statement2->execute();


  if($_SESSION['username'] == '') {
  echo "<center><span style='font-size:200px;'>&infintie;</span><br><h2 style='position:relative; margin-top:-70px;'>Du bist nicht angemeldet !</h2></center>";
  die();
  }


}

function abmelden($user, $pdo) {

  $timestamp = TIME();
  $stmt3 = $pdo->prepare("UPDATE user SET last_update = :last, online = 0 WHERE email = :email");
  $stmt3->bindParam(':last', $timestamp);
  $stmt3->bindParam(':email', $user);
  $stmt3->execute();

	$uhrzeit_logout = date('d.m.Y - H:i', $timestamp);
	$eintrag = "Der User ".$user." hat sich um ".$uhrzeit_logout." Uhr vom System abgemeldet !";
	logbucheintrag($eintrag, $pdo);

}

function help($text) {
  ?><img src="img/help.png" border="0" style="margin-bottom:-5px; margin-left:0px; width:24px;" alt="<?=$text;?>" title="<?=$text;?>" /><?
}

function abbrechen($text) {
  echo "<img src='img/not_ok.png' border='0' style='' alt='".$text."' title='".$text."' />";
}

function mailcheck($user, $pdo) {

  $statement = $pdo->prepare("SELECT * FROM messages WHERE an_user = ? AND gelesen = 0");
  $statement->execute(array($user));
  $anz = $statement->rowCount();

  if($anz == 0) { $text = "Keine neuen Nachrichten"; }
  if($anz == 1) { $text = "<a class='link' href='http://portal.zwpc.de/?q=KX8ZpI1TKZjLr1GWbBkMLfNbZuvsdAwJYL6QEjA8VmJrk3FACQY84sbslpc9GGuKiM7gtc3fEHVJfUR3jXkH4SZsKCirvSbPntnH'><span style='color:red'>".$anz." neue Nachricht !</span></a>"; }
  if($anz >= 2) { $text = "<a class='link' href='http://portal.zwpc.de/?q=KX8ZpI1TKZjLr1GWbBkMLfNbZuvsdAwJYL6QEjA8VmJrk3FACQY84sbslpc9GGuKiM7gtc3fEHVJfUR3jXkH4SZsKCirvSbPntnH'><span style='color:red'>".$anz." neue Nachrichten !</span></a>"; }
  return $text;

}

function mailcheck2($user, $pdo) {

  $statement = $pdo->prepare("SELECT * FROM messages WHERE an_user = ?");
  $statement->execute(array($user));
  $anz = $statement->rowCount();
  return $anz;

}

function pfeil_back() {
?>
<a href='javascript:window.history.back();'><img style='padding-left:15px; padding-right:15px; float:left; margin-bottom:-6px;' src='./img/back_1.png' border='0' /></a>
  <?
}


function getPassword($length=3)
{
    $pw='';
 // Passwortanforderung - von allen Zeichen: [a-z], [A-Z] und [0-9] - je Eines
 while(!(preg_match('/[a-z]/',$pw)&&
         preg_match('/[A-Z]/',$pw)&&
         preg_match('/[0-9]/',$pw)))
  {
   srand((double)microtime()*1000000);
   // Um Verwechselungen zu vermeiden, ohne diese Zeichen: 0,O,o,I,J,l,1,j
   $c = '23456789abcdefghikmnpqrstuvwxyzABCDEFGHKLMNPQRSTUVWXYZ';
   $pw = '';
   while (strlen($pw) < $length) $pw .= substr($c, (rand() % (strlen($c))),1);
  }
 return $pw;
}

function user_firma($user, $pdo) {
  $stmt4 = $pdo->prepare("SELECT * FROM firmen WHERE email = :email");
  $stmt4->bindParam(':email', $user);
  $stmt4->execute();
  $anz_firm = $stmt4->rowCount();
  if($anz_firm >= 1) { $_SESSION['firma'] = 1; } else { $_SESSION['firma'] = 0; }

}

function in_friendlist($user, $freund, $pdo) {
  $stmt4 = $pdo->prepare("SELECT * FROM freundesliste WHERE user = :user AND freund = :freund");
  $stmt4->bindParam(':user', $user);
  $stmt4->bindParam(':freund', $freund);
  $stmt4->execute();
  while($row = $stmt4->fetch()) { $bestaetigt = $row['bestaetigt']; }
  return $stmt4->rowCount();
  return $bestaetigt;
}

function werbung($pdo) {
  $werbung = $pdo->prepare("SELECT * FROM werbung ORDER BY rand() LIMIT 1");
  $werbung->execute();
    while($row_werb = $werbung->fetch()) {
      $werbung2 = $row_werb['code'];
    }
return $werbung2;

}


function zitat($pdo) {
  $stmt4 = $pdo->prepare("SELECT * FROM zitate ORDER BY rand() LIMIT 1");
  $stmt4->execute();



  while($row = $stmt4->fetch()) {

    echo "<center>".$werbung."<br>".werbung($pdo)."<br>Und denke daran: <h2><a href='#'></a>".utf8_encode($row['text'])."</h2></center>";
  }

}




function anzahl_firmen($pdo) {

  $statement = $pdo->prepare("SELECT * FROM firmen");
  $statement->execute();
  return  $statement->rowCount();

}

function einmalige_id() {

  return md5(uniqid(rand(), TRUE));

}

function anzahl_user($pdo) {

  $statement = $pdo->prepare("SELECT * FROM user");
  $statement->execute();
  return  $statement->rowCount();

}

function alle_firmen($pdo) {





  $statement = $pdo->prepare("SELECT * FROM firmen ORDER BY :suche_nach :sort");
  $statement->bindParam(':suche_nach', $suche_nach);
  $statement->bindParam(':sort', $sort);
  $statement->execute();
  $anz_firmen = $statement->rowCount();



  $statement2 = $pdo->prepare("SELECT * FROM user WHERE email = ?");
  $statement2->execute(array($_SESSION['username']));
  while($row_user = $statement2->fetch()) {

    $sperre = $row_user['naechste_bewerbung'];

  }
    echo "<table width='100%'><tr>";
    echo "<td>Sortieren:</td>";
    echo "<td><a href='?q=".$_GET['q']."&suche_nach=mitarbeiter&sort=ASC'>Mitarbeiter AUF</a>";
    echo "<td><a href='?q=".$_GET['q']."&suche_nach=mitarbeiter&sort=DESC'>Mitarbeiter AB</a>";
    echo "<td><a href='?q=".$_GET['q']."&suche_nach=firmenname&sort=ASC'>Firmenname Auf</a>";
    echo "<td><a href='?q=".$_GET['q']."&suche_nach=firmenname&sort=DESC'>Firmenname AB</a>";
    echo "</table>";


  echo "<table width='100%'><tr>";
  echo "<td width='50%' style='border-bottom:1px solid grey;'>Firmenname</td>";
  echo "<td width='10%' style='border-bottom:1px solid grey;'>Mitarbeiter</td>";
  echo "<td width='40%' style='border-bottom:1px solid grey;'>In dieser Firma bewerben</td>";
  echo "</tr>";



  if($anz_firmen == 0) { echo "<td colspan='3'><center><h2>Es sind noch keine Firmen registriert !</h2></center>";
    if(isset($_SESSION['username'])) {
      echo "<center><a class='link' href='?q=AK1PLrshWBEuImVhGosA15aF4MjXdbiOfkUxASesTVgTq4LDoz12FLA5ZD4d0TBrkTWLzJ5GCUhxs2X1wOFttrsMM0foSKS9GA7A'>Jetzt gleich eine Firma eröffnen !</a></center>";
    } else {
      echo "<center><a class='link' href='?q=CXhw9zkblljRs7gaXV1RNwGtkvFU9Ak95GUtemJstgVyvIhrxLxF8f5sHeW2Hwle7PvBnwECzK68jKFs6J9dWrgR2RgSP1mSvM95'>Jetzt gleich eine Firma eröffnen !</a></center>";
    }

  } else {
    while($row = $statement->fetch()) {

      echo "<tr><td><a class='link' href='?23f426c4f4013282f0af720151cd52e6=".$row['einmalige_id']."&q=8gVwkb8n8BaBPmY8bDRKzehtfO8l2GIK3tlYxa8JxE5jIFZ7vuWuGFSpVt5hpmBbyjgCWwEs541wScFt3MTZUZyYRS1rcaBKIvZt'>".$row['firmenname']."</a></td>";
      echo "<td>".$row['mitarbeiter']."</td>";

      if (!isset($_SESSION['username'])) { echo "<td>Du bist nicht angemeldet ! &nbsp;&nbsp;<a class='link' href='?q=RqRB4Ybfszgln4eM82QGNgLdb9noE5mrD2DJigLv65yX53CjdC0i4n7Tmyl03XwChFQdKuxKP0gdS1OuySpVmghwtb101XvgQAww'>Jetzt Registrieren</a></td></tr>";  } else {
        if($_SESSION['firma'] == 1) { echo "<td>Als Firmeninhaber nicht möglich !</td></tr>"; } else {
          if($sperre >= TIME()) { echo "<td>Du bist noch bis ".date('d.m.Y - H:i', $sperre)." Uhr für Bewerbungen gesperrt !</td></tr>"; } else {
      echo "<td><a class='link' href='?q=XPOF8mjsfvApu4DHgybC1uwwMt9GEYv2ApdxTN5zgOWTB5s2sdwVCIM8F8cRFAw0QQVSck88ItbYW9Ab3d7H5Lh1fWCkm7HI3U3k&gzkgjrt4hh58jjt65=".$row['einmalige_id']."'>Bewerbung schreiben</a></td></tr>"; }
    }}}
  echo "</table>";
}

if($_SESSION['firma'] == 0) { echo "<hr><center><a class='btn_senden' href='?q=AK1PLrshWBEuImVhGosA15aF4MjXdbiOfkUxASesTVgTq4LDoz12FLA5ZD4d0TBrkTWLzJ5GCUhxs2X1wOFttrsMM0foSKS9GA7A'>Eigene Firma gründen</a></center>"; }

echo "<br/><br/><hr><center><span style='color:red'><a href='#'>Wichtig: </a>&nbsp;1. Aus Sicherheitsgründen kannst du dich nur alle 3 Tage bei einer neuen Spedition bewerben !<br>2. Du kannst nur in einer Spedition vertreten sein.<br>3. Wenn du eine Firma hast, sind Bewerbungen nicht möglich!<br>4. Bei mehr als 3 Verwarnungen, kannst du dich nicht mehr Bewerben.</span></center><hr><br/><br/><br/><br/>";


 }




 class JSON {

   function alle_staedte_select() {
     $anz = 0;
     $json_url = "https://api.truckyapp.com/v2/truckersmp/player?playerID=".$playerID;
     $json = file_get_contents($json_url);
     $data = json_decode($json, TRUE);
     $anz_stadt = count($data['result']);

     echo "<select name='stadt'>";
     while($anz <= $anz_stadt) {
       echo "<option value='".$data['response']['response']['steamUser']."'>".$data['response']['response']['steamUser']."</option>";
       $anz++;
     }
     echo "</select>";

   }


      function supported_game_version_ets() {

        $json = file_get_contents("https://api.truckyapp.com/v2/truckersmp/version");
        $data = json_decode($json, TRUE);
        return $data['response']['supported_game_version'];

      }

      function supported_game_version_ats() {

        $json = file_get_contents("https://api.truckyapp.com/v2/truckersmp/version");
        $data = json_decode($json, TRUE);
        return $data['response']['supported_ats_game_version'];

      }

      function serverstatus() {
        $anz5 = 0;
        $json_url = "https://api.truckyapp.com/v2/truckersmp/servers";
        $json = file_get_contents($json_url);
        $data = json_decode($json, TRUE);
        $anz_server = count($data['response']);
        echo "<h3 style='padding-left:20px; text-align:left;color:#fff;  border-bottom:1px solid grey; padding-bottom: 5px; margin-top:0px;'><u>Server-Status</u></h3>";

        echo "<table style='width:90%'>";
        while($anz5 <= $anz_server) {

          echo "<td style='width:30%; background:grey; border-top-left-radius:10px;' align='center'>".$data['response']['servers'][$anz5]['shortname']."</td>";
          echo "<td style='width:30%; background:grey;' align='center'>".$data['response']['servers'][$anz5]['players']." Fahrer</td>";
          echo "<td style=' background:grey; border-top-right-radius:10px;' align='center'>( max.".$data['response']['servers'][$anz5]['maxplayers']." )</td><tr>";
          echo "<td colspan='4' style='padding-bottom:20px; text-align:center'>";
          echo "<progress style='width:99%;' value='".$data['response']['servers'][$anz5]['players']."' max='".$data['response']['servers'][$anz5]['maxplayers']."'></progress>";
          echo "</td>";
          echo "<tr>";

          $anz5++;
        }
        echo "</table>";

      }



 }



?>
