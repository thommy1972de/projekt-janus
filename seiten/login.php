
<form action="#" method="POST" autocomplete="off" style="text-align:right; width:670px; margin-bottom:-10px;">
<p style="position:absolute; right:2%; margin-top:-17px; font-size:24px;">>> Benutzer-Login <<</p><br/>
<input type="text" name="username" placeholder="E-Mail Adresse" style="width:200px" autocomplete="off" />
<input type="password" name="passwort" placeholder="Passwort" style="width:200px" autocomplete="off" />
<input type="submit" name="senden" class="btn_senden" value="LOGIN" />
</form>
<a class="link" style="font-size:12px; margin-left:120px;" href="?q=RqRB4Ybfszgln4eM82QGNgLdb9noE5mrD2DJigLv65yX53CjdC0i4n7Tmyl03XwChFQdKuxKP0gdS1OuySpVmghwtb101XvgQAww">Benutzer-Account anlegen</a>
<a class="link" style="font-size:12px; margin-left:100px;" href="#">Passwort vergessen</a>

<?
if(isset($_POST['senden'])) {

$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
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
<meta http-equiv="refresh" content="0; URL=?q=diljiY0Bfv9JdgXZopTDeBjwVRGdBHvbKJuprQ716gCQKoZh8lVXnKOvn6vwRSF5i0Wmv0BkKEjV8Bu8qIvM7JwJOdDzpUmY323E">
<?
} else {
  echo "<br/><span style='margin-left:180px; color:red;'>Leider stimmt das Passwort nicht !</span>";
}
}

}
?>
