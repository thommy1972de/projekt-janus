<?

abmelden($_SESSION['username'], $pdo);

session_unset();
session_destroy();

$_SESSION['username'] = "";


echo "<center><div class='loader'>Loading...</div><h1>Du wirst vom System abgemeldet</h1>und gleich Weitergeleitet...</center><br><br>";
zitat($pdo);
?><meta http-equiv="refresh" content="1; URL=?q=V7csiaGV3c9bgDE9pw8dceGmg40KvTkAOmxlEd6qjtPXGiVpUww8egIQy4RyjmH2"><?
