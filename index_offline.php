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
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/timeTo.css">
<script src="js/jquery.time-to.js"></script>
<script src="js/jquery.time-to.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="//code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
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



  <div style="margin-top:5%;">
  <center>
    <h2 style="font-size:58px;"><u>Pro</u>j<u>ekt</u></h2><br>
    <h1 style="font-size:128px; margin-top:-100px; margin-left:130px;">JANUS</h1>
    <p class="waitingForConnection" style="font-size:69px; margin-top:-120px; margin-left:-0px; margin-bottom:0px;">Wir gehen Online am 02.06.2019</p>
<br><br>
<div style="width:500px;border-right:1px solid grey; border:1px solid grey; border-radius:50px; padding:20px;-webkit-box-shadow: 0px 0px 21px 19px rgba(201,142,47,1);
-moz-box-shadow: 0px 0px 21px 19px rgba(201,142,47,1);
box-shadow: 0px 0px 21px 19px rgba(201,142,47,1);"><br>
  <center>

</center>
Die neusten Updates findet ihr ab sofort im Discord Channel "#update-news" !<br><br><img src="https://img.icons8.com/color/48/000000/discord-logo.png" style="margin-bottom:-15px; padding-right:10px;"> <a style="font-size:24px;" href="https://discord.gg/GNPwAjH">https://discord.gg/GNPwAjH</a>
</div>
<div style="width:60%; font-size:34px;">
<h2>Was ist Projekt: JANUS! ?</h2>
Wir haben das Projekt im Mai 2019 gegründet, um Spielern von ETS2 und ATS eine Plattform zu bieten,
sich Auszutauschen, Bilder zu Posten, Meldungen zum Spiel zu machen und
neue Freunde oder Mitspieler für ihre Speditionen zu suchen.<br><br>
Des Weiteren sind oder werden diverse Statistiken und Berechnungen über das Spiel implementiert, die Auskunft über Fahrzeiten, Kraftstoffverbrauch
sowie Aufträge und anderes anzeigen werden.
<br>Wir führen eine Freundschaftsliste ein,
in die man Freunde einladen kann und eine Blacklist, in der Spieler, die Auffällig wurden,
zentralisiert geführt und gesucht werden können.<br><br>
Das Projekt ist noch im Aufbau und wir suchen derzeit noch Tester zur Fehlersuche, einen C# Skripter und Moderatoren.<br><br>
<? if(empty($_SESSION['formular'])) { ?>
Bewerben könnt ihr euch gleich hier:<br>

<form action="#" method="POST">
  <select name="als_was">
    <option selected>Als was willst du dich Bewerben ?</option>
    <option value="Beta-Tester">Beta-Tester</option>
    <option value="Skripter">Skripter</option>
    <option value="Moderator">Moderator</option>
  </select><br>
  <input type="text" name="name_gamer" size="50" placeholder="Dein Name (wird nicht veröffentlicht)" /><br>
  <input type="email" name="email_gamer" size="50" placeholder="Deine Email Adresse (wird nicht veröffentlicht)" /><br>
  <textarea name="warum" cols="75" rows="4" placeholder="Was zeichnet dich für die Stelle aus ?" onlick="this.value=''"></textarea>
	<br />
	<input type="submit" name="bewerben" class="btn_green" value="Bewerbung absenden" />

</form>
<? } else { echo "<center>Danke für deine Bewerbung !</center>"; } ?>

<br><br>
</div>

</center>

    <div style="position:fixed; bottom:10px;">
      <div class="footer">
      <a class="link" href="https://icons8.de" target="_blank">ICONS von ICON8.de</a>
      <a class="link" href="?q=5tBkyFG23nVAHue3rFm9UMPIKYPw9E3ewPEu3XgO5B8CGMwTMgz7u6UElHP3BEbk9qZ4KLB2cEMJtPh430b2eyb0cF4ny5xTWIo7">Informationen</a>
      <a class="link" href="?q=iDgHqVduXwXvFxgCvEr7lnswCsBKzqOH86NTFmzwVpimYkXqlBQ1xBdbskFNJjyU2T61X403ZKnu0tLjY4678kWGszdi7Dk2265v">Impressum</a>
      <a class="link" href="?q=OUzEIPRWaIubLCaiK0A3KieWSS884yyB63vLK1eBIXK8w7YrO2B7gqFCwYoV6asgavpydXklM3WcSTif3BFfcYx5X7Yx5SszR7PU">Datenschutz</a><br>
      <a id="1477858" href="http://www.besucherzaehler-homepage.de">besucherzaehler-homepage</a><script type="text/javascript" language="JavaScript" src="https://www.besucherzaehler-homepage.com/counter_js.php?account=1477858&style=26"></script>
      <div>
    </div>

<?
if(isset($_POST["bewerben"])) {

$_SESSION['formular'] = "1";

$name = filter_input(INPUT_POST, "name_gamer", FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, "email_gamer", FILTER_SANITIZE_STRING);
$als_was = filter_input(INPUT_POST, "als_was", FILTER_SANITIZE_STRING);
$warum = filter_input(INPUT_POST, "warum", FILTER_SANITIZE_STRING);


$empfaenger = EMAIL_ADRESSE;
$betreff = "Bewerbung ".SITENAME;
$from = "From: Projekt JANUS! <".EMAIL_ADRESSE.">\r\n";
$from .= "Reply-To: ".EMAIL_ADRESSE."\r\n";
$from .= "Content-Type: text/html\r\n";
$text = "Ein User hat sich Beworben. Name: ".utf8_decode($name)."<br>Email: ".$email."<br>Als: ".$als_was."<br>Warum: ".$warum." !";
mail($empfaenger, $betreff, $text, $from);

echo "<center><h2>Vielen Dank für deine Bewerbung. Wir prüfen diese Umgehend und melden uns bei dir !</h2></center><br><br><br>";
?>
<meta http-equiv="refresh" content="0; URL=https://projekt-janus.de/">

<? } ?>

  </body>
  </html>
