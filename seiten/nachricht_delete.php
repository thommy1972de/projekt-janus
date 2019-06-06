<? onlinecheck($pdo); ?><?
$un_id = filter_input(INPUT_POST, "einmalige_id", FILTER_SANITIZE_STRING);
$stmt3 = $pdo->prepare("DELETE FROM messages WHERE einmalige_id = :un_id");
$stmt3->bindParam(':un_id', $un_id);
$stmt3->execute();



?>
<div class="loader">Loading...</div>
<br><?=zitat($pdo);?><br>
<meta http-equiv="refresh" content="4; URL=?q=KX8ZpI1TKZjLr1GWbBkMLfNbZuvsdAwJYL6QEjA8VmJrk3FACQY84sbslpc9GGuKiM7gtc3fEHVJfUR3jXkH4SZsKCirvSbPntnH">
