<?php 

$dsn = "mysql:host=localhost;dbname=projects";
$user = "root";

try {
  $db_work = new PDO($dsn, $user, "");

} catch (PDOException $e) {
  echo "CAN NOT CONNECT" . $e;
}