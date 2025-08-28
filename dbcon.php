<?php
/*
$servername = "sql112.epizy.com";
$username = "epiz_31399905";
$password = "ULDh5iagarubHc";
$database = "epiz_31399905_counteringdb";*/

$servername = "localhost";
$username = "root";
$password = "";
$database = "gatepassdb";

try {

  $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // set the PDO error mode to exception
  // echo "Connected Successfully";

} catch (PDOException $e) {

  echo "Connection Failed" . $e->getMessage();
}
