<?
session_start();
$SID = session_id();
$uhrzeit = time();
$timeout = $timestamp - 900;


include 'inc/functions.php';
include 'inc/defines.php';
include 'db/conn.php';
include 'js/standard.php';
require_once "inc/Mobile_Detect.php";
$detect = new Mobile_Detect;

if ( $detect->isMobile() ) {
  ?><meta http-equiv="refresh" content="0; URL=/mobile/"><?
  exit;
}

$seite = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING);
user_firma($_SESSION['username'], $pdo);

$ob_on = $pdo->prepare("SELECT * FROM useronline WHERE einmalige_id = :ein_id");
$ob_on->bindParam(':ein_id', $SID);
$ob_on->execute();


if($ob_on->rowCount() == 0) {

    $insert = $pdo->prepare("INSERT INTO useronline (timestamp, ip, einmalige_id, file, username) VALUES(:uhrzeit, :remote, :einmalige_id, :woher, :username)");
    $insert->bindParam(':uhrzeit', $uhrzeit);
    $insert->bindParam(':remote', $_SERVER['REMOTE_ADDR']);
    $insert->bindParam(':einmalige_id', $SID);
    $insert->bindParam(':woher', $_SERVER['PHP_SELF']);
    $insert->bindParam(':username', $_SESSION['username']);
    $insert->execute();
 } else {
   $insert = $pdo->prepare("UPDATE useronline SET timestamp = :uhrzeit, ip = :remote, file = :woher, username = :username WHERE einmalige_id = :einmalige_id");
   $insert->bindParam(':uhrzeit', $uhrzeit);
   $insert->bindParam(':remote', $_SERVER['REMOTE_ADDR']);
   $insert->bindParam(':woher', $_SERVER['PHP_SELF']);
   $insert->bindParam(':username', $_SESSION['username']);
   $insert->bindParam(':einmalige_id', $SID);
   $insert->execute();
 }

$delete = $pdo->prepare("DELETE FROM useronline WHERE timestamp < ?");
$delete->execute(array($timeout));


?>
<!DOCTYPE html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link href="https://fonts.googleapis.com/css?family=Merienda" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/menu.css">
<link rel="stylesheet" type="text/css" href="css/menu_2.css">
<script src="js/rangeslider.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="https://s3.amazonaws.com/menumaker/menumaker.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<title>Projekt-JANUS! - Die Speditionsverwaltung für ETS !</title>
<meta name="title" content="Projekt-JANUS! - Die Speditionsverwaltung für ETS !">
<meta name="description" content="Was ist Projekt: JANUS ? Wir arbeiten mit Spielern zusammen, um eine zentrale Plattform für ETS2 und ATS zu bieten.
Wir wünschen euch nun viel Spaß">

<!-- FAVICONS -->
<link rel="apple-touch-icon" sizes="57x57" href="img/favicons/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="img/favicons/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="img/favicons/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="img/favicons/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="img/favicons/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="img/favicons/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="img/favicons/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="img/favicons/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="img/favicons/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="img/favicons/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="img/favicons/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="img/favicons/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="img/favicons/favicon-16x16.png">
<link rel="manifest" href="img/favicons/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="https://projekt-janus.de/">
<meta property="og:title" content="Projekt-JANUS! - Die Speditionsverwaltung für ETS !">
<meta property="og:description" content="Was ist Projekt: JANUS ? Wir arbeiten mit Spielern zusammen, um eine zentrale Plattform für ETS2 und ATS zu bieten.
Wir wünschen euch nun viel Spaß">
<meta property="og:image" content="https://projekt-janus.de/werbung_8.jpg">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="https://projekt-janus.de/">
<meta property="twitter:title" content="Projekt-JANUS! - Die Speditionsverwaltung für ETS !">
<meta property="twitter:description" content="Was ist Projekt: JANUS ? Wir arbeiten mit Spielern zusammen, um eine zentrale Plattform für ETS2 und ATS zu bieten.
Wir wünschen euch nun viel Spaß">
<meta property="twitter:image" content="https://projekt-janus.de/werbung_8.jpg">

</head>



<body>

  <!--Start of Tawk.to Script-->
  <script type="text/javascript">
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
  var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
  s1.async=true;
  s1.src='https://embed.tawk.to/5cefbb5b267b2e578530256c/default';
  s1.charset='UTF-8';
  s1.setAttribute('crossorigin','*');
  s0.parentNode.insertBefore(s1,s0);
  })();
  </script>
  <!--End of Tawk.to Script-->

<script>
      $("#cssmenu").menumaker({
        title: "Menu",
        breakpoint: 768,
        format: "multitoggle"
    });





</script>


  <div class="head">
    <center>
      <h1 style="margin-top:-10px; font-size: 76px;"><a href="<?=URL;?>">Projekt: JANUS!</a></h1>
      <h4 style="border-top:1px solid grey; margin-top:-65px; margin-left:120px; font-size: 1.6vw; width:80%;">Denn es geht auch einfach...</h4>
    </center>
  </div>




  <div class="top-bar1">
    <table width="100%" cellspacing="5">
      <tr>

        <td width="65%">
            <span style="font-size:36px; padding-top:-15px;">Einfach, Verständlich, Kostenlos !</span>
        </td>

        <td>
            <? if (empty($_SESSION['username'])) { include ( "seiten/login.php" ); echo $api_key; } else { include ( "seiten/werbung.php" ); } ?>
        </td>

      </tr>
    </table>

  </div>


  <div id="cssmenu" style="margin-top:-15px;">
    <?
    $statement = $pdo->prepare("SELECT einmalige_id FROM user WHERE email = ?");
    $statement->execute(array($_SESSION['username']));
      while($row = $statement->fetch()) {
            $eigene_id_2 = $row['einmalige_id'];
        }
        ?>

    <ul>
      <? if(isset($_SESSION['username'])) { ?>
       <li class="active"><a href="?q=diljiY0Bfv9JdgXZopTDeBjwVRGdBHvbKJuprQ716gCQKoZh8lVXnKOvn6vwRSF5i0Wmv0BkKEjV8Bu8qIvM7JwJOdDzpUmY323E"><i class="fa fa-fw fa-home"></i> Dashboard</a></li>
     <? } else { ?>
       <li class="active"><a href="?q=V7csiaGV3c9bgDE9pw8dceGmg40KvTkAOmxlEd6qjtPXGiVpUww8egIQy4RyjmH2"><i class="fa fa-fw fa-home"></i> Dashboard</a></li>
     <? } ?>


     <? if(isset($_SESSION['username'])) { ?>


       <li class="has-sub"><a href="#"><i class="fa fa-fw fa-bars"></i> Über dich<? if(neue_freundschaftsanfrage($eigene_id_2, $pdo) >= 1) { echo "<img style='margin-top:-15px;' src='https://img.icons8.com/doodle/24/000000/alarm.png'>"; } ?></a>
          <ul>
             <li><a href="?q=10ioL9Kzm2YaEG6Tb4tot2bpGWr3kXO678zXFsATuJEaynLaGmD0jloGEDRdnwJtULKZg9uyuMVvvrY227nEugzfacQmZL4n3CTG"><i class="fa fa-fw fa-user"></i> Dein Profil</a></li>
             <li><a href="?q=pWqaLqQmWSK2QgjLJRneDWLi7yVSjp7emExFpgldauYiOke6Dg5dTDxoaUzYPU3y6aNrOMXmD08ZJC3zzi8c3svA1YH2YOLujOWT"><i class="fa fa-fw fa-industry"></i> Deine Firma</a></li>

              <?
              if(neue_freundschaftsanfrage($eigene_id_2, $pdo) >= 1) { echo "<li><a href='#'><img style='margin-bottom:0px; margin-left:40%;' src='https://img.icons8.com/doodle/24/000000/alarm.png'></a></li>"; } ?>
             <li><a href="?q=ceRlDqQm8ANdNHbQ0nMBkAykhU47WHt5CVfEe9gShF0ib1C1F9lNpuTT0eWmLVDRQOIWDEICMC9XsFGuUTF3pJQcGV54JXLZA2ul"><i class="fa fa-fw fa-group"></i> Deine Freunde</a></li>

             <?
             $stmt_steam = $pdo->prepare("SELECT * FROM user WHERE email = :email");
             $stmt_steam->bindParam(':email', $_SESSION['username']);
             $stmt_steam->execute();
             while($row_steam = $stmt_steam->fetch()) { $steam_nummer = $row_steam['steam_id']; }
             if(!empty($steam_nummer)) { ?>
             <li><a href="?q=b1nN6XTNetDliqKuvmPaMQSluFhXL0VkDLebVZsoTWJVeq6FOKPlHHFxSwA7OpwL31XAQKThnmUjpHPKamOduP5EpMVCtvpNOxpD"><i class="fa fa-fw fa-group"></i> STEAM Freunde</a></li>
           <? } ?>
             <li><a href="?q=KX8ZpI1TKZjLr1GWbBkMLfNbZuvsdAwJYL6QEjA8VmJrk3FACQY84sbslpc9GGuKiM7gtc3fEHVJfUR3jXkH4SZsKCirvSbPntnH"><i class="fa fa-fw fa-commenting"></i> Nachrichten</a></li>
          </ul>
       </li>


       <li class="has-sub"><a href="#">Spieler</a>
          <ul>
             <li><a href="?q=WO5kP2yk95kf70rD0ok6dN3jZTOi0LVF6GWp4yDKTjToOGgxiBWNUxY625LvPMwuB69FYOSmhORbYuVmzUvA5f54S5EuesVpOQz0"><i class="fa fa-fw fa-group"></i> Alle Spieler</a></li>
             <li><a href="?q=uI9jjtmKqbNxXx3f5nHDnkwapFh2T7xar4XW1ayIkyCueTT3z0K8BbYsgL5xv1gsdKmPMh1bthgxPtS2VZJv2EYtgM7XRkL3mNJD"><i class="fa fa-fw fa-search"></i> Spielersuche</a></li>
          </ul>
       </li>
       <li><a href="?q=veic1YOxiHOXn922WC2jDixVx8DpAaUCFTFk5vtuboBsJMlndOpswFeCxnV7InywDZ2Vz6TiIYjkBkLpglaLSVboX5ELDivvLipc"><i class="fa fa-fw fa-truck"></i> Speditionen</a></li>
       <li><a href="?q=V8nGOa5P7sXdN2et3xuzpRQHS6IChEqLBDMTky4wJoWYlcKrF90Zimfg1jvb"><i class="fa fa-fw fa-gg"></i> Events</a></li>
       <li><a href="?q=JdCMK6eo6wiXnOpWAH3xN4bwmoYzsdqbyS86lmTwdAG2GWEnpRti5CIth5G05C3YXvi3PxtsoiBuX1SYtjG31bcnvnhGUR4nMHPk"><i class="fa fa-fw fa-thumbs-down"></i> Blacklist</a></li>

       <? $rang = rang($_SESSION['username'], $pdo);?>
       <!-- Rechte Seite -->
       <? if($rang == 3) {  ?>
       <li style="float:right"><a href="?q=759szGV9df5Y1OZOqPSIdGOAH0scDXguhHSzsUC5WVvLoH4DWBTcXosaR5BeYwJlDSKZjClEDz40cZaHDed3yy3umEamfEndEtna"><i class="fa fa-fw fa-refresh"></i> Update Posten</a></li>
     <? } ?>
        <li style="float:right"><a href="?q=epqCbcK1bYaviJrbiQNQFIqdFaBd2oYFVNL1nuDlWTtn2A54rkm6H8OwpCE7ZTWtAFb8GCJTMvBoPTZpFFtfXE5aAIksFEFizW8Q"><i class="fa fa-fw fa-exclamation-circle"></i> Melde-Center</a></li>
      <!-- <li style="float:right"><a target="_blank" href="http://forum.projekt-janus.de"><i class="fa fa-fw fa-thumbs-up"></i> Forum Extern</a></li> -->

       <!-- <li style="float:right"><a href="?q=qEdaQNmcn15SA1pX4L3OZM5pZKKuE49LkHa8d3ABeKJWBeG5ZymRoYGUr4aW5fFZiZa39pgXVA2jJJNknY12buIUa2YumZBkFnuM"><i class="fa fa-fw fa-question-circle"></i> Fragen</a></li>-->

     <? } ?>
    </ul>
  </div>



  </div>

  <div class="top-bar2">
    <?
    if(!isset($_SESSION['username'])) {
    if($seite == 'V7csiaGV3c9bgDE9pw8dceGmg40KvTkAOmxlEd6qjtPXGiVpUww8egIQy4RyjmH2' OR $seite == "") {
      include ('seiten/top_bar_1.php');
      }
    } ?>
  </div>


<div class="content">
  <?

  if ($seite == "") { $seite = "V7csiaGV3c9bgDE9pw8dceGmg40KvTkAOmxlEd6qjtPXGiVpUww8egIQy4RyjmH2"; }

  include ( "seiten/".link_holen($seite,$pdo).".php" );


  ?>
</div>



<div class="footer">
  <a href="https://discord.gg/GNPwAjH" target="_BLANK"><img style="margin-bottom:-15px" src="https://img.icons8.com/color/48/000000/discord-new-logo.png"></a>
<a href="https://icons8.de" target="_blank">Alle ICONS von ICON8.de</a>
<a class="link" href="?q=5tBkyFG23nVAHue3rFm9UMPIKYPw9E3ewPEu3XgO5B8CGMwTMgz7u6UElHP3BEbk9qZ4KLB2cEMJtPh430b2eyb0cF4ny5xTWIo7">Informationen</a>
<a class="link" href="?q=iDgHqVduXwXvFxgCvEr7lnswCsBKzqOH86NTFmzwVpimYkXqlBQ1xBdbskFNJjyU2T61X403ZKnu0tLjY4678kWGszdi7Dk2265v">Impressum</a>
<a class="link" href="?q=OUzEIPRWaIubLCaiK0A3KieWSS884yyB63vLK1eBIXK8w7YrO2B7gqFCwYoV6asgavpydXklM3WcSTif3BFfcYx5X7Yx5SszR7PU">Datenschutz</a>
<div>


</center>
</body>
</html>
