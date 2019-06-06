<? session_start();
include '../inc/defines.php';
include '../db/conn.php';
include 'inc/function.php';
?>
<!DOCTYPE html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link href="https://fonts.googleapis.com/css?family=Merienda" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="style/style.css">
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

<title>Projekt-JANUS! - Adminbereich !</title>
<meta name="title" content="Projekt-JANUS! - Adminbereich !">
<meta name="description" content="Was ist Projekt: JANUS ? Wir arbeiten mit Spielern zusammen, um eine zentrale Plattform für ETS2 und ATS zu bieten.
Wir wünschen euch nun viel Spaß">
</head>
<body>

<center><h1>Adminbereich</h1>

<?
$seite = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING);
if ($seite == "" OR $_SESSION['admin'] == 0) { $seite = "login"; }
?>
<div id="cssmenu">
  <ul>
     <li class="active"><a href="?q=startseite"><i class="fa fa-fw fa-home"></i> Startseite</a></li>
     <li><a href="?q=user"><i class="fa fa-fw fa-group"></i> Benutzer</a></li>
     <li><a href="?q=logfile"><i class="fa fa-fw fa-file-code-o"></i> Logfile</a></li>
     <li><a href="?q=news_add"><i class="fa fa-fw fa-hand-spock-o"></i> System Nachricht</a></li>
     <li><a href="?q=meldungen"><i class="fa fa-fw fa-warning"></i> Meldungen</a></li>

     <li style="float:right"><a href="?q=logout"><i class="fa fa-fw fa-power-off"></i> Logout</a></li>
  </ul>
</div>
<?
include ( "seiten/".$seite.".php" );

?>
<script>


$('#cssmenu > ul').prepend('<li class=\"mobile\"><a href=\"#\"><span>Menu <i>&#9776;</i></span></a></li>');
$('#cssmenu > ul > li > a').click(function(e) {
  $('#cssmenu li').removeClass('active');
  $(this).closest('li').addClass('active');
  var checkElement = $(this).next();
  if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
    $(this).closest('li').removeClass('active');
    checkElement.slideUp('normal');
  }
  if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
    $('#cssmenu ul ul:visible').slideUp('normal');
    checkElement.slideDown('normal');
  }
  if( $(this).parent().hasClass('mobile') ) {
    e.preventDefault();
    $('#cssmenu').toggleClass('expand');
  }
  if($(this).closest('li').find('ul').children().length == 0) {
    return true;
  } else {
    return false;
  }
});


</script>
</body>
</html>
