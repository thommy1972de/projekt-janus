<?
include 'inc/functions.php';
include 'inc/defines.php';
include 'db/conn.php';
$firmen_id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

$stmt4 = $pdo->prepare("SELECT * FROM firmen WHERE id = :id");
$stmt4->bindParam(':id', $firmen_id);
$stmt4->execute();


while($row = $stmt4->fetch()) {

    $id_fa = $row['id'];
    $firmenname = $row['firmenname'];
    $firmenlogo = $row['firmen_logo'];
    $firmenheader = $row['firmen_header'];
    $beschreibung = $row["beschreibung"];
    $werbebild = $row["werbebild"];
    $werbetext = $row["werbetext"];
	
	$seit_datum = $row["datum"];
	$inhaber_name = $row["vorname"]." ".substr($row["nachname"], 0,1).".";
	$mitarbeiter = $row["mitarbeiter"];
	$bewerber_hinweis = $row["bewerber_hinweis"];
	$ts_ip = $row["teamspeak_url"];
	$ts_port = $row["teamspeak_port"];
	$facebook = (empty($row["fb_site"])) ? "Nicht angegeben" : $row["fb_site"];
	$twitter = (empty($row["twitter_site"])) ? "Nicht angegeben" : $row["twitter_site"];
	
    if($firmenlogo == "") { $firmenlogo = "kl.png"; } else { $firmenlogo = $row['firmen_logo']; }
    if($firmenheader == "") { $firmenheader = "kl1.png"; } else { $firmenheader = $row['firmen_header']; }
}
?>
<!DOCTYPE html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Merienda" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
<meta property="og:title" content="<?=$firmenname;?>" />
<meta property="og:type" content="website" />
<meta property="fb:app_id" content="299605944253163" />
<meta property="ia:rules_url" content="<?=URL;?>/index_2.php?q=OUzEIPRWaIubLCaiK0A3KieWSS884yyB63vLK1eBIXK8w7YrO2B7gqFCwYoV6asgavpydXklM3WcSTif3BFfcYx5X7Yx5SszR7PU" />
<meta property="og:url" content="<?=URL;?>/f_ann.php?id=<?=$firmen_id;?>" />
<meta property="og:image" content="<?=URL;?>/img/firmenwerbung2/<?=$werbebild;?>" />
<meta property="og:description" content="<?=$werbetext;?>" />
</head>
<body>
<center>
  <table width="98%">
      <tr>
        <td width="45%" align="center">
          <h1>Willkommen in der Spedition<br><span style="font-size:10vh;"><?=$firmenname;?> !</span></h1>
        </td>
        <td align="center">
          <img src="img/firmenheader/<?=$firmenheader;?>" border="0" style="float:right" />
        </td>
    </tr>
</table>

<table width="98%">
  <tr>
  <td width="45%" align="center" style="font-size:34px; padding:20px">
    <?=nl2br($werbetext);?>
</td>

<td>

<table style="100%">
<td>
<td colspan="2" align="left"><h2>Daten über die Firma</h2></td><tr>
<td style="width:200px; border-bottom: 1px solid grey;" align="right">Inhaber:</td><td style="border-bottom: 1px solid grey;"><?=$inhaber_name;?></td><tr>
<td style="width:200px; border-bottom: 1px solid grey;" align="right">Gibt es seit:</td><td style="border-bottom: 1px solid grey;"><?=date("d.m.Y", $seit_datum);?></td><tr>
<td style="width:200px; border-bottom: 1px solid grey;" align="right">Mitarbeiter:</td><td style="border-bottom: 1px solid grey;"><?=$mitarbeiter;?></td><tr>
<? if(isset($ts3server)) { ?>
<td style="width:200px; border-bottom: 1px solid grey;" align="right">Teamspeak:</td><td style="border-bottom: 1px solid grey;"><a href="ts3server://<?=$ts3server;?>?port=<?=$ts_port;?>"><?=$ts3server.":".$ts_ip; ?></a></td><tr>
<? } else { ?>
	<td style="width:200px; border-bottom: 1px solid grey;" align="right">Teamspeak:</td><td style="border-bottom: 1px solid grey;">Nicht angegeben !</td><tr>
<? } ?>
<td style="width:200px; border-bottom: 1px solid grey;" align="right">Facebook:</td><td style="border-bottom: 1px solid grey;"><?=$facebook;?></td><tr>
<td style="width:200px; border-bottom: 1px solid grey;" align="right">Twitter:</td><td style="border-bottom: 1px solid grey;"><?=$twitter;?></td><tr>

<td style="width:200px; border-bottom: 1px solid grey;" align="right">Bewerber-Hinweis:</td><td style="border-bottom: 1px solid grey;"><?=utf8_encode($bewerber_hinweis);?></td><tr>


</table>

</td>
</td>
</tr>
</table>
<br>
<p style="font-size:34px">
<?=utf8_encode(nl2br($werbetext)); ?>
</p>
<a class="btn_green" target="_blank" href="<?=URL;?>">Sieh dir diese Firma auf Projekt: JANUS! an</a>

<br><br>oder, teile die Spedition auf deiner Facebook-Seite:<br><br>
<div style="position:fixed; bottom:10px; right:10px; text-align: reight; padding-right:20px;"><a href="<?URL;?>/index.php" target="_blank">Projekt:JANUS!</a></div>

<script type="text/javascript">
function fbshare(){
var sharer = "https://www.facebook.com/sharer/sharer.php?u=";
window.open(sharer + location.href,'sharer', 'width=626,height=436');
}
</script>
<a href="" class="btn_green" onclick="fbshare();">Diese Seite auf Facebook teilen</a>


<br><br><br>

</body>
</html>
