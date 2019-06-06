<?
session_start();

include 'inc/functions.php';
include 'inc/defines.php';
include 'db/conn.php';
?>
<!DOCTYPE html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link href="https://fonts.googleapis.com/css?family=Merienda" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style_m.css">
<script src="js/rangeslider.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>
<link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat'>

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
<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
<script src="js/index.js"></script>
</head>
  <!-- XXX: Start of Tawk.to Script-->
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
    <!-- CHANGED: Begin Mobile Header -->

<body><br>
<a href="https://projekt-janus.de/mobile/"><img src="img/2.jpg" width="100%" border="0" /></a>


<?

  $seite = $_GET['q'];
  if(empty($seite)) { $seite = "login"; }
  if(!isset($_SESSION['username'])) { $seite = "login"; }
    include("seiten/".$seite.".php");




?>
