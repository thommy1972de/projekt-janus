<form action="#" method="POST">

<input type="text" name="username" placeholder="Dein Username" size="35" />
<input type="password" name="passwort" placeholder="Dein Passwort" size="35" />
<br><br>
<input type="submit" name="senden" value="Login" />


</form>
<?
if(isset($_POST['senden'])) {

$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
$passwort = filter_input(INPUT_POST, "passwort", FILTER_SANITIZE_STRING);

$statement = $pdo->prepare("SELECT * FROM admin WHERE email = ? LIMIT 1");
$statement->execute(array($username));
$anz = $statement->rowCount();
if($anz == 0) {  echo "<br><span style='margin-left:150px; color:red; '>Dieser Benuzer ist uns leider nicht bekannt !</span>";  }

  while($row = $statement->fetch()) {
        $db_email = $row['email'];
        $db_pass = $row['passwort'];
    }

if (password_verify($passwort, $db_pass)) {

$_SESSION['admin'] = 1;
$_SESSION['username'] = $db_email;
$datum = date("d.m.Y", TIME());
$uhrzeit = date("H:i", TIME());

$eintrag = "Der Admin ".$db_email." hat sich am ".$datum." um ".$uhrzeit." Uhr im Adminbereich angemeldet !";
logbucheintrag($eintrag, $pdo);

?>
<meta http-equiv="refresh" content="0; URL=?q=startseite">
<?

} else {
  echo "<br/><span style='margin-left:180px; color:red;'>Leider stimmt dein Passwort nicht !</span>";
}


}
?>
