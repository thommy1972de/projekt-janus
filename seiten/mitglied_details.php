<? onlinecheck($pdo); ?><h2>Mitglied-Details</h2>

<?
echo "<div style='width:30%; float:left; padding:10px;'>";

$idnu_2 = filter_input(INPUT_GET, "uruskapet", FILTER_SANITIZE_STRING);
$statement98 = $pdo->prepare("SELECT * FROM user WHERE einmalige_id = ?");
$statement98->execute(array($idnu_2));
while($row = $statement98->fetch()) {
echo "Name: ".$row['vorname']." ".substr($row['nachname'], 0, 1).".<br>";
if($row['ort'] == "") {
echo "Wohnort: n.A.<br>";
} else {
echo "Wohnort: ".$row['ort']."<br>";
}
echo "User-ID:".$row['id']."<br>";

}
echo "</div>";

echo "<div style='width:40%; padding:10px; float:left;'>";
$statement99 = $pdo->prepare("SELECT * FROM verwarnungen WHERE einmalige_id = ?");
$statement99->execute(array($idnu_2));
while($row_verw = $statement99->fetch()) {
  $e_id_1 = $row_verw['einmalige_id'];
}
$anz_verwarnungen = $statement99->rowCount();
echo "<img src='img/security.png' border='0' style='margin-bottom:-10px' /><a class='link' href='?terebskptlq=".$e_id_1."&q=3GoPnWQAhTolx3sL7XNyfGuYoC34uRCHtP8C1TAakvq9j3BhPbWE6ELrzmQzbUtazULMIgBDkqgOuSqEjmVMKXD5CGQewJ1iXtQZ'> Der User hat ".$anz_verwarnungen." Verwarnungen.</a>";


$statement100 = $pdo->prepare("SELECT * FROM auszeichnungen WHERE einmalige_id = ?");
$statement100->execute(array($idnu_2));

$anz_auszeichnungen = $statement100->rowCount();
echo "<br><br><img src='img/award.png' border='0' style='margin-bottom:-10px' /><a class='link' href='?terebskptlq=".$e_id_1."&q=glCGpDmNgzcElwW3uxpYEauBS3SFlHxqP3mq2OgSS8OQmj1Gdabp19ycT3SlkC0Hu2ZAzaasPTWNwrzKkLLAUK9rSiQu0VxtsIWN'> Der User hat ".$anz_auszeichnungen." Auszeichnungen.</a>";
echo "</div>";
?>
