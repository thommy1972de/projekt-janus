<? onlinecheck($pdo); ?><h2><?=pfeil_back();?> Nachrichten-Details</h2>
<?
$id = $_GET["id"];

$statement97 = $pdo->prepare("UPDATE messages SET gelesen = 1 WHERE einmalige_id = ?");
$statement97->execute(array($id));

$statement98 = $pdo->prepare("SELECT * FROM messages WHERE einmalige_id = ?");
$statement98->execute(array($id));



while($row98 = $statement98->fetch()) {
echo "<h1>Betreff: ".$row98['titel']."</h1>";
echo nl2br($row98['inhalt']);

}

?>
<table width="500px" ceelpadding="10" cellspacing="100"><td>
<form style="float:right" action="?q=hAu5kTerB8P0DvaFOHVwn5prUqNxWJYcoOadbasmWQWQ9aKlopkTUWtq7O8BdGF8Q3cFooyjvW6i3as42GetIIZPLMrNlEQEjzz5" method="POST">
  <input type="hidden" name="einmalige_id" value="<?=$id; ?>" />
  <input class="btn_senden" type="submit" name="senden" value="Nachricht beantworten" />
</form>
</td><td>
<form action="?q=ubcDJY33cC81t6kLyOZppK00MXKjisBlC9r9JGtT8g3xk2v2Nb2mQwEQHB8uNJjlv5at7eNaDkl9cPxlyVCwukXHqmePTngtPhJh" method="POST">
  <input type="hidden" name="einmalige_id" value="<?=$id; ?>" /> <input class="btn_red" type="submit" name="delete" value="Nachricht löschen" />
</form>
</td>
</table>

<?
if(isset($_POST["delete"])) {
  echo "DELETE";

}
?>
