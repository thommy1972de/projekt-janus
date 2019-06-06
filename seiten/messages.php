<? onlinecheck($pdo); ?><h2>Messages</h2>

<?
$statement = $pdo->prepare("SELECT * FROM messages WHERE an_user = ?");
$statement->execute(array($_SESSION['username']));
$anz = $statement->rowCount();
if($anz == 0) {  echo "<br><center><h1>Du hast keine Nachrichten !</h1></center>";  } else {

echo "<table width='50%' style='border:0px solid grey;'><tr>";
echo "<td width='5%' align='center'>Neu</td>";
echo "<td width='20%' align='center'>Absender</td>";
echo "<td width='75%' align='left' style='padding-left:20px'>Betreff</td>";
echo "</tr>";

  while($row = $statement->fetch()) {

    $statement2 = $pdo->prepare("SELECT * FROM user WHERE email = ?");
    $statement2->execute(array($row['von_user']));
    while($row2 = $statement2->fetch()) { $von_user_name = $row2['vorname']; if($row['von_user'] == EMAIL_ADRESSE) { $von_user_name = "<span style='color:red'>Administration</span>"; } }
    if($row['gelesen'] == 0) { $neu = "NEU!"; }
    echo "<tr>";
    echo "<td width='5%' style='border:1px solid grey; padding:10px;'>".$neu."</td>";
    echo "<td width='20%' style='border:1px solid grey; padding:10px;'>".$von_user_name."</td>";
    echo "<td width='75%' style='border:1px solid grey; padding:10px;'><a class='link' href='?id=".$row['einmalige_id']."&q=OU7QS6tUnexlqDvT9oz3bc4r6cM7gqKXItMzuy3oVvS2TY2RgAqPKxdiDavtVcN0pgyi3kdhKfhumjNpJ0sXxAIdhJtVG1whZj68'>".$row['titel']."</a></td>";
    echo "</tr>";
    }
}
?>
</table><br><br>
<a href="?q=D6spP8FHSuVOeZcrzywWMXxvf0j2GE49tUdkbYBC7hK1RTLn5l3AIQoiqgma"><h2>Neue Nachricht an einen Freund schicken</h2></a>
