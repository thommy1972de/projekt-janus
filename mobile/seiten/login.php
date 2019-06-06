<h2>Login</h2>
<br>
<center>
Willkommen bei Projekt:JANUS!<br><br><hr style="border:2px solid #fff;;"><br>
Diese Seite richtet sich an virtuelle Spediteure und ihre Fahrer.
<br><br>Diese mobile Webseite ist nur zur Kontrolle der Daten, es können keine Eingaben geändert oder eingegeben werden !<br><br><hr><br>Am System anmelden:<br><br>

<form action="#" method="POST">
  <input type="email" name="username" placeholder="Email-Adresse" /><br>
  <input type="password" name="passwort" placeholder="Dein Passwort" /><br>
  <input type="submit" name="senden" value="Anmelden" />


</form>
<br><br><br>
</center>
<?
if(isset($_POST['senden'])) {

$username = filter_input(INPUT_POST, "username", FILTER_VALIDATE_EMAIL);
$passwort = filter_input(INPUT_POST, "passwort", FILTER_SANITIZE_STRING);

$statement = $pdo->prepare("SELECT * FROM user WHERE email = ? LIMIT 1");
$statement->execute(array($username));
$anz = $statement->rowCount();
if($anz == 0) {  echo "<br><span style='margin-left:150px; color:red; '>Dieser Benuzer ist uns leider nicht bekannt !</span>";  }

  while($row = $statement->fetch()) {
        $db_email = $row['email'];
        $db_pass = $row['passwort'];
        $freigabe = $row['freigabe'];

    }


if($freigabe == 0) {  echo "<br><span style='margin-left:150px; color:red; '>Du wurdest noch nicht vom Admin freigeschaltet !</span>";  } else {

if (password_verify($passwort, $db_pass)) {

$_SESSION['username'] = $db_email;
$datum = date("d.m.Y", TIME());
$uhrzeit = date("H:i", TIME());
$eintrag = "Der User ".$db_email." hat sich am ".$datum." um ".$uhrzeit." Uhr am System angemeldet !";
logbucheintrag($eintrag, $pdo);
set_online($db_email, $pdo);

?>
<meta http-equiv="refresh" content="0; URL=?q=startseite">
<?
} else {
  echo "<br/><span style='margin-left:180px; color:red;'>Leider stimmt das Passwort nicht !</span>";
}
}

}
?>
