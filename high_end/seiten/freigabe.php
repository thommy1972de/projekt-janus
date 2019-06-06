<?
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
$stmt1 = $pdo->prepare("UPDATE user SET freigabe = '1' WHERE id = :id");
$stmt1->bindParam(':id', $id);
$stmt1->execute();

header("Location: ?q=user");
?>
