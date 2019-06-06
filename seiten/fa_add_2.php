<? onlinecheck($pdo); ?>
<form  action="#" method="POST" style="width:60%; text-align:center; border:1px solid #fff; margin:0px auto; padding:10px;">


  <input type="text" name="firmenname" placeholder="Dein neuer Firmenname" value="<?=$_POST['firmenname'];?>" style="font-size:22px;width:450px" required /><br>

  <input type="checkbox" name="DS" id="DS" value="1" /> <label for="DS">Ich habe die <a class="link" href="?q=OUzEIPRWaIubLCaiK0A3KieWSS884yyB63vLK1eBIXK8w7YrO2B7gqFCwYoV6asgavpydXklM3WcSTif3BFfcYx5X7Yx5SszR7PU"> Datenschutzhinweise</a> gelesen und stimme diesen zu.</label><br/><br/>
  <input type="submit" name="senden7" class="btn1" value="Deine Firma jetzt eintragen" style="font-size:22px" /><br/><br/>
</form>

<?
if(isset($_POST['senden7'])) {

  $statement = $pdo->prepare("SELECT * FROM user WHERE email = ?");
  $statement->execute(array($_SESSION['username']));
    while($row = $statement->fetch()) {
          $vorname = $row['vorname'];
          $nachname = $row['nachname'];
          $email = $row['email'];
      }

$firmenname = filter_input(INPUT_POST, 'firmenname', FILTER_SANITIZE_STRING);

$usercheck = $pdo->prepare("SELECT * FROM firmen WHERE email = ?");
$usercheck->execute(array($$email));
if($usercheck->rowCount() >= 1) { echo "<center><h2>Du kannst nur eine Firma haben !</h2></center>"; } else {


$DS = $_POST["DS"];
$timestamp = TIME();
$e_id = einmalige_id();

try{

  $stmt1 = $pdo->prepare("INSERT INTO firmen (einmalige_id, datum, firmenname, email, vorname, nachname, mitarbeiter) VALUES (:einmalige_id, :datum, :firmenname, :email, :vorname, :nachname, 1)");
  $stmt1->bindParam(':einmalige_id', $e_id);
  $stmt1->bindParam(':datum', $timestamp);
  $stmt1->bindParam(':firmenname', $firmenname);
  $stmt1->bindParam(':email', $email);
  $stmt1->bindParam(':vorname', $vorname);
  $stmt1->bindParam(':nachname', $nachname);
  $stmt1->execute();

  $stmt2 = $pdo->prepare("UPDATE user SET in_spedition = :spedi WHERE email = :username");
  $stmt2->bindParam(':spedi', $firmenname);
  $stmt2->bindParam(':username', $email);
  $stmt2->execute();

  $logeintrag = utf8_decode('Es wurde ein Firma für den vorhandenen Benutzer '.$vorname.' '.$nachname.' mit der Email Adresse '.$email.' erstellt');
  logbucheintrag($logeintrag, $pdo);


} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}
?>
<meta http-equiv="refresh" content="0; URL=?q=veic1YOxiHOXn922WC2jDixVx8DpAaUCFTFk5vtuboBsJMlndOpswFeCxnV7InywDZ2Vz6TiIYjkBkLpglaLSVboX5ELDivvLipc">
<?

}
}
?>
