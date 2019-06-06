<?
onlinecheck($pdo);

if($_SESSION['firma'] == 0) {




    $stmt7 = $pdo->prepare("SELECT * FROM user WHERE email = :email");
    $stmt7->bindParam(':email', $_SESSION['username']);
    $stmt7->execute();
    while($row_u = $stmt7->fetch()) {
      $in_spedi = $row_u['in_spedition'];
      $last_login = $row_u['last_login'];
    }

    if($in_spedi == 0) { $deine_spedition = "Du bist in keiner Spedition&nbsp;&nbsp;&nbsp;<a class='link' href='?q=veic1YOxiHOXn922WC2jDixVx8DpAaUCFTFk5vtuboBsJMlndOpswFeCxnV7InywDZ2Vz6TiIYjkBkLpglaLSVboX5ELDivvLipc'>Jetzt suchen</a>"; }

    echo "<p style='margin-top:-20px; padding-bottom:-50px;'>Deine Spedition: ".$deine_spedition."<br/>";
    echo "Dein letzter Login: ".date('d.m.Y - H:i', $last_login)." Uhr<br/>";
    echo "Nachrichten: ".mailcheck($_SESSION['username'], $pdo)."<br>Nachrichten Gesamt: ".mailcheck2($_SESSION['username'], $pdo)."<br/>";
    echo "</p>";


} else {
  $stmt5 = $pdo->prepare("SELECT * FROM firmen WHERE email = :email");
  $stmt5->bindParam(':email', $_SESSION['username']);
  $stmt5->execute();
  while($row_f = $stmt5->fetch()) {
    $firmenename3 = $row_f['firmenname'];
    $fa_ma = $row_f['mitarbeiter'];
  }

  $stmt6 = $pdo->prepare("SELECT * FROM bewerbungen WHERE an_firma = :an_fa AND gelesen = 0");
  $stmt6->bindParam(':an_fa', $_SESSION['username']);
  $stmt6->execute();
  $bewerbungen = $stmt6->rowCount();


  echo "<p style='margin-top:-20px; padding-bottom:-50px;'>Deine Firma: <a href='?q=pWqaLqQmWSK2QgjLJRneDWLi7yVSjp7emExFpgldauYiOke6Dg5dTDxoaUzYPU3y6aNrOMXmD08ZJC3zzi8c3svA1YH2YOLujOWT'>".$firmenename3."</a><br/>";
  echo "Mitarbeiter: ".$fa_ma."<br/>";
  echo "Bewerbungen: ".$bewerbungen."<br>";
  echo "Nachrichten: ".mailcheck($_SESSION['username'], $pdo)." (".mailcheck2($_SESSION['username'], $pdo)." Ges.)<br/>";
  echo "</p>";




}
?>
<a class="link" style="float:right; margin-top:-100px; padding-right:20px;" href="?q=jDRKLVibMzLhEpOGK46M2dXFpLcFrwNERe5FCq7tTvejcCyPwzEmFuYMgk3ezdeEQBLg3I03VE3SmzOzJGj2f53hoaq8T8gDQExL">Abmelden</a>
