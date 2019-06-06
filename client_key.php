<?
include 'inc/functions.php';
include 'inc/defines.php';
include 'db/conn.php';


$username = filter_input(INPUT_GET, "euid", FILTER_SANITIZE_STRING);


$statement = $pdo->prepare("SELECT * FROM user WHERE einmalige_id = ?");
$statement->execute(array($username));
  while($row = $statement->fetch()) {
        $vorname = $row['vorname'];
        $nachname = $row['nachname'];
        $client_key = $row['client_key'];

    }

    ?>
    <!DOCTYPE html>
    <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link href="https://fonts.googleapis.com/css?family=Merienda" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/rangeslider.js"></script>
    <script src="//code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <title>Verifizierung für Projekt:JANUS!</title>
    <meta name="description" content="Projekt:JANUS - denn es geht auch einfach!">
    </head>
    <body>
      <?
echo "<center><h2>Dein persönlicher Client-Key lautet:</h2><hr><span style='font-size:18px'>".$client_key."</span><br><hr><span style='color:red; font-family: verdana;'>Gibt diesen einmaligen Code <u>niemals</u> an jemanden weiter.<br>Auch Administatoren oder Moderatoren von Projekt: JANUS!<br>werden dich niemals nach dem genauen Code fragen !</span>";

?>
</body>
</html>
