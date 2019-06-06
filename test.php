<?
include 'db/server.php';

$client_key = $_GET["client_key"];

$game_name = $_GET["game_name"];

$truck_gear = $_GET["truck_gear"];
$truck_modell = $_GET["truck_modell"];
$truck_marke = $_GET["truck_marke"];
$truck_speed = $_GET["truck_speed"];

$engine_rpm = $_GET["engine_rpm"];
$engine_rpm_max = $_GET["engine_rpm_max"];
$engine_fuel = $_GET["engine_fuel"];
$engine_fuel_max = $_GET['engine_fuel_max'];
$engine_on = $_GET["engine_on"];
$job_income = $_GET["job_income"];
$job_source_city = $_GET["job_source_city"];
$job_source_company = $_GET['job_source_company'];
$job_destination_city = $_GET["job_destination_city"];
$job_destination_company = $_GET["job_destination_company"];

echo $truck_gear;


$statement = $pdo_server->prepare("SELECT * FROM userdaten WHERE client_key = ?");
$statement->execute(array($client_key));
if($statement->rowCount() >= 1) {

  $stmt3 = $pdo_server->prepare("UPDATE userdaten SET game_name = :game_name, truck_gear = :truck_gear WHERE client_key = :client_key");
  $stmt3->bindParam(':game_name', $game_name);
  $stmt3->bindParam(':truck_gear', $truck_gear);
  $stmt3->bindParam(':client_key', $client_key);
  $stmt3->execute();


} else {

  $stmt3 = $pdo_server->prepare("INSERT INTO userdaten (client_key) VALUES (:client_key)");
  $stmt3->bindParam(':client_key', $client_key);
  $stmt3->execute();

}




?>
