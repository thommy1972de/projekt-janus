<?
onlinecheck($pdo); 
// FAHRER EINSTELLEN
$fahrer_id = filter_input(INPUT_GET, "keretimat", FILTER_SANITIZE_STRING);
$sped_id = filter_input(INPUT_GET, "sped_id", FILTER_SANITIZE_STRING);


$timestamp = time();



$update = $pdo->prepare("INSERT INTO fahrer (fahrer_id, sped_id, datum, rang) VALUES (:fahrer_id, :sped_id, :datum, 1)");
$update->bindParam(':fahrer_id', $fahrer_id);
$update->bindParam(':sped_id', $sped_id);
$update->bindParam(':datum', $timestamp);
$update->execute();

$update2 = $pdo->prepare("UPDATE firmen SET mitarbeiter = mitarbeiter + 1 WHERE einmalige_id = :ein_id");
$update2->bindParam(':ein_id', $sped_id);
$update2->execute();

?>
<center><h2>Du hast den Fahrer eingestellt !</h2></center>

<meta http-equiv="refresh" content="0; URL=?q=pWqaLqQmWSK2QgjLJRneDWLi7yVSjp7emExFpgldauYiOke6Dg5dTDxoaUzYPU3y6aNrOMXmD08ZJC3zzi8c3svA1YH2YOLujOWT">
