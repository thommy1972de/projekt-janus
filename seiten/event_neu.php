<? onlinecheck($pdo); ?><h2>Neues Event planen</h2>
<form action="#" method="POST">
  <table width="90%"><tr>

    <?
    $header = $_GET["image"];
    if($header == "") { $header = "eventheader_1.jpg"; } ?>
    <td colspan="5" align="center"><img src="img/eventheader/<?=$header;?>" border="0" width="800px" /></td><tr>

    <form action="#" method="POST">
    <td width="300px" align="right">Header wählen:</td><td>

      <select name="header" onchange="this.form.submit()">
        <option selected>Auswahl</option>
          <option value="eventheader_1.jpg" <? if($header == "eventheader_1.jpg") { echo "selected"; } ?>>Version 1</option>
          <option value="eventheader_2.jpg" <? if($header == "eventheader_2.jpg") { echo "selected"; } ?>>Version 2</option>
        </select>
      </form>
      (Wird beim Wechseln, neu geladen)
    </td><tr>
      <?
      if(isset($_POST["header"])) {
        $header = $_POST["header"];
        ?>
        <meta http-equiv="refresh" content="0; URL=?q=qLBUhJkpwoOaPd5VselfiMxCS09EYTFWb4gynt8NKcQ16H2Iz7u3jADmvrZR&image=<?=$header;?>">
        <?
      } ?>


    <td width="300px" align="right">Name deines Events:</td><td><input type="text" name="titel" style="width:500px" placeholder="Name" /></td><tr>
    <td align="right">Datum & Uhrzeit des Events:</td><td><input type="date" name="datum" style="width:110px;" /> Uhrzeit: <input type="text" name="uhrzeit" style="width:110px;" /> Uhr</td><tr>

      <td align="right">Start-Ort:</td><td>
        <?
        $anz = 0;
        $json_url = "https://api.truckyapp.com/v2/map/cities/all";
        $json = file_get_contents($json_url);
        $data = json_decode($json, TRUE);
        $anz_stadt = count($data['response']);

        echo "<select name='startort' style='width:200px'>";
        while($anz <= $anz_stadt) {
          echo "<option value='".$data['response'][$anz]['realName']."'>".$data['response'][$anz]['realName']."</option>";
          $anz++;
        }
        echo "</select>";
      ?></td><tr>

        <td align="right">Ziel-Ort:</td><td>
          <?
          $anz = 0;
          $json_url = "https://api.truckyapp.com/v2/map/cities/all";
          $json = file_get_contents($json_url);
          $data = json_decode($json, TRUE);
          $anz_stadt = count($data['response']);

          echo "<select name='zielort' style='width:200px'>";
            echo "<option value='je nach Auftrag' selected>Unbekannt</option>";
          while($anz <= $anz_stadt) {
            echo "<option value='".$data['response'][$anz]['realName']."'>".$data['response'][$anz]['realName']."</option>";
            $anz++;
          }
          echo "</select>";
        ?></td><tr>


        <td align="right">Pausenzeit:</td><td>
          <select name="pausenzeit" style="width:100px">
            <option selected>Auswahl</option>
            <option value="5 Min">5 Min</option>
            <option value="10 Min">10 Min</option>
            <option value="15 Min">15 Min</option>
            <option value="20 Min">20 Min</option>
            <option value="25 Min">25 Min</option>
            <option value="30 Min">30 Min</option>
            <option value="35 Min">35 Min</option>
            <option value="40 Min">40 Min</option>
            <option value="45 Min">45 Min</option>
          </select>
        </td><tr>

          <td align="right">Pausen-Ort:</td><td>
            <?
            $anz = 0;
            $json_url = "https://api.truckyapp.com/v2/map/cities/all";
            $json = file_get_contents($json_url);
            $data = json_decode($json, TRUE);
            $anz_stadt = count($data['response']);

            echo "<select name='pausenort' style='width:200px'>";
            echo "<option value='Wird spontan Entschieden' selected>Wird spontan Entschieden</option>";
            while($anz <= $anz_stadt) {
              echo "<option value='".$data['response'][$anz]['realName']."'>".$data['response'][$anz]['realName']."</option>";
              $anz++;
            }
            echo "</select>";
          ?></td><tr>

            <td align="right">Wir fahren auf dem Server:</td><td>
              <?
              $anz = 0;
              $json_url = "https://api.truckyapp.com/v2/truckersmp/servers";
              $json = file_get_contents($json_url);
              $data = json_decode($json, TRUE);
              $anz_server = count($data['response']);

              echo "<select name='server' style='width:200px'>";
              while($anz <= $anz_server) {
                echo "<option value='".$data['response']['servers'][$anz]['name']."'>(".$data['response']['servers'][$anz]['game']." ) ".$data['response']['servers'][$anz]['name']."</option>";
                $anz++;
              }
              echo "</select>";
            ?></td><tr>

              <td align="right">Wird ein Trailer benötigt ?</td><td>
                <select name="trailer" style="width:200px">
                  <option selected>Nein</option>
                  <option value="Kühlgutauflieger">Kühlgutauflieger</option>
                  <option value="Kühlgutauflieger (aerodynamisch) ">Kühlgutauflieger (aerodynamisch) </option>
                  <option value="Auflieger mit Kran ">Auflieger mit Kran </option>
                  <option value="Siloauflieger">Siloauflieger</option>
                  <option value="Tankauflieger (Chemikalien) ">Tankauflieger (Chemikalien) </option>
                  <option value="Curtainsider">Curtainsider</option>
                  <option value="Tankauflieger (Lebensmittel) ">Tankauflieger (Lebensmittel) </option>
                  <option value="Flachbettauflieger">Flachbettauflieger</option>
                  <option value="Tankauflieger (Treibstoff)">Tankauflieger (Treibstoff)</option>
                  <option value="Gooseneck Cargo 20">Gooseneck Cargo 20 </option>
                  <option value="Gooseneck Cargo 30">Gooseneck Cargo 30</option>
                  <option value="Gooseneck Cargo 40">Gooseneck Cargo 40</option>
                  <option value="Gooseneck Cistern">Gooseneck Cistern</option>
                  <option value="Isolierter Kofferauflieger ">Isolierter Kofferauflieger </option>
                  <option value="Tieflader">Tieflader</option>
                  <option value="Rungenauflieger">Rungenauflieger</option>
                  <option value="Sattelkipper">Sattelkipper</option>

                  <option value="Pritschenauflieger, Standard ">Pritschenauflieger, Standard </option>
                </select>
              </td><tr>

                <td align="right" valign="top">Benötigte DLC ETS2: </td><td>

                      <p><input type="checkbox" name="going" id="1" value="1" /><label for="1">Going East!</label></p>
                      <p><input type="checkbox" name="scandinavia" id="2" value="1" /><label for="2">Scandinavia</label></p>
                      <p><input type="checkbox" name="france" id="3" value="1" /><label for="3">Vive la France !</label></p>
                      <p><input type="checkbox" name="italia" id="4" value="1" /><label for="4">Italia</label></p>
                      <p><input type="checkbox" name="baltic" id="5" value="1" /><label for="5">Beyond the Baltic Sea</label></p>

                  </td><tr></td><tr>

                  <td align="right" valign="top" style="padding-top:20px">Benötigte DLC ATS: </td><td>
                      <p style="padding-top:20px"><input type="checkbox" name="arizona" id="6" value="1" /><label for="6">Arizona</label></p>
                      <p><input type="checkbox" name="mexico" id="7" value="1" /><label for="7">New Mexico</label></p>
                      <p><input type="checkbox" name="oregon" id="8" value="1" /><label for="8">Oregon</label></p>
                      <p><input type="checkbox" name="washington" id="9" value="1" disabled="disabled" /><label for="9">Washington</label></p>
                  </td><tr>




      <td align="right" valign="top">Beschreibe dein Event den anderen Fahrern:</td><td><textarea name="beschreibung" cols="69" rows="6" style="text-align:left;"></textarea></td><tr>


        <td align="right" valign="top"></td><td><input type="submit" class="btn_senden" name="event_eintragen" value="Event eintragen" /></td><tr>

    </table>

    <br><br><br><br>


    <?
    if(isset($_POST["event_eintragen"])) {

      $header = filter_input(INPUT_POST, "header", FILTER_SANITIZE_STRING);
      $titel = filter_input(INPUT_POST, "titel", FILTER_SANITIZE_STRING);
      $datum = filter_input(INPUT_POST, "datum", FILTER_SANITIZE_STRING);
      $uhrzeit = filter_input(INPUT_POST, "uhrzeit", FILTER_SANITIZE_STRING);
      $startort = filter_input(INPUT_POST, "startort", FILTER_SANITIZE_STRING);
      $zielort = filter_input(INPUT_POST, "zielort", FILTER_SANITIZE_STRING);
      $pausenzeit = filter_input(INPUT_POST, "pausenzeit", FILTER_SANITIZE_STRING);
      $pausenort = filter_input(INPUT_POST, "pausenort", FILTER_SANITIZE_STRING);
      $server = filter_input(INPUT_POST, "server", FILTER_SANITIZE_STRING);
      $trailer = filter_input(INPUT_POST, "trailer", FILTER_SANITIZE_STRING);
      $beschreibung = filter_input(INPUT_POST, "beschreibung", FILTER_SANITIZE_STRING);

      $dlc_going_east = filter_input(INPUT_POST, "going", FILTER_VALIDATE_INT);
      $dlc_scandinavia = filter_input(INPUT_POST, "scandinavia", FILTER_VALIDATE_INT);
      $dlc_france = filter_input(INPUT_POST, "france", FILTER_VALIDATE_INT);
      $dlc_italia = filter_input(INPUT_POST, "italia", FILTER_VALIDATE_INT);
      $dlc_baltic = filter_input(INPUT_POST, "baltic", FILTER_VALIDATE_INT);

      $dlc_arizona = filter_input(INPUT_POST, "arizona", FILTER_VALIDATE_INT);
      $dlc_mexico = filter_input(INPUT_POST, "mexico", FILTER_VALIDATE_INT);
      $dlc_oregon = filter_input(INPUT_POST, "oregon", FILTER_VALIDATE_INT);
      //$dlc_washington = filter_input(INPUT_POST, "washington", FILTER_VALIDATE_INT);

      if($dlc_going_east == "") { $dlc_going_east = "0"; }
      if($dlc_scandinavia == "") { $dlc_scandinavia = "0"; }
      if($dlc_france == "") { $dlc_france = "0"; }
      if($dlc_italia == "") { $dlc_italia = "0"; }
      if($dlc_baltic == "") { $dlc_baltic = "0"; }
      if($dlc_arizona == "") { $dlc_arizona = "0"; }
      if($dlc_mexico == "") { $dlc_mexico = "0"; }
      if($dlc_oregon == "") { $dlc_oregon = "0"; }


      $stmt2 = $pdo->prepare("INSERT INTO events (header,titel,datum,uhrzeit,server,von_wo,nach_wo,pause,pausenort,trailer,beschreibung, dlc_going_east, dlc_scandinavia, dlc_france, dlc_italia, dlc_baltic, dlc_arizona, dlc_mexico, dlc_oregon) VALUES (:header,:titel,:datum,:uhrzeit,:server,:von_wo,:nach_wo,:pause,:pausenort,:trailer,:beschreibung,:dlc_going_east,:dlc_scandinavia,:dlc_france,:dlc_italia,:dlc_baltic,:dlc_arizona,:dlc_mexico,:dlc_oregon)");
      $stmt2->bindParam(':header', $header);
      $stmt2->bindParam(':titel', $titel);
      $stmt2->bindParam(':datum', $datum);
      $stmt2->bindParam(':uhrzeit', $uhrzeit);
      $stmt2->bindParam(':server', $server);
      $stmt2->bindParam(':von_wo', $startort);
      $stmt2->bindParam(':nach_wo', $zielort);
      $stmt2->bindParam(':pause', $pausenzeit);
      $stmt2->bindParam(':pausenort', $pausenort);
      $stmt2->bindParam(':trailer', $trailer);
      $stmt2->bindParam(':beschreibung', $beschreibung);
      $stmt2->bindParam(':dlc_going_east', $dlc_going_east);
      $stmt2->bindParam(':dlc_scandinavia', $dlc_scandinavia);
      $stmt2->bindParam(':dlc_france', $dlc_france);
      $stmt2->bindParam(':dlc_italia', $dlc_italia);
      $stmt2->bindParam(':dlc_baltic', $dlc_baltic);
      $stmt2->bindParam(':dlc_arizona', $dlc_arizona);
      $stmt2->bindParam(':dlc_mexico', $dlc_mexico);
      $stmt2->bindParam(':dlc_oregon', $dlc_oregon);

      $stmt2->execute();

      ?>
      <meta http-equiv="refresh" content="0; URL=?q=V8nGOa5P7sXdN2et3xuzpRQHS6IChEqLBDMTky4wJoWYlcKrF90Zimfg1jvb">
      <?

    }
    ?>
