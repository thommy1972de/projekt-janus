<? onlinecheck($pdo); ?>
<h2>Die Blacklist</h2>
<?
$statement97 = $pdo->prepare("SELECT * FROM blacklist ORDER BY nachname ASC");
$statement97->execute();

echo "<center><table width='98%' cellpadding='5'>";
echo "<tr>";
echo "<td width='150px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>Vorname</td>";
echo "<td width='30px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>NN</td>";
echo "<td width='130px' align='center' style='background: #2E2E2E;border-bottom:1px solid grey;'>Player-ID</td>";
echo "<td width='250px' align='left' style='background: #2E2E2E;border-bottom:1px solid grey;'>Steam User</td>";
echo "<td width='150px' align='left' style='background: #2E2E2E;border-bottom:1px solid grey;'>Vorfälle</td>";
echo "<td></td></tr>";
echo "</table>";

echo "<table width='98%' cellpadding='5'>";
  while($row55 = $statement97->fetch()) {

    $statement98 = $pdo->prepare("SELECT * FROM user WHERE einmalige_id = ?");
    $statement98->execute(array($row55['einmalige_id']));
    while($row66 = $statement98->fetch()) {
        echo "<tr>";
        echo "<td width='150px' align='left'>".$row55['vorname']."</td>";
        echo "<td width='30px' align='center'>".substr($row55['nachname'],0,1).".</td>";
        echo "<td width='130px' align='center'><a class='link' href='?q=uI9jjtmKqbNxXx3f5nHDnkwapFh2T7xar4XW1ayIkyCueTT3z0K8BbYsgL5xv1gsdKmPMh1bthgxPtS2VZJv2EYtgM7XRkL3mNJD&player_id=".$row66['truckers_mp']."'>".$row66['truckers_mp']."</a></td>";
        echo "<td width='250px'>".$row55['steam_name']."</td>";
        echo "<td width='150px'><a class='link' href='?terebskptlq=".$row55['einmalige_id']."&q=3GoPnWQAhTolx3sL7XNyfGuYoC34uRCHtP8C1TAakvq9j3BhPbWE6ELrzmQzbUtazULMIgBDkqgOuSqEjmVMKXD5CGQewJ1iXtQZ'>Vorfälle anzeigen</a></td>";
        echo "<td></td></tr>";
    }}
echo "</table><br>Aus Datenschutzrechtlichen Gründen zeigen wir nirgends Nachnamen an !</center>";
    ?>
