<?=onlinecheck($pdo);?>
<h2>Update-News</h2><center>
<form action="#" method="POST">
  <input type="text" name="betreff" size="60" placeholder="Titel" /><br>
  <textarea name="inhalt" cols="57" rows="5"></textarea>

<br><br>
<input class="btn_green" type="submit" name="eintrag55" value="Auf Discord posten" />
</form>
</center>

<?
if(isset($_POST["eintrag55"])) {

  $betreff = filter_input(INPUT_POST, "betreff", FILTER_SANITIZE_STRING);
$text = filter_input(INPUT_POST, "inhalt", FILTER_SANITIZE_STRING);

postToUpdate_News($betreff." :: ".$text);

?>
<meta http-equiv="refresh" content="0; URL=?q=V7csiaGV3c9bgDE9pw8dceGmg40KvTkAOmxlEd6qjtPXGiVpUww8egIQy4RyjmH2">
<?
}
