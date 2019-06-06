<?
onlinecheck($pdo);

if(isset($_POST['buch'])) {
  $buchstabe = $_POST['buch'];
  $statement = $pdo->prepare("SELECT * FROM firmen WHERE firmenname LIKE '".$buchstabe."%'");
}

else {
  $statement = $pdo->prepare("SELECT * FROM firmen ORDER BY firmenname ASC");
}

  $statement->execute();
  $anz_firmen = $statement->rowCount();


// ################################  SPERRE AUSLESEN   ##############################
  $statement2 = $pdo->prepare("SELECT * FROM user WHERE email = ?");
  $statement2->execute(array($_SESSION['username']));
  while($row_user = $statement2->fetch()) { $sperre = $row_user['naechste_bewerbung']; }
// ################################  SPERRE AUSLESEN ENDE   ########################


// ################################  SUCHEFELD ANFANG   ########################

    echo "<table width='70%'><tr>";
    echo "<form action='#' METHOD='POST'>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value=''>#</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='a'>A</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='b'>B</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='c'>C</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='d'>D</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='e'>E</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='f'>F</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='g'>G</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='h'>H</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='i'>I</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='j'>J</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='k'>K</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='l'>L</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='m'>M</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='n'>N</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='o'>O</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='p'>P</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='q'>Q</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='r'>R</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='s'>S</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='t'>T</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='u'>U</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='v'>V</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='w'>W</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='x'>X</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='y'>Y</button></a>";
    echo "<td><button class='btn_grey' type='submit' name='buch' value='z'>Z</button></a>";

    echo "</form></table>";
// ################################  SUCHEFELD ENDE   ########################



  echo "<table width='100%'><tr>";
  echo "<td width='50%' style='border-bottom:1px solid grey;'>Firmenname</td>";
  echo "<td width='10%' style='border-bottom:1px solid grey;'>Mitarbeiter</td>";
  echo "<td width='40%' style='border-bottom:1px solid grey;'>In dieser Firma bewerben</td>";
  echo "</tr>";



  if($anz_firmen == 0) { echo "<td colspan='3'><center><h2>Es sind keine Firmen registriert !</h2></center>"; } else {
    while($row = $statement->fetch()) {

      echo "<tr><td><a class='link' href='?23f426c4f4013282f0af720151cd52e6=".$row['einmalige_id']."&q=8gVwkb8n8BaBPmY8bDRKzehtfO8l2GIK3tlYxa8JxE5jIFZ7vuWuGFSpVt5hpmBbyjgCWwEs541wScFt3MTZUZyYRS1rcaBKIvZt'>".$row['firmenname']."</a></td>";
      echo "<td>".$row['mitarbeiter']."</td>";

      if (!isset($_SESSION['username'])) { echo "<td>Du bist nicht angemeldet ! &nbsp;&nbsp;<a class='link' href='?q=RqRB4Ybfszgln4eM82QGNgLdb9noE5mrD2DJigLv65yX53CjdC0i4n7Tmyl03XwChFQdKuxKP0gdS1OuySpVmghwtb101XvgQAww'>Jetzt Registrieren</a></td></tr>";  } else {
        if($_SESSION['firma'] == 1) { echo "<td>Als Firmeninhaber nicht möglich !</td></tr>"; } else {
          if($sperre >= TIME()) { echo "<td>Du bist noch bis ".date('d.m.Y - H:i', $sperre)." Uhr für Bewerbungen gesperrt !</td></tr>"; } else {
      echo "<td><a class='link' href='?q=XPOF8mjsfvApu4DHgybC1uwwMt9GEYv2ApdxTN5zgOWTB5s2sdwVCIM8F8cRFAw0QQVSck88ItbYW9Ab3d7H5Lh1fWCkm7HI3U3k&gzkgjrt4hh58jjt65=".$row['einmalige_id']."'>Bewerbung schreiben</a></td></tr>"; }
    }}}
  echo "</table>";
}

if($_SESSION['firma'] == 0) { echo "<hr><center><a class='btn_senden' href='?q=AK1PLrshWBEuImVhGosA15aF4MjXdbiOfkUxASesTVgTq4LDoz12FLA5ZD4d0TBrkTWLzJ5GCUhxs2X1wOFttrsMM0foSKS9GA7A'>Eigene Firma gründen</a></center>"; }

echo "<br/><br/><hr><center><span style='color:red'><a href='#'>Wichtig: </a>&nbsp;1. Aus Sicherheitsgründen kannst du dich nur alle 3 Tage bei einer neuen Spedition bewerben !<br>2. Du kannst nur in einer Spedition vertreten sein.<br>3. Wenn du eine Firma hast, sind Bewerbungen nicht möglich!<br>4. Bei mehr als 3 Verwarnungen, kannst du dich nicht mehr Bewerben.</span></center><hr><br/><br/><br/><br/>";


?>
