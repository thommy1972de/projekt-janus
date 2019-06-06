<? onlinecheck($pdo); ?><? $ei = filter_input(INPUT_GET, "zetifaq", FILTER_SANITIZE_STRING); ?>

<center>

  <form action="?q=4l1c2BAoDMQDCzdZp3ktAPqKFfcptlCj4y1XTLVMGxqG4RmOlcoVgI99g0lz1f7nQCq0M2So1R5FHDJ7cG4RBYFalF8NuPXIykZm" method="POST">
    <h2>Was willst  du Melden ?</h2>
    <br>
    <input type="hidden" name="e_i" value="<?=$ei;?>" />
    <select name="was" onchange="this.form.submit()">
        <optgroup label="Im Spiel">
          <option value="Rammen">Rammen</option>
          <option value="Blockieren">Blockieren</option>
          <option value="Fahren in falscher Richtung">Fahren in falscher Richtung</option>
          <option value="Rücksichtsloser Fahrstil">Rücksichtsloser Fahrstil</option>
          <option value="Unangemessenes Verhalten im Chat">Unangemessenes Verhalten im Chat</option>
          <option value="Unangemessenes Verhalten im CB-Funk">Unangemessenes Verhalten im CB-Funk</option>
          <option value="Unangemessener Benutzername">Unangemessener Benutzername</option>
          <option value="Nicht erlaubter Hack oder Bug-Using">Nicht erlaubter Hack oder Bug-Using</option>
          <option value="Sonstiges">Sonstiges</option>
        </optgroup>
        <optgroup label="Auf der Webseite">
          <option value="Vulgäre Ausdrucksweise">Vulgäre Ausdrucksweise</option>
          <option value="Unangebrachter Kommentar">Unangebrachter Kommentar</option>
          <option value="Spamming">Spamming</option>
          <option value="Hacking">Hacking</option>
          <option value="Rechtspopulismus">Rechtspopulismus</option>
          <option value="Sonstiges">Sonstiges</option>
        <optgroup>
      </select>
    </form>
  </center>
