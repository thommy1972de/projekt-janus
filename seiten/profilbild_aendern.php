<? onlinecheck($pdo); ?><?=pfeil_back(); ?> <h2>Dein Profilbild ändern</h2>

<form action="#" method="post" enctype="multipart/form-data">
    Wähle dein neues Firmenlogo:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Bild hochladen" name="submit">
</form>

<?php
if(isset($_POST['submit'])) {

  $statement9 = $pdo->prepare("SELECT * FROM user WHERE email = ?");
  $statement9->execute(array($_SESSION['username']));
    while($row3 = $statement9->fetch()) {
      $datei = "img/userimages/".$row3['profilbild'];
        unlink ($datei);
      }



$target_dir = "img/userimages/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Deine Datei ist kein Bild !<br/>";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, Datei existiert bereits.<br/>";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 1000000) {
    echo "Sorry, Bild ist zu Groß. (max. 1 MB)<br/>";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "Sorry, nur JPG, JPEG, PNG & GIF - Bilder sind erlaubt.<br/>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, Datei konnte nicht hochgeladen werden.<br/>";
    exit();
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "Dein Bild ". basename( $_FILES["fileToUpload"]["name"]). " wurde hochgeladen.";
    } else {
        echo "Sorry, es gab ein Problem mit dem Hochladen des Bildes.<br/>";
    }
}

$stmt1 = $pdo->prepare("UPDATE user SET profilbild = :bild WHERE email = :email");
$stmt1->bindParam(':bild', basename($_FILES["fileToUpload"]["name"]));
$stmt1->bindParam(':email', $_SESSION['username']);
$stmt1->execute();

?>
<?=zitat($pdo);?>
<meta http-equiv="refresh" content="2; URL=?q=10ioL9Kzm2YaEG6Tb4tot2bpGWr3kXO678zXFsATuJEaynLaGmD0jloGEDRdnwJtULKZg9uyuMVvvrY227nEugzfacQmZL4n3CTG">
<?

}
?>
