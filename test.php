<?php

include("connect_db.php");
$sql_select = "SELECT * FROM persons";
$statement = $db_work->prepare($sql_select);
$statement->execute();
while($result = $statement->fetch(PDO::FETCH_ASSOC))
{

  echo "<pre>";
  print_r($result);
  echo "</pre>";
}
