<? onlinecheck($pdo); ?>
<h2>Forum</h2>

<?
$statement = $pdo->prepare("SELECT * FROM forum ORDER BY name ASC");
$statement->execute();
echo "<table width='100%' cellpadding='5' cellspacing='5'>";
while($row = $statement->fetch()) {




  $forum = $row['id'];
  $antworten_erlaubt = $row['antworten'];

  echo "<tr><td style='background:#2E2E2E'><a href='?forum=".$row['id']."&ant=".$antworten_erlaubt."&q=hWmueP3zAdvLNhw2SlamqXH9jTkuzl3TCr7SlrwQMynZz1tCOaLWVgrGXb1xTV8KPGLrd4XJiZqvE501BB3E4Ee2ZeXXSy5XH9nq'><h2>".$row['name']."</h2></a><br>";
    $beitraege = $pdo->prepare("SELECT * FROM forenposts WHERE forum = ?");
    $beitraege->execute(array($forum));
    echo "Beiträge gesamt: ".$beitraege->rowCount();

    echo "</td></tr>";
}
echo "</table>";
?>
