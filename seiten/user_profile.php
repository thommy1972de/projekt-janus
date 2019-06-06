<? onlinecheck($pdo); ?>
<h2>Benutzerprofil</h2>

<?
$ein_id = filter_input(INPUT_GET, "grt4ghtrte575rgfz7rtzr456tfghg9hfrt", FILTER_SANITIZE_STRING);
$stmt413 = $pdo->prepare("SELECT * FROM user WHERE email = ?");
$stmt413->execute(array($ein_id));
while($row3 = $stmt413->fetch()) {








}
?>
