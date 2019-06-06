
<?
onlinecheck($pdo); 

$firmen_id = filter_input(INPUT_GET, "23f426c4f4013282f0af720151cd52e6", FILTER_SANITIZE_STRING);
$statement = $pdo->prepare("SELECT * FROM firmen WHERE einmalige_id = ?");
$statement->execute(array($firmen_id));
while($row = $statement->fetch()) {
   $einmalige_id = $row['einmalige_id'];
   $background =  $row['firmen_header'];
   $firmenname = $row['firmenname'];
   $datum = $row['datum'];
   $inh_vorname = $row['vorname'];
   $inh_nachname = $row['nachname'];
   $anz_ma = $row['mitarbeiter'];
   $fa_logo = $row['firmen_logo'];

   $mindestalter = $row['mindestalter'];
   if($mindestalter == "") { $mindestalter = MINDESTALTER; }
   
   $fb_site = $row['fb_site'];
   if($fb_site == "") { $fb_site = "Nicht angegeben"; }
   $twitter_site = $row['twitter_site'];
   if($twitter_site == "") { $twitter_site = "Nicht angegeben"; }
   $bewerber_hinweis = $row['bewerber_hinweis'];
   $teamspeak_url = $row['teamspeak_url'];
   $teamspeak_port = $row['teamspeak_port'];
   $ts_oeffentlich = $row['ts_oeffentlich'];
   $ts_viewer_code = $row['ts_viewer_code'];
   $discord_server = $row['discord_server'];
   $discord_oeffentlich = $row['discord_oeffentlich'];

}

if($fa_logo == "") { $fa_logo = "kl.png"; }
if($background == "") { $background = "kl1.png"; }
?>
<div style="background-image: url('img/firmenheader/<?=$background;?>'); height: 200px;  background-attachment: fixed; background-position: left; background-repeat: no-repeat; background-size: auto auto;"></div>

<div style="height:500px; color:#000; background: #929292; border-radius:50px; padding:20px;font-size:36px;">

<img src="img/firmenlogos/<?=$fa_logo; ?>" border="0" style="position:absolute; padding:20px 50px 0px 50px; background-color: #929292; border-radius:50px;right:120px; margin-top:-190px; width:190px;" />

<h3><?=$firmenname;?></h3><hr>

<div style="width:600px; margin-top:-100px; # color:#000; font-size:18px; float:right;">
  <?
$statement2 = $pdo->prepare("SELECT * FROM user WHERE email = ?");
$statement2->execute(array($_SESSION['username']));
while($row_user = $statement2->fetch()) {

  $sperre = $row_user['naechste_bewerbung'];

}

  if($sperre >= TIME()) { echo "Du bist noch bis ".date('d.m.Y - H:i', $sperre)." Uhr für Bewerbungen gesperrt !"; } else {
  if(!isset($_SESSION['username'])) { echo "<a class='link' style='color:#000' href='?q=RqRB4Ybfszgln4eM82QGNgLdb9noE5mrD2DJigLv65yX53CjdC0i4n7Tmyl03XwChFQdKuxKP0gdS1OuySpVmghwtb101XvgQAww'>Jetzt Registrieren</a>";
    } else {
    echo "<a class='link' style='color:#000' href='?q=XPOF8mjsfvApu4DHgybC1uwwMt9GEYv2ApdxTN5zgOWTB5s2sdwVCIM8F8cRFAw0QQVSck88ItbYW9Ab3d7H5Lh1fWCkm7HI3U3k&gzkgjrt4hh58jjt65=".$einmalige_id."'>Bewerbung schreiben</a>";
  }}


    ?>
  </div>

</center>
</p>


<table width="500px" style="float:left; color:#000;"><tr>
<td width="15%">Gründer:</td><td><?=utf8_encode($inh_vorname).' '.utf8_encode($inh_nachname);?></td><tr>
<td>Gründungsdatum:</td><td><?=date('d.m.Y', $datum);?></td><tr>
<td>Mitarbeiter:</td><td><?=$anz_ma;?></td><tr>
<td>Facebook-Seite:</td><td><?=$fb_site;?></td><tr>
<td>Twitter-Seite:</td><td><?=$twitter_site;?></td><tr>
<!-- TEAMSPEAK ANFANG ---->
<?
if($teamspeak_url == "") { ?>
  <td>Teamspeak:</td><td>Kein Server angegeben !</td><tr>
  <? } else {
if($ts_oeffentlich == 1) { ?>
  <td>Teamspeak:</td><td><a class="link" href="ts3server://<?=$teamspeak_url;?>?port=<?=$teamspeak_port;?>"><?=$teamspeak_url.':'.$teamspeak_port;?></a></td><tr>
<? } else { ?>
  <td>Teamspeak:</td><td>Bitte TS-Daten bei der Spedition anfragen !</td><tr>
<? }} ?>

<!--- DISCORD ANFANG --->
<?
if($discord_server == "") { ?>
  <td>Discord:</td><td>Kein Server angegeben !</td><tr>
  <? } else {
if($discord_oeffentlich == 1) { ?>
  <td>Discord:</td><td><?=$discord_server;?></td><tr>
<? } else { ?>
  <td>Discord:</td><td>Bitte Discord-Daten bei der Spedition anfragen !</td><tr>
<? }} ?>
<td>Mindest-Alter:</td><td><?=$mindestalter;?> Jahre</td><tr>
<td valign="top">Bewerber-Hinweis:</td><td><?=utf8_encode($bewerber_hinweis);?></td><tr>




</table>

<div style="position:absolute;left:600px; width:300px;">
<?if(isset($ts_viewer_code) && $ts_oeffentlich == 1) {
  echo $ts_viewer_code;
}
?>
</div>



</div>
<br><br><br>
