<? onlinecheck($pdo); 


if(isset($_POST["update_firma"])) {
	

 $werbetext = filter_input(INPUT_POST, "werbetext", FILTER_SANITIZE_STRING);
 $ts_server = filter_input(INPUT_POST, "teamspeak_server", FILTER_SANITIZE_STRING);
 $ts_port = filter_input(INPUT_POST, "teamspeak_port", FILTER_VALIDATE_INT);
 $mindestalter = filter_input(INPUT_POST, "mindestalter", FILTER_VALIDATE_INT);
 $abrechnungssystem2 = filter_input(INPUT_POST, "abrechnungssystem", FILTER_SANITIZE_STRING);
 $idnummer = $_POST["idnummer"];
 
 echo $werbetext;
 

 $stmt3 = $pdo->prepare("UPDATE firmen SET werbetext = :werbetext, teamspeak_url = :teamspeak_server, teamspeak_port = :teamspeak_port, abrechnungssystem = :abrechnungssystem, mindestalter = :mindestalter WHERE id = :idnummer");
 $stmt3->bindParam(':werbetext', $werbetext);
 $stmt3->bindParam(':teamspeak_server', $ts_server);
 $stmt3->bindParam(':teamspeak_port', $ts_port);
 $stmt3->bindParam(':abrechnungssystem', $abrechnungssystem2);
 $stmt3->bindParam(':mindestalter', $mindestalter);
 $stmt3->bindParam(':idnummer', $idnummer);
 $stmt3->execute();

}

?>



<center>
  <div class="loader">Loading...</div>
  <h2>Deine Daten werden übernommen</h2></center>

  <meta http-equiv="refresh" content="2; URL=?q=pWqaLqQmWSK2QgjLJRneDWLi7yVSjp7emExFpgldauYiOke6Dg5dTDxoaUzYPU3y6aNrOMXmD08ZJC3zzi8c3svA1YH2YOLujOWT">
  <?
