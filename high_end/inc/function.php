<?

function username_admin ($user_ad, $pdo) {

  $username = $pdo->prepare("SELECT * FROM user WHERE einmalige_id = ?");
  $username->execute(array($user_ad));
    while($row_user = $username->fetch()) {
      return $row_user['nachname']." ".$row_user['vorname'];
    }
}



?>
